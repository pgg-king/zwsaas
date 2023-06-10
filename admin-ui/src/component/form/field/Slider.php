<?php

namespace Tadm\ui\component\form\field;

use Tadm\ui\component\common\Html;
use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\FormItemRest;
use Tadm\ui\component\layout\Row;

/**
 * 滑动输入条
 * Class Slider
 * @link   https://next.antdv.com/components/slider-cn 滑动输入条组件
 * @link   https://next.antdv.com/components/tooltip-cn/ tooptip展示位置
 * @method $this autofocus(bool $focus = true) 自动获取焦点																boolean
 * @method $this disabled(bool $disabled = true) 值为 true 时，滑块为禁用状态												boolean
 * @method $this dots(bool $dots = true) 是否只能拖拽到刻度上															boolean
 * @method $this included(bool $included = true) marks 不为空对象时有效，值为 true 时表示值为包含关系，false 表示并列			boolean
 * @method $this max(int $max = 100) 最大值																				number
 * @method $this min(int $min = 0) 最小值																				number
 * @method $this reverse(bool $reverse = true) 反向坐标轴														boolean
 * @method $this step(mixed $step = 1) 步长，取值必须大于 0，并且可被 (max - min) 整除。当 marks 不为空对象时，
 * 										  可以设置 step 为 null，此时 Slider 的可选值仅有 marks 标出来的部分。               number|null
 * @method $this value(mixed $value) 设置当前取值。当 range 为 false 时，使用 number，否则用 [number, number]				number|number[]
 * @method $this vertical(bool $vertical = true) 值为 true 时，Slider 为垂直方向											boolean
 * @method $this tooltipPlacement(string $placement) 设置 Tooltip 展示位置。参考 Tooltip。								string
 * @method $this tooltipVisible(bool $visible) 值为true时，Tooltip 将会始终显示；否则始终不显示，哪怕在拖拽及移入时。			boolean
 * @package Tadm\ui\component\form\field
 */
class Slider extends Field
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASlider';

	public function __construct($field = null,$value = '')
    {

        parent::__construct($field, $value);
    }

    /**
     * 双滑块模式
     * @return $this
     */
    public function range(){
        $this->modelValueArray();
        return $this->attr('range',true);
    }
    /**
     * 显示输入框
     * @return $this
     */
    public function showInput(){
        $number = InputNumber::create($this->field,$this->value);
        $number->setFormItem($this->formItem);
        $number->modelValue();
        $slider = array_pop($this->formItem->content['default']);
        $html = Html::create();
        $html->content([
            Html::create($slider)->style(['flex'=>1,'marginRight'=>'10px']),
            FormItemRest::create()->content($number),
        ])->style(['display'=>'flex']);
        $this->formItem->content($html);
        return $this;
    }
}
