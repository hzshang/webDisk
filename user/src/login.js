$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
});

$(document).ready(function(){
    function login(){
        $.ajax({
            type:"POST",
            url:"_login.php",
            dataType:"json",
            data:{
                email: $("#email").val(),
                passwd: $("#passwd").val(),
                remember_me: $("#remember_me").val()
            },
            success:function(data){
                if(data.ok){
                    $("#msg-error").hide(100);
                    $("#msg-success").show(100);
                    $("#msg-success-p").html(data.msg);
                    window.setTimeout("location.href='index.php'", 2000);
                }else{
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html(data.msg);
                }
            },
            error:function(jqXHR){
                $("#msg-error").hide(10);
                $("#msg-error").show(100);
                $("#msg-error-p").html("发生错误："+jqXHR.status);
                console.log(removeHTMLTag(jqXHR.responseText));
            }
        });
    }
    $("html").keydown(function(event){
        if(event.keyCode==13){
            login();
        }
    });
    $("#login").click(function(){
        login();
    });
     $("#ok-close").click(function(){
        $("#msg-success").hide(100);
    });
    $("#error-close").click(function(){
        $("#msg-error").hide(100);
    });
})
