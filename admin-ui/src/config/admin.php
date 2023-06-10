<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-21
 * Time: 21:12
 */
return [
    'request_interface' => [
        //Tadm\ui\contract\LoginInterface
        'login' => '',
        //Tadm\ui\contract\SystemAbstract
        'system' => '',
    ],
    'grid' => [
         //Tadm\ui\Manager
        'manager' => \Tadm\ui\manager\GridManager::class,
    ],
    'form' => [
        //Tadm\ui\Manager
        'manager' => \Tadm\ui\manager\FormManager::class,
        //Tadm\ui\contract\ValidatorAbstract
        'validator' => '',
        //Tadm\ui\contract\UploaderAbstract
        'uploader'=>'',
    ],
    'echart' => [
        //Tadm\ui\Manager
        'manager' => \Tadm\ui\manager\EchartManager::class,
    ],
    //扫描权限目录
    'auth_scan' => [],
    
    //插件
    'plugin'=>[
        //插件目录
        'dir'=>dirname(__DIR__,5).DIRECTORY_SEPARATOR.'plugin',
        //插件命名空间
        'namespace'=>'plugin'
    ],
    //菜单
    //Tadm\ui\contract\MenuAbstract
    'menu'=>'',
];
