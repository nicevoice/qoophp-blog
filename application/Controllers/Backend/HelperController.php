<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\BackendControllerBase;

class HelperController extends BackendControllerBase
{
    public function getArticleSlugAction()
    {
        $name = $this->request->get('data');
        $api_key = 'iDYOtufGSCzhAiuMHpdkxcN3';
        $url = 'http://openapi.baidu.com/public/2.0/bmt/translate?';
        $param = array(
            'client_id' => $api_key,
            'q' => $name,
            'from' => 'zh',
            'to' => 'en'
        );
        $request_url = $url . http_build_query($param);
        $result =  json_decode(file_get_contents($request_url),true);
        if(isset($result['error_code'])){
            echo 'error';
            exit;
        }
        $dst = $result['trans_result'][0]['dst'];
        $str = str_replace(' ', '-',strtolower($dst));
        $end_str = '';
        for($i = 0; $i<strlen($str); $i++){
            $char = $str{$i};
            if($char != '-' && (ord($char) > ord('z') || ord($char) < ord('a'))){
                continue;
            }
            $end_str .= $char;
        }

        echo trim($end_str,'-');
        exit;
    }
} 