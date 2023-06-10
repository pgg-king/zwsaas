<?php

namespace Tadm\ui\component\grid\grid\excel;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Symfony\Component\Filesystem\Filesystem;

class Excel extends AbstractExporter
{
    protected $maxRow = 1048576;

    protected $spreadsheet;
    /**
     * @var Worksheet
     */
    protected $sheet;
    /**
     * 图片存储临时目录
     * @var array
     */
    protected $tmpImageDirs = [];
    /**
     * 图片列宽度
     * @var array
     */
    protected $imageColumnWidth = [];

    public function init()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    public function columns(array $columns)
    {
        parent::columns($columns); // TODO: Change the autogenerated stub
        //表头
        $header = array_values($this->getColumns());
        foreach ($header as $index => $title) {
            $this->sheet->setCellValueByColumnAndRow($index + 1, $this->currentRow, $title);
            $this->sheet->getColumnDimensionByColumn($index + 1)->setWidth(ceil(mb_strlen($title, 'utf-8') * 4));
            $this->sheet->getStyleByColumnAndRow($index + 1, 1)->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
            ]);
        }
        return $this;
    }

    /**
     * 写入数据
     * @param array $data
     * @param \Closure $finish 完成
     */
    public function write(array $data, \Closure $finish = null)
    {
        //写入数据
        $fields = array_keys($this->getColumns());
        foreach ($data as $row) {
            $this->currentRow++;
            foreach ($fields as $index => $field) {
                $value = $row[$field];
                if ($this->mapCallback instanceof \Closure) {
                    $value = call_user_func($this->mapCallback, $value, $this->sheet);
                }
                if(in_array($field,$this->imageColumns) && in_array($this->extension,['xlsx','xls'])){
                    $this->insertImage($value, Coordinate::stringFromColumnIndex($index + 1) );
                }else{
                    if (is_array($value)) {
                        $value = implode('、', $value);
                    }
                    $this->sheet->setCellValueExplicitByColumnAndRow($index + 1, $this->currentRow, $value, DataType::TYPE_STRING);
                    $this->sheet->getStyleByColumnAndRow($index + 1, $this->currentRow)->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                            'vertical' => Alignment::VERTICAL_CENTER
                        ],
                    ]);
                }
                $this->cache->set($this->progressKey,[
                    'status' => 0,
                    'progress' => $this->progress()
                ],60);
            }
            if ($this->currentRow > $this->count) {
                if ($finish) {
                    $result = call_user_func($finish, $this);
                    $this->cache->set($this->progressKey,[
                        'status' => 1,
                        'url' => $result
                    ],60);
                }
            }
        }
    }

    protected function insertImage($images, $letter)
    {
        $coordinates = $letter.$this->currentRow;
        $this->sheet->getRowDimension($this->currentRow)->setRowHeight(80);
        if (!is_array($images)) {
            $images = [$images];
        }
        foreach ($images as $index => $image) {
            $imageContents = @file_get_contents($image);
            if(empty($imageContents)){
                continue;
            }
            $dir = sys_get_temp_dir().$this->filename;
            $this->tmpImageDirs[] = $dir;
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $filePath = tempnam($dir, 'Drawing');
            file_put_contents($filePath, $imageContents);
            $drawing = new Drawing();

            $drawing->setPath($filePath);
            $drawing->setResizeProportional(false);
            $drawing->setWidth(80);
            $drawing->setHeight(80);
            $drawing->setOffsetX($index * 80 + 10);
            $drawing->setOffsetY(0);
            $drawing->setCoordinates($coordinates);
            $drawing->setWorksheet($this->sheet);
        }
        $count = count($images);
        $width = $count * 80 ;
        if(!isset($this->imageColumnWidth[$letter]) || $width > $this->imageColumnWidth[$letter]){
            $this->imageColumnWidth[$letter] = $width;
            $this->sheet->getColumnDimension($letter)->setWidth($width,'px');
        }
    }

    /**
     * 保存
     * @param string $path 保存目录
     * @return string|bool
     */
    public function save(string $path)
    {
        $writer = IOFactory::createWriter($this->spreadsheet, ucfirst($this->extension));
        $path = rtrim($path, DIRECTORY_SEPARATOR);
        $filename = $path . DIRECTORY_SEPARATOR . $this->filename . '.' . $this->extension;
        $writer->save($filename);
        $Filesystem = new Filesystem;
        $Filesystem->remove($this->tmpImageDirs);
        return $filename;
    }

}