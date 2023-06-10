<?php

namespace Tadm\ui\component\form\field\checkbox;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\field\OptionsClosure;
use Tadm\ui\component\layout\Col;
use Tadm\ui\component\layout\Row;

/**
 * 多选框
 * Class CheckboxGroup
 * @link   https://next.antdv.com/components/checkbox-cn 多选框组件
 * @method $this disabled(bool $disabled = true)    整组失效                                                                boolean
 * @method $this name(string $name) CheckboxGroup 下所有 input[type = "checkbox"] 的 name 属性                                string
 * @method $this value(mixed $value = []) 指定选中的选项                                                                    string[]
 * @package Tadm\ui\component\form\field
 */
class CheckboxGroup extends Field
{
    use OptionsClosure;

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ACheckboxGroup';


    protected $column;

    protected $disabledValue = [];


    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
    }

    /**
     * 布局一行显示几列
     * @param int $number 数量
     * @return $this
     */
    public function column(int $number)
    {
        $this->column = $number;
        return $this;
    }

    /**
     * 禁用选项
     * @param array $data
     * @return $this
     */
    public function disabledValue(array $data)
    {
        $this->disabledValue = $data;
        return $this;
    }

    /**
     * 设置选项
     * @param array $data 数据源
     * @return $this
     */
    public function options(array $data)
    {
        $this->optionsClosure = function () use ($data) {
            $checkbox = [];
            foreach ($data as $key => $value) {
                $disabled = false;
                if (in_array($key, $this->disabledValue)) {
                    $disabled = true;
                }
                if ($this->column) {
                    $checkbox[] = [
                        'slotDefault' => Checkbox::create()
                            ->removeModel('checked')
                            ->attr('value', $key)
                            ->content($value)
                    ];

                } else {
                    $this->options[] = [
                        'label' => $value,
                        'value' => $key,
                        'disabled' => $disabled,
                    ];
                }
            }
            if ($this->column) {
                $this->content(
                    Row::create()->content(
                        Col::create()->map($checkbox)->span(24 / $this->column)->mapAttr('slotDefault')
                    )
                );
            } else {
                $this->attr('options', $this->options);
            }
        };
        return $this;
    }
}
