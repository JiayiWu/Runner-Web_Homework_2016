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
                        var tem = makeTheHtmlElement(object[i].id, object[i].ownerid, object[i].ownername, object[i].createdate, object[i].content);
                        $('#mainControl').after(tem);
                    }
                }
            }
        }
    })
}


function makeTheHtmlElement(elementid,id,name,time,content) {
    var result = "	<div class='col-xs-10 col-sm-10 col-md-10  col-lg-10 col-xs-offset-1  col-sm-offset-1 col-md-offset-1  col-lg-offset-1  media-list-base mainPanel' >";
    result +="<div class='media'>";
    result= result+"<p style=visibility: hidden>"+elementid+"</p>";
    result+="<a class='media-left' href='#'>";
    result= result + "<img src=\'\./others/dp\/"+picMatch(id)+".png\' alt='dp' class='img-circle'>";
    result+= "</a>";
    result+= "<div class='media-body'>";
    result+="<h4 class='media-heading'>";
    result+=name;
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