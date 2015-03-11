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

    private static function seprateImages($string)
    {
        preg_match_all('/<img[^>]+>/i', $string, $result);
        $res = [];
        for ($i = 0, $count = count($result[0]); $i < $count; $i++) {
            if (preg_match('/src="([^"]*)"/i', $result[0][$i], $tt)) {
                $res[] = ['http://yaldayekavir.com/' . $tt[1]];
            }
        }
        return $res;
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
                $short_description = str_replace(["\n", "\r", "<br />", "&nbsp;"], "", nl2br(strip_tags($items['introtext'])));
                $result[] = [
                    'id' => $items['id'],
                    'type' => $items['cat_title'],
                    'title' => $items['title'],
                    'language' => $items['language'],
                    'images' => self::seprateImages(str_replace(["\n", "\r", "<br />", "&nbsp;"], "", nl2br(strip_tags($items['introtext'], '<img>')))),
                    'short_description' => $short_description,
                    'full_text' => $items['fulltext'] == ""
                        ? $short_description
                        : str_replace(["\n", "\r", "<br />", "&nbsp;"], "", nl2br(strip_tags($items['fulltext'])))
                ];
            }
            $getResponse = Yii::$app->getResponse();
            $getResponse->setStatusCode(200);
            return $result;

        } else {
            return [];
        }
    }
}