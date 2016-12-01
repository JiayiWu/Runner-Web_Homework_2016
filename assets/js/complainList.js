/**
 * Created by StevenWu on 16/12/1.
 */

$(function () {
    init();
    eventID();
});


function init() {
    jQuery.ajax({
        url: 'complaint',
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
                    insertNode(object[i].id,object[i].racetopic,object[i].racecontent,object[i].cname,object[i].hname,object[i].reason,object[i].date,point);
                }

                var btns = $('.delete-confirm');
                for (var i = 0; i < btns.length; ++i) {

                    btns[i].onclick = function () {
                        deleteEvent($(this).attr('id'));
                    }
                }

                var imgs = $('.ignore');
                for (var i = 0; i < imgs.length; ++i) {

                    imgs[i].onclick = function () {
                        ignoreEvent($(this).attr('id'));
                    }
                }
            }
        }
    })
}

function insertNode(id,topic,content,cname,hname,reason,date,pointElement) {

    var deleteid = "de"+id;
    var ignoreid = "ig"+id;
    var result = 	"<div class=' col-sm-6   col-md-6 gallery-node   '> " +
        "<div class='thumbnail'> <div class='caption'>投诉活动主题:<h3 class='complain-p-base'>${topic}</h3>" +
        "投诉活动介绍:<p class='complain-p-base'>${content}</p>投诉人:<p class='complain-p-base' >${cname}</p>" +
        "被投诉人:<p class='complain-p-base'>${hname}</p>投诉原因:<p class='complain-p-base'>${reason}</p>" +
        "投诉时间:<p class='complain-p-base'>${date}</p> <p class='complain-p-base'>" +
        "<a href='#' class='btn btn-danger deal-base delete delete-confirm' role='button' id=${deleteid}>删除</a> " +
        "<a href='#' class='btn btn-default deal-base ignore' role='button' id=${ignoreid}>忽略</a> </p> </div> </div> </div>";
    $.tmpl(result, {
        deleteid: deleteid,
        ignoreid: ignoreid,
        topic:topic,
        content:content,
        cname:cname,
        hname:hname,
        reason:reason,
        date:date
    }).appendTo(pointElement);

}


function deleteEvent(id) {
    var deleteid = id.substr(2,id.length);
    swal({
        title: "确定删除？",
        text: "您确定要删除该比赛？(删除后可在历史记录中恢复)",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "是的，我要删除",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "complaint/delete",
            type: "post",
            data:{
                id:deleteid
            }
        }).done(function(data) {
            if(data.state == true) {
                swal("操作成功!", "已成功删除数据！", "success");
                init();
            }
            else
                swal("OMG", "删除操作失败了!", "error");
        }).error(function(data) {
            swal("OMG", "删除操作失败了!", "error");
        });
    });
}
function  eventID() {
    function f1(){
        deleteNum=999;
        function f2(){
           return deleteNum++;
        }
        return f2;
    }
    var result=f1();
  return  result();
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