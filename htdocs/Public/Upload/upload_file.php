<?php
/**
 * Created by PhpStorm.
 * User: ZQ
 * Date: 2018/7/26
 * Time: 15:21
 */

//上传的文件储存在服务器的临时文件夹
if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
}
echo '<hr/>';
echo '<hr/>';

//对临时文件进行保存
if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))
    && ($_FILES["file"]["size"] < 200000))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
            //将文件保存的位置
            move_uploaded_file($_FILES["file"]["tmp_name"], "D:/Project/6player/htdocs/Public/Upload/images/" . $_FILES["file"]["name"]);
            echo "Stored in: " . "D:/Project/6player/htdocs/Public/Upload/images" . $_FILES["file"]["name"];
        }
    }
}
else
{
    echo "Invalid file （失败）";
}
