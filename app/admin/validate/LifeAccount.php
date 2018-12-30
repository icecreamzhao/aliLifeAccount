<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.27
 * Time: 21:40
 */

namespace app\admin\validate;


class LifeAccount extends AdminBase
{
    // 验证规则
    protected $rule =   [

        'life_type_id'          => 'require',
        'life_name'             => 'require|unique:life_account',
        'appid'                 => 'require|number|unique:life_account',
        'alipay_public_key'     => 'require|unique:life_account',
        'merchant_private_key'  => 'require|unique:life_account',
    ];

    // 验证提示
    protected $message  =   [

        'life_type_id.require'          => '请选择一个类型',
        'life_name.require'             => '生活号标题不能为空',
        'appid.require'                 => 'appid不能为空',
        'appid.number'                  => 'appid只能为数字',
        'alipay_public_key.require'     => '商户公钥不能为空',
        'appid.unique'                  => 'appid已经存在',
        'alipay_public_key.unique'      => '商户公钥已经存在',
        'merchant_private_key.require'  => '商户私钥不能为空',
        'merchant_private_key.unique'   => '商户私钥已经存在',
    ];

    // 应用场景
    protected $scene = [

        'add'  =>  ['life_type_id', 'life_name', 'appid', 'alipay_public_key', 'merchant_private_key'],
        'edit' =>  ['life_type_id', 'life_name'],
    ];
}