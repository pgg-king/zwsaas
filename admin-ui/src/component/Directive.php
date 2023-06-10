<?php

namespace Tadm\ui\component;

use Tadm\ui\component\common\Html;
use Tadm\ui\component\navigation\menu\MenuItem;
use Tadm\ui\support\Container;

trait Directive
{
    //自定义指令
    protected $directive = [];
    /**
     * @param string $name 指令名称
     * @param string|array $value 值
     * @param string|array $argument 参数(可选)
     * @return $this
     */
    public function directive($name, $value = '', $argument = '')
    {
        $this->directive[] = ['name' => $name, 'argument' => $argument, 'value' => $value];
        return $this;
    }
    public function getDirective(){
        return $this->directive;
    }
    public function setDirective(array $directive){
        $this->directive = $directive;
    }

    /**
     * ajax请求
     * @param string|array $url 请求url 空不请求
     * @param array $params 请求参数
     * @param string $method 请求方式
     * @return Ajax
     */
    public function ajax($url, array $params = [],string $method = 'POST')
    {
        $url = admin_url($url);
        $this->whenShow(admin_check_permissions($url,$method));
        return new Ajax($this,[
            'url' => $url,
            'data' => $params,
            'method' => $method,
        ]);
    }
    /**
     * 跳转路径
     * @param mixed $url
     * @param array $params
     * @return $this
     */
    public function redirect($url, $params = [])
    {
        list($url, $params) = $this->parseComponentCall($url, $params);
        $this->whenShow(admin_check_permissions($url,'GET'));
        $url = $url . '?' . http_build_query($params);
        $style = $this->attr('style') ?? [];
        $style = array_merge($style, ['cursor' => 'pointer']);
        $this->attr('style', $style);
        return $this->directive('redirect', $url);

    }

    /**
     * 拷贝
     * @param string $content 复制文本
     * @return $this
     */
    public function copy($content){
        return $this->directive('copy', $content);
    }

    /**
     * 队列进度
     * @param string $title 标题
     * @param string $class 队列类名
     * @param bool $refresh 成功刷新页面
     * @return Component
     */
    public function queueProgress($title, $class,$refresh = true)
    {
        return $this->directive('queueProgress', $title,[
            'class'=>$class,
            'refresh'=>$refresh
        ]);
    }
}
