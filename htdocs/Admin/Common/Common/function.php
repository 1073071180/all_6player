<?php
/**
  +------------------------------------------------------------------------------
 * ommon.php
  +------------------------------------------------------------------------------
 * @author   	赵尊杰 <10199720@qq.com>
 * @version  	$Id: common.php v001 2015-09-24
 * @description 公共函数库
  +------------------------------------------------------------------------------
 */

function l4p() {
	static $logger;
	if (is_null($logger)) {
		// Insert the path where you unpacked log4php
		require_once('./plugin/log4php/src/main/php/Logger.php'); // path
		// Tell log4php to use our configuration file.
		// Logger::configure('log4php.xml'); // path
		Logger::configure(array('rootLogger' => array(
				'appenders' => array('default'),
				'level'=>'TRACE',
		),
				'appenders' => array(
						'default' => array(
								'class' => 'LoggerAppenderFile',
								'layout' => array('class' => 'LoggerLayoutPattern',
										'params' => array("conversionPattern"=>"[%date{Y-m-d H:i:s,u}] %level [%logger] %F:%line %message%newline")
								),
								'params' => array(
										'file' => ini_get('error_log'),
										'append' => true
								)
						)
				)));

		// Fetch a logger, it will inherit settings from the root logger
		//$log = Logger::getLogger('myLogger');
		$logger = Logger::getLogger('default');

		// Start logging
		// $log->trace("My first message.");   // Not logged because TRACE < WARN
		// $log->debug("My second message.");  // Not logged because DEBUG < WARN
		// $log->info("My third message.");    // Not logged because INFO < WARN
		// $log->warn("My fourth message.");   // Logged because WARN >= WARN
		// $log->error("My fifth message.");   // Logged because ERROR >= WARN
		// $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
	}
	return $logger;
}

function getFlushSession($sessionName){
	if( ! isset($_SESSION[$sessionName])){
		return false;
	}

	$sessionValue = $_SESSION[$sessionName];
	unset($_SESSION);
	return $sessionValue;
}



/**
 * PHP计算两个时间段是否有交集（边界重叠不算）
 *
 * @param string $beginTime1 开始时间1
 * @param string $endTime1 结束时间1
 * @param string $beginTime2 开始时间2
 * @param string $endTime2 结束时间2
 * @return bool
 * @author blog.snsgou.com
 */
