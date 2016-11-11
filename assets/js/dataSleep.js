/**
    * Created by Jiayiwu on 16/10/16.
    * Mail:wujiayi@lgdreamer.com
    * Change everywhere
    */



//运动分布统计图表

var myChartcount = echarts.init(document.getElementById('chart-sleep-count'));
var data = [["2016-10-05",8.3],["2016-10-06",7.9],["2016-10-07",6.5],["2016-10-08",6.3],["2016-10-09",8.3],["2016-10-10",7.2],["2016-10-11",7.3]
    ,["2016-10-12",6.8],["2016-10-13",7.5]];

option = {
    title: {
        text: '睡眠时间统计'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        data: data.map(function (item) {
            return item[0];
        })
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
        data: data.map(function (item) {
            return item[1];
        }),
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


//睡眠质量分布
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
                {value:30, name:'深度睡眠'},
                {value:60, name:'浅睡眠'},
                {value:10, name:'清醒'},

            ]
        }
    ]
};

$(window).resize(function(){
    myChart.resize();
});
myChart.setOption(option);