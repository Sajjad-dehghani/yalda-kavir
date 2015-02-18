<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "exn8o_jshopping_categories".
 *
 * @property integer $category_id
 * @property string $category_image
 * @property integer $category_parent_id
 * @property integer $category_publish
 * @property integer $category_ordertype
 * @property string $category_template
 * @property integer $ordering
 * @property string $category_add_date
 * @property integer $products_page
 * @property integer $products_row
 * @property integer $access
 * @property string $name_en-GB
 * @property string $alias_en-GB
 * @property string $short_description_en-GB
 * @property string $description_en-GB
 * @property string $meta_title_en-GB
 * @property string $meta_description_en-GB
 * @property string $meta_keyword_en-GB
 * @property string $name_fa-IR
 * @property string $alias_fa-IR
 * @property string $short_description_fa-IR
 * @property string $description_fa-IR
 * @property string $meta_title_fa-IR
 * @property string $meta_description_fa-IR
 * @property string $meta_keyword_fa-IR
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jshopping_categories}}';
    }

    public function fields()
    {
        return [
            'category_id',
            'image' => function ($model) {
                return $model['category_image']
                    ? Yii::$aliases['@baseCategoryImagePath'] . '/' . $model['category_image']
                    : "";

            },
            'category_add_date',
            'languages' => function ($model) {
                return [
                    'fa' => [
                        'name' => $model['name_fa-IR'],
                        'path' => $model['alias_fa-IR']
                            ? Yii::$aliases['@siteFaCategoryPatch'] . '/' . $model['alias_fa-IR']
                            : ""
                    ],
                    'en' => [
                        'name' => $model['name_en-GB'],
                        'path' => $model['alias_en-GB']
                            ? Yii::$aliases['@siteEnCategoryPatch'] . '/' . $model['alias_en-GB']
                            : ""
                    ]
                ];
            },
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_parent_id', 'category_publish', 'category_ordertype', 'ordering', 'products_page', 'products_row', 'access'], 'integer'],
            [['ordering', 'name_en-GB', 'alias_en-GB', 'short_description_en-GB', 'description_en-GB', 'meta_title_en-GB', 'meta_description_en-GB', 'meta_keyword_en-GB', 'name_fa-IR', 'alias_fa-IR', 'short_description_fa-IR', 'description_fa-IR', 'meta_title_fa-IR', 'meta_description_fa-IR', 'meta_keyword_fa-IR', 'name_en-US', 'alias_en-US', 'short_description_en-US', 'description_en-US', 'meta_title_en-US', 'meta_description_en-US', 'meta_keyword_en-US'], 'required'],
            [['category_add_date'], 'safe'],
            [['short_description_en-GB', 'description_en-GB', 'meta_description_en-GB', 'meta_keyword_en-GB', 'short_description_fa-IR', 'description_fa-IR', 'meta_description_fa-IR', 'meta_keyword_fa-IR', 'short_description_en-US', 'description_en-US', 'meta_description_en-US', 'meta_keyword_en-US'], 'string'],
            [['category_image', 'name_en-GB', 'alias_en-GB', 'meta_title_en-GB', 'name_fa-IR', 'alias_fa-IR', 'meta_title_fa-IR', 'name_en-US', 'alias_en-US', 'meta_title_en-US'], 'string', 'max' => 255],
            [['category_template'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_image' => 'Category Image',
            'category_parent_id' => 'Category Parent ID',
            'category_publish' => 'Category Publish',
            'category_ordertype' => 'Category Ordertype',
            'category_template' => 'Category Template',
            'ordering' => 'Ordering',
            'category_add_date' => 'Category Add Date',
            'products_page' => 'Products Page',
            'products_row' => 'Products Row',
            'access' => 'Access',
            'name_en-GB' => 'Name En  Gb',
            'alias_en-GB' => 'Alias En  Gb',
            'short_description_en-GB' => 'Short Description En  Gb',
            'description_en-GB' => 'Description En  Gb',
            'meta_title_en-GB' => 'Meta Title En  Gb',
            'meta_description_en-GB' => 'Meta Description En  Gb',
            'meta_keyword_en-GB' => 'Meta Keyword En  Gb',
            'name_fa-IR' => 'Name Fa  Ir',
            'alias_fa-IR' => 'Alias Fa  Ir',
            'short_description_fa-IR' => 'Short Description Fa  Ir',
            'description_fa-IR' => 'Description Fa  Ir',
            'meta_title_fa-IR' => 'Meta Title Fa  Ir',
            'meta_description_fa-IR' => 'Meta Description Fa  Ir',
            'meta_keyword_fa-IR' => 'Meta Keyword Fa  Ir',
            'name_en-US' => 'Name En  Us',
            'alias_en-US' => 'Alias En  Us',
            'short_description_en-US' => 'Short Description En  Us',
            'description_en-US' => 'Description En  Us',
            'meta_title_en-US' => 'Meta Title En  Us',
            'meta_description_en-US' => 'Meta Description En  Us',
            'meta_keyword_en-US' => 'Meta Keyword En  Us',
        ];
    }
}
