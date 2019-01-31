<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
   <title>Janela de Backups</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>static/lib/dhtmlxScheduler/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/dhtmlxscheduler.css" type="text/css">
</head>

<style type="text/css" media="screen">
    html, body{
        margin:0px;
        padding:0px;
        height:100%;
        overflow:hidden;
    }
    .one_line{
        white-space:nowrap;
        overflow:hidden;
        padding-top:5px; padding-left:5px;
        text-align:left !important;
    }

    <!-- Defini the color -->
        .dhx_cal_event div.dhx_footer,
        .dhx_cal_event.past_event div.dhx_footer,
        .dhx_cal_event.event_english div.dhx_footer,
        .dhx_cal_event.event_math div.dhx_footer,
        .dhx_cal_event.event_science div.dhx_footer{
            background-color: transparent !important;
        }
        .dhx_cal_event .dhx_body{
            -webkit-transition: opacity 0.1s;
            transition: opacity 0.1s;
            opacity: 0.7;
        }
        .dhx_cal_event .dhx_title{
            line-height: 12px;
        }
        .dhx_cal_event_line:hover,
        .dhx_cal_event:hover .dhx_body,
        .dhx_cal_event.selected .dhx_body,
        .dhx_cal_event.dhx_cal_select_menu .dhx_body{
            opacity: 1;
        }

        .dhx_cal_event.event_math div, .dhx_cal_event_line.event_math{
            background-color: #436EEE !important;
            border-color: #a36800 !important;
        }
        .dhx_cal_event_clear.event_math{
            color:#436EEE !important;
        }

        .dhx_cal_event.event_science div, .dhx_cal_event_line.event_science{
            background-color: #36BD14 !important;
            border-color: #698490 !important;
        }
        .dhx_cal_event_clear.event_science{
            color:#36BD14 !important;
        }

        .dhx_cal_event.event_english div, .dhx_cal_event_line.event_english{
            background-color: red !important;
            border-color: #698490 !important;
        }
        .dhx_cal_event_clear.event_english{
            color:red !important;
        }
    <!--/* Important !!! */-->
    .dhx_scale_hour {
        line-height:normal;
    }

</style>




<body onload="init();">
    <div style='height:30px; padding:5px;'>
        <div class="filters_wrapper" id="filters_wrapper">
            <label>Status:</label>
            <span>
                <input type="checkbox" name="Completed" />
                Completed
            </span>
            <span>
                <input type="checkbox" name="Completed/Failures" />
                Completed/Failures
            </span>
            <span>
                <input type="checkbox" name="Aborted" />
                Aborted
            </span>
            <span>
                <input type="checkbox" name="Completed/Errors" />
                Completed/Errors
            </span>
            <span>
                <input type="checkbox" name="Failed" />
                Failed
            </span>
            <span>
                <input type="checkbox" name="InProgress/Failures" />
                InProgress/Failures
            </span>
            <span>
                <input type="checkbox" name="InProgress/Errors" />
                InProgress/Errors
            </span>
            <span>
                <input type="checkbox" name="InProgress" />
                InProgress
            </span>

            <label>
                Legenda:
            </label>
                <span class="label label-primary">Full</span>
                <span class="label label-success">Incremental</span>
                <span class="label label-danger">Imprevisto</span>
                <span class="label label-info">Copia</span>
        </div>
    </div>
    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:95%;'>
        <div class="dhx_cal_navline">
            <div class='dhx_cal_export pdf' id='export_pdf' title='Export to PDF' onclick='scheduler.toPDF("http://dhtmlxscheduler.appspot.com/export/pdf", "color")'>&nbsp;</div>
            <div class="dhx_cal_prev_button">&nbsp;</div>
            <div class="dhx_cal_next_button">&nbsp;</div>
            <div class="dhx_cal_today_button"></div>
            <div class="dhx_cal_date"></div>
            <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
            <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
            <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
            <div class="dhx_cal_tab" name="unit_tab" style="right:280px;"></div>
            <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>
            <div class="dhx_minical_icon" id="dhx_minical_icon" onclick="show_minical()">&nbsp;</div>
        </div>
        <div class="dhx_cal_header"></div>
        <div class="dhx_cal_data"></div>
    </div>
</body>
    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/dhtmlxscheduler.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_timeline.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_treetimeline.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_minical.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_tooltip.js"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_key_nav.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_recurring.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_units.js"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_pdf.js"></script>

    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/locale/locale_pt.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/locale/recurring/locale_recurring_pt.js" ></script>
    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_readonly.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo base_url() ?>static/lib/dhtmlxScheduler/codebase/ext/dhtmlxscheduler_active_links.js"></script>
    <script type="text/javascript" charset="utf-8">

        //===============
        //Set MiniCalendar
        //===============

        function show_minical(){
            if (scheduler.isCalendarVisible()){
                scheduler.destroyCalendar();
            } else {
                scheduler.renderCalendar({
                    position:"dhx_minical_icon",
                    date:scheduler._date,
                    navigation:true,
                    handler:function(date,calendar){
                        scheduler.setCurrentView(date);
                        scheduler.destroyCalendar()
                    }
                });
            }
        }

            //===============
            //Config to view 15 to 15 minute in week view
            //===============
            var step = 10;
            var format = scheduler.date.date_to_str("%H:%i");

            scheduler.config.hour_size_px = (60/step)*22;
            scheduler.templates.hour_scale = function(date){
                html="";
                for (var i=0; i<60/step; i++){
                    html+="<div style='height:22px;line-height:22px;'>"+format(date)+"</div>";
                    date = scheduler.date.add(date,step,"minute");
                }
                return html;
            };

        function init() {

            //===============
            //Config Basic
            //===============

            scheduler.config.xml_date="%Y-%m-%d %H:%i";             //Set format date
            scheduler.config.prevent_cache = true;
            scheduler.config.multi_day = true;
            scheduler.config.limit_time_select = true;
            scheduler.config.details_on_dblclick = true;
            scheduler.config.details_on_create = true;
            scheduler.locale.labels.timeline_tab = "Backups";       //set the name of the timeline
            scheduler.locale.labels.unit_tab = "Drivers"            //set the name of the unit
            scheduler.locale.labels.section_template = 'Descrição'; //set the name of the section
            scheduler.config.details_on_create = true;
            scheduler.config.details_on_dblclick = true;
            scheduler.config.start_on_monday = false;               //disable fish week to monday that is default to sunday
            scheduler.config.wide_form = false;                     // form that the lightbox view
            scheduler.config.show_loading=true;                     //exibe barra de progresso ate carregar os dados do banco.
            scheduler.config.readonly_form = true;

            scheduler.config.prevent_cache = true;

                //===============
                //Config the color events
                //===============

                scheduler.templates.event_class = function (start, end, event) {
                    if (event.mode == 'full' && event.queuing == '00:00:00'){
                        return "event_math";
                    } else if (event.mode == 'full' && event.queuing !== '00:00:00'){
                        return "event_english";
                    } else if (event.mode == 'incr' && event.queuing == '00:00:00') {
                        return "event_science";
                    } else if (event.mode == 'incr' && event.queuing !== '00:00:00'){
                        return "event_english";
                    } else  if (event.mode == 'incr1' && event.queuing == '00:00:00') {
                        return "event_science";
                    } else if (event.mode == 'incr1' && event.queuing !== '00:00:00'){
                        return "event_english";
                    }
                };

                //===============
                //Config block readonly
                //===============

                function block_readonly(id){
                    if (!id) return true;
                    return !this.getEvent(id).readonly;
                };

                scheduler.attachEvent("onBeforeDrag",block_readonly);
                scheduler.attachEvent("onClick",block_readonly);

                //===============
                //Config Tooltip
                //===============

                var format=scheduler.date.date_to_str("%d-%m-%Y %H:%i");
                scheduler.templates.tooltip_text = function(start,end,event) {
                    return "<b>Backup:</b> "+event.text+"<br/><b>Status:</b> "+
                    event.status+"<br/><b>Tempo de Espera:</b> "+
                    event.queuing+"<br/><b>Data início:</b> "+
                    format(start)+"<br/><b>Data fim:</b> "+format(end);
                };

                //===============
                // Tooltip related code
                //===============

                // we want to save "dhx_cal_data" div in a variable to limit look ups
                var scheduler_container = document.getElementById("scheduler_here");
                var scheduler_container_divs = scheduler_container.getElementsByTagName("div");
                var dhx_cal_data = scheduler_container_divs[scheduler_container_divs.length-1];

                // while target has parent node and we haven't reached dhx_cal_data
                // we can keep checking if it is timeline section
                scheduler.dhtmlXTooltip.isTooltipTarget = function(target) {
                    while (target.parentNode && target != dhx_cal_data) {
                        var css = target.className.split(" ")[0];
                        // if we are over matrix cell or tooltip itself
                        if (css == "dhx_matrix_scell" || css == "dhtmlXTooltip") {
                            return { classname: css };
                        }
                        target = target.parentNode;
                    }
                    return false;
                };

                scheduler.attachEvent("onMouseMove", function(id, e) {
                    var timeline_view = scheduler.matrix[scheduler.getState().mode];

                    // if we are over event then we can immediately return
                    // or if we are not on timeline view
                    if (id || !timeline_view) {
                        return;
                    }

                    // native mouse event
                    e = e||window.event;
                    var target = e.target||e.srcElement;

                    var tooltip = scheduler.dhtmlXTooltip;
                    var tooltipTarget = tooltip.isTooltipTarget(target);
                    if (tooltipTarget) {
                        if (tooltipTarget.classname == "dhx_matrix_scell") {
                            // we are over cell, need to get what cell it is and display tooltip
                            var text = scheduler.getActionData(e).section;
                            var section = timeline_view.y_unit[timeline_view.order[text]];

                            // showing tooltip itself
                            var text = "Backup : <b>"+section.label+"</b>";
                            tooltip.delay(tooltip.show, tooltip, [e, text]);
                        }
                        if (tooltipTarget.classname == "dhtmlXTooltip") {
                            dhtmlxTooltip.delay(tooltip.show, tooltip, [e, tooltip.tooltip.innerHTML]);
                        }
                    }
                });

                //===============
                //Config Units
                //===============

                scheduler.createUnitsView({
                    name:"unit",
                    property:"unit_id",
                    list:[
                        {key:1, label:"HP-01"},
                        {key:2, label:"HP-02"},
                        {key:3, label:"IBM-01"},
                        {key:3, label:"IBM-02"}
                    ]
                });

                //===============
                //Config Filter events
                //===============

                // default values for filters
                var filters = {
                    'Completed':                true,
                    'Completed/Failures':       true,
                    'Aborted':                  true,
                    'Completed/Errors':         true,
                    'Failed':                   true,
                    'InProgress/Failures':      true,
                    'InProgress/Errors':        true,
                    'InProgress':               true
                };

                var filter_inputs = document.getElementById("filters_wrapper").getElementsByTagName("input");
                for (var i=0; i<filter_inputs.length; i++) {
                    var filter_input = filter_inputs[i];

                    // set initial input value based on filters settings
                    filter_input.checked = filters[filter_input.name];

                    // attach event handler to update filters object and refresh view (so filters will be applied)
                    filter_input.onchange = function() {
                        filters[this.name] = !!this.checked;
                        scheduler.updateView();
                    }
                }

                // here we are using single function for all filters but we can have different logic for each view
                scheduler.filter_month = scheduler.filter_day = scheduler.filter_week = scheduler.filter_timeline = scheduler.filter_units = function(id, event) {
                    // display event only if its type is set to true in filters obj
                    // or it was not defined yet - for newly created event
                    if (filters[event.status] || event.status==scheduler.undefined) {
                        return true;
                    }

                    // default, do not display event
                    return false;
                };

                //===============
                //Config Timeline
                //===============


                //var sections =
                //[{"key":"APP_HOMOLOGACAO","label":"APP_HOMOLOGACAO"},{"key":"RACD_ARCHIVES","label":"RACD_ARCHIVES"},{"key":"EMAIL","label":"EMAIL"},{"key":"DBDEV_DATABASE","label":"DBDEV_DATABASE"},{"key":"APPS_WLS","label":"APPS_WLS"},{"key":"RACDBHOM01_EXPORT","label":"RACDBHOM01_EXPORT"},{"key":"RACD_EXPORT","label":"RACD_EXPORT"},{"key":"TED_DISTP_LOGS","label":"TED_DISTP_LOGS"},{"key":"TED_DISTH","label":"TED_DISTH"},{"key":"RACD_DATABASE","label":"RACD_DATABASE"},{"key":"NFC","label":"NFC"},{"key":"ARQ","label":"ARQ"},{"key":"TEDSERVER","label":"TEDSERVER"},{"key":"RISDC","label":"RISDC"},{"key":"BKP_OMNIBACK","label":"BKP_OMNIBACK"},{"key":"BKP_DATABASE","label":"BKP_DATABASE"},{"key":"ARQ_LOGS","label":"ARQ_LOGS"},{"key":"SYBASE","label":"SYBASE"},{"key":"LINUX","label":"LINUX"},{"key":"WINDOWS","label":"WINDOWS"},{"key":"RISSRV02","label":"RISSRV02"},{"key":"SERV_SEMANAL","label":"SERV_SEMANAL"},{"key":"DBDEV_EXPORT","label":"DBDEV_EXPORT"},{"key":"CLUSTER_NFC","label":"CLUSTER_NFC"},{"key":"CLUSTER_ORACLE","label":"CLUSTER_ORACLE"},{"key":"CLUSTER_HOMOLOG","label":"CLUSTER_HOMOLOG"},{"key":"CLUSTER_NETWORK","label":"CLUSTER_NETWORK"},{"key":"DBDEV_EXPORT_MENSAL","label":"DBDEV_EXPORT_MENSAL"},{"key":"EMAIL_MENSAL","label":"EMAIL_MENSAL"},{"key":"APPS_WLS_MENSAL","label":"APPS_WLS_MENSAL"},{"key":"SYBASE_MENSAL","label":"SYBASE_MENSAL"},{"key":"ARQ_LOGS_MENSAL","label":"ARQ_LOGS_MENSAL"},{"key":"RACD_EXPORT_MENSAL","label":"RACD_EXPORT_MENSAL"},{"key":"CLUSTER_NETWORK_MENSAL","label":"CLUSTER_NETWORK_MENSAL"},{"key":"RACD_NFEXML_MENSAL","label":"RACD_NFEXML_MENSAL"},{"key":"NFC_MENSAL","label":"NFC_MENSAL"},{"key":"WINDOWS_MENSAL","label":"WINDOWS_MENSAL"},{"key":"RIS_MENSAL","label":"RIS_MENSAL"},{"key":"LINUX_MENSAL","label":"LINUX_MENSAL"}];

                var backups=scheduler.serverList("backup_list"); // armazena lista

                scheduler.createTimelineView({
                    name:   "timeline",
                    x_unit: "minute",               //measuring unit of the X-Axis.
                    x_date: "%i",                   //date format of the X-Axis
                    x_step: 10,                     //X-Axis step in 'x_unit's
                    x_size: 144,                    //X-Axis length specified as the total number of 'x_step's
                    x_start: 0,                     //X-Axis offset in 'x_unit's
                    x_length: 144,                  //number of 'x_step's that will be scrolled at a time - referente setas que mudam de um dia para o outro.
                    y_unit: backups,                //sections of the view (titles of Y-Axis)
                    y_property: "text",             //mapped data property
                    render:"bar",                   //view mode
                    section_autoheight: false,      // disable height in y_unit's
                    dy: 15,                         // dimensao de Y
                    event_dy: "full",               // events fica todo cheio
                    second_scale:{
                        x_unit: "hour",             // unit which should be used for second scale
                        x_date: "%H"                // date format which should be used for second scale, "July 01"
                    }
                });

                //===============
                //Config lightbox
                //===============

                scheduler.config.lightbox.sections = [
                    {name:"template", height: 40, type:"template", map_to:"my_template"},
                    {name:"time", height:160, type:"time", map_to:"auto"}
                ];

                //scheduler.attachEvent("onEventCreated", function(id, e) {
                scheduler.attachEvent("onClick", function(id, e) {
                    var ev = scheduler.getEvent(id);
                    ev.my_template = "<p><b>Backup: </b>"+ ev.text +"&nbsp;&nbsp;<b>Duração: </b>"+ ev.duracao +"&nbsp;&nbsp;<b>Status: </b>"+ ev.status +"&nbsp;&nbsp;<b>Quantidade de arquivos copiados: </b>"+ ev.files +"</p><b>Sessão ID: </b>"+ ev.session_id + "&nbsp;&nbsp;<b>Tamanho: </b>"+ ev.tamanho +" GB &nbsp;&nbsp;<b>Midias: </b>"+ ev.media +" fita(s) &nbsp;&nbsp;<b>Mode: </b>"+ ev.mode+ "&nbsp;&nbsp;<b>Tempo de espera: </b>"+ ev.queuing+"";
                });

                scheduler.attachEvent("onTemplatesReady", function(){
                    scheduler.templates.event_text=function(start,end,event){
                        return "<b>" + event.text + "</b><br><i>Duração:" + event.duracao + "</i><br><i>Tempo de espera:" + event.queuing + "</i>";
                    }
                });

                //===============
                //Command that inicial the system
                //===============

                scheduler.init('scheduler_here',new Date(),"week");

                //===============
                //Config data of events
                //===============

                //scheduler.load("./db/genjson.php", "json");
                scheduler.load("https://producaoh.sefa.pa.gov.br/portal/backup/janela_bkp/data"); //XML
                /*,function(){ //XML
                    alert("Dados Carregados com Sucesso!");
                });

                var dp = new dataProcessor("./db/genjson.php");
                dp.init(scheduler);
                */
            }
        </script>
</html>

<!-- /* End of file janela_bkp.php */ -->
<!-- /* Location: ./application/views/backup/janela_bkp.php */ -->