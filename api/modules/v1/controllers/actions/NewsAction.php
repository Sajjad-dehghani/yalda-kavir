<?php
namespace api\modules\v1\controllers\actions;

use yii;

class NewsAction extends \yii\rest\Action
{
    public function run()
    {
        return $this->properData();
    }

    public function properData()
    {
        $query = (new yii\db\Query())
            ->select([
                'con.id', 'con.title', 'con.catid', 'con.alias', 'con.introtext', 'con.fulltext',
                'con.created', 'con.language', 'c.title as cat_title'
            ])
            ->from('{{%categories}} c')
            ->leftJoin('{{%content}} con', 'c.id = con.catid')
            ->leftJoin('{{%assets}} ast', 'ast.id = c.asset_id')
            ->where(['c.id' => 9])
            ->orWhere(['c.id' => 78])
            ->orWhere(['c.id' => 84])
            ->all();

        if ($query) {
            $result = [];
            foreach ($query as $items) {
                $result[] = [
                    'id' => $items['id'],
                    'type' => $items['cat_title'],
                    'title' => $items['title'],
                    'path' => ($items['language'] == 'fa-IR' || $items['language'] == "*") ?
                        Yii::$aliases['@siteFaPatch'] . '/' . $items['alias']
                        : Yii::$aliases['@siteEnPatch'] . '/' . $items['alias'],
                    'language' => $items['language'],
                    'short_description' => str_replace(["\n", "\r", "<br />", "&nbsp;"], "", (strip_tags($items['introtext']))),
                    'full_text' => str_replace(["\n", "\r", "<br/>", "&nbsp;"], "", (strip_tags($items['fulltext'])))
                ];
            }
            return $result;

        } else {
            return [];
        }
    }
}