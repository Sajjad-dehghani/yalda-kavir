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
    public $modelClass = 'api\modules\v1\models\news';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/html' => Response::FORMAT_JSON,
                    'charset' => 'UTF-8',
                ],
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'api\modules\v1\controllers\actions\NewsAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'view' => [
                'class' => 'api\modules\v1\controllers\actions\NewsViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ]);
    }
}


