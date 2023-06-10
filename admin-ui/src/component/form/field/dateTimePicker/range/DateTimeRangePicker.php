<?php

namespace Tadm\ui\component\form\field\dateTimePicker\range;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\field\dateTimePicker\RangePicker;

/**
 * 日期时间范围选择框
 * Class DateTimeRangePicker
 * @link   https://next.antdv.com/components/date-picker-cn 日期选择框组件
 * @link   https://day.js.org/docs/zh-CN/display/format 时间格式
 * @link   https://github.com/vueComponent/ant-design-vue/blob/next/components/date-picker/locale/example.json 国际化配置
 * @link   https://next.antdv.com/components/time-picker-cn/#API TimePicker Options
 * @package Tadm\ui\component\form\field
 */
class DateTimeRangePicker extends RangePicker
{
    public function __construct($startField,$endField, $value = [])
    {
        parent::__construct($startField, $endField, $value);
        $this->showTime();
        $this->valueFormat('YYYY-MM-DD HH:mm:ss');
    }


}
