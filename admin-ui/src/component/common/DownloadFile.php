<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-02-16
 * Time: 00:00
 */

namespace Tadm\ui\component\common;



use Tadm\ui\component\Component;

/**
 * Class DownloadFile
 * @package namespace Tadm\ui\component\common
 * @method $this filename(string $filename) 文件名
 * @method $this url(string $url) 文件链接
 * @method $this onlyImage(bool $value = true) 只是图片
 */
class DownloadFile extends Component
{
    protected $name = 'ExDownloadFile';

}
