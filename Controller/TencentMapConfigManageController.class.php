<?php
/**
 * User: jayinton
 * Date: 2019/12/26
 * Time: 13:45
 */

namespace Lbs\Controller;


use Common\Controller\AdminBase;
use Lbs\Service\TencentMapConfigService;

class TencentMapConfigManageController extends AdminBase
{
    function lists()
    {
        $this->display();
    }

    function edit()
    {
        $this->display();
    }

    function doEdit()
    {
        $data = I('post.');
        $data['detail_url'] = I('post.detail_url', '', '');
        $data['content'] = I('post.content', '', '');
        if (empty($data['id'])) {
            $data['create_time'] = time();
            $data['update_time'] = time();
            $res = TencentMapConfigService::createItem($data);
        } else {
            $id = $data['id'];
            unset($data['id']);
            $data['update_time'] = time();
            $res = TencentMapConfigService::updateItem($id, $data);
        }
        $this->ajaxReturn($res);
    }

    function doDelete()
    {
        $id = I('post.id');
        $res = TencentMapConfigService::deleteItem($id);
        $this->ajaxReturn($res);
    }

    function doDeleteConfig()
    {
        $id = I('post.id');
        $res = TencentMapConfigService::deleteConfig($id);
        $this->ajaxReturn($res);
    }

    function getDetail()
    {
        $id = I('id');
        $res = TencentMapConfigService::getById($id);
        $this->ajaxReturn($res);
    }

    function getList()
    {
        $page = I('page', 1);
        $limit = I('limit', 15);
        $res = TencentMapConfigService::getList([], 'id desc', $page, $limit);
        $this->ajaxReturn($res);
    }

    //显示编辑配置项
    function editKey()
    {
        $this->display();
    }

    //获取单一配置项
    function getKeyconfig(){
        $key = I('key','');
        $res = TencentMapConfigService::getConfigByKey($key);
        $this->ajaxReturn($res);
    }

    /**
     *  修改单一配置项
     *  @param $key
     */
    function doEditKeyconfig()
    {
        $data = I('post.');
        $data['key'] = I('post.key', '', '');
        $data['name'] = I('post.name', '', '');
        $data['value'] = I('post.value', '', '');
        if (empty($data['id'])) {
            $res = TencentMapConfigService::createCongfig($data);
        } else {
            $id = $data['id'];
            unset($data['id']);
            $res = TencentMapConfigService::updateConfigByKey('id',$id, $data);
        }
        $this->ajaxReturn($res);
    }



}