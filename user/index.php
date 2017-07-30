<?php
require_once '_main.php';
use \Ss\File\FileManager;

$fm=new FileManager($U->GetUid());
$upToken=$fm->upToken();
$prefix=$U->GetPrefix();
?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                文件管理
                <small>File Manage</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <input id="file" type="file" style="display: none;">
                    <div id="container" style="display: none;" class="progress" >
                        <div id="fileProgress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                          0%
                        </div>
                    </div>
                    <div >
                        <button id="upload" type="button" class="btn btn-info">上传文件</button>
                        <button id="cancel" type="button" class="btn btn-danger" style="display: none;">取消上传</button>
                        <button id="del" type="button" class="btn btn-danger" style="display: none;">批量删除</button>
                    </div>

                    <p></p>
                    <div id="msg-loading" style="display: none;" class="alert alert-info">
                      <a class="close" onclick="$('.alert').hide()">×</a>  
                      <center>文件正在上传！</center>
                    </div>
                    <div id="msg-error"  style="display: none;" class="alert alert-warning">
                      <a class="close" onclick="$('.alert').hide()">×</a>  
                      <center>上传失败！</center>
                    </div>
                    <div id="del-success"  style="display: none;" class="alert alert-info">
                      <a class="close" onclick="$('.alert').hide()">×</a>  
                      <center>删除成功！</center>
                    </div>
                    <div id="del-error"  style="display: none;" class="alert alert-warning">
                      <a class="close" onclick="$('.alert').hide()">×</a>  
                      <center>删除失败！</center>
                    </div>                    
                    <div id="share-info"  style="display: none;" class="alert alert-info">
                      <a class="close" onclick="$('.alert').hide()">×</a>  
                      <center id="shareUrl"></center>
                    </div>
                    <!-- </div> -->
                    <div id="refreshPart">
                        <br><br><br><br>
                        <div class="loader center-block"></div>
                        <style type="text/css">
                            .loader {
                                border: 16px solid #f3f3f3; /* Light grey */
                                border-top: 16px solid #3498db; /* Blue */
                                border-radius: 50%;
                                width: 120px;
                                height: 120px;
                                animation: spin 2s linear infinite;
                            }

                            @keyframes spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
    </div>

<script type="text/javascript">
$(document).ready(function(){
    getFile();
    $("#file").change(function(){
        uploadFile();
    });
    $("#upload").click(function(){
        if($("#container").is(':visible') == false)
            $("#file").trigger('click');
        else
            $("#msg-loading").show();
    });
    $("#del").click(function(){
        delFile();
    });
});
</script>
<script type="text/javascript">
var all=0;
function showMult(ele){
    if(ele.checked)
        all++;
    else
        all--;
    if(all>0)
        $("#del").show();
    else
        $("#del").hide(100);
}
function getFile(){
    $("#refreshPart").load("getFiles.php");
}
function delFile(){
    var file=[];
    $(".check:checked").each(function() {
            file.push(this.value);
    });
    $.ajax({
        url:'file_del.php',
        type:'post',
        data:{
            'file':file
        },
        success:function(data){
            if(data==true){
                $("#del-success").show();
                getFile();
            }else{
                $("#del-error").show();
                getFile();
            }
            $("#del").hide(100);
        }
    });
}
function uploadFile(){
        var name=$("#file").val().split('\\').pop().replace(/\s+/g, '-');
        var formData=new FormData();
        formData.append("key","<?php echo $prefix;?>"+name);
        formData.append("token","<?php echo $upToken;?>");
        formData.append("file",$("#file")[0].files[0]);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','<?php echo $upRegion;?>');
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data=JSON.parse(xhr.responseText);
                $.ajax({
                url:'file_add.php',
                type:'post',
                data:{
                    'key':data['key']
                },
                success:function(data){
                    getFile();
                },
                error:function(){
                    $("#msg-error").show();
                }
            });} else {
                $("#msg-error").show();
            }
            $('#container').delay(1000).hide(100);
            $('#cancel').hide(100);
        };
        xhr.onloadstart=function(){
            $('#fileProgress').css('width', "0%").attr('aria-valuenow',0);
            $('#fileProgress').html('0%');
            $("#container").show();
            $("#cancel").show();
            $("#cancel").click(function(){
                xhr.abort();
                $('#container').hide(100);
                $('#cancel').hide(100);
            });
        };
        xhr.upload.onprogress = function (event) {
        if (event.lengthComputable) {
            var valeur= (event.loaded / event.total * 100 | 0);
            $('#fileProgress').css('width', valeur+'%').attr('aria-valuenow', valeur);
            $('#fileProgress').html( valeur+'%');
        }};
        xhr.send(formData);
    }
function share(key){
    $.ajax({
        url:'share_file.php',
        type:'post',
        data:{
            'key':key
        },
        dataType:'json',
        success:function(data){
            $("#shareUrl").html("分享成功，链接:"+data.url+",提取码:"+data.pwd);
            $("#share-info").show();
        }
    })
}
</script>
<?php
require_once '_footer.php'; ?>