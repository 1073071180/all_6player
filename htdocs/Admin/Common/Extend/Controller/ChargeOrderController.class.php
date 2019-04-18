<?php
/**
 * Thinkphp控制器扩展，
 * @Author: Dave Jiang
 * @Date:   2015-10-07 16:23:21
 * @Last Modified by:   anchen
 * @Last Modified time: 2015-11-21 17:54:11
 */
namespace Extend\Controller;
use Think\Controller;
class ChargeOrderController extends Controller {
    public function charge($cargoWeight,$cargoVolume,$minimumGuarantee,$lineType,$lineStepPrice){
        if ($cargoWeight == 0) { // 转换成数字
            $cargoWeight = 0;
        }
        if ($cargoVolume == 0) { // 转换成数字
            $cargoVolume = 0;
        }
        $volumeToWeight = 0;
        if ($lineType == C('AIR_LINE')) {
            $volumeToWeight = C('AIR_CARRIAGE_VOLUME_TO_WEIGHT');
        } else {
            $volumeToWeight = C('LAND_CARRIAGE_VOLUME_TO_WEIGHT');
        }
        $weight = max($cargoWeight,
                      $cargoVolume==0?0:($cargoVolume*$volumeToWeight));
        for ($index=count($lineStepPrice)-1; $index>=0; --$index) {
            if ($weight >= $lineStepPrice[$index]['step_weight']) {
                $priceByWeight = $lineStepPrice[$index]['weight_cargo_price'] * $cargoWeight;
	            $priceByVolume = $lineStepPrice[$index]['light_cargo_price'] * $cargoVolume;
	            $isWeightCargo = ($priceByWeight>=$priceByVolume); // 判断重货还是轻货
	            $finalPrice = max($minimumGuarantee,$priceByWeight, $priceByVolume);
                $finalPrice = round($finalPrice,2);

                $result = $lineStepPrice[$index];
                $result['carriage_fee'] = $finalPrice; // 按重量/体积计算的运费
                $result['is_weight_cargo'] = $isWeightCargo;
                return $result;
            }
        }
        return null;
    }
}