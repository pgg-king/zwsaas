<?php

namespace Tadm\ui\component\form\field\select;

use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\field\CallbackDefinition;
use Tadm\ui\component\form\FormItem;
use Tadm\ui\component\grid\grid\Grid;
use Tadm\ui\support\Request;

/**
 * Class SelectTable
 * @package Tadm\ui\component\form\field\select
 * @method $this gridRefresh() 成功刷新grid表格
 * @method $this modalRefresh() 成功刷新弹窗
 * @method $this gridBatch() grid批量选中项
 */
class SelectTable extends Field
{
    use CallbackDefinition;
    
    protected $name = 'ExSelectTable';

    public function __construct($field = null, $value = null)
    {
        parent::__construct($field, $value);

    }
    /**
     * 渲染实例
     * @param mixed $grid
     * @param array $params
     * @return $this
     */
    public function grid($grid, $params = []){
        list($url, $params) = $this->parseComponentCall($grid,$params);
        $this->attr('gridUrl',$url);
        $this->attr('params',$params);
        return $this;
    }

    /**
     * 多选
     * @return $this
     */
    public function multiple()
    {
        $this->attr('multiple',true);
        $this->attr('mode','multiple');
        $this->modelValueArray();
        return $this;
    }
    public function display(\Closure $closure){
        $this->attr('custom',true);
        return $this->selectRequest($closure,function ($data){
            return $data;
        });
    }
    public function options(\Closure $closure)
    {
        return $this->selectRequest($closure,function ($data){
            $options = [];
            foreach ($data as $key => $value) {
                $options[] = [
                    'value' => $key,
                    'label' => $value
                ];
            }
            return $options;
        });
    }


    /**
     * 提交地址
     * @param array|string $url
     * @param array $params
     * @return $this
     */
    public function submit($url,array $params = []){
        $url = admin_url($url);
        if(empty($params)){
            $params = new \stdClass();
        }
        $this->attr('submitUrl',$url);
        $this->attr('submitParams',$params);
        return $this;
    }

    protected function selectRequest(\Closure $closure,\Closure $custom){
        $callbackField = $this->setCallback($closure,$custom);
        $this->attr('submitUrl',$this->formItem->form()->attr('url'));
        $this->attr('submitParams',$this->formItem->form()->call['params']+['ex_admin_form_action'=>'selectTable','ex_admin_callback_field'=>$callbackField]);
        return $this;
    }
    
   

}
