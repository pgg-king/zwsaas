<?php

namespace Tadm\ui\component\form\field\radio;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\field\OptionsClosure;

/**
 * 单选框 - 按钮组
 * Class RadioGroup
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this buttonStyle(string $style = 'outline') RadioButton 的风格样式，目前有描边和填色两种风格					outline | solid
 * @method $this disabled(bool $disabled = false) 禁选所有子单选器														boolean
 * @method $this name(string $name) RadioGroup 下所有 input[type="radio"] 的 name 属性									string
 * @method $this size(string $size = 'default') 大小，只对按钮样式生效														large | default | small
 * @package Tadm\ui\component\form\field
 */
class RadioGroup extends Field
{
    use OptionsClosure;
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ARadioGroup';

    /**
     * 单选框类型
     * @var bool
     */
    protected $buttonType = false;
    
    protected $disabledValue = [];
    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);
        $this->initBindOptions();
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
     * 按钮样式
     * @return $this
     */
    public function button()
    {
        $this->buttonType = true;
        return $this;
    }
    /**
     * 设置选项
     * @param array $data 数据源 [key => value] 的形式
     * @param array $disabledArr 禁选的id
     * @param bool $buttonType false 默认 true 按钮
     * @return $this
     */
    public function options(array $data)
    {
        $this->bindOptionsField();
        $this->optionsClosure = function () use ($data) {
            foreach($data as $id => $value) {
                $disabled = false;
                if (in_array($id, $this->disabledValue)) {
                    $disabled = true;
                }
                $this->options[] = [
                    'value' => $id,
                    'label' => $value,
                    'disabled' => $disabled,
                    'slotDefault' => $value,
                ];
            }
            if ($this->buttonType) {
                $radio = RadioButton::create();
            } else {
                $radio = Radio::create();
            }
            $radioOption = $radio
                ->map($this->options,$this->optionsBindField)
                ->mapAttr('value')
                ->mapAttr('disabled')
                ->mapAttr('slotDefault');
            $this->content($radioOption);
        };
        return $this;
    }
   
   
}
