[![Yii2](https://img.shields.io/badge/required-Yii2_v2.0.33-blue.svg)](https://packagist.org/packages/yiisoft/yii2)
[![Downloads](https://img.shields.io/packagist/dt/wdmg/yii2-votes.svg)](https://packagist.org/packages/wdmg/yii2-votes)
[![Packagist Version](https://img.shields.io/packagist/v/wdmg/yii2-votes.svg)](https://packagist.org/packages/wdmg/yii2-votes)
![Progress](https://img.shields.io/badge/progress-in_development-red.svg)
[![GitHub license](https://img.shields.io/github/license/wdmg/yii2-votes.svg)](https://github.com/wdmg/yii2-votes/blob/master/LICENSE)

# Yii2 User votes
System of accounting user votes

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.33 and newest
* [Yii2 Base](https://github.com/wdmg/yii2-base) module (required)
* [Yii2 Users](https://github.com/wdmg/yii2-users) module (optionaly)

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-votes"`

After configure db connection, run the following command in the console:

`$ php yii votes/init`

And select the operation you want to perform:
  1) Apply all module migrations
  2) Revert all module migrations

# Migrations
In any case, you can execute the migration and create the initial data, run the following command in the console:

`$ php yii migrate --migrationPath=@vendor/wdmg/yii2-votes/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'votes' => [
            'class' => 'wdmg\votes\Module',
            'routePrefix' => 'admin'
        ],
        ...
    ],

# Routing
Use the `Module::dashboardNavItems()` method of the module to generate a navigation items list for NavBar, like this:

    <?php
        echo Nav::widget([
        'votes' => ['class' => 'navbar-nav navbar-right'],
            'label' => 'Modules',
            'items' => [
                Yii::$app->getModule('votes')->dashboardNavItems(),
                ...
            ]
        ]);
    ?>

# Status and version [in progress development]
* v.0.0.10 - Update README.md and dependencies versions
* v.0.0.9 - Fixed deprecated class declaration
* v.0.0.8 - Added extra options to composer.json and navbar menu icon
* v.0.0.7 - Added choice param for non interactive mode