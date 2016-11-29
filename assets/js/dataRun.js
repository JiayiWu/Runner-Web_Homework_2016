/**
    * Created by Jiayiwu on 16/10/13.
    * Mail:wujiayi@lgdreamer.com
    * Change everywhere
    */

$(function () {
    chart.draw();
});


var chart = {
    draw:function () {
        jQuery.ajax({
            url: 'runner/data/sport',
            cache: false,
            success: function(data) {
                if(data.state == true){
                    var object = data.object;
                    var date = [];
                    var chardata = [];
                    for (var i=0;i<object.length;i++){
                        date.push(object[i].date);
                        chardata.push(object[i].calorie);
                    }
                    var max = object[object.length-1];
                    chart.drawMapChart(max.running_percent,max.swimming_percent,max.cycling_percent,max.walking_percent,max.sitting_percent);
                    chart.drawCalChart(date,chardata);

                }
            }
        })
    },

    drawMapChart:function (run,swim,cycling,walk,sit) {
        //运动分布统计图表
        var myChart = echarts.init(document.getElementById('distribution'));

        option = {
            title : {
                text: '运动分布',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data:['跑步','游泳','骑行','慢走','静坐']
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:run, name:'跑步'},
                        {value:swim, name:'游泳'},
                        {value:cycling, name:'骑行'},
                        {value:walk, name:'慢走'},
                        {value:sit, name:'静坐'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };


        $(window).resize(function(){
            myChart.resize();
        });
        myChart.setOption(option);
    },

    drawCalChart:function (date,data) {
//消耗卡路里状态图统计图标
        var myChart1 = echarts.init(document.getElementById('recordChange'));



        option = {
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            title: {
                left: 'center',
                text: '近期统计',
            },
            legend: {
                top: 'bottom',
                data:['意向']
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
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: date
            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%']
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 10
            }, {
                start: 0,
                end: 10,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name:'卡路里',
                    type:'line',
                    smooth:true,
                    symbol: 'none',
                    sampling: 'average',
                    itemStyle: {
                        normal: {
                            color: 'rgb(255, 70, 131)'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgb(255, 158, 68)'
                            }, {
                                offset: 1,
                                color: 'rgb(255, 70, 131)'
                            }])
                        }
                    },

                    data: data
                }
            ]
        };
        myChart1.setOption(option);
        $(window).resize(function(){
            myChart1.resize();
        });
    }
}





