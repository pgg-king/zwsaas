<?php
namespace Tadm\ui\support;

use Symfony\Component\Translation\Formatter\MessageFormatter;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageSelector;

class Translator extends \Symfony\Component\Translation\Translator
{
    public function __construct($locale='en')
    {

        parent::__construct($locale);
        $this->addLoader('array', new ArrayLoader());
        $this->load(__DIR__.'/../lang','ex_admin_ui');

    }
    public function load($path,$name){
        $path = rtrim($path,'/');
        foreach (glob($path.'/*') as $item){
            if(is_dir($item)){
                $locale =  basename($item);
                foreach (glob($item.'/*.php') as $file){
                    $resource = include $file;

                    $domain = str_replace('.php','',basename($file));

                    $this->addResource('array',$resource,$locale,$name.'-'.$domain);
                }
            }
        }
    }
    public function tran($id, $default = null, array $parameters = [],  $locale = null)
    {
        $domain = null;
        $arr = explode('.',$id);
        $domain = array_shift($arr);
        $id = implode('.',$arr);
        if (empty($id)){
            $formatter = new MessageFormatter();
            $catalogue = $this->getCatalogue($locale);
            $locale = $catalogue->getLocale();
            $all = $catalogue->all($domain);
            $data = [];
            foreach ($all as $key=>$message){
                $this->setArr($data,$key,$formatter->format($message,$locale,$parameters));
            }
            return $data;
        }

        $content =  parent::trans($id, $parameters, $domain, $locale); // TODO: Change the autogenerated stub
        if($content == $id && !is_null($default)){
            $content = $default;
        }
        return $content;
    }
    protected function setArr(&$array, $key, $value)
    {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
}
