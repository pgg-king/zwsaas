<?php

namespace Tadm\ui\component\form\step;

use Tadm\ui\component\common\Button;
use Tadm\ui\component\form\Form;
use Tadm\ui\support\Arr;
use Tadm\ui\support\Request;

class StepResult
{
    protected $form;

    protected $id = null;

    public function __construct(Form $form,$id)
    {
        $this->form = $form;
        $this->id = $id;
    }
    /**
     * 返回成功
     * @param string $title 标题
     * @param string  $content 内容
     * @return \Tadm\ui\component\feedback\Result
     */
    public function success($title=null, $content='')
    {
        return $this->result($title ?? admin_trans('form.operation_complete'), $content, 'success');
    }
    /**
     * 重新提交按钮
     * @param string $text
     * @return Button
     */
    public function resetButton($text = null)
    {
        return Button::create($text ?? admin_trans('form.resubmit'))
            ->eventFunction('click', 'stepReset', [], Request::input('FORM_REF'));
    }
    /**
     * 返回错误
     * @param string $title
     * @param string $content
     * @return \Tadm\ui\component\feedback\Result
     */
    public function error($title, $content){
        return $this->result($title, $content, 'error');
    }

    /**
     * 返回警告
     * @param string $title
     * @param string $content
     * @return \Tadm\ui\component\feedback\Result
     */
    public function warning($title, $content){
        return $this->result($title, $content, 'warning');
    }

    /**
     * 返回信息
     * @param string $title
     * @param string $content
     * @return \Tadm\ui\component\feedback\Result
     */
    public function info($title, $content){
        return $this->result($title, $content, 'info');
    }
    /**
     * @param string $title
     * @param string $content
     * @param string $status
     * @return \Tadm\ui\component\feedback\Result
     */
    public function result($title, $content, $status)
    {
        return \Tadm\ui\component\feedback\Result::create()->status($status)
            ->content($title, 'title')
            ->content($content, 'subTitle')
            ->content($this->resetButton(),'extra');
    }
    /**
     * 获取提交数据
     * @param string $field 字段
     * @return mixed
     */
    public function input($field=null)
    {
        return $this->form->input($field);
    }
    /**
     * 获取保存成功id
     * @return null
     */
    public function getId(){
        return $this->id;
    }
}
