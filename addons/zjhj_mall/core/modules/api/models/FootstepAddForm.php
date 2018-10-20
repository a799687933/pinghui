<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/30
 * Time: 13:22
 */

namespace app\modules\api\models;

use app\models\Footstep;

class FootstepAddForm extends ApiModel
{
    public $store_id;
    public $user_id;
    public $goods_id;

    public function rules()
    {
        return [
            [['goods_id'], 'required',],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->errorResponse;
        }
        $existFootstep = Footstep::findOne([
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'goods_id' => $this->goods_id,
            'is_delete' => 0,
        ]);
            if ($existFootstep) {
                $existFootstep->addtime = time();
                     if ($existFootstep->save()) {
                        return [
                            'code' => 0,
                            'msg' => 'success',
                        ];
                    } else {
                        return [
                            'code' => 1,
                            'msg' => 'fail',
                        ];
            }
        }
        $Footstep = new Footstep();
        $Footstep->store_id = $this->store_id;
        $Footstep->user_id = $this->user_id;
        $Footstep->goods_id = $this->goods_id;
        $Footstep->addtime = time();
        if ($Footstep->save()) {
            return [
                'code' => 0,
                'msg' => 'success',
            ];
        } else {
            return [
                'code' => 1,
                'msg' => 'fail',
            ];
        }
    }
}
