<?php

namespace Tadm\ui\component\grid\grid\driver;

use Tadm\ui\contract\GridAbstract;
use Tadm\ui\response\Message;
use Tadm\ui\response\Response;
use Tadm\ui\support\Request;

class Plugin extends GridAbstract
{
    /**
     * 删除
     * @param array $ids 删除id
     * @return Message
     */
    public function delete(array $ids,bool $all = false): Message
    {
        // TODO: Implement delete() method.
    }

    /**
     * 恢复数据
     * @param array $ids 恢复id
     * @return Message
     */
    public function restore(array $ids): Message
    {
        // TODO: Implement restore() method.
    }


    /**
     * 拖拽排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @param string $field 字段
     * @return Message
     */
    public function dragSort($id, int $sort, string $field): Message
    {
        // TODO: Implement dragSort() method.
    }

    /**
     * 输入框排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @param string $field 字段
     * @return Message
     */
    public function inputSort($id, int $sort, string $field): Message
    {
        // TODO: Implement inputSort() method.
    }

    /**
     * 表格列触发排序
     * @param string $field 字段
     * @param string $sort 排序 asc desc
     * @return mixed
     */
    public function tableSort($field, $sort)
    {
        // TODO: Implement tableSort() method.
    }

    /**
     * 快捷搜索
     * @param string $keyword 关键词
     * @param string|array|\Closure $search 搜索设置
     * @return mixed
     */
    public function quickSearch($keyword, $search)
    {
        $this->quickSearch = $keyword;
        // TODO: Implement quickSearch() method.
    }

    /**
     * 数据源
     * @param int $page 第几页
     * @param int $size 分页大小
     * @param bool $hidePage 是否分页
     * @return mixed
     */
    public function data(int $page, int $size, bool $hidePage)
    {
        $data = plugin()->getList(Request::input('type',0),$this->quickSearch,Request::input('cate_id'),$page,$size);
        $this->setTotal($data['total']);
        //print_r($data['data']);die;
        return $data['data'];
    }

    /**
     * 总条数
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * 是否有回收站
     * @return bool
     */
    public function trashed(): bool
    {
       return false;
    }

    /**
     * 导出数据
     * @param array $selectIds 导出选中id
     * @param array $columns 导出列
     * @param bool $all 是否导出全部
     * @return Response
     */
    public function export(array $selectIds, array $columns, bool $all): Response
    {
        // TODO: Implement export() method.
    }

    /**
     * 筛选
     * @param array $rule
     * @return mixed
     */
    public function filter(array $rule)
    {
        // TODO: Implement filter() method.
    }

    /**
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
    }

}
