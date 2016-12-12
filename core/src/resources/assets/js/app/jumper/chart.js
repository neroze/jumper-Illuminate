var Chart = {}

Chart.pieChart = function(_id, _data) {
    var myChart = echarts.init(document.getElementById(_id), theme);
    myChart.setOption({
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: _data.label
        },
        toolbox: {
            show: false,
            feature: {
                magicType: {
                    show: true,
                    type: ['pie', 'funnel']
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        calculable: true,
        series: [{
            name: 'Area Mode',
            type: 'pie',
            radius: [25, 90],
            center: ['50%', 170],
            roseType: 'area',
            x: '50%',
            max: 40,
            sort: 'ascending',
            data: _data.data
        }]
    });
}


Chart.prepareSplineChartData = function(_data) {
    var barData = [];
    if (_.isArray(_data.data) && false) {
        _.each(_data.data, function(item, key) {
            var a = {
                        name: _data.label[key],
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [item]
                    };

            barData.push(a);
        });
    } else {
        barData = [{
                        name: "",
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [_data.data]
                    }];
    }
    return barData;
}

Chart.splineChart = function(_id, _data) {

    var myChart = echarts.init(document.getElementById(_id), theme);
    myChart.setOption({
        // title: {
        //     text: 'Line Graph',
        //     subtext: 'Subtitle'
        // },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: _data.label
        },
        toolbox: {
            show: false,
            feature: {
                magicType: {
                    show: true,
                    type: ['line', 'bar', 'stack', 'tiled']
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        calculable: true,
        xAxis: [{
            type: 'category',
            boundaryGap: false,
            data: _data.label
        }],
        yAxis: [{
            type: 'value'
        }],
        series: [{
            name: 'Deal',
            type: 'line',
            smooth: true,
            itemStyle: {
                normal: {
                    areaStyle: {
                        type: 'default'
                    }
                }
            },
            data: _data.data
        }]
    });

}

Chart.prepareBarDiagramData = function(_data) {
    var barData = [];
    if (_.isArray(_data.data)) {
        _.each(_data.data, function(item, key) {
            var a = {
                name: _data.label[key],
                type: 'bar',
                data: [item],
                markPoint: {
                    data: [{
                        type: 'max',
                        name: ''
                    }, {
                        type: 'min',
                        name: ''
                    }]
                },
                markLine: {
                    data: [{
                        type: 'average',
                        name: ''
                    }]
                }

            }

            barData.push(a);
        });
    } else {
        barData = [{
                name: _data.label[key],
                type: 'bar',
                data: [_data.data],
                markPoint: {
                    data: [{
                        type: 'max',
                        name: ''
                    }, {
                        type: 'min',
                        name: ''
                    }]
                },
                markLine: {
                    data: [{
                        type: 'average',
                        name: ''
                    }]
                }

            }];
    }
    return barData;
}

Chart.barDiagram = function(_id, _data) {
    var myChart9 = echarts.init(document.getElementById(_id), theme);
    myChart9.setOption({

        //theme : theme,
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: _data.label
        },
        toolbox: {
            show: false
        },
        calculable: false,
        xAxis: [{
            type: 'category',
            data: _data.label
        }],
        yAxis: [{
            type: 'value'
        }],
        series: Chart.prepareBarDiagramData(_data)
    });
}


module.exports = Chart;