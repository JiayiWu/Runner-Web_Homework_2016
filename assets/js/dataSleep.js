/**
    * Created by Jiayiwu on 16/10/16.
    * Mail:wujiayi@lgdreamer.com
    * Change everywhere
    */



//运动分布统计图表



$(function () {
    countChart.draw();
});
    
var countChart = {
    draw :function () {

        jQuery.ajax({
            url: 'runner/data/sleep',
            cache: false,
            success: function(data) {
                if(data.state == true){
                    var object = data.object;
                    var array_sleep = [];
                    var array_date = [];
                    for(var i = 0;i<object.length;i++){

                        array_date.push(object[i].date);
                        array_sleep.push(parseInt(object[i].sleephour));

                    }

                    countChart.drawCountChart(array_date,array_sleep);
                    sleepMap.drawMap(object[object.length-1].ds,object[object.length-1].ss,object[object.length-1].aw);
                }
            }
        })

    },

    drawCountChart :function (array_date,array_sleep) {
        var myChartcount = echarts.init(document.getElementById('chart-sleep-count'));
        option = {
            title: {
                text: '睡眠时间统计'
            },
            tooltip: {
                trigger: 'axis'
            },
            xAxis: {
                data: array_date
            },
            yAxis: {
                splitLine: {
                    show: false
                }
            },
            toolbox: {
                left: 'center',
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },
            backgroundColor:"#f5f5f5",
            visualMap: {
                top: 10,
                right: 10,
                pieces: [{
                    gt: 0,
                    lte: 5,
                    color: '#cc0033'
                }, {
                    gt: 5,
                    lte: 7,
                    color: '#ffde33'
                }, {
                    gt: 7,
                    lte: 8,
                    color: '#096'
                }, {
                    gt: 8,

                    color: '#ff9933'
                }],
                outOfRange: {
                    color: '#ffde33'
                }
            },
            series: {
                name: '睡眠时间(h)',
                type: 'line',
                data: array_sleep,
                markLine: {
                    silent: true,
                    data: [{
                        yAxis: 4
                    }, {
                        yAxis: 5
                    }, {
                        yAxis: 6
                    }, {
                        yAxis: 7
                    }, {
                        yAxis: 8
                    }
                    ]
                }
            }
        }
        $(window).resize(function(){
            myChartcount.resize();
        });
        myChartcount.setOption(option);
    }
};    

    
var sleepMap ={


    drawMap:function (ds,ss,aw) {
        var myChart = echarts.init(document.getElementById('chart-sleep-dist'));

        option = {
            title: {
                text: '睡眠质量统计',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data:['深度睡眠','浅睡眠','清醒']
            },
            backgroundColor:"#f5f5f5",
            series: [
                {
                    name:'睡眠分布',
                    type:'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        normal: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            show: true,
                            textStyle: {
                                fontSize: '30',
                                fontWeight: 'bold'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data:[
                        {value:ds, name:'深度睡眠'},
                        {value:ss, name:'浅睡眠'},
                        {value:aw, name:'清醒'},

                    ]
                }
            ]
        };

        $(window).resize(function(){
            myChart.resize();
        });
        myChart.setOption(option);
    }
}

//睡眠质量分布
