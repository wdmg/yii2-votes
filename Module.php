<?php

namespace wdmg\votes;

/**
 * Yii2 Votes
 *
 * @category        Module
 * @version         0.0.10
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-votes
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use wdmg\base\BaseModule;
use wdmg\votes\components\Votes;

/**
 * Votes module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\votes\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = "votes/index";

    /**
     * @var string, the name of module
     */
    public $name = "Votes";

    /**
     * @var string, the description of module
     */
    public $description = "User voting module";

    /**
     * @var string the module version
     */
    private $version = "0.0.10";

    /**
     * @var integer, priority of initialization
     */
    private $priority = 10;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Set version of current module
        $this->setVersion($this->version);

        // Set priority of current module
        $this->setPriority($this->priority);

    }

    /**
     * {@inheritdoc}
     */
    public function dashboardNavItems($options = false)
    {
        $items = [
            'label' => $this->name,
            'url' => [$this->routePrefix . '/'. $this->id],
            'icon' => 'fa fa-fw fa-check-square',
            'active' => in_array(\Yii::$app->controller->module->id, [$this->id])
        ];
        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        parent::bootstrap($app);

        // Configure votes component
        $app->setComponents([
            'votes' => [
                'class' => Votes::class
            ]
        ]);
    }
}