function is_time_cross($beginTime1 = '', $endTime1 = '', $beginTime2 = '', $endTime2 = '')
{
	$status = $beginTime2 - $beginTime1;
	if ($status > 0)
	{
		$status2 = $beginTime2 - $endTime1;
		if ($status2 >= 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		$status2 = $endTime2 - $beginTime1;
		if ($status2 > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function getMillisecond() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}
	//生成随机字符串
	function randStr($len,$isNum=false){
		if($isNum){
			$chars = array("0","1", "2","3", "4", "5", "6", "7", "8", "9");
		}else{
			$chars = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B","D", "E", "F", "G","H","J","L", "M", "N","Q", "R","T", "U","Y", "2","3", "4", "5", "6", "7", "8", "9"
			);
		}
		$charsLen = count($chars) - 1;
		shuffle($chars);    // 将数组打乱
		$outStr= "";
		for ($i=0; $i<$len; $i++){
			$outStr .= $chars[mt_rand(0, $charsLen)];
		}
		return $outStr;
	}

function my_array_column($array,$column_name) {
	if(function_exists("array_column")){
		return array_column($array,$column_name);
	}
	return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
}
	
	//UTF8转GB2312/Gbk
	function utf8Gb2312(&$item,$strType='gb2312'){
		if(is_array($item)){
			array_walk($item,'utf8Gb2312');
		}else{
			if($strType=='gb2312'){
				$item = iconv('UTF-8','gb18030//IGNORE',$item);
			}else{
				$item = mb_convert_encoding($item,'GBK','UTF-8');
			}
		}
	}
	
	//GB2312/Gbkז转UTF8
	function gb2312Utf8(&$item,$strType='gb2312'){
		if(is_array($item)){
			array_walk($item,'gb2312Utf8');
		}else{		
			if($strType=='gb2312'){
				$item = iconv('gb18030','UTF-8//IGNORE',$item);
			}else{
				$item = mb_convert_encoding($item,'UTF-8','GBK');
			}
		}
	}
	
	function formatTime($time){
		return substr($time,5,11);
	}
	
	
	function formatAttr($itemId,$itemName){
		foreach($itemId as $value){
			$item[$value]=$itemName[$value];
		}
		echo implode(' ',$item);
	}
	
	function formatGoodsSn($sn,$cp=1,$goodsSn=''){
		if(!empty($sn)){
			$prefix=substr($sn,0,3);
			if($cp==1){
				echo $prefix;
			}else{
				$sn=str_replace($prefix,'',$sn);
				if(empty($sn)){
					echo $goodsSn;
					exit;
				}
				echo $sn; 
			}
		}else{
			if($cp==1){
				echo 'F00';
			}else{
				echo $goodsSn; 
			}
		}
		echo '';
	}	
	
	function formatOrderGoodsAttr($goodsAttr){
		if(!empty($goodsAttr['goodsAttributeValues'])){
			foreach($goodsAttr['goodsAttributeValues'] as $key=>$value){
				$itemName[]=$value['attributeItem']['name'];
			}
		}
		return implode(' ',$itemName);
	}

	function parseGoodsAttr($goodsAttrVal){
		if(empty($goodsAttrVal)){
			return false;
		}

		$goodsAttrVal = json_decode($goodsAttrVal,TRUE);
		return formatOrderGoodsAttr($goodsAttrVal);
	}
	
	function exportexcel($data=array(),$title=array(),$filename='report'){
	    header("Content-type:application/octet-stream");
	    header("Accept-Ranges:bytes");
	    header("Content-type:application/vnd.ms-excel");  
	    header("Content-Disposition:attachment;filename=".$filename.".xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    //导出xls 开始
	    if (!empty($title)){
	        foreach ($title as $k => $v) {
	            $title[$k]=iconv("UTF-8", "GBK",$v);
	        }
	        $title= implode("\t", $title);
	        echo "$title\n";
	    }
	    if (!empty($data)){
	        foreach($data as $key=>$val){
	            foreach ($val as $ck => $cv) {
	                $data[$key][$ck]=iconv("UTF-8", "GBK", $cv);
	            }
	            $data[$key]=implode("\t", $data[$key]);
	            
	        }
	        echo implode("\n",$data);
	    }
	}
	
	function formatSelectTime($name='startTime[]'){
		$time='<select name="'.$name.'" style="width:60px">';
		for($i=0;$i<=24;$i++){
			if($i<10){
				$j='0'.$i.':00';
			}else{
				$j=$i.':00';
			}
			$time.='<option value="'.$j.'">'.$j.'</option>';
		}
		$time.='</select>';
		echo $time;
	}
	
	
	/** 
	 * 求一个数的平方 
	 * @param $n 
	 */  
	function sqr($n){  
	    return $n*$n;  
	}  
	  
	/** 
	* 生产min和max之间的随机数，但是概率不是平均的，从min到max方向概率逐渐加大。 
	* 先平方，然后产生一个平方值范围内的随机数，再开方，这样就产生了一种“膨胀”再“收缩”的效果。 
	*/    
	function xRandom($bonus_min,$bonus_max){  
	    $sqr = intval(sqr($bonus_max-$bonus_min));  
	    $rand_num = rand(0, ($sqr-1));  
	    return intval(sqrt($rand_num));  
	} 
	  
	 /** 
	 *   
	 * @param $bonus_total 红包总额 
	 * @param $bonus_count 红包个数 
	 * @param $bonus_max 每个小红包的最大额 
	 * @param $bonus_min 每个小红包的最小额 
	 * @return 存放生成的每个小红包的值的一维数组 
	 */    
	function getBonus($bonus_total, $bonus_count, $bonus_max, $bonus_min) {    
	    $result = array();    
	  
	    $average = $bonus_total / $bonus_count;    
	  
	    $a = $average - $bonus_min;    
	    $b = $bonus_max - $bonus_min;    
	  
	    //    
	    //这样的随机数的概率实际改变了，产生大数的可能性要比产生小数的概率要小。    
	    //这样就实现了大部分红包的值在平均数附近。大红包和小红包比较少。    
	    $range1 = sqr($average - $bonus_min);    
	    $range2 = sqr($bonus_max - $average);    
	  
	    for ($i = 0; $i < $bonus_count; $i++) {    
	        //因为小红包的数量通常是要比大红包的数量要多的，因为这里的概率要调换过来。    
	        //当随机数>平均值，则产生小红包    
	        //当随机数<平均值，则产生大红包    
	        if (rand($bonus_min, $bonus_max) > $average) {    
	            // 在平均线上减钱    
	            $temp = $bonus_min + xRandom($bonus_min, $average);    
	            $result[$i] = $temp;    
	            $bonus_total -= $temp;    
	        } else {    
	            // 在平均线上加钱    
	            $temp = $bonus_max - xRandom($average, $bonus_max);    
	            $result[$i] = $temp;    
	            $bonus_total -= $temp;    
	        }    
	    }    
	    // 如果还有余钱，则尝试加到小红包里，如果加不进去，则尝试下一个。    
	    while ($bonus_total > 0) {    
	        for ($i = 0; $i < $bonus_count; $i++) {    
	            if ($bonus_total > 0 && $result[$i] < $bonus_max) {    
	                $result[$i]++;    
	                $bonus_total--;    
	            }    
	        }    
	    }    
	    // 如果钱是负数了，还得从已生成的小红包中抽取回来    
	    while ($bonus_total < 0) {    
	        for ($i = 0; $i < $bonus_count; $i++) {    
	            if ($bonus_total < 0 && $result[$i] > $bonus_min) {    
	                $result[$i]--;    
	                $bonus_total++;    
	            }    
	        }    
	    }
	    
	    if($bonus_total>0 and $bonus_total<1){
			$result[0]=$result[0]+$bonus_total;
		}
	    return $result;    
	}
?>
