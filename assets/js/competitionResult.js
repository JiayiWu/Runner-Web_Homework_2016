/**
 * Created by StevenWu on 16/11/30.
 */

$(function () {
    init();
});

function init() {
    jQuery.ajax({
        url: 'race/result',
        cache: false,
        success: function(data) {
            var allCom = data.object.allCom;
            var winCom = data.object.winCom;
            var percent = parseInt(winCom/allCom*100)+"%";
            var result = "胜率:"+percent+"%"+"("+winCom+"\/"+allCom+")";
            $('#win-percent').html(result);
            $('#percent-pro').css("width",percent);

            var point = $('#re-local');
            if(data.state == "true"){
                $("div").remove(".col-sm-6.gallery-node");
                var object = data.object.object;
                if(object.length == 0){
                    var temP = "<div style='text-align: center;font-size: 20px;color: white;margin-top: 200px' class='gallery-node' id='temP'><p >您还没参加过任何比赛!</p></div>";
                    $('#re-local').append(temP);


                }else {
                    $('p').removeClass("#temP");
                }
                for (var i = 0;i<object.length;i++){
                    insertNode(object[i].id,object[i].topic,object[i].content,object[i].win,point);
                }
            }
        }
    })
}

function insertNode(id,topic,content,win,pointElement) {


    var tem = parseInt(id);
    var pic = tem%4;
    var isWin = "fail";
    if(pic == 0)
        pic = 1;
    if(win){
        isWin = "win";
    }
    var result = "<div class=' col-sm-6   col-md-6 gallery-node  '> " +
        "<div class='thumbnail location'> " +
        "<img class='img-result' src='images/result/${isWin}.png'>" +
        " <img src='images/cover/com${pic}.png' alt='cover'> " +
        "<div class='caption'>" +
        " <h3>${topic}</h3> " +
        "<p>${content}" +
        "</p> </div> </div> </div>"

    $.tmpl(result, {
        isWin:isWin,
        pic:pic,
        topic:topic,
        content:content
    }).appendTo(pointElement);
}