<?php

namespace wdmg\votes;

/**
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 */

use yii\base\BootstrapInterface;
use Yii;
use wdmg\votes\components\Votes;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Get the module instance
        $module = Yii::$app->getModule('votes');

        // Get URL path prefix if exist
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        // Add module URL rules
        $app->getUrlManager()->addRules(
            [
                $prefix . '<module:votes>/' => '<module>/votes/index',
                $prefix . '<module:votes>/<controller:\w+>/' => '<module>/<controller>',
                $prefix . '<module:votes>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                [
                    'pattern' => $prefix . '<module:votes>/',
                    'route' => '<module>/votes/index',
                    'suffix' => '',
                ], [
                'pattern' => $prefix . '<module:votes>/<controller:\w+>/',
                'route' => '<module>/<controller>',
                'suffix' => '',
            ], [
                'pattern' => $prefix . '<module:votes>/<controller:\w+>/<action:\w+>',
                'route' => '<module>/<controller>/<action>',
                'suffix' => '',
            ],
            ],
            true
        );

        // Configure options component
        $app->setComponents([
            'votes' => [
                'class' => Votes::className()
            ]
        ]);
    }
}