<?php

namespace Tadm\ui\component;
/**
 * ajax请求
 */
class Ajax implements \JsonSerializable
{
    protected $component;
    protected $options = [];
    protected $arg = [];

    public function __construct($component, $options)
    {
        $this->component = $component;
        $this->options = $options;
    }


    public function arg($name,array $options)
    {
        $this->arg[$name] = $options;
        return $this;
    }

    /**
     * grid 选择项
     * @return $this
     */
    public function gridBatch()
    {
        $this->arg['gridBatch'] = true;
        return $this;
    }

    /**
     * 刷新grid
     * @return $this
     */
    public function gridRefresh()
    {
        $this->arg['gridRefresh'] = true;
        return $this;
    }
    /**
     * 刷新弹窗
     * @param array $params 携带参数
     * @return $this
     */
    public function modalRefresh(array $params = [])
    {
        $this->arg['modalRefresh'] = $params;
        return $this;
    }
    public function __call(string $name, array $arguments)
    {
        call_user_func_array([$this->component,$name],$arguments);
        return $this;
    }

    public function jsonSerialize()
    {
        $this->component->directive('ajax', $this->options, $this->arg);
        return $this->component;
    }
}
