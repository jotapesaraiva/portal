$(function () {
    $('#container').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Evolução Diária do Job de Backup EMAIL em Março de 2015'
        },
        xAxis: [{

            categories: ["2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],

           crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value} Hs',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Tempo',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
            },
          { // Secondary yAxis
            title: {
                text: 'Volume',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} GB',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],

        tooltip: {
            shared: true
        },
        legend: {
            align: 'right',
            x: -70,
            verticalAlign: 'top',
            y: -5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        series: [{
            name: 'Volume',
            type: 'column',
            yAxis: 1,
            data : [91.11,94.46,98.48,102.51,103.15,1683.79,403.61,92.80,95.57,96.70,95.68,94.41,1694.76,406.17,92.77,0.00,193.74,97.30,96.40,1705.35,407.64,91.47,95.70,101.25,102.35,96.79,1658.40,476.73,90.82,93.72],
            tooltip: {
                valueSuffix: ' GB'
            }

        }, {
            name: 'Tempo',
            type: 'spline',
                data : [1.1,0.3,0.4,0.3,0.3,3.5,1.4,0.4,0.3,0.4,0.3,0.4,4.2,1.1,0.3,1.5,3.2,0.7,0.3,4.8,1.1,0.3,0.3,0.4,0.5,0.3,4.5,2.4,0.3,0.3],
            tooltip: {
                valueSuffix: ' Hs'
            }
        }]
    });
});