<?php

namespace Tadm\ui\component\grid\grid;

use Tadm\ui\component\common\Button;
use Tadm\ui\component\common\Html;
use Tadm\ui\component\Component;
use Tadm\ui\component\feedback\Process;
use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\field\AutoComplete;
use Tadm\ui\component\form\field\input\Input;
use Tadm\ui\component\form\field\InputNumber;
use Tadm\ui\component\form\field\Rate;
use Tadm\ui\component\form\field\Switches;
use Tadm\ui\component\form\Form;
use Tadm\ui\component\form\FormAction;
use Tadm\ui\component\form\traits\FormComponent;
use Tadm\ui\component\grid\image\Image;
use Tadm\ui\component\grid\image\ImagePreviewGroup;
use Tadm\ui\component\grid\Popover;
use Tadm\ui\component\grid\statistic\Statistic;
use Tadm\ui\component\grid\TableSummaryCell;
use Tadm\ui\component\grid\tag\Tag;
use Tadm\ui\component\grid\ToolTip;
use Tadm\ui\support\Arr;
use Tadm\ui\support\Request;
use Tadm\ui\traits\ColumnFilter;
use Tadm\ui\traits\Display;

/**
 * 表格列
 * Class Column
 * @method $this dataIndex(string $value) 对应列内容的字段名
 * @method $this header(string $value)    自定义内容
 * @method $this align(string $value) 设置列的对齐方式 left | right | center
 * @method $this width(int $width) 宽度
 * @method $this ellipsis(bool $value) 超过宽度将自动省略
 * @method $this fixed(mixed $value) 列是否固定，可选 true(等效于 left) 'left' 'right'
 * @method $this resizable(bool $value) 是否可拖动调整宽度，此时 width 必须是 number 类型
 * @method $this minWidth(int $width) 拖动列最大宽度，会受到表格自动调整分配宽度影响
 * @method $this maxWidth(int $width) 拖动列最小宽度，会受到表格自动调整分配宽度影响
 */
class Column extends Component
{
    use Display;

    protected $name = 'ATableColumn';

    protected $grid;

    protected $closure = [];

    protected $displayValue = null;

    protected $summaryCell = null;

    protected $displayComponent = null;

    protected $exportClosure = null;

    protected $editable = null;
    /**
     * @var ColumnWhen
     */
    protected $when;

    protected $default = '--';

    protected $field;


    public function __construct(Grid $grid,$field, $label = '')
    {
        parent::__construct();
        $this->grid = $grid;
        $this->field = $field;
        $this->dataIndex($field);
        if (!empty($label)) {
            $this->attr('title', $label);
            $this->header(
                Html::create($label)->attr('class', 'ex_admin_table_th_' . $this->attr('dataIndex'))
            );
        }
        $this->when = new ColumnWhen($this);
        //统计列
        $this->summaryCell = TableSummaryCell::create();
    }

    public function getField()
    {
        return $this->field;
    }

    /**
     * 设置缺失值
     * @param $value
     */
    public function default($value)
    {
        $this->default = $value;
    }

    /**
     * 解析每行数据
     * @param array $data 数据
     * @param mixed $originData 原始数据
     * @param bool $export 是否导出
     * @return mixed
     */
    public function row($data, $originData, $export = false)
    {
        $originValue = Arr::get($originData, $this->field);

        if (is_null($originValue)) {
            $value = $this->default;
        } else {
            $value = Arr::get($data, $this->field);
        }
        $resetClosure = [$this->editable, $this->closure, $this->exportClosure];

        $displayClosure = $this->closure;

        $this->closure = [];
        //条件显示
        $this->when->exec($originValue, $originData);
        $displayClosure = array_merge($this->closure,$displayClosure);
        //自定义内容显示处理
        $this->displayValue = $originValue;
        $this->displayComponent = $originValue;
        foreach ($displayClosure as $key=>$display){
            $value = call_user_func_array($display,[$originValue, $originData,$this->displayValue]);
            $this->displayComponent = $value;
            if(!is_object($value)){
                $this->displayValue = $value;
            }
        }
        if($this->attr('totalRow')){
            $this->summaryCell->increment($this->displayValue);
        }
        if (!is_null($this->editable)) {
            $value = call_user_func_array($this->editable, [$originValue, $originData, $value]);
        }
        if ($export) {
            //自定义导出
            if (!is_null($this->exportClosure)) {
                $value = call_user_func_array($this->exportClosure, [$originValue, $originData]);
            } elseif (!empty($this->using)) {
                $value = $originValue;
                if (!is_array($value)) {
                    $value = [$value];
                }
                $renderValue = [];
                foreach ($value as $key) {
                    if (isset($this->using[$key])) {
                        $renderValue[] = $this->using[$key];
                    }
                }
                $value = implode('、', $renderValue);
            } elseif (!is_string($value) && !is_numeric($value)) {
                $value = $originValue;
            }
        } else {
            $html = Html::create($value)->attr('class', 'ex_admin_table_td_' . $this->field);
            $fontSize = $this->grid->attr('fontSize');
            if ($fontSize) {
                $html->style(['fontSize' => $fontSize . 'px']);
            }
            $value = $html;
        }
        //重置
        [$this->editable, $this->closure, $this->exportClosure] = $resetClosure;
        return $value;
    }

