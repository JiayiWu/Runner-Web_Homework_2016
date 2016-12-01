/**
 * Created by StevenWu on 16/12/1.
 */

$(function () {
    init();
});


function init() {
    jQuery.ajax({
        url: 'complaint/history',
        cache: false,
        success: function(data) {
            var point = $('#re-local');
            if(data.state == true){

                $("div").remove(".col-sm-6.gallery-node");
                var object = data.object;
                if(object.length == 0){
                    var temP = "<div style='text-align: center;font-size: 20px;color: white;margin-top: 200px' class='gallery-node' id='temP'><p >目前还没有投诉!</p></div>";
                    $('#re-local').append(temP);


                }else {
                    $('p').removeClass("#temP");
                }
                for (var i = 0;i<object.length;i++){
                    insertNode(object[i].id,object[i].racetopic,object[i].racecontent,object[i].cname,object[i].hname,object[i].reason,object[i].date,object[i].state,point);
                }

                var btns = $('.deal-base');
                for (var i = 0; i < btns.length; ++i) {

                    btns[i].onclick = function () {
                        recoverEvent($(this).attr('id'));
                    }
                }


            }
        }
    })
}

function insertNode(id,topic,content,cname,hname,reason,date,state,pointElement) {

    var rcid = "rc"+id;

    var classResult = "complain-p-ignore";
    var result1 ="忽略";
    var onclick = "disabled='disabled'>";


    if (state == 1){
        result1 = "删除";
        classResult = "complain-p-delete";
        onclick = ">";
    }


 var result = "	<div class=' col-sm-6   col-md-6 gallery-node   '>" +
     " <div class='thumbnail'> <div class='caption'>投诉活动主题:<h3 class='complain-p-base'>${topic}</h3>" +
     "投诉活动介绍:<p class='complain-p-base'>${content}</p>" +
     "投诉人:<p class='complain-p-base' >${cname}</p>被投诉人:<p class='complain-p-base'>${hname}</p>" +
     "投诉原因:<p class='complain-p-base'>${reason}</p>投诉时间:<p class='complain-p-base'>${date}</p>" +
     "处理结果:<p class='complain-p-base ${classResult} '><i>${result1}</i></p> <p class='complain-p-base'>" +
     "<a href='#' class='btn btn-primary deal-base delete delete-confirm' role='button'id=${rcid} " +
      onclick +"恢复活动</a> </p> " +
     "</div> </div> </div>";

    $.tmpl(result, {
        rcid:rcid,
        topic:topic,
        content:content,
        cname:cname,
        hname:hname,
        reason:reason,
        date:date,
        result1:result1,
        classResult:classResult,
        onclick:onclick
    }).appendTo(pointElement);

}


function recoverEvent(id) {
    var rcid = id.substr(2,id.length);
    swal({
        title: "确定恢复？",
        text: "您确定要恢复该比赛？",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "是的，确认恢复",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "complaint/recover",
            type: "post",
            data:{
                id:rcid
            }
        }).done(function(data) {
            if(data.state == true) {
                swal("操作成功!", "处理结果:恢复", "success");
                init();
            }
            else
                swal("OMG", "删除操作失败了!", "error");
        }).error(function(data) {
            swal("OMG", "删除操作失败了!", "error");
        });
    });
}

function ignoreEvent(id) {
    var ignoreid = id.substr(2,id.length);
    swal({
        title: "确定？",
        text: "您确定不处理该投诉?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "是的，我确认",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "complaint/ignore",
            type: "post",
            data:{
                id:ignoreid
            }
        }).done(function(data) {
            if(data.state == true) {
                swal("操作成功!", "已处理该投诉(忽略处理)！", "success");
                init();
            }
            else
                swal("OMG", "操作失败了!", "error");
        }).error(function(data) {
            swal("OMG", "操作失败了!", "error");
        });
    });
}