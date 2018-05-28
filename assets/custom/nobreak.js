$(function () {
Highcharts.setOptions({
                            colors : [ '#485F77','#E55B3C','#3CC6E6']
                        });
    $('#container1').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Evolução da <?php echo $_POST['variavel'];?> do Nobreak <?php echo $_POST['nobreak'];?> <?php if($tipo_graf=='diario'){ echo 'no dia '.$_POST['dia'];}?> do mês atual'
        },
        xAxis: [{
            type: 'datetime',
            dateTimeLabelFormats: {
               year: '%Y'
            }
        }],
        yAxis: [{ // Primary yAxis
            allowDecimals: false,
            labels: {
                format: '{value} <?php echo $array_dados_nobreak['unidade'];?>',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: '<?php echo $_POST['variavel'];?>',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        },

        { // Secondary yAxis
            title: {
                text: '<?php echo $_POST['variavel'];?>',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} <?php echo $array_dados_nobreak['unidade'];?>',
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
            align: 'left',
            x: 0,
            verticalAlign: 'up',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        series: [{
                name: '<?php echo $_POST['variavel'];?>',
                type: 'spline',
                yAxis: 1,
                data : [<?php echo join($array_dados_nobreak['dados'][$variavel],',')?>],
                <?php if($tipo_graf=='diario'){?>
                pointInterval: 300000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, <?=$dia?>, 0, 0, 0),
                <?php }else{?>
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, 1, 0, 0, 0),
                <?php } ?>
                tooltip: {
                    valueSuffix: ' <?php echo $array_dados_nobreak['unidade'];?>'
                }
            },
            <?if($variavel=='Tensao' || $variavel=='Corrente'):?>
            {
                name: '<?php echo $_POST['variavel'];?> 2',
                type: 'spline',
                yAxis: 1,
                data : [<?php echo join($array_dados_nobreak['dados'][$variavel.'2'],',')?>],
                <?php if($tipo_graf=='diario'){?>
                pointInterval: 300000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, <?=$dia?>, 0, 0, 0),
                <?php }else{?>
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, 1, 0, 0, 0),
                <?php } ?>
                tooltip: {
                    valueSuffix: ' <?php echo $array_dados_nobreak['unidade'];?>'
                }
            },
            {
                name: '<?php echo $_POST['variavel'];?> 3',
                type: 'spline',
                yAxis: 1,
                data : [<?php echo join($array_dados_nobreak['dados'][$variavel.'3'],',')?>],
                <?php if($tipo_graf=='diario'){?>
                pointInterval: 300000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, <?=$dia?>, 0, 0, 0),
                <?php }else{?>
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(<?=$ano?>, <?=$mes_graf-1?>, 1, 0, 0, 0),
                <?php } ?>
                tooltip: {
                    valueSuffix: ' <?php echo $array_dados_nobreak['unidade'];?>'
                }
            }
            <?endif;?>
        ]
    });

    });