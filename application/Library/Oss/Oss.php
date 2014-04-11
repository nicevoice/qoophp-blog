<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Oss;
include __DIR__ . '/aliyun.php';
use Aliyun\OSS\OSSClient;
use Phalcon\Mvc\User\Component;

class Oss extends Component{
    public function getBudgetList()
    {
        $buckets = $this->getClient()->listBuckets();

        var_dump($buckets);

        foreach ($buckets as $bucket) {
            echo 'Bucket: ' . $bucket->getName() . "\n";
        }
    }

    public function getClient()
    {
        $oss = $this->config->oss;
        return OSSClient::factory(array(
            'AccessKeyId' => $oss->key,
            'AccessKeySecret' => $oss->secret
        ));
    }
} 