    /**
     * @return TableSummaryCell
     */
    public function getSummaryCell(){
        return $this->summaryCell;
    }

    /**
     * 统计行
     * @param \Closure|null $closure 自定义显示
     * @return $this
     */
    public function totalRow(\Closure $closure = null){
        $this->attr('totalRow',true);
        if($closure){
            $this->summaryCell->display($closure);
        }
        return $this;
    }
    /**
     * 自定义导出
     * @param \Closure $closure
     * @return $this
     */
    public function export(\Closure $closure)
    {
        $this->exportClosure = $closure;
        return $this;
    }

    /**
     * 关闭当前列导出
     * @return $this
     */
    public function closeExport()
    {
        $this->attr('closeExport', true);
        return $this;
    }

    /**
     * 隐藏
     * @return \Eadmin\grid\Column|$this
     */
    public function hide()
    {
        $this->attr('hide', true);
        return $this;
    }

    /**
     * 隐藏列仅导出
     * @return $this
     */
    public function onlyExport(){
        $this->attr('checkboxColumnShow', false);
        $this->attr('onlyExport', true);
        return $this;
    }
    /**
     * 获取当前列是否隐藏
     * @return bool
     */
    public function isHide()
    {
        return $this->attr('hide');
    }

    /**
     * 开启排序
     * @return $this
     */
    public function sortable()
    {
        $this->attr('sorter', true);
        return $this;
    }

    /**
     * 开关
     * @return $this
     */
    public function switch($switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        $this->display(function ($value, $data) use ($switchArr) {
            return $this->getSwitch($value, $data, $this->field, $switchArr);
        });
        return $this;
    }

    /**
     * 开关组
     * @param array $fields
     * @return $this
     */
    public function switchGroup($fields)
    {
        $this->display(function ($value, $data) use ($fields) {
            $content = [];
            foreach ($fields as $field => $label) {
                $content[] = Html::create([
                    Html::create($label . ': '),
                    $this->getSwitch($data[$field], $data, $field),
                ])->style(['display' => 'flex', 'justifyContent' => 'space-between'])->tag('p');
            }
            return $content;
        });
        return $this;
    }
    /**
     * 获取开关
     * @param string $value 当前值
     * @param array $data 行数据
     * @param string $field 字段
     * @param array $switchArr 开关选项
     * @return mixed
     */
    protected function getSwitch($value, $data, $field, $switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        $form = Form::create($this->grid->driver()->getRepository());
        if (Request::has('ex_form_switch_id')) {
            $this->grid->driver()->setForm($form);
        }
        return Switches::create(null, $value)
            ->options($switchArr)
            ->url($this->grid->attr('url'))
            ->field($field)
            ->params([
                'ex_form_switch_id' => $data[$this->grid->driver()->getPk()],
                'ex_admin_form_action' => 'save',
                'id' => $data[$this->grid->driver()->getPk()],
            ]);
    }


    /**
     * 自定义显示
     * @param \Closure $closure
     * @return $this
     */
    public function display(\Closure $closure)
    {
        $this->closure[] = $closure;
        return $this;
    }

    /**
     * 条件执行
     * @param $condition |\Closure
     * @param \Closure $closure
     * @param \Closure|null $other
     * @return $this
     */
    public function when($condition, \Closure $closure, $other = null)
    {
        return $this->when->if($condition)->then($closure)->else($other)->end();
    }

    /**
     * 条件执行
     * @param $condition |\Closure
     * @return ColumnWhen
     */
    public function if($condition)
    {
        return $this->when->if($condition);
    }

