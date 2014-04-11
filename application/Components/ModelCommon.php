<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Common;

use Phalcon\Mvc\Model;

class ModelCommon extends Model
{
    const HAS_MANY = 'hasMany';
    const HAS_ONE = 'hasOne';
    const BELONGS_TO = 'belongsTo';
    const MANY_TO_MANY = 'hasManyToMany';

    protected $table_prefix = 'tb_';

    public function initialize()
    {
        //设置TableSource
        $this->_setSource();
        $this->_setRelations();
    }

    public function getErrorMessage()
    {
        $messages = '';
        foreach ($this->getMessages() as $message) {
            $messages .= "<p>" . $message->getMessage() . "</p>";
        }
        return $messages;
    }

    public function _di($name){
        return $this->getDI()->get($name);
    }

    /**
     * 便捷验证
     * @return bool
     */
    public function validation()
    {
        $rules = $this->rules();

        if (empty($rules)) reutrn;

        foreach ($rules as $rule) {
            $fields = explode(',', $rule[0]);
            $validator = $rule[1];

            foreach ($fields as $field) {
                $message = '';
                if (empty($rule['message'])) {
                    $message = $this->_getMessage($validator, trim($field));
                } else {
                    $message = str_replace('{column}', $field, $rule['message']);
                }
                $conf = array(
                    "field" => trim($field),
                    "message" => $message
                );

                $class = trim('\Phalcon\Mvc\Model\Validator\ ') . $validator;
                $this->validate(new $class($conf));
            }
        }
        return !$this->validationHasFailed();
    }


    /**
     * 获取人性化错误提示
     * @param $type
     * @param $field
     * @return string
     */
    private function _getMessage($type, $field)
    {
        $message_map = array(
            'PresenceOf' => '不能为空',
            'Email' => '不是一个Email',
            'ExclusionIn' => '在指定列表值中',
            'InclusionIn' => '不在指定列表值中',
            'Numericality' => '不是一个数字',
            'Regex' => '不符合表达式',
            'Uniqueness' => '数据库重复记录',
            'StringLength' => '长度不够',
            'Url' => '不是一个Url'
        );
        if (isset($message_map[$type])) {
            $mess = $field . $message_map[$type];
        } else {
            $mess = $field . "__NO_DEFAULT_MESSAGE__";
        }
        return $mess;
    }

    private function _setRelations()
    {
        $relations = $this->relations();

        if (empty($relations)) return;

        foreach ($relations as $key => $detail) {
            list($relation, $model, $model_column) = $detail;
            $options = isset($detail[3]) ? $detail[3] : array();
            $this->$relation($key, $model, $model_column, $options);
        }
    }

    /**
     * 设置table source
     */
    private function _setSource()
    {
        $ref = new \ReflectionClass($this);

        $model_class_name = substr($ref->getName(), strlen($ref->getNamespaceName()) + 1);
        $new_model_class_name = preg_replace("/[A-Z]/", "_\${0}", $model_class_name);
        $table_name = $this->table_prefix . strtolower(ltrim($new_model_class_name, '_'));
        $this->setSource($table_name);
    }

    /**
     *  before save hook
     */
    public function beforeSave()
    {

    }

    public function beforeCreate()
    {
        if (empty($this->create_date)) {
            $this->create_date = time();
        }
        if (empty($this->update_date)) {
            $this->update_date = time();
        }
    }

    public function beforeUpdate()
    {
        $this->update_date = time();
    }

    public function rules()
    {
        return array();
    }

    public function relations()
    {
        return array();
    }
} 