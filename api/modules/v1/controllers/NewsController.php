<?php

namespace api\modules\v1\controllers;

use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class NewsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\products';

    public $enableCsrfValidation = false;
}


