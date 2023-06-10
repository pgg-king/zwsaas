<?php

namespace Tadm\ui\component\form\traits;

use Tadm\ui\component\form\field\AutoComplete;
use Tadm\ui\component\form\field\Cascader;
use Tadm\ui\component\form\field\CascaderMultiple;
use Tadm\ui\component\form\field\CascaderSingle;
use Tadm\ui\component\form\field\checkbox\Checkbox;
use Tadm\ui\component\form\field\checkbox\CheckboxGroup;
use Tadm\ui\component\form\field\CheckboxTag;
use Tadm\ui\component\form\field\ColorPicker;
use Tadm\ui\component\form\field\dateTimePicker\range\DateTimeRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\MonthRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\QuarterRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\WeekRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\range\YearRangePicker;
use Tadm\ui\component\form\field\dateTimePicker\DatePicker;
use Tadm\ui\component\form\field\dateTimePicker\date\DateTimePicker;
use Tadm\ui\component\form\field\dateTimePicker\date\MonthPicker;
use Tadm\ui\component\form\field\dateTimePicker\date\QuarterPicker;
use Tadm\ui\component\form\field\dateTimePicker\date\WeekPicker;
use Tadm\ui\component\form\field\dateTimePicker\date\YearPicker;
use Tadm\ui\component\form\field\dateTimePicker\RangePicker;
use Tadm\ui\component\form\field\dateTimePicker\TimePicker;
use Tadm\ui\component\form\field\dateTimePicker\TimeRangePicker;
use Tadm\ui\component\form\field\Descriptions;
use Tadm\ui\component\form\field\DynamicTag;
use Tadm\ui\component\form\field\Editor;
use Tadm\ui\component\form\field\input\Hidden;
use Tadm\ui\component\form\field\input\Input;
use Tadm\ui\component\form\field\InputNumber;
use Tadm\ui\component\form\field\input\Password;
use Tadm\ui\component\form\field\input\TextArea;
use Tadm\ui\component\form\field\MdEditor;
use Tadm\ui\component\form\field\mentions\Mentions;
use Tadm\ui\component\form\field\NumberRange;
use Tadm\ui\component\form\field\radio\RadioGroup;
use Tadm\ui\component\form\field\Rate;
use Tadm\ui\component\form\field\select\Select;
use Tadm\ui\component\form\field\select\SelectTable;
use Tadm\ui\component\form\field\SelectIcon;
use Tadm\ui\component\form\field\Slider;
use Tadm\ui\component\form\field\Switches;
use Tadm\ui\component\form\field\Transfer;
use Tadm\ui\component\form\field\Tree;
use Tadm\ui\component\form\field\TreeSelect;
use Tadm\ui\component\form\field\upload\File;
use Tadm\ui\component\form\field\upload\Image;

