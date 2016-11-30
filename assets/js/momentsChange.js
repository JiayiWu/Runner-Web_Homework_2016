/**
 * Created by StevenWu on 16/11/29.
 */

$(function () {
    init();
});

function init() {
getAllMoments();
    $('#send-button').on('click', function () {
        addMoments();
    });
    $('#send-button-xs').on('click', function () {
        addMoments();
    });

    //循环遍历所有的按钮，一个一个添加事件绑定

    // $("").click(function () {
    //     var deleteId =  $(this).attr(id);
    //     var point =  $(('#'+deleteId)).parent().parent().parent().children(':hidden').html();
    //     swal({
    //         title: "确定删除？",
    //         text: "您确定要删除这条数据？",
    //         type: "warning",
    //         showCancelButton: true,
    //         closeOnConfirm: false,
    //         confirmButtonText: "是的，我要删除",
    //         confirmButtonColor: "#ec6c62"
    //     }, function() {
    //         $.ajax({
    //             url: "moments/delete",
    //             type: "post",
    //             data:{
    //                 id:point
    //             }
    //         }).done(function(data) {
    //             if(data.state == true)
    //                 swal("操作成功!", "已成功删除数据！", "success");
    //             else
    //                 swal("OMG", "删除操作失败了!", "error");
    //         }).error(function(data) {
    //             swal("OMG", "删除操作失败了!", "error");
    //         });
    //     });
    // })
}

function addMoments() {
  var contentDate =  $("#textContent").val();
    if(contentDate.length>68){
        $('#textContent').val("");
        alert("朋友圈字数限制,不能超过70个字");
        return;
    }
    jQuery.ajax({
        url: 'moments/add',
        type: 'post',
        data: {
            content: contentDate
        },
        cache: false,
        success: function(data) {
            if(data.state == true){
                $('#textContent').val("");
                $('#textContent').focus();
                getAllMoments();
            }
        }
    })
}


function getAllMoments() {
    jQuery.ajax({
        url: 'moments',
        cache: false,
        success: function(data) {
            if(data.state == true){
                $("div").remove(".mainPanel");
                var allMoments = [];

                var object = data.object;
                if(object !=null) {
                    for (var i = 0; i < object.length; i++) {
                        var tem = makeTheHtmlElement(object[i].id, object[i].ownerid, object[i].ownername, object[i].createdate, object[i].content,object[i].isMy,i);
                        $('#mainControl').after(tem);
                    }

                    var btns = $('.deletebutton');
                    for (var i = 0; i < btns.length; ++i) {
                        btns[i].onclick = function () {
                            deleteButton($(this).attr('id'));
                        }
                    }
                }
            }
        }
    })
}


function makeTheHtmlElement(elementid,id,name,time,content,isMy,buttonId) {
    var result = "	<div class='col-xs-10 col-sm-10 col-md-10  col-lg-10 col-xs-offset-1  col-sm-offset-1 col-md-offset-1  col-lg-offset-1  media-list-base mainPanel' >";
    result +="<div class='media'>";
    result= result+"<p style=visibility: hidden>"+elementid+"</p>";
    result+="<a class='media-left' href='#'>";
    result= result + "<img src=\'\./others/dp\/"+picMatch(id)+".png\' alt='dp' class='img-circle'>";
    result+= "</a>";
    result+= "<div class='media-body'>";
    result+="<h4 class='media-heading'>";
    result+=name;

    if(isMy == true){
        result+=" <img src='\.\/images\/deleteButton\.png' class='deletebutton' id='"+buttonId+"'>";
    }

    result+="</h4>";
    result+="<p class='time'>";
    result+=time;
    result+="</p>";
    result+="<section class='content'>";
    result+=content;
    result= result+"</section></div></div></div>";
    return result;
}

function picMatch(id) {
    return id%10;
}

function  deleteButton(id) {
    var deleteId =  id;
   var point =  $(('#'+deleteId)).parent().parent().parent().children(':hidden').html();
    swal({
        title: "确定删除？",
        text: "您确定要删除这条数据？",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "是的，我要删除",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "moments/delete",
            type: "post",
            data:{
                id:point
            }
        }).done(function(data) {
            if(data.state == true) {
                swal("操作成功!", "已成功删除数据！", "success");
                getAllMoments();
            }
            else
                swal("OMG", "删除操作失败了!", "error");
        }).error(function(data) {
            swal("OMG", "删除操作失败了!", "error");
        });
    });
}

