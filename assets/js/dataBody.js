/**
    * Created by Jiayiwu on 16/10/14.
    * Mail:wujiayi@lgdreamer.com
    * Change everywhere
    */

//运动分布统计图表


$(function () {
    dataBodyChart.draw();
});
var dataBodyChart = {
    draw :function () {
        var series_weight =[];
        var series_bf = [];
        var timeData = [];
        var weight = 0;
        var height = 0;
        jQuery.ajax({
            url: '/user/basicinfo',
            cache: false,
            success: function(data) {
                if(data.state == true){
                    dataBodyChart.height = data.object.height;
                    $('#height').val(dataBodyChart.height);
                    $('#height_xs').val(dataBodyChart.height);
                }
            }
        }),



        jQuery.ajax({
            url: '/runner/data/body',
            cache: false,
            success: function(data) {
             if(data.object == null){
                 series_bf.push(0);
                 series_weight.push(0);
                 timeData.push(0);
             }else{
                 var object = data.object;
                for(var i = 0;i<object.length;i++){
                    series_weight.push(object[i].weight);
                    series_bf.push(object[i].bf);
                    timeData.push(object[i].date);
                }
             }

                dataBodyChart.drawChart(series_weight,series_bf, timeData);
                 $('#weight').val(object[object.length-1].weight);
                 $('#weight_xs').val(object[object.length-1].weight);

                calBMIAndOther();
            }
        })
    },
    drawChart:function (series_weigth,series_bf,timeData) {
        var myChart = echarts.init(document.getElementById('chart'));


        option = {
            title: {
                text: '体重变化',
                subtext: '数据来源于您每天的体重记录',
                x: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    animation: false
                }
            },
            legend: {
                data:['体重','体脂率'],
                x: 'left'
            },
            toolbox: {
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },

            grid: [{
                left: 50,
                right: 50,
                height: '35%'
            }, {
                left: 50,
                right: 50,
                top: '55%',
                height: '35%'
            }],
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: true},
                    data: timeData
                },
                {
                    gridIndex: 1,
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: true},
                    data: timeData,
                    position: 'top'
                }
            ],
            yAxis : [
                {
                    name : '体重(公斤)',
                    type : 'value',
                    max : 100
                },
                {
                    gridIndex: 1,
                    name : '体脂率(%)',
                    type : 'value',
                    inverse: true
                }
            ],
            series : [
                {
                    name:'体重(公斤)',
                    type:'line',
                    symbolSize: 8,
                    hoverAnimation: false,
                    data:series_weigth
                },
                {
                    name:'体脂率(%)',
                    type:'line',
                    xAxisIndex: 1,
                    yAxisIndex: 1,
                    symbolSize: 8,
                    hoverAnimation: false,
                    data: series_bf
                }
            ]
        };


        $(window).resize(function(){
            myChart.resize();
        });
        myChart.setOption(option);

    }

};

function calBMIAndOther() {
    var weight = $('#weight').val();
    var height = $('#height').val();
    $('#BMI').empty().append(parseInt(weight/((height/100)*(height/100))));
    $('#weight_cal').empty().append(parseInt((height-100)*0.9));
    $('#weight_cal_xs').empty().append(parseInt((height-100)*0.9));
    $('#calorie_cal').empty().append(parseInt(170*weight-382));
    $('#calorie_cal_xs').empty().append(parseInt(170*weight-382));
}

$('#cal_xs').on('click', function () {
    calBMIAndOther();
});

$('#cal').on('click', function () {
    calBMIAndOther();
});




