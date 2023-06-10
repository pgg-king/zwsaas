<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-12
 * Time: 20:56
 */

namespace Tadm\ui\component\grid\grid\driver;

use ExAdmin\laravel\Grid\Event\Deleted;
use ExAdmin\laravel\Grid\Event\Deling;
use ExAdmin\laravel\Grid\Event\Updated;
use ExAdmin\laravel\Grid\Event\Updateing;
use Tadm\ui\component\grid\grid\Export;
use Tadm\ui\component\grid\grid\Grid;
use Tadm\ui\contract\GridAbstract;
use Tadm\ui\response\Message;
use Tadm\ui\response\Response;
use Tadm\ui\support\Request;


class Arrays extends GridAbstract
{

    /**
     * 更新
     * @param array $ids 更新条件id集合
     * @param array $data 更新数据
     * @return Message
     */
    public function update(array $ids, array $data): Message
    {
        $result = $this->dispatchEvent('updateing', [$ids, $data]);
        if ($result instanceof Message) {
            return $result;
        }


        $deletedResult = $this->dispatchEvent('updated', [$ids, $data]);
        if ($deletedResult instanceof Message) {
            return $deletedResult;
        }

        return message_success(admin_trans('grid.update_success'));
    }


    public function delete(array $ids, bool $all = false): Message
    {
        $arg = $all ? $all : $ids;
        $result = $this->dispatchEvent('deling', [$arg]);
        if ($result instanceof Message) {
            return $result;
        }


        $deletedResult = $this->dispatchEvent('deleted', [$arg]);
        if ($deletedResult instanceof Message) {
            return $deletedResult;
        }
        return message_success(admin_trans('grid.delete_success'));
    }
    
    public function dragSort($id, int $sort, string $field): Message
    {
        $result = $this->dispatchEvent('sorting', [$id,$sort,$field]);
        if ($result instanceof Message) {
            return $result;
        }
        return message_success(admin_trans('grid.sort_success'));
    }

    public function inputSort($id, int $sort, string $field): Message
    {
        $result = $this->dispatchEvent('sorting', [$id,$sort,$field]);
        if ($result instanceof Message) {
            return $result;
        }
        return message_success(admin_trans('grid.sort_success'));
    }

    public function tableSort($field, $sort)
    {
        // TODO: Implement tableSort() method.
    }

    /**
     * 快捷搜索
     * @param string $keyword 关键词
     * @param string|array|\Closure $search
     * @return mixed
     */
    public function quickSearch($keyword, $search)
    {
        // TODO: Implement quickSearch() method.
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
     * 数据源
     * @param int $page 第几页
     * @param int $size 分页大小
     * @param bool $hidePage 是否分页
     * @return mixed
     */
    public function data(int $page, int $size, bool $hidePage)
    {
        if ($hidePage) {
            return $this->repository;
        } else {
            $page = ($page - 1) * $size;
            return array_slice($this->repository, $page, $size);
        }
    }

    public function total(): int
    {
        return count($this->repository);
    }

    public function export(array $selectIds, array $columns, bool $all): Response
    {
        $export = $this->grid->getExport();
        $export->setProgressKey(uniqid());
        $columns = array_column($columns, 'title', 'dataIndex');

        if ($all) {
            $data = $this->repository;
        } else {
            $data = array_filter($this->repository, function ($item) use ($selectIds) {
                if (in_array($item[$this->getPk()], $selectIds)) {
                    return true;
                }
                return false;
            });
        }
        $data = $this->grid->parseColumn($data, true);
        $export->columns($columns)->count(count($data));
        $export->write($data, function ($export) {
            $filename = $export->save(sys_get_temp_dir());
            return Request::getSchemeAndHttpHost() . '/ex-admin/system/download?App-Name=' . Request::header('App-Name') . '&file=' . $filename;
        });
        return $export->export();
    }

    public function filter(array $rule)
    {
        // TODO: Implement filter() method.
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


    public function model()
    {
        // TODO: Implement model() method.
    }
}
