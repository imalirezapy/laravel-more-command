![issues](https://img.shields.io/github/issues/imalirezapy/laravel-more-command??style=flat&logo=appveyor)
![forks](https://img.shields.io/github/forks/imalirezapy/laravel-more-command?style=flat&logo=appveyor)
![stars](https://img.shields.io/github/stars/imalirezapy/laravel-more-command?style=flat&logo=appveyor)
[![GitHub license](https://img.shields.io/github/license/imalirezapy/laravel-more-command)](https://github.com/imalirezapy/laravel-more-command/blob/master/LICENSE)

# Laravel More Command
Laravel More Command is a collection of a few `php artisan` commands. You can use it to create a __Repository, Repository with Interface, Service, Trait, View(blade file)__, and __Clear Log__ from the command line using `php artisan` command.\
<br />
[Note : This package also worked for [nWidart/laravel-modules](https://github.com/nWidart/laravel-modules)]

## Installation
Require the package with composer using the following command:

```
composer require imalirezapy/laravel-more-command --dev
```

Or add the following to your composer.json's require-dev section and `composer update`

```json
"require-dev": {
    "imalirezapy/laravel-more-command": "^1.0.0"
}
```

## Publish Package Configuration
```shell
 php artisan vendor:publish --provider="imalirezapy\LaravelMoreCommand\LaravelMoreCommandProvider" --tag="config"
```
### To Change Default Namespace [config/laravel-more-command.php]
```php
<?php
return [
    'repository-namespace' => 'App', // Your Desire Namespace for Repository Classes
    'service-namespace' => 'App', // Your Desire Namespace for Service Classes
];
```

## Artisan Command List

<!-- List Of Command -->
<div>
  <ol>
    <li><a href="#Make-Repository">Make Repository</a></li>
    <li><a href="#Make-Strategy">Make Strategy</a></li>
    <li><a href="#Make-Service">Make Service</a></li>
    <li><a href="#Make-Trait">Make Trait</a></li>
    <li><a href="#Make-View">Make View</a></li>
    <li><a href="#Log-Clear">Log Clear</a></li>
  </ol>
</div>
<!-- End list of command -->

<br />

## Make Repository

__Create a repository Class.__\
`php artisan make:repository your-repository-name`

Example:
```
php artisan make:repository UserRepository
```
or
```
php artisan make:repository Backend/UserRepository
```

The above will create a **Repositories** directory inside the **App** directory.\

__Create a repository with Interface.__\
`php artisan make:repository your-repository-name -i`

Example:
```
php artisan make:repository UserRepository -i
```
or
```
php artisan make:repository Backend/UserRepository -i
```
Here you need to put extra `-i` flag.
The above will create a **Repositories** directory inside the **App** directory.


###### In [nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) Modules

__Create a repository Class.__\
`php artisan module:make-repository your-repository-name {module-name}`

Example:
```
php artisan module:make-repository UserRepository Blog
```
or
```
php artisan module:make-repository Backend/UserRepository Blog
```

The above will create a **Repositories** directory inside the **{Module}** directory.

__Create a repository with Interface.__\
`php artisan module:make-repository your-repository-name {module-name} -i`

Example:
```
php artisan module:make-repository UserRepository -i Blog
```
or
```
php artisan module:make-repository Backend/UserRepository -i Blog
```
Here you need to put extra `-i` flag.
The above will create a **Repositories** directory inside the **{Module}** directory.
\

__An Example of created repository class:__

```
<?php

namespace App\Repositories;

class UserRepository
{
    public function __constuct()
    {
        //
    }
}


```

<br />

## Make Strategy

#### signature: `make:strategy {context} {--s|strategy=*} {--i|interface}`

__Create a context Class.__\
`php artisan make:stratey context-name`

Example:
```
php artisan make:strategy PaymentContext
```
or
```
php artisan make:repository Pay/PaymentContext
```

The above will create a **PaymentContext/Pay** directory inside the **app/Services** directory.\

__Create a strategies classes.__\
`php artisan make:strategy context-name {--s|strategy=*}   (multiple values allowed)`
Example:
```
php artisan make:strategy PaymentContext -sOnlinePayment -sOfflinePayment
```
or
```
php artisan make:strategy PaymentContext --strategy=OnlinePayment --strategy=OfflinePayment
```

__Create a strategy  with Interface.__\
`php artisan make:strategy context-name -i`

Example:
```
php artisan make:repository PaymentContext -i
```
or
```
php artisan make:repository Pay/PaymentContext -i
```
Here you need to put extra `-i` or `--interface` flag.


<br />

## Make Service

__Create a Service Class.__\
`php artisan make:service your-service-name`

Example:
```
php artisan make:service UserService
```
or
```
php artisan make:service Backend/UserService
```
The above will create a **Services** directory inside the **App** directory.


###### In [nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) Modules

`php artisan module:make-service your-service-name {module-name}`

Example:
```
php artisan module:make-service UserService
```
or
```
php artisan module:make-service Backend/UserService
```
The above will create a **Services** directory inside the **{Module}** directory.


<br />

## Make Trait

__Create a Trait.__\
`php artisan make:trait your-trait-name`

Example:
```
php artisan make:trait HasAuth
```
or
```
php artisan make:trait Backend/HasAuth
```
The above will create a **Traits** directory inside the **App** directory.

###### In [nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) Modules

`php artisan module:make-trait your-trait-name {module-name}`

Example:
```
php artisan module:make-trait HasAuth
```
or
```
php artisan module:make-trait Backend/HasAuth
```
The above will create a **Traits** directory inside the **{Module}** directory.




<br />

## Make View
__Create a view.__\
`php artisan make:view your-view-file-name`

Example:
```
php artisan make:view index
```
or
```
php artisan make:view user/index
```
The above will create a **blade** file inside the **/resource/views/** directory.

###### In [nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) Modules

`php artisan module:make-view your-view-file-name {module-name}`

Example:
```
php artisan module:make-view index
```
or
```
php artisan module:make-view user/index
```
The above will create a **blade** file inside the **{Module}/Resources/views/** directory.



<br />

## Log Clear

`php artisan log:clear`

The above will deleted all old log data from **/storage/logs/** directory.




# License

The MIT License (MIT). Please see [License](LICENSE) for more information.
