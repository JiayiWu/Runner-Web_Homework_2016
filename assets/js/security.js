/**
 * Created by StevenWu on 16/12/1.
 */

$(function () {

    $('#create-btn').on('click', function () {
        modifyPassword();
    });
});


function modifyPassword() {
 var oldpass = $('#oldpass').val();
 var newpass = $('#newpass').val();
 var newpass1 = $('#newpass1').val();
    if(newpass != newpass1){
        swal("信息", "两次密码输入不一致!", "info");
        return
    }else if (newpass.length<6){
        swal("信息", "新密码不能少于8位!", "warning");
        return
    }
    oldpass = $.md5(oldpass);
    newpass = $.md5(newpass);
    jQuery.ajax({
        url: 'user/update/password',
        type:"post",
        cache: false,
        data:{
          oldpass:oldpass,
          newpass:newpass
        },
        success: function(data) {
            if(data.state == true){
                swal("成功", "密码修改成功!", "success");
                $('#oldpass').val("");
                $('#newpass').val("");
                $('#newpass1').val("");
            }
            else {
                swal("错误", "密码修改失败,请稍后再试!", "error");
                $('#oldpass').val("");
                $('#newpass').val("");
                $('#newpass1').val("");
            }
        }
    })

}