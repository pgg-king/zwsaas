<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-27
 * Time: 22:01
 */

namespace Tadm\ui\support;
use Tadm\ui\component\form\field\dateTimePicker\range\DateTimeRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\MonthRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\QuarterRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\WeekRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\YearRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\RangePicker;
use Tadm\ui\component\form\field\dateTimePicker\TimeRangePicker;
use Tadm\ui\component\form\field\NumberRange;
use Tadm\ui\component\form\traits\FormComponent;

/**
 * Class FilterIde
 * @package Tadm\ui\support
 * @method RangePicker dateRange(string $filed, string $label = '') 日期范围选择框
 * @method DateTimeRangePicker dateTimeRange(string $filed, string $label = '') 日期时间范围选择框
 * @method TimeRangePicker timeRange(string $filed, string $label = '') 时间范围选择框
 * @method YearRangePicker yearRange(string $filed, string $label = '') 年份范围选择框
 * @method MonthRangePicker monthRange(string $filed, string $label = '') 月份范围选择框
 * @method WeekRangePicker weekRange(string $filed, string $label = '') 星期范围选择框
 * @method QuarterRangePicker quarterRange(string $filed, string $label = '') 季度范围选择框
 * @method NumberRange numberRange(string $filed, string $label = '') 数字范围输入框
 * @mixin FormComponent
 */

class FilterIde
{

}
