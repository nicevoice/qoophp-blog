<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Widgets\HotArticles;
use Common\WidgetComponent;
use Models\Article;

class HotArticles extends WidgetComponent
{
    public function initialize($param)
    {
        $limit = isset($params['limit']) ? $params['limit'] : 5;
        $criteria = array(
            'order' => 'view_count desc, create_date desc',
            'limit' => $limit
        );
        $model = Article::find($criteria);

        $this->render('list', array('model'=>$model));
    }
} 