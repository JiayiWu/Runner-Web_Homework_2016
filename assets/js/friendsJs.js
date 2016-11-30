/**
 * Created by StevenWu on 16/11/29.
 */





function mainPanelMade(id,name,slogan,model,pointElement,result) {

    var choice ="";
    var button_module = "";
    if (model == 0){
        choice = "取消关注";
        button_module = "btn-primary";
    }else if(model == 1){
        choice = "关注";
        button_module = "btn-success";
    }else {
        choice = "≡相互关注";
        button_module = "btn-primary";
    }

    $.tmpl(result, {
        "id": id,
        name:name,
        choice:choice,
        slogan:slogan,
        button_module:button_module,
        model:model
    }).appendTo(pointElement);
}


function buttonEvent(id) {
    // var Id =  $(this).attr('id');
    var pointElement =  $(('#'+id))
    var model = pointElement.attr('model');

    if(model == 0){

     // var id = pointElement.parent().parent().parent().parent().children(':hidden').html();
        swal({
            title: "确定取消关注？",
            text: "您将不再关注该用户",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "确定",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "friends/canclef",
                type: "post",
                data:{
                    id:id
                }
            }).done(function(data) {
                if(data.state == true) {

                    pointElement.removeClass("btn-primary");
                    pointElement.addClass("btn-success");
                    pointElement.attr('model',1);
                    pointElement.attr('lastmodel',0);
                    pointElement.html("关注");
                    swal("操作成功!", "已取消关注该用户！", "success");
                }
                else
                    swal("OMG", "取消关注失败,请稍后再试!", "error");
            }).error(function(data) {
                swal("OMG", "取消关注失败,请稍后再试", "error");
            });
        });
    }else if(model == 1){
        // var id = pointElement.parent().parent().parent().parent().children(':hidden').html();
        jQuery.ajax({
            url: 'friends/focus',
            type: 'post',
            cache: false,
            data:{
                id:id
            },
            success: function(data) {
                if(data.state == true){
                    var lastmodel = pointElement.attr('lastmodel');
                    pointElement.removeClass("btn-success");
                    pointElement.addClass("btn-primary");
                    if(lastmodel == 2){
                    pointElement.attr("model",2);
                    pointElement.attr("lastmodel",1);
                    pointElement.html("≡相互关注");
                    }else if(lastmodel == 0){
                        pointElement.attr("model",0);
                        pointElement.attr("lastmodel",1);
                        pointElement.html("取消关注");
                    }
                }else {
                    if(data.object != null){
                        swal(":)","您已经关注过该用户啦!","warning");
                    }else
                        swal("OMG", "关注失败,请稍后再试", "error");
                }
            }
        })
    }else if (model == 2){
        // var id = pointElement.parent().parent().parent().parent().children(':hidden').html();
        swal({
            title: "确定取消关注？",
            text: "您将不再关注该用户(对方已经关注了您)",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "确定",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "friends/canclef",
                type: "post",
                data:{
                    id:id
                }
            }).done(function(data) {
                if(data.state == true) {

                    pointElement.removeClass("btn-primary");
                    pointElement.addClass("btn-success");
                    pointElement.attr('model',1);
                    pointElement.attr('lastmodel',2);
                    pointElement.html("关注");
                    swal("操作成功!", "已取消关注该用户！", "success");
                }
                else
                    swal("OMG", "取消关注失败,请稍后再试!", "error");
            }).error(function(data) {
                swal("OMG", "取消关注失败,请稍后再试", "error");
            });
        });
    }
}