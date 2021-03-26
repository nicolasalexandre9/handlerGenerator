HANDLER GENERATOR
=============

# Installation

```
composer require 'nicolasalexandre9/handler-generator'
```
That's all, thanks Laravel auto discovery !


# Requirements

- Laravel >=7

# Configuration


## publish assets

```
php artisan vendor:publish --provider="Nicolasalexandre9\HandlerGenerator\HandlerGeneratorProvider" --tag="config"
```
Set all informations for generate PHPDoc
```
category  => '',
package   => '',
author'   => '',
license'  => '',
link'     => '',
```


## Use
```
php artisan generate:handler model Namespace1 Namespace2
```
Warning => respect case like the example (model in lowercase and namespace capitalize)

This command will generate the next files (IF NOT EXIST): 
* App\Models\Model.php
* App\Transformers\ModelTransformer.php
* App\Http\Requests\ModelRequest.php
* App\Http\Handlers\Core\ModelHandler.php
* App\Http\Handlers\Interfaces\ModelHandlerInterface.php
* App\Http\Controllers\Api\V1\AbstractModelsController.php
* App\Http\Controllers\Api\V1\Namespace1\ModelsController.php
* App\Http\Controllers\Api\V1\Namespace2\ModelsController.php

And update config\pattern.php for automatically binding new handler.
