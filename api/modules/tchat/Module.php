<?php
namespace api\modules\tchat;

use yii\filters\VerbFilter;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\tchat\controllers';

    public function init()
    {
        parent::init();
    }
}
