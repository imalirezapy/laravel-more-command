<?php

namespace Theanik\LaravelMoreCommand\Commands;

use Mockery\Exception;
use PHPUnit\Runner\ReflectionException;
use Theanik\LaravelMoreCommand\Support\FileGenerator;
use Theanik\LaravelMoreCommand\Support\GenerateFile;

class StrategyCommand extends CommandGenerator
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:strategy {context} {--s|strategy=*} {--i|interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make:strategy
    {context: name of the context}
    {--s|strategy: make multiple strategies (optional)}
    {--i|interface: with interface (optional)}
';
    private $replaces;


    private function formatPath($path)
    {
        return ucwords(
            preg_replace('/[\\\|\/]+/', DIRECTORY_SEPARATOR, trim($path)),
            DIRECTORY_SEPARATOR
        );
    }

    private function resolvePathAndContext($path)
    {
        $path = $this->formatPath($path);
        $path = explode(DIRECTORY_SEPARATOR, $path);

        if (count($path) == 1) {
            return [$path[0], $path[0]];
        }

        $context = end($path);
        array_pop($path);
        $path = implode(DIRECTORY_SEPARATOR, $path);

        return [$context, $path];
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('context');
        [$context, $path] = $this->resolvePathAndContext($path);

        $this->replaces['class_namespace'] = $this->getServiceNamespaceFromConfig() . "\\Services\\$path";
        $this->replaces['class'] = $context;
        $this->replaces['interface_namespace'] = $this->replaces['class_namespace'] . "\\{$context}Interface";
        $this->replaces['interface'] = "{$context}Interface";

        $path = base_path("app\\Services\\$path");

        $file = $path . DIRECTORY_SEPARATOR . $context . '.php';

        $this->mkDir($path);

        $content = $this->getTemplateContents();


        if (file_exists($file)) {
            $this->error("Context  already exists.");
            return;
        };


        (new FileGenerator($file, $content))->generate();
        $this->info("Created : {$file}");


        if ($this->option('interface') === true) {
            $interfaceFile = $path . DIRECTORY_SEPARATOR . "{$context}Interface.php";
            $interfaceContents = $this->getInterfaceTemplateContents();

            (new FileGenerator($interfaceFile, $interfaceContents))->generate();

            $this->info("Created : {$interfaceFile}");
        }

        foreach ($this->option('strategy') as $strategy)
        {
            $strategy = str_ends_with($strategy, 'Strategy') ? $strategy : "{$strategy}Strategy";
            $content = $this->getStrategyTemplateContents($strategy);
            $file = $path . DIRECTORY_SEPARATOR . $strategy . '.php';
            (new FileGenerator($file, $content))->generate();
            $this->info("Created : {$file}");
        }

    }

    protected function getInterfaceTemplateContents(): string
    {
        return (new GenerateFile(__DIR__ . "/stubs/interface.stub",$this->replaces))->render();
    }

    protected function getStrategyTemplateContents($class): string
    {
        $strategy = 'strategy';
        if ($this->option('interface')) {
            $strategy = 'strategy-interface';
        }
        return (new GenerateFile(__DIR__ . "/stubs/$strategy.stub", [
            'class_namespace' => $this->replaces['class_namespace'],
            'class' => $class,
            'interface_namespace' => $this->replaces['interface_namespace'],
            'interface' => $this->replaces['interface'],
        ]))->render();
    }

    private function mkDir($path)
    {
        try {
            if (!is_dir($path)) {

                return $this->laravel['files']->makeDirectory($path, 0777, true);
            }
        } catch (Exception $exception) {
            return false;
        }
    }

    protected function getStubFilePath(): string
    {
        if ($this->option('interface') === true) {
            $stub = '/stubs/context-interface.stub';
        } else {
            $stub = '/stubs/context.stub';
        }

        return $stub;
    }


    protected function getTemplateContents(): string
    {
        return (new GenerateFile(__DIR__ . $this->getStubFilePath(), $this->replaces))->render();
    }


    protected function getDestinationFilePath(): string
    {
        return 'string';
    }
}