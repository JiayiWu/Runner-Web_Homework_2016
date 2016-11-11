/**
    * Created by Jiayiwu on 16/10/14.
    * Mail:wujiayi@lgdreamer.com
    * Change everywhere
    */

//运动分布统计图表
var myChart = echarts.init(document.getElementById('chart'));


var timeData=['10/16','10/17','10/18','10/19','10/20','10/21']



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
           data:[
              50,51,49,50,52,53,48
           ]
        },
        {
            name:'体脂率(%)',
            type:'line',
            xAxisIndex: 1,
            yAxisIndex: 1,
            symbolSize: 8,
            hoverAnimation: false,
            data: [
                10,12,13,10,12,13,11
            ]
        }
    ]
};


$(window).resize(function(){
    myChart.resize();
});
myChart.setOption(option);