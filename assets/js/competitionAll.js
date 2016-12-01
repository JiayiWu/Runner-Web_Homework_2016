/**
 * Created by StevenWu on 16/11/30.
 */

$(function () {
    init();
});
function init() {
    jQuery.ajax({
        url: 'race',
        cache: false,
        success: function(data) {
            var point = $('#re-local');
            if(data.state == "true"){

                $("div").remove(".col-sm-6.gallery-node");
                var object = data.object;
                if(object.length == 0){
                    var temP = "<div style='text-align: center;font-size: 20px;color: white;margin-top: 200px' class='gallery-node' id='temP'><p >目前还没有人创建比赛!</p></div>";
                    $('#re-local').append(temP);


                }else {
                    $('p').removeClass("#temP");
                }
                for (var i = 0;i<object.length;i++){
                    insertNode(object[i].id,object[i].topic,object[i].content,object[i].nickname,point);
                }

                var btns = $('.button-base');
                for (var i = 0; i < btns.length; ++i) {

                    btns[i].onclick = function () {
                        clickEvent($(this).attr('id'));
                    }
                }

                var imgs = $('.report-img');
                for (var i = 0; i < imgs.length; ++i) {

                    imgs[i].onclick = function () {
                        complaintsEvent($(this).attr('id'));
                    }
                }
            }
        }
    })
}

function insertNode(id,topic,content,name,pointElement) {
    var tem = parseInt(id);
    var pic = tem%4;
    var imgid = "img"+id;
    if(pic == 0)
        pic = 1;
    var result = "<div class=' col-sm-6  col-md-6 gallery-node '> " +
        "<div class='thumbnail'> <img src='images/cover/com${pic}.png' alt='cover'> " +
        "<div class='caption'> <h3>${topic}</h3> <p style='margin: 10px 0 10px 0 '>${content}</p> <h4>${name}</h4>" +
        " <p><a href='#' class='btn btn-primary button-base' role='button' id='${id}'>参加比赛</a> " +
        "</p> <img  class='report-img' src='images/report.png' id=${imgid}> " +
        "</div> </div> </div>"
    $.tmpl(result, {
        id: id,
        name:name,
        pic:pic,
        topic:topic,
        content:content,
        imgid:imgid
    }).appendTo(pointElement);
}


function complaintsEvent(id) {
    var imgid = id.substr(3,id.length);
    $('#myModal').modal('toggle');
    $("#myModal").modal().css({
        "margin-top": function () {
            return ($(this).height() /5);
        }
    });
    $('#confirmB').on('click', function () {
        jQuery.ajax({
            url: 'complaint/create',
            type:'post',
            cache: false,
            data:{
                id:imgid,
                reason:$('#select_k1').val()
            },
            success: function(data) {
               if (data.state == true){
                   swal("投诉成功!", "我们将在三个工作日内答复您的投诉", "success");
               }else {
                   swal("未能成功投诉", data.message, "info");
               }
            }
        })
    });

}


function clickEvent(id) {
    jQuery.ajax({
        url: 'race/join',
        type:'post',
        cache: false,
        data:{
            id:id
        },
        success: function(data) {

            if(data.state == true){

                var object = data.object;
                var joinCountMile = "您7天内的运动公里数为: "+object.joincount+" \n";
                var ownerCount ="对手7天内的运动公里数为: "+object.ownercount+" \n";
                var resultMatch = object.result;
                if(object.result == 0){
                    swal("比赛败北!", joinCountMile+ownerCount, "error");
                }else if(object.result == 1){
                    swal("获胜!", joinCountMile+ownerCount, "success");
                }else {
                    swal("平局!", joinCountMile+ownerCount, "warning");
                }
                init();

            }else {
                swal("出错啦!", data.message, "error");
            }
        }
    })
}