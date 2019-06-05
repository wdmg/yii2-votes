<?php

namespace wdmg\votes;

/**
 * Yii2 Votes
 *
 * @category        Module
 * @version         0.0.5
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-votes
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use wdmg\base\BaseModule;

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
    private $version = "0.0.5";

    /**
     * @var integer, priority of initialization
     */
    private $priority = 10;

    public function bootstrap($app)
    {
        parent::bootstrap($app);

        // Configure votes component
        $app->setComponents([
            'votes' => [
                'class' => Votes::className()
            ]
        ]);
    }
}