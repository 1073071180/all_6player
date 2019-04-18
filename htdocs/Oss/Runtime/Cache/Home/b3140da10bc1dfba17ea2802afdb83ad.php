<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>js+ajax异步上传</title>
    <script>
        $('#demo').on('click', '.diySuccess', function() {
            var url_cache = $(this).parent().find('.viewThumb img').attr('data-url'),
                arr_cache = JSON.parse($('#value').val()),
                new_arr = [];

            for (var i=0; i<arr_cache.length; i++) {
                if (url_cache !== arr_cache[i].url) {
                    new_arr.push(arr_cache[i]);
                }
            }

            $(this).parents('li').remove();
            $("#value").val(JSON.stringify(new_arr));
            arr = new_arr;
        })
        var arr=[];
        $('#as').diyUpload({
            url:'Source/php/uploadify.php',
            success:function( data ) {
                var data_cache={};
                data_cache.name=data.name;
                data_cache.url=data.url;
                arr.push(data_cache);
                $("#value").val(JSON.stringify(arr));
            },
            error:function( err ) {
                console.info( err );
            },
            buttonText : '选择文件',
            chunked:true,
            // 分片大小
            chunkSize:512 * 1024,
            //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
            fileNumLimit:50,
            fileSizeLimit:500000 * 1024,
            fileSingleSizeLimit:50000 * 1024,
            accept: {}
        });
    </script>
</head>
<body>
    <div class="main">
        <form action="index.php" method='POST' id="form1">
            <p><i id="photoup"></i><span>图片上传（多图上传）</span></p>
            <div class="form_item">
                <input  id="value" type="hidden" name='pics' value="1111">
                <div id="demo">
                    <div id="as" ></div>
                </div>
            </div>
            <input type='submit' class='button' name='dosubmit' value="提交"/>
        </form>
    </div>
</body>
</html>