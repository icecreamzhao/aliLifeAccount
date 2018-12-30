<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.27
 * Time: 21:38
 */

namespace app\admin\controller;


class LifeType extends AdminBase
{
    /**
     * 生活号类型添加
     */
    public function addLifeType()
    {
        // 如果是post请求则跳转logic层的member的添加方法
        IS_POST && $this->jump($this->logicLifeType->addLifeType($this->param));

        // 如果不是则跳转视图层
        return $this->fetch('life_type_add');
    }

    /**
     * 生活号类型列表
     */
    public function lifeTypeList()
    {
        //
        $this->assign('lifeTypeList', $this->logicLifeType->lifeTypeList());

        // 返回视图
        return $this->fetch('life_type_list');
    }
}