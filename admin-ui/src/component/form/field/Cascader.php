<?php

namespace Tadm\ui\component\form\field;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\FormItem;
use Tadm\ui\support\Arr;

/**
 * 级联选择
 * Class Cascade
 * @link   https://next.antdv.com/components/cascader-cn 级联组件
 * @method $this allowClear(bool $clear = true) 是否支持清除                                                            boolean
 * @method $this autofocus(bool $focus = true) 自动获取焦点                                                                boolean
 * @method $this bordered(bool $bordered = true) 是否有边框                                                              boolean
 * @method $this clearIcon(mixed $clearIcon) 自定义的选择框清空图标                                                           slot
 * @method $this changeOnSelect(bool $change = true) 当此项为 true 时，点选每级菜单选项值都会发生变化，具体见上面的演示        boolean
 * @method $this defaultValue(mixed $value = [])    默认的选中项                                                            string[] | number[]
 * @method $this disabled(bool $disabled = true) 禁用                                                                    boolean
 * @method $this expandTrigger(string $trigger = 'click') 次级菜单的展开方式，可选 'click' 和 'hover'                        string
 * @method $this fieldNames(mixed $content = "{ label: 'label', value: 'value', children: 'children' }") 自定义 options 中 label name children 的字段                                  object
 * @method $this notFoundContent(mixed $content = 'Not Found') 当下拉列表为空时显示的内容                                    boolean | string | number
 * @method $this placeholder(string $placeholder = '请选择') 输入框占位文本                                                string
 * @method $this showSearch(mixed $show = true) 在选择框中显示搜索框                                                        boolean | object
 * @method $this size(mixed $size = 'default') 输入框大小，可选 large default small                                        string
 * @method $this suffixIcon(mixed $suffix) 自定义的选择框后缀图标                                                            string | VNode | slot
 * @method $this value(mixed $value) 指定选中项                                                                            string[] | number[]
 * @method $this expandIcon(mixed $value = true) 自定义次级菜单展开图标                                                    slot
 * @method $this maxTagCount(mixed $num) 最多显示多少个 tag，响应式模式会对性能产生损耗                                        number | responsive
 * @method $this maxTagPlaceholder(mixed $maxTagPlaceholder) 隐藏 tag 时显示的内容
 * @method $this dropdownClassName(string $name) 自定义浮层类名                                                            string
 * @method $this open(bool $show) 控制浮层显隐                                                                            boolean
 * @method $this alwayLoad(bool $value)  总是load请求，配合load                                                                           boolean
 * @method $this placement(string $placement = 'bottomLeft') 浮层预设位置：bottomLeft bottomRight topLeft topRight        string
 * @method $this removeIcon(mixed $removeIcon) 自定义的多选框清除图标                                                      slot
 * @method $this searchValue(mixed $value) 设置搜索的值，需要与 showSearch 配合使用                                        string
 * @method $this tagRender(mixed $tagRender) 自定义 tag 内容，多选时生效                                                    slot
 * @package Tadm\ui\component\form\field
 */
class Cascader extends Field
{
    use CascadeTrait,CallbackDefinition;
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'clearIcon',
        'expandIcon',
        'maxTagPlaceholder',
        'removeIcon',
        'suffixIcon',
        'tagRender',
    ];
    protected $vModel = 'cascaderValue';
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ExCascader';


    public function __construct($field = null, $value = [])
    {
        parent::__construct('c'.md5(json_encode($field)), $value);
        $this->allowClear();
        $this->attr('fields', $field);
        $this->expandTrigger('hover');

    }
    public function modelValue()
    {
        parent::modelValue();
        if ($this->formItem) {

            $form = $this->formItem->form();
            $this->exceptField($this->field);
            $fields = [];
            $values = [];
            foreach ($this->attr('fields') as $bindField) {
                $this->form->inputDefault($bindField);
                $value = $this->form->input($bindField);
                if(!is_null($value)){
                    $values[] = $this->form->input($bindField);
                }
                $bindField = $form->getBindField($bindField);
                $fields[] = $bindField;
            }
            $this->value = $values;
            $this->form->inputDefault($this->field, $this->value);
        }
        $this->attr('bindField', $fields);
    }
    /**
     * 多选
     * @param string $relation 关联方法
     * @return CascaderMultiple
     */
    public function multiple($relation = null)
    {
        $this->attr('relation', $relation);
        $this->attr('multiple', true);
        $form = $this->formItem->form();
        $form->popItem();
        $fields = $this->attr('fields');
        $relation = $this->getRelation($relation);
        array_unshift($fields, $relation);
        array_push($fields, $this->formItem->attr('label'));
        $cascader = $form->cascaderMultiple(...$fields);
        $cascader->attribute = array_merge($this->attribute, $cascader->attribute);
        if($this->optionsClosure){
            $cascader->optionsClosure = $this->optionsClosure->bindTo($cascader);
        }
        $cascader->setField($this->getField());
        return $cascader;
    }
    /**
     * 动态加载选项
     * @param string|\Closure $callback 闭包回调或者url
     * @return $this
     */
    public function load($callback){
        $callbackField = '';
        $url = $this->formItem->form()->attr('url');
        if($callback instanceof \Closure){
            $callbackField = $this->setCallback($callback);
        }else{
            $url = $callback;
        }
        $params  = [
            'url' => $url,
            'data' => [
                'ex_admin_form_action'=>'remoteOptions',
                'ex_admin_callback_field'=> $callbackField,
            ],
            'method' => 'POST',
        ];
        $this->attr('loadRemote',$params);
        return $this;
    }
    public function getRelation($relation = null)
    {
        if (!$relation) {
            $relation = 'cascader' . md5(implode(',', $this->attr('fields')));
        }
        return $relation;
    }
    public function setFormItem(FormItem $formItem)
    {
        parent::setFormItem($formItem); // TODO: Change the autogenerated stub
        if($this->form->attr('layout') == 'inline'){
            $this->style(['minWidth'=>'200px']);
        }
    }
}
