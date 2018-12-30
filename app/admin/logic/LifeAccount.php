<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.25
 * Time: 22:38
 */

namespace app\admin\logic;

/**
 * Class LifeAccount
 * 生活号逻辑
 * @package app\admin\logic
 */
class LifeAccount extends AdminBase
{
    /**
     * 获取生活号列表
     */
    public function lifeAccountList($where = [], $field = true, $order = '', $paginate = false)
    {
        // 指定数据库表别名
        $this->modelLifeAccount->alias('m');

        // 条件
        $where['m.id'] = ['<>', 0];

        // 查数据库
        $list = $this->modelLifeAccount->getList($where, $field, $order, $paginate);

        foreach ($list as $key => $value) {
            $value['totalFans'] = $this->getLifeAccountFans($value);
            $this->modelLifeAccount->setInfo($value);
        }
        return $list;
    }

    /**
     * 获取生活号粉丝列表
     */
    public function getLifeAccountFans($lifeAccount)
    {
        vendor('alipay.aop.AopClient');
        vendor('alipay.aop.request.AlipayOpenPublicFollowBatchqueryRequest');
        $aop = new \AopClient ();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';

        $aop->appId = $lifeAccount['appid'];
        $aop->rsaPrivateKey = $lifeAccount['merchant_private_key'];
        $aop->alipayrsaPublicKey = $lifeAccount['alipay_public_key'];
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $request = new \AlipayOpenPublicFollowBatchqueryRequest ();
        $request->setBizContent("{" .
            "\"next_user_id\":\"2088102146158132\"" . "  }");
        $result = $aop->execute ( $request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        echo $result;
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            echo "成功";
        } else {
            echo "失败";
        }
        return $resultCode;
    }

    /**
     * 添加生活号
     * @param array $data
     */
    public function addLifeAccount($data = [])
    {
        // 检查是否包含所需要的全部字段
        $validate_result = $this->validateLifeAccount->scene('add')->check($data);

        // 如果验证未通过
        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateLifeAccount->getError()];
        }

        // 验证通过
        $url = url('lifeAccountList');

        //
        $result = $this->modelLifeAccount->setInfo($data);

        $result && action_log('新增', '生活号，life_name：' . $data['life_name']);

        return $result ? [RESULT_SUCCESS, '生活号添加成功', $url] : [RESULT_ERROR, $this->modelLifeAccount->getError()];
    }
}