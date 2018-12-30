<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.24
 * Time: 23:00
 */

namespace app\admin\controller;

class LifeAccount extends AdminBase
{
    /**
     * 生活号列表
     */
    public function lifeAccountList()
    {
        // 获取列表并直接设置到页面
        $this->assign('logicLifeAccountList', $this->logicLifeAccount->lifeAccountList());

        // 返回视图
        return $this->fetch('life_account_list');
    }

    /**
     * 生活号添加
     */
    public function addLifeAccount()
    {
        // 如果是post请求则跳转logic层的member的添加方法
        IS_POST && $this->jump($this->logicLifeAccount->addLifeAccount($this->param));

        // 如果不是则跳转视图层
        $this->assign('lifeTypeList', $this->logicLifeType->lifeTypeList());
        return $this->fetch('life_account_add');
    }


}