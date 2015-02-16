<?php
namespace api\modules\v1\controllers\actions;

use yii;

class ProductViewAction extends \yii\rest\Action
{
    public function run()
    {
        $params = Yii::$app->request->queryParams;
        if ($params['id']) {
            return $this->properData($params['id']);
        }
    }

    public function properData($id)
    {
        $query = (new yii\db\Query())
            ->select([
                'p.product_id', 'p.product_date_added', 'p.product_thumb_image', 'p.product_name_image',
                'p.name_en-GB', 'p.alias_en-GB', 'p.name_fa-IR', 'p.alias_fa-IR', 'p.short_description_en-GB',
                'p.description_en-GB', 'p.short_description_fa-IR', 'p.description_fa-IR', 'lb.name as label_name', 'lb.image as label_image'
            ])
            ->from('{{%jshopping_products_to_categories}} pc')
            ->leftJoin('{{%jshopping_products}} p', 'p.product_id = pc.product_id')
            ->leftJoin('{{%jshopping_product_labels}} lb', 'lb.id = p.label_id')
            ->where(['pc.category_id' => $id])
            ->all();

        if ($query) {
            $result = [];
            foreach ($query as $items) {
                $result[] = [
                    'product_id' => $items['product_id'],
                    'product_thumb_image' => $items['product_thumb_image']
                        ? Yii::$aliases['@baseProductImagePath'] . '/' . $items['product_thumb_image']
                        : "",

                    'product_name_image' => $items['product_name_image']
                        ? Yii::$aliases['@baseProductImagePath'] . '/' . $items['product_name_image']
                        : "",
                    'product_date_added' => $items['product_date_added'],
                    'label' => [
                        'name' => $items['label_name'],
                        'image' => $items['label_image']
                            ? Yii::$aliases['@baseLabelImagePath'] . '/' . $items['label_image']
                            : '',
                    ],
                    'languages' => [
                        'fa' => [
                            'name' => $items['name_fa-IR'],
                            'path' => $items['alias_fa-IR'],
                            'short_description' => strip_tags($items['short_description_fa-IR']),
                            'description' => strip_tags($items['description_fa-IR']),
                        ],
                        'en' => [
                            'name' => $items['name_en-GB'],
                            'path' => $items['alias_en-GB'],
                            'short_description' => strip_tags($items['short_description_en-GB']),
                            'description' => strip_tags($items['description_en-GB']),
                        ],
                    ]
                ];
            }
            return $result;

        } else {
            return [];
        }
    }
}