<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-03
 * Time: 22:10
 */

namespace Tadm\ui\component\feedback;


use Tadm\ui\component\common\Button;
use Tadm\ui\component\common\Html;
use Tadm\ui\component\Component;

/**
 * Class Confirm
 * @method static $this create($component) 创建
 * @method $this title(string $value) 标题
 * @method $this width(int $value) 宽度
 * @method $this icon(string $value) 图标
 * @method $this url(string $value) ajax请求url
 * @method $this method(string $value) ajax请求method get / post /put / delete
 * @method $this params(array $value) 提交ajax参数
 * @method $this gridRefresh() 成功刷新grid表格
 * @method $this modalRefresh(array $params = []) 成功刷新弹窗
 * @method $this gridBatch() grid批量选中项
 * @package Tadm\ui\component\feedback
 */
class Confirm extends Component
{
    protected $component;
    public function __construct($component)
    {
        $this->component = $component;
        parent::__construct();
    }

    /**
     * 内容
     * @param mixed $content
     * @param string $name
     * @return Component|Confirm|mixed
     */
    public function content($content, $name = 'default')
    {
       return $this->attr('content',$content);
    }
    public function jsonSerialize()
    {
        return $this->component
            ->ajax($this->attr('url'),$this->attr('params'),$this->attr('method'))
            ->when($this->attr('gridBatch'),function ($component){
                $component->gridBatch();
            })
            ->arg('confirm',$this->attribute);

    }
}
