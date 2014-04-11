<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Widgets\RecentArticles;


use Common\WidgetComponent;
use Models\Article;

class RecentArticles extends WidgetComponent
{
    public function initialize($params)
    {
        $limit = isset($params['limit']) ? $params['limit'] : 5;
        $criteria = array(
            'conditions' => 'status = 1',
            'order' => 'create_date desc',
            'limit' => $limit
        );
        $model = Article::find($criteria);

        $this->render('list', array('model'=>$model));
    }
}