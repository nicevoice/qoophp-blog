<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;

class Bookmark extends ModelCommon
{
    public static function getList()
    {
        $criteria = array(
            'order' => 'create_date desc'
        );

        return self::find($criteria);
    }
} 