/**
 * @method Input text(string $field, string $label = '') 文本输入框
 * @method Hidden hidden(string $field) 隐藏域
 * @method InputNumber number(string $field, string $label = '') 数字输入框
 * @method NumberRange numberRange(string $startFiled, string $endField, string $label = '') 数字范围输入框
 * @method Password password(string $field, string $label = '') 密码输入框
 * @method TextArea textarea(string $field, string $label = '') 文本域输入框
 * @method Rate rate(string $field, string $label = '') 评分
 * @method Slider slider(string $field, string $label = '') 滑动输入条
 * @method Transfer transfer(string $field, string $label = '') 穿梭框
 * @method Select select(string $field, string $label = '') 下拉选择框
 * @method TreeSelect treeSelect(string $field, string $label = '') 树形选择框
 * @method Tree tree(string $field, string $label = '') 树形
 * @method Switches switch (string $field, string $label = '') 开关
 * @method CheckboxGroup checkbox(string $field, string $label = '') 多选框 # TODO 全选未封装
 * @method Cascader cascader(array $field, $label) 级联选择器 （多字段）
 * @method CascaderSingle cascaderSingle(string $field, $label) 级联选择器 （单字段）
 * @method RadioGroup radio(string $field, string $label = '') 单选框
 * @method DatePicker date(string $field, string $label = '') 日期选择框
 * @method DateTimePicker dateTime(string $field, string $label = '') 日期时间选择框
 * @method YearPicker year(string $field, string $label = '') 年份选择框
 * @method MonthPicker month(string $field, string $label = '') 月份选择框
 * @method WeekPicker week(string $field, string $label = '') 星期选择框
 * @method QuarterPicker quarter(string $field, string $label = '') 季度选择框
 * @method RangePicker dateRange(string $startFiled, string $endField, string $label = '') 日期范围选择框
 * @method DateTimeRangePicker dateTimeRange(string $startFiled, string $endField, string $label = '') 日期时间范围选择框
 * @method YearRangePicker yearRange(string $startFiled, string $endField, string $label = '') 年份范围选择框
 * @method MonthRangePicker monthRange(string $startFiled, string $endField, string $label = '') 月份范围选择框
 * @method WeekRangePicker weekRange(string $startFiled, string $endField, string $label = '') 星期范围选择框
 * @method QuarterRangePicker quarterRange(string $startFiled, string $endField, string $label = '') 季度范围选择框
 * @method TimePicker time(string $field, string $label = '') 时间选择框
 * @method TimeRangePicker timeRange(string $startFiled, string $endField, string $label = '') 时间范围选择框
 * @method File file(string $field, string $label = '') 文件上传
 * @method Image image(string $field, string $label = '') 图片上传
 * @method Editor editor(string $field, string $label = '') 富文本
 * @method Mentions mentions(string $field, string $label = '') 提及(@某人)
 * @method AutoComplete autoComplete(string $field, string $label = '') 自动完成
 * @method SelectIcon icon(string $field, string $label = '') 图标选择器
 * @method SelectTable selectTable(string $field, string $label = '') 表格选择器
 * @method ColorPicker color(string $field, string $label = '') 颜色选择器
 * @method MdEditor mdEditor($field, $label = '') md编辑器
 * @method CheckboxTag checkboxTag($field, $label = '') 多选标签
 * @method DynamicTag dynamicTag($field, $label = '') 动态标签
 * @method Descriptions desc($field, $label = '') 显示html
 * @method Checkbox checkboxSingle($field, $label = '') 单复选框
 */
trait FormComponent
{
    protected static $formComponent = [
        'text'          => Input::class,
        'hidden'          => Hidden::class,
        'number'        => InputNumber::class,
        'numberRange'        => NumberRange::class,
        'password'      => Password::class,
        'textarea'      => TextArea::class,
        'rate'          => Rate::class,
        'slider'        => Slider::class,
        'transfer'      => Transfer::class,
        'treeSelect'    => TreeSelect::class,
        'tree'          => Tree::class,
        'select'        => Select::class,
        'switch'        => Switches::class,
        'checkbox'      => CheckboxGroup::class,
        'checkboxSingle'      => Checkbox::class,
        'cascader'      => Cascader::class,
        'cascaderSingle'      => CascaderSingle::class,
        'cascaderMultiple'      => CascaderMultiple::class,
        'radio'         => RadioGroup::class,
        'date'          => DatePicker::class,
        'dateTime'      => DateTimePicker::class,
        'year'          => YearPicker::class,
        'month'         => MonthPicker::class,
        'week'          => WeekPicker::class,
        'quarter'       => QuarterPicker::class,
        'yearRange'     => YearRangePicker::class,
        'monthRange'    => MonthRangePicker::class,
        'weekRange'     => WeekRangePicker::class,
        'quarterRange'  => QuarterRangePicker::class,
        'dateRange'     => RangePicker::class,
        'dateTimeRange' => DateTimeRangePicker::class,
        'time'          => TimePicker::class,
        'timeRange'     => TimeRangePicker::class,
        'file'          => File::class,
        'image'         => Image::class,
        'editor'        => Editor::class,
        'mentions'      => Mentions::class,
        'autoComplete'  => AutoComplete::class,
        'icon'  => SelectIcon::class,
        'selectTable'  => SelectTable::class,
        'color'  => ColorPicker::class,
        'mdEditor'  => MdEditor::class,
        'checkboxTag'  => CheckboxTag::class,
        'dynamicTag'  => DynamicTag::class,
        'desc'  => Descriptions::class,
    ];
}