    /**
     * 可编辑
     * @param Field $editable
     * @param bool $alwaysShow 总是显示
     * @param bool $gridRefresh 成功是否刷新grid
     * @return $this
     */
    public function editable($editable = null, $alwaysShow = false, $gridRefresh = true)
    {
        $this->editable = function ($value, $data, $html) use ($editable, $alwaysShow, $gridRefresh) {
            $form = Form::create($this->grid->driver()->getRepository());
            if (!$gridRefresh) {
                $form->removeEvent('success', 'custom');
            }
            $form->style(['padding' => '0px', 'background' => 'none']);
            $form->layout('inline');
            $form->removeAttr('labelCol');
            $form->url($this->grid->attr('url'));
            $form->method('PUT');
            $form->params($this->grid->getCall()['params'] + [
                    'ex_form_editable_id' => $data[$this->grid->driver()->getPk()],
                    'ex_admin_form_action' => 'save',
                    'id' => $data[$this->grid->driver()->getPk()],
                ]);
            $form->actions()->submitButton()->htmlType('submit');
            if (Request::has('ex_form_editable_id')) {
                $this->grid->driver()->setForm($form);
            }
            if (is_null($editable)) {
                $editable = Editable::text();
            }
            $field = $this->field;
            foreach ($editable->getCall() as $key => $item) {
                $arguments = $item['arguments'];
                if ($key == 0) {
                    if (isset($arguments[0])) {
                        $field = $arguments[0];
                    }
                    $component = call_user_func_array([$form, $item['name']], [$field]);

                } else {
                    $component = call_user_func_array([$component, $item['name']], $arguments);
                }
            }
            $component->default($data[$field]);
            //去除条件，减少vue性能消耗
            $component->getFormItem()->removeBind(true)->setWhere([]);


            if ($alwaysShow) {
                if ($component instanceof Input || $component instanceof InputNumber || $component instanceof AutoComplete) {
                    $component->allowClear(false);
                    $component->getFormItem()->style(['width' => '100%']);
                    $event = 'blur';

                } else {
                    $event = 'change';
                }
                if ($component->getFormItem()->attr('rules') || $form->validator()->hasRule()) {
                    $component->eventFunction($event, 'submit', [], $form);
                    $form->actions()->hide();
                } else {
                    //没验证规则不需要渲染表单，只渲染组件
                    $bindField = $component->random();
                    $component->vModel($component->getModelField(), $bindField, $data[$field]);
                    $component->eventCustom($event, 'GridEditable', [
                        'bindField' => $bindField,
                        'ex_admin_success' => $gridRefresh,
                        'ex_admin_field' => $field,
                        'ajax' => [
                            'url' => $this->grid->attr('url'),
                            'data' => $this->grid->getCall()['params'] + [
                                    'ex_form_editable_id' => $data[$this->grid->driver()->getPk()],
                                    'ex_admin_form_action' => 'save',
                                    'id' => $data[$this->grid->driver()->getPk()],
                                ],
                            'method' => 'PUT',
                        ]
                    ]);
                    $form = $component;
                }
                return $form;
            } else {
                $component->directive('focus');
                $popover = Popover::create(Html::create()->tag('i')->attr('class', ['far fa-edit', 'editable-cell-icon']))
                    ->trigger('click')
                    ->destroyTooltipOnHide()
                    ->content($form);
                $visible = $popover->vModel('visible', null, false);
                return Html::div()->content([
                    Html::create($html),
                    $popover
                ])
                    ->attr('class', 'ex-admin-editable-cell')
                    ->event('dblclick', [$visible => true]);
            }
        };
        return $this;
    }

    /**
     * 列筛选
     * @param Field|array $filterColumn
     */
    public function filter($filterColumn)
    {

        if (!is_array($filterColumn)) {
            $filterColumn = [$filterColumn];
        }
        $filter = $this->grid->getFilter();
        $form = Form::create([], null, $filter->form()->getModel());
        $form->actions()->hide();
        $form->removeAttr('labelCol')
            ->layout('vertical');
        $form->url($this->grid->attr('url'));
        foreach ($filterColumn as $item) {
            $this->filterForm($item, $form);
        }
        $form->removeAttr('url');
        $form->content(
            Html::create([
                Button::create(admin_trans('antd.Grid.search'))
                    ->eventFunction('click', 'submit', [], $form)
                    ->size('small')
                    ->type('primary'),
                Button::create(admin_trans('form.reset'))
                    ->size('small')
                    ->eventFunction('click', 'form.resetFields', [], $form)
            ])
                ->style(['borderTop' => '1px solid #DCDFE6', 'paddingTop' => '10px'])
                ->tag('div')
            , 'footer');
        if(!Request::has('ex_admin_form_action')){
            $form->exec();
            $form->setBind([]);
        }
        $this->attr('customFilterDropdown', true);
        $this->attr('customFilterForm', $form->style(['padding' => '8px']));
    }

    /**
     * @param $filterColumn
     */
    protected function filterForm($filterColumn, $form)
    {
        $filter = $this->grid->getFilter();
        foreach ($filterColumn->getCall() as $key => $item) {
            $arguments = $item['arguments'];
            if ($key == 1 && count($arguments) == 0) {
                $arguments = [$this->attr('dataIndex')];
            }
            if ($key < 2) {
                $filter = $filter->setRule($item['name'], $arguments);
                if($filter instanceof Field){
                    $formItem = clone $filter->getFormItem();
                    $filter->getFormItem()->style(['display' => 'none']);
                    $form->push($formItem);
                }
            } else {
                $filter = call_user_func_array([$filter, $item['name']], $arguments);
            }
        }
    }

}
