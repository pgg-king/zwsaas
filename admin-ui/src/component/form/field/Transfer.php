<?php

namespace Tadm\ui\component\form\field;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;

/**
 * 穿梭框
 * Class Transfer
 * @link   https://next.antdv.com/components/transfer-cn 穿梭框组件
 * @method $this disabled(bool $disabled = false) 是否禁用																boolean
 * @method $this listStyle(mixed $style) 两个穿梭框的自定义样式															object
 * @method $this locale(mixed $locale) 各种语言																			{ itemUnit: '项', itemsUnit: '项', notFoundContent: '列表为空', searchPlaceholder: '请输入搜索内容' }
 * @method $this oneWay(bool $oneWay = false) 展示为单向样式																boolean
 * @method $this operations(array $operations = ['>', '<']) 操作文案集合，顺序从上至下										string[]
 * @method $this pagination(mixed $pagination = false) 使用分页样式，自定义渲染列表下无效									boolean | { pageSize: number }
 * @method $this selectedKeys(array $keys = []) 设置哪些项应该被选中														string[]
 * @method $this showSearch(bool $show = false) 是否显示搜索框															boolean
 * @method $this showSelectAll(bool $show = true) 是否展示全选勾选框														boolean
 * @method $this targetKeys(array $focus = []) 显示在右侧框数据的 key 集合													string[]
 * @method $this titles(array $focus = ['', '']) 标题集合，顺序从左至右													string[]
 * @method $this dataSource(array $data) 数据源
 * @method $this footer(mixed $content) 底部内容
 * @package Tadm\ui\component\form\field
 */
class Transfer extends Field
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATransfer';

    protected $slot = [
        'footer'
    ];
    protected $vModel = 'targetKeys';

    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
        $this->bindFunction('render',"return item.label;",['item']);
        $this->bindFunction('rowKey',"return record.id;",['record']);
    }
    
    /**
     * 数据选项
     * @param array $data
     * @return $this
     */
    public function options($data)
    {
        if(count($data) == count($data,1)){
            foreach ($data as $id => $label) {
                $options[] = [
                    'id' => $id,
                    'label' => $label,
                    'disabled' => false,
                ];
            }
        }else{
            $options = $data;
        }
        $this->dataSource($options);
        return $this;
    }
}
