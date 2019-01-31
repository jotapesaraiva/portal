    document.body.onload = function() {
        scheduler.config.xml_date="%Y-%m-%d %H:%i";
//        scheduler.config.prevent_cache = true;

        scheduler.config.lightbox.sections=[
            {name:"description", height:130, map_to:"text", type:"textarea" , focus:true},
            {name:"location", height:43, type:"textarea", map_to:"details" },
            {name:"time", height:72, type:"time", map_to:"auto"}
        ];
        scheduler.config.first_hour = 4;
        scheduler.config.limit_time_select = true;
        scheduler.locale.labels.section_location="Location";



        scheduler.init('scheduler_here',new Date(2010,7,1),"month");
        scheduler.setLoadMode("month");
        scheduler.load("./janela_bkp/teste");

        var dp = new dataProcessor("./janela_bkp/teste");
        dp.init(scheduler);
    };