/**
 * Created by StevenWu on 16/11/30.
 */


$(function () {
    init();
});


function init() {
    jQuery.ajax({
        url: 'race/mylist',
        cache: false,
        success: function(data) {
            var point = $('#re-local');

            if(data.state == "true"){

                $("div").remove(".col-sm-6.gallery-node");
                var object = data.object;

                if(object.length == 0){
                    var temP = "<div style='text-align: center;font-size: 20px;color: white;margin-top: 200px' class='gallery-node' id='temP'><p >目前您还没有任何正在进行的比赛</p></div>";
                    $('#re-local').append(temP);


                }else {
                    $('p').removeClass("#temP");
                }
                for (var i = 0;i<object.length;i++){
                    insertNode(object[i].id,object[i].topic,object[i].content,point);
                }

                var btns = $('.btn-info');
                for (var i = 0; i < btns.length; ++i) {

                    btns[i].onclick = function () {
                        modifyEvent($(this).attr('id'));
                    }
                }

                var btns1 = $('.btn-danger');
                for (var i = 0; i < btns1.length; ++i) {

                    btns1[i].onclick = function () {
                        deleteEvent($(this).attr('id'));
                    }
                }
            }
        }
    })
}

function insertNode(id,topic,content,pointElement) {
    var tem = parseInt(id);
    var modifyid = "md"+id;
    var pic = tem%4;
    if(pic == 0)
        pic = 1;
    var result = "<div class=' col-sm-6   col-md-6 gallery-node  '> <div class='thumbnail'> " +
        "<img src='images/cover/com${pic}.png' alt='cover'> <div class='caption'>" +
        " <h3>${topic}</h3> <p>${content}</p>" +
        " <p><a href='#' class='btn btn-info ' role='button' id=${modifyid}>修改比赛</a>" +
        " <a href='#' class='btn btn-danger ' role='button' id=${id}>删除比赛</a> " +
        "</p> </div> </div> </div>"
    $.tmpl(result, {
        "id": id,
        pic:pic,
        topic:topic,
        content:content,
        modifyid:modifyid
    }).appendTo(pointElement);
}

function deleteEvent(id) {



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
            url: "race/delete",
            type: "post",
            data:{
                id:id
            }
        }).done(function(data) {
            if(data.state == true){

                swal("删除成功!", data.message, "info");
                init();

            }else {
                swal("出错啦!", data.message, "error");
            }
        }).error(function(data) {
            swal("OMG", "删除操作失败了!", "error");
        });
    });


}

function modifyEvent(id) {
    var id = id.substr(2,id.length);
    swal({
            title: "修改比赛内容",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
        },
        function(inputValue){
            if (inputValue === false) return false;

            if (inputValue === "") {
                swal.showInputError("您需要写点什么!");
                return false
            }
            jQuery.ajax({
                url: 'race/modify',
                type:'post',
                cache: false,
                data:{
                    id:id,
                    content:inputValue

                },
                success: function(data) {

                    if(data.state == true){

                        swal("修改成功!", data.message, "info");
                        init();

                    }else {
                        swal("出错啦!", data.message, "error");
                    }
                }
            })

        });





}