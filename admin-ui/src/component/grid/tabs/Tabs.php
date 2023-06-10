<?php

namespace Tadm\ui\component\grid\tabs;

use Tadm\ui\component\common\AsyncRender;
use Tadm\ui\component\Component;
use Tadm\ui\component\form\Form;
use Tadm\ui\component\grid\grid\Grid;

/**
 * 标签页
 * Class Tabs
 * @link    https://next.antdv.com/components/tabs-cn 标签页组件
 * @method $this activeKey(string $activeKey) 当前激活 tab 面板的 key                                                        string
 * @method $this animated(mixed $animated) 是否使用动画切换 Tabs，在 tabPosition = top | bottom 时有效                       boolean | {
inkBar:boolean, tabPane:boolean
}
 * @method $this destroyInactiveTabPane(bool $value=true) 被隐藏时是否销毁 DOM 结构                                        boolean
 * @method $this centered(bool $centered = true) 标签居中展示                                                            boolean
 * @method $this hideAdd(bool $hideAdd = true) 是否隐藏加号图标，在 type = "editable-card" 时有效                           boolean
 * @method $this size(string $size = 'default') 大小，提供 large default 和 small 三种大小                                string
 * @method $this tabBarExtraContent(string $value)    tab bar 上额外的元素                               slot
 * @method $this tabBarStyle(mixed $tabBarStyle) tab bar 的样式对象                                                        object
 * @method $this tabPosition(string $tabPosition = 'top') 页签位置，可选值有 top right bottom left                        string
 * @method $this type(string $type = 'line') 页签的基本样式，可选 line、card editable-card 类型                            string
 * @method $this tabBarGutter(int $tabBarGutter) tabs 之间的间隙                                                            number
 * @method static $this create(string $value = 1, $bindField = null) 创建
 * @package Tadm\ui\component\form\field
 */
class Tabs extends Component
{
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ATabs';

    protected $vModel = 'activeKey';

    protected $slot = [
        'tabBarExtraContent'
    ];
    /**
     * @var Form
     */
    protected $form;

    protected $pane = [];

    public function __construct($value = 1, $field = null)
    {
        parent::__construct();
        $this->vModel($this->vModel, $field, $value);
    }

    /**
     * 当前激活 tab 面板的 key
     * @param string $value
     */
    public function active($value){
        $field = $this->bindAttr($this->vModel);
        $this->bind($field,$value);
    }

    /**
     * 添加选项卡
     * @param string $title 标题
     * @param string|Component|\Closure $content 内容
     * @param string $key 对应 activeKey
     * @return $this
     */
    public function pane($title, $content, $key = null)
    {
        if (is_null($key)) {
            $key = count($this->pane) + 1;
        }
        $pane = TabsPane::create()
            ->tab($title)
            ->key($key);
        $this->pane[] = $pane;
        if($content instanceof \Closure && $this->form){
            $pane->forceRender();
            $this->form->tabs[$this->getModel()] = $key;
            $content = $this->form->collectFields($content);
            unset($this->form->tabs[$this->getModel()]);
        }


        if($content instanceof Grid){
            list($url,$params) = $this->parseComponentCall($content);
            $content = AsyncRender::create()->url($url)->params($params);
            $conditionFunction = <<<JS
            if(activeKey == $key){
                return true
            }
            return false
JS;
            $this->event('change', ['function' => 'refresh', 'params' => [], 'ref' => $content->ref(),'conditionFunction'=>[
                'activeKey',
                $conditionFunction
            ]], 'function');

        }
        $pane->content($content);
        $this->content($pane);
        return $this;
    }

    public function setForm(Form $form){
        $this->form = $form;
        $this->form->except($this->getModel());
    }
}
