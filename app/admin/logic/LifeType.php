<?php
/**
 * Created by PhpStorm.
 * User: littleboy
 * Date: 18.12.27
 * Time: 21:39
 */

namespace app\admin\logic;


class LifeType extends AdminBase
{
    /**
     * 添加生活号类型
     */
    public function addLifeType($data = [])
    {
        // 检查是否包含所需要的全部字段
        $validate_result = $this->validateLifeType->scene('add')->check($data);

        // 如果验证未通过
        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateLifeType->getError()];
        }

        // 验证通过
        $url = url('lifeTypeList');

        //
        $result = $this->modelLifeType->setInfo($data);

        $result && action_log('新增', '生活号类型，type_name：' . $data['type_name']);

        return $result ? [RESULT_SUCCESS, '生活号类型添加成功', $url] : [RESULT_ERROR, $this->modelLifeType->getError()];
    }

    /**
     * 生活号类型列表
     * @param array $where 条件
     * @param bool $field 需要查询的字段
     * @param string $order 排序
     * @param bool $paginate 分页, 如果不需要分页则设置为false
     * @return mixed
     */
    public function lifeTypeList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {
        // 指定数据库表别名
        $this->modelLifeType->alias('m');

        $where['m.id'] = ['<>', 0];

        return $this->modelLifeType->getList($where, $field, $order, $paginate);
    }
}