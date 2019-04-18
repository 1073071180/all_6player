<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/15
 * Time: 17:36
 */
namespace Home\Controller;
use Think\Controller;
class UploadController extends Controller {

    public function index(){

    }
    //创建目录
    public function creatDir($fileName){
        if(strpos($fileName,'/')){
            $dirArray = explode('/',$fileName);
            array_pop($dirArray);
            foreach($dirArray as $val){
                $dir .= $val.'/';
                $oldumask = umask(0);
                if(!is_dir($dir)){
                    mkdir($dir,0777);
                }
                chmod($dir,0777);
                umask($oldumask);
            }
            return true;
        }
        return false;
    }

    //生成文件名称
    function randomFilename(){
        return date('YmdHis').rand(100,999);
    }

    //上传图片
    public function uploadImg(){
        $inputName=isset($_GET['inputName'])?trim($_GET['inputName']):'';
        $channel=isset($_GET['channel'])?trim($_GET['channel']):'';

        $types=isset($_GET['types'])?trim($_GET['types']):'';
        $fileAllow=C('IMG_ALLOW');
        $fileName=$this->randomFilename();
        if($channel=='normal'){
            //上传正常图片，无具体限制
            if(is_uploaded_file($_FILES[$inputName]['tmp_name']) and !empty($types)){
                //获取上传的图片参数 $size  ,宽$width,高$height
                $size=getimagesize($_FILES[$inputName]['tmp_name']);
                $width=$size[0];
                $height=$size[1];
                if($types=='logo'){
                    //长和宽大于100的正方形图片
                    if($width<100 or $height<100 or $width!=$height){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }

            }
            //图片保存路径，如果文件夹不存在，则创建
            $filePath=C('DIR_AVATAR_IMG');
            if( ! is_dir($filePath)){
                $this->creatDir($filePath);
            }


            //上传图片
            $reMesg=$this->uploadFile($inputName,$filePath,$fileName,$fileAllow);
            if($reMesg['code']<=0){
                echo json_encode(array('0',$reMesg['code']));
            }else{

                echo json_encode(array('1',$fileName.$reMesg['suffix']));
            }
        }else if($channel=='brand'){
            //品牌缩略图尺寸大于100*100的正方形图片
            if(is_uploaded_file($_FILES[$inputName]['tmp_name']) and !empty($types)){
                $size=getimagesize($_FILES[$inputName]['tmp_name']);
                $width=$size[0];
                $height=$size[1];
                if($types=='logo'){
                    //长和宽大于100的正方形图片
                    if($width<100 or $height<100 or $width!=$height){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }elseif($types=='pic'){
                    //宽大于600 且 长小于 720的 图片
                    if($width<600 or $height>720){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }
            }

            $filePath=C('DIR_BRAND_LOGO');
            //上传图片
            $reMesg=$this->uploadFile($inputName,$filePath,$fileName,$fileAllow);
            if($reMesg['code']<=0){
                echo json_encode(array('0',$reMesg['code']));
            }else{

                echo json_encode(array('1',$fileName.$reMesg['suffix']));
            }
        }elseif($channel=='avatar'){
            //品牌缩略图尺寸大于100*100的正方形图片
            if(is_uploaded_file($_FILES[$inputName]['tmp_name']) and !empty($types)){
                $size=getimagesize($_FILES[$inputName]['tmp_name']);
                $width=$size[0];
                $height=$size[1];
                if($types=='logo'){
                    if($width<300 or $height<300 or $width!=$height){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }elseif($types=='pic'){
                    if($width<600 or $height>720){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }
            }

            $filePath=C('DIR_AVATAR_IMG');
            if( ! is_dir($filePath)){
                $this->creatDir($filePath);
            }
            //上传图片
            $reMesg=$this->uploadFile($inputName,$filePath,$fileName,$fileAllow);
            if($reMesg['code']<=0){
                echo json_encode(array('0',$reMesg['code']));
            }else{

                echo json_encode(array('1',$fileName.$reMesg['suffix']));
            }
        }elseif($channel=='goods'){
            $sourcePath=C('DIR_SOURCE_IMG');//原图存放目录
            $goodsPath=C('DIR_GOODS_IMG');//压缩后的中图
            $thumbPath=C('DIR_THUMB_IMG');//压缩后的小图
            $this->creatDir($sourcePath);
            $this->creatDir($goodsPath);
            $this->creatDir($thumbPath);

            if(is_uploaded_file($_FILES[$inputName]['tmp_name'])){
                //正方形的缩略图，尺寸不小于260*260
                if($types=='thumb'){
                    $size=getimagesize($_FILES[$inputName]['tmp_name']);
                    $width=$size[0];
                    $height=$size[1];
                    if($width<260 or $height<260){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }
                if($types=='goods'){
                    //
                }
                //先上传原图
                $reMesg=$this->uploadFile($inputName,$sourcePath,$fileName,$fileAllow);
                if($reMesg['code']<=0){
                    echo json_encode(array('0',$reMesg['code']));
                }else{
                    //对原图进行压缩
                    $sourceFile=$sourcePath.$fileName.$reMesg['suffix'];
                    $goodsSize=$this->format($sourceFile,C('SIZE_GOODS_IMG'));
                    $thumbSize=$this->format($sourceFile,C('SIZE_THUMB_IMG'));
                    $goodsFile=$goodsPath.$fileName.$reMesg['suffix'];
                    $thumbFile=$thumbPath.$fileName.$reMesg['suffix'];
                    $this->compressPic($sourceFile,$goodsFile,$goodsSize['width'],$goodsSize['height']);
                    $this->compressPic($sourceFile,$thumbFile,$thumbSize['width'],$thumbSize['height']);
                    echo json_encode(array('1',$fileName.$reMesg['suffix']));
                }
            }
        }elseif($channel=='bind'){//绑定
            if(is_uploaded_file($_FILES[$inputName]['tmp_name']) and !empty($types)){
                $size=getimagesize($_FILES[$inputName]['tmp_name']);
                $width=$size[0];
                $height=$size[1];
                if($types=='thumb'){
                    if($width!=344 or !in_array($height,array('310','460','520','800'))){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }elseif($types=='pic'){
                    if($width!=750 or $height!=460){
                        echo json_encode(array('-4','图片尺寸不合要求'));
                        exit;
                    }
                }
            }

            $filePath=C('DIR_GOODS_IMG');
            //上传图片
            $reMesg=$this->uploadFile($inputName,$filePath,$fileName,$fileAllow);
            if($reMesg['code']<=0){
                echo json_encode(array('0',$reMesg['code']));
            }else{
                echo json_encode(array('1',$fileName.$reMesg['suffix']));
            }
        }
    }


    //上传文件
    //$inputName:文件域名称,$filePath:文件上传路径,$newFileName:新文件名(不带后缀)
    public function uploadFile($inputName,$filePath,$newFileName,$allowFile = array('.png','.gif','.jpg','.rar','.zip','.doc','.pdf'),$allowSize=0){
        if($allowSize==0){
            $allowSize=C('UPLOAD_IMAGE_MAX_SIZE')*1024*1024;
        }
        $upload['code']='1';
        //$suffix = strtolower(substr($_FILES[$inputName]['name'],-4));
        $suffix = '.'.end(explode('.', strtolower($_FILES[$inputName]['name'])));;
        if(!in_array($suffix,$allowFile)){
            $upload['code']='-3';
        }
        if(intval($upload['code'])>0 and $allowSize>0 and ($_FILES[$inputName]['size']>$allowSize)){
            $upload['code']='-2';
        }
        if(empty($newFileName)){
            $newFileName=date('YmdHis').rand(1000,9999);
        }
        if(intval($upload['code'])>0){
            if(is_uploaded_file($_FILES[$inputName]['tmp_name'])){
                if(!move_uploaded_file($_FILES[$inputName]['tmp_name'],$filePath.$newFileName.$suffix)){
                    error_log($_FILES[$inputName]['tmp_name'],0);
                    error_log($filePath.$newFileName.$suffix);
                    $upload['code']='0';
                }else{
                    $upload['name']=$newFileName;
                    $upload['suffix']=$suffix;
                }
            }else{
                $upload['code']='-1';
            }
        }
        return $upload;
    }

    public function format($img,$sizeStr){
        $sizeArr=explode(',',$sizeStr);
        $width=$sizeArr[0];
        $height=$sizeArr[1];
        $arr=getimagesize($img);
        if($width>=$arr[0] and $height>=$arr[1]){
            return array('width'=>$arr[0],'height'=>$arr[1]);
        }
        if($width<$arr[0]){
            $newHeight=($width/$arr[0])*$arr[1];
            if($newHeight>$height){
                return array('width'=>($height/$arr[1])*$arr[0],'height'=>$height);
            }
            return array('width'=>$width,'height'=>$newHeight);
        }

        if($height<$arr[1]){
            return array('width'=>($height/$arr[1])*$arr[0],'height'=>$height);
        }
    }

    //压缩图片
    //使用方法:compressPic(压缩目标,储存图片名,图片长,图片宽)
    public function compressPic($imgPath,$imgName,$imgX,$imgY){
        $arr=getimagesize($imgPath);
        switch($arr['mime']){
            case "image/jpeg" :
                $resource = imagecreatefromjpeg($imgPath);
                break;
            case  "image/gif" :
                $resource = imagecreatefromgif($imgPath);
                break;
            case  "image/png" :
                $resource = imagecreatefrompng($imgPath);
                break;
            case "image/wbmp" :
                $resource =imagecreatefromwbmp($imgPath);
                break;
        }

        $resources=imagecreatetruecolor($imgX,$imgY);
        if(!imagecopyresized($resources,$resource,0,0,0,0,$imgX,$imgY,$arr[0],$arr[1])){
            return -1;
            exit;
        }

        switch($arr['mime']){
            case "image/jpeg" :
                $im = imagejpeg($resources,$imgName);
                break;
            case  "image/gif" :
                $im = imagegif($resources,$imgName);
                break;
            case  "image/png" :
                $im = imagepng($resources,$imgName);
                break;
            case "image/wbmp" :
                $im = imagewbmp($resources,$imgName);
                break;
        }
        if($im){
            return 1;
        }else{
            return 0;
        }
    }

    //删除图片
    public function delImg(){
        $file=isset($_GET['file'])?trim($_GET['file']):'';
        $channel=isset($_GET['channel'])?trim($_GET['channel']):'';
        if(!empty($file) and !empty($channel)){
            if($channel=='brand'){
                $file=C('DIR_BRAND_LOGO').$file;
                @unlink($file);
            }
            if($channel=='product'){
                $thumbImg=C('DIR_THUMB_IMG').$file;
                $goodsImg=C('DIR_GOODS_IMG').$file;
                $sourceImg=C('DIR_SOURCE_IMG').$file;
                @unlink($thumbImg);
                @unlink($goodsImg);
                @unlink($sourceImg);
            }
        }
    }

}
?>