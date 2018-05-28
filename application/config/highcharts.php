<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// shared_options : highcharts global settings, like interface or language
$config['shared_options'] = array(
	'chart' => array(
		'backgroundColor' => array(
			'linearGradient' => array(0, 0, 500, 500),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(240, 240, 255)')
			)
		),
        'zoomType' => 'xy'
	),
    'title' => array(
        'text' => 'Title default'
    ),
    'credits'=> array(
        'enabled'=> false
    ),
    'tooltip' => array(
        'shared' => true
    ),
    'legend' => array(
        'align' => 'left',
        'x' => 0,
        'verticalAlign' => 'up',
        'y' => 0,
        'floating' => true,
        'borderColor' => '#CCC',
        'borderWidth' => 1,
        'shadow' => false
    ),
    'xAxis' => array(
        'crosshair' => true
    ),
    'yAxis' => array(
        'allowDecimals' => false,
        'labels' => array(
            'format' => '{value}',
            'style' => array(
                'color' => array('#485F77','#E55B3C','#3CC6E6')
            )
        ),
        'title' => array(
            'style' => array('#485F77','#E55B3C','#3CC6E6')
        )
    )
);

// Template Example
$config['chart_template'] = array(
	'chart' => array(
		'renderTo' => 'graph',
		'defaultSeriesType' => 'column',
		'backgroundColor' => array(
			'linearGradient' => array(0, 500, 0, 0),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(190, 200, 255)')
			)
		),
     ),
     'colors' => array(
     	 '#ED561B', '#50B432'
     ),
     'credits' => array(
     	'enabled'=> true,
     	'text'	=> 'highcharts library on GitHub',
		'href' => 'https://github.com/ronan-gloo/codeigniter-highcharts-library'
     ),
     'title' => array(
		'text' => 'Template from config file'
     ),
     'legend' => array(
     	'enabled' => false
     ),
    'yAxis' => array(
		'title' => array(
			'text' => 'population'
		)
	),
	'xAxis' => array(
		'title' => array(
			'text' => 'Countries'
		)
	),
	'tooltip' => array(
		'shared' => true
	)
);

$config['chart_backup'] = array(
            'chart' => array(
                'zoomType' => 'xy'
            ),
            'xAxis' => array(
               'crosshair' => true
            ),
            'yAxis' => array( // Primary yAxis
                'opposite' => true
            ),
            'tooltip' => array(
                'shared' => true
            ),
            'legend' => array(
                'align' => 'right',
                'x' => -70,
                'verticalAlign' => 'up',
                'y' => -5,
                'floating' => true,
                'borderColor' => '#CCC',
                'borderWidth' => 1,
                'shadow' => false
            )
);