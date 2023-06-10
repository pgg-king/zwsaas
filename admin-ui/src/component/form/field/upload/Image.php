<?php

namespace Tadm\ui\component\form\field\upload;
/**
 * 图片上传组件
 * @method $this imageWidth(int $value) 图片框宽度
 * @method $this imageHeight(int $value) 图片框高度
 * @mixin \Intervention\Image\Image
 */
class Image extends File
{
    protected $macros = [
        'action',
        'options',
        'params',
        'headers',
        'type',
        'disk',
        'directory',
        'driver',
        'accept',
        'chunk',
        'isDirectory',
        'input',
        'chunkSize',
        'domain',
        'progress',
        'onlyShow',
        'limit',
        'accessKey',
        'secretKey',
        'bucket',
        'region',
        'uploadToken',
        'disabled',
        'imageWidth',
        'imageHeight',
        'paste',
        'hideFinder',
    ];
    protected $interventionCall = [];

    protected $thumbnail = [];

    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);
        $this->type('image')
            ->size(80,80)
            ->accept('image/*')
            ->input(false);
    }

    /**
     * 缩略图
     * @param string|array $name
     * @param int $width 宽度
     * @param int $height 高度
     * @return $this
     */
    public function thumbnail($name = 'thumb', $width = null, $height = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $size) {
                $this->thumbnail[$key] = $size;
            }
        } else {
            $this->thumbnail[$name] = [$width, $height];
        }
        return $this;
    }
    /**
     * 上传图片框尺寸
     * @param int $width 宽度
     * @param int $height 高度
     * @return $this
     */
    public function size(int $width,int $height)
    {
        $this->imageWidth($width);
        $this->imageHeight($height);
        return $this;
    }
    public function getThumbnail(){
        return $this->thumbnail;
    }
    public function getInterventionCall(){
        return $this->interventionCall;
    }
    public function __call($name, $arguments)
    {
        if(in_array($name,$this->macros)){
            return parent::__call($name, $arguments); // TODO: Change the autogenerated stub
        }
        $this->interventionCall[] = [
            'method'    => $name,
            'arguments' => $arguments,
        ];
        return $this;
    }
}
