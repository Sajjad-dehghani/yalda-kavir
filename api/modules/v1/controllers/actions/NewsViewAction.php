<?php
namespace api\modules\v1\controllers\actions;

use yii;

class NewsViewAction extends \yii\rest\Action
{
    public function run()
    {
        $params = Yii::$app->request->queryParams;
        if (isset($params['id'])) {
            return $this->properData($params['id']);
        }
    }

    public function properData($id)
    {
        $query = (new yii\db\Query())
            ->select([
                'con.id', 'con.title', 'con.catid', 'con.alias', 'con.introtext', 'con.fulltext',
                'con.created', 'con.language', 'c.title as cat_title'
            ])
            ->from('{{%categories}} c')
            ->leftJoin('{{%content}} con', 'c.id = con.catid')
            ->leftJoin('{{%assets}} ast', 'ast.id = c.asset_id')
            ->where(['con.id' => $id])
            ->all();

        if ($query) {
            $result = [];
            foreach ($query as $items) {
                $result[] = [
                    'id' => $items['id'],
                    'type' => $items['cat_title'],
                    'title' => $items['title'],
                    'language' => $items['language'],
                    'short_description' => $items['introtext'],
                    'full_text' => $items['fulltext']
                ];
            }
            return $result;

        } else {
            return [];
        }
    }
}