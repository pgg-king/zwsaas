<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-21
 * Time: 22:32
 */

namespace Tadm\ui\support;

use Tadm\ui\auth\Node;
use Tadm\ui\plugin\Manager;
use Tadm\ui\Route;


/**
 * @property Config $config
 * @property Translator $translator
 * @property Node $node
 * @property Captcha $captcha
 * @property Route $route
 * @property Manager $plugin
 * @property Cache $cache
 */
class Container
{
    protected static $instance = null;
    protected $bind = [
        'config'=>Config::class,
        'translator'=>Translator::class,
        'node'=>Node::class,
        'captcha'=>Captcha::class,
        'route'=>Route::class,
        'plugin'=>Manager::class,
        'cache'=>Cache::class,
    ];
    protected $instances = [];



    /**
     * 获取当前容器的实例（单例）
     * @access public
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    public function __get($name)
    {

        if(isset($this->bind[$name])){
            if(isset($this->instances[$this->bind[$name]])){
                return $this->instances[$this->bind[$name]];
            }
            return $this->make($this->bind[$name]);
        }
    }

    public function make($name, array $arguments = [], bool $newInstance = false)
    {
        if ($newInstance || !isset($this->instances[$name])) {
            $this->instances[$name] = new $name(...$arguments);
        }
        return $this->instances[$name];
    }
}
