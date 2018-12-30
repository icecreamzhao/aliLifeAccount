<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.27
 * Time: 21:40
 */

namespace app\admin\validate;


class LifeType extends AdminBase
{
    // 验证规则
    protected $rule =   [

        'type_name'      => 'require|unique:life_type',
    ];

    // 验证提示
    protected $message  =   [

        'type_name.require'      => '类型名不能为空',
        'type_name.unique'       => '类型名已经存在',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['typeName'],
        'edit'      =>  ['typeName']
    ];
}