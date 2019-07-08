//<![CDATA[
/** COPYRIGHT NOTICE
This code is available for a fee.
Please contact me at wolfpil@gmail.com
*/
//declarando de variaveis
var href = window.location.href;
var markers = [];
var base = "https://sites.google.com/site/mapalinks/";//só é possivel usar o kmllayer se os kml estiverem hospedados em um servidor publico visivel pelo google.
var markerCluster = null;
var map,iw,timer,actual;
var chosen = [];
var stored = [];
var bounds_listener;
var glob={marks:[],polies:[]};

var latlng = new google.maps.LatLng(-4.893941, -52.913819); // latitude e longitude default ao carregar o mapa.

var icons={
	img:"img/icons-dot.png",//imagems dos icones
	down:[0,0],//vermelho
	up:[96,32],//96,0 azul marinho
	white:[160,0]//branco
	};
//0,0 vermelho 32,0 lilas 64,0 rosa choque 96,0 azul marinho 128,0 cinza 160,0 azul escuro 192,0 branco
//0,32 amarelo 32,32 rosa 64,32 verde claro 96,32 verde 128,32 amarelo mostarda 160,32 laranja 192,32 sombra
	function shifter(a){
		var b={
			url:icons.img,
			size:new google.maps.Size(32,32),
			origin:new google.maps.Point(a[0],a[1]),
			anchor:new google.maps.Point(15,32)
			};
		return b
	}
//
var hover={
	over:function(a){
		var c=markers[a];
		var b=document.getElementById(c.id);
		b.className="focus";
		c.setIcon(shifter(icons.white))
	},
	out:function(a){
		var c=markers[a];
		var b=document.getElementById(c.id);

			if(c.mycategory=="down"){
			b.className="down";
			} else{
			b.className="up";
			}
//		b.className="normal";
		c.setIcon(shifter(icons[c.mycategory]))
		}
};
// frunçao que mostra uma camada com a situção do tranfego de transito.
//var trafficLayer = new google.maps.TrafficLayer();
/*
var layers = {
  "clouds": new google.maps.weather.CloudLayer(),
  "weather": new google.maps.weather.WeatherLayer({
	temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS,
	windSpeedUnits: google.maps.weather.WindSpeedUnit.KILOMETERS_PER_HOUR
	})
};
*/
var $id=function(a){
	return document.getElementById(a)
};

//Para que os desenhos no mapa sejam exibidos é necessario que os arquivos kmz estejam em um site publico para que a api da google possa ser carregadas.
var kml = {
	a: {
		name: "Estado do Par&aacute;",
		url: base + "Para.kmz"
	},
	//b: {
	//	name: "Estados Br",
	//	url: base + "Estados.kmz"
	//},
	//c: {
	//	name: "Municipios do PA",
	//	url: base + "Municipios_PA.kmz"
	//},
	b: {
		name: "Baixo Amazonas",
		url: base + "baixo_amazonas_PA.kmz"
	},
	c: {
		name: "Maraj&oacute;",
		url: base + "marajo.kmz"
	},
	d: {
		name: "Metropolitana de Bel&eacute;m",
		url: base + "metropolitana_belem_PA.kmz"
	},
	e: {
		name: "Nordeste do Par&aacute;",
		url: base + "nordeste_PA.kmz"
	},
	f: {
		name: "Sudoeste do Par&aacute;",
		url: base + "sudoeste_PA.kmz"
	},
	g: {
		name: "Sudeste do Par&aacute;",
		url: base + "sudeste_PA.kmz"
	}
	//j: {
	//	name: "Teste;",
	//	url: base + ".kmz"
	//}
};

//####################################?????????????????????????????????????????##################################
function normalize(){
	for(var a=0,b;b=glob.marks[a];a++){
		if(b.iw_open){
			b.iw_open=false;
			b.setIcon(icon(b.col));
			document.getElementById("member"+a).previousSibling.style.backgroundPosition="-33px 0"
		}
	}
}

//####################################??????????????????????????????????????##################################
function getWindowSize(){
	var a,b;
		if(typeof(window.innerWidth)=="number"){
			a=window.innerWidth;
			b=window.innerHeight
		}
		else if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){
			a=document.documentElement.clientWidth;
			b=document.documentElement.clientHeight
		}
		else if(document.body&&(document.body.clientWidth||document.body.clientHeight)){
		a=document.body.clientWidth;
		b=document.body.clientHeight
		}
	return{
		width:a,
		height:b
	}
}

//########################## funcao que faz o efeito de aproximação quando o grupo é selecionado#########################
function fitBounds(a){
	var b=new google.maps.LatLngBounds();
		for(var d=0,c;c=glob.marks[d];d++){
			if(c.col==a){
				b.extend(c.getPosition())
			}
		}
	map.fitBounds(b)
}

//##############################Função que redimensiona o mapa#################################
function myresize(){
	$id("gmap").style.height=getWindowSize().height-70+"px";
	$id("allpanelCards").style.height=getWindowSize().height-123+"px";
		if(document.all)google.maps.event.trigger(map,"resize")
}

//#######################funcao que inicializa o mapa###################################
function init(){
	$id("allpanelCards").style.height=getWindowSize().height-123+"px";//dimensiona o tamanho do quadro onde será exibido a lista de links.
	var a=$id("gmap");//definindo variavel do quadro onde será exibido o mapa
	a.style.height=getWindowSize().height-70+"px";// dimensiona o tamanho do quadro onde será exibido o mapa.
	var latlng=new google.maps.LatLng(-4.893941, -52.913819); // latitude e longitude default ao carregar o mapa.----REPETIDO----
	var myOption={
		zoom:5,
		center:latlng,
		scaleControl:true,
		streetViewControl:true,
		draggableCursor:'auto',

		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		},

		mapTypeId:google.maps.MapTypeId.ROADMAP,
		overviewMapControl:true,
		overviewMapControlOptions:{
			opened:false
		}
	};
	map=new google.maps.Map(a,myOption);
	iw=new google.maps.InfoWindow();
	google.maps.event.addListener(iw,"closeclick",function(){
		normalize()
	});
	google.maps.event.addListener(map,"click",function(){
		normalize();
		iw.close()
	});
		// Add self created control
   //var more_control = new MoreControl();
   var md_control = new MDControl();

	var f=$id("minimize");
	map.getDiv().appendChild(f);

	var g=$id("addr");

	var h=new google.maps.places.Autocomplete(g);
		if(document.all)
			a.onresize=myresize;
			//readData()
			carregarPontos()
	createSidebar()
}

//###############################funcao que configura a inicializacao dos pontos#########################################################
function carregarPontos() {
	$.getJSON(href+'/assets/custom/maps/zabbix/alertas_zabbix_api.php', function(data) {
		$.each(data, function(index, ponto) {
			var iconShadow={
			url:icons.img,
			size:new google.maps.Size(59,32),
			origin:new google.maps.Point(192,32),
			anchor:new google.maps.Point(15,32)
			};
			var ident = ponto.id;
			var sdbar = ponto.name;
			var category = ponto.type;
			var point = new google.maps.LatLng(ponto.latitude, ponto.longitude);
			var name = ponto.name;
            var duration = ponto.duration;// --REPETIDO
			var marker = new google.maps.Marker({
				map:map,
				position: point,
				title: name,
				clickable:true,
				draggable:false,
				icon:shifter(icons[category]),
				shadow: iconShadow
			});
			//informações do balão
			var myOptions = "<b><a href='http://x-oc-cacti.sefa.pa.gov.br:8080/nagios/cgi-bin/trends.cgi?host=' target='_blank' title='Consulta nagios' style='text-decoration: none; color:#000000; font-weight:bold'>"+ponto.name+"</a><\/b><p style='font-size:smaller'>"+
				"<b>Designacao: </b>"+
				"<br>"+"<b>IP Sefa: </b><a href='http://portal-monitoramento.sefa.pa.gov.br/index/links_ping.php?ip="+ponto.ip+"' target='_blank' title='Ping'>"+ponto.ip+"</a>"+
				"<br>"+"<b>IP Embratel: </b>"+ ponto.ip +
				"<br>"+"<b>Tipo link: </b>"+  +
				"<br>"+"<b>Velocidade: </b>"+  +"k"+
				"<br>"+"<b>Dura&ccedil;&atilde;o: </b>"+ ponto.duration+" </p>";//--REPETIDO

			google.maps.event.addListener(marker,"click",function(){
				iw.setContent(myOptions);
				iw.open(map,marker)
			});

			google.maps.event.addListener(marker,"mouseover",function(){
				marker.setIcon(shifter(icons.white));
				var a=document.getElementById(ident);
					if(a){
						a.className="focus";
						actual=a
						}
			});
			google.maps.event.addListener(marker,"mouseout",function(){
				marker.setIcon(shifter(icons[category]));
					if(actual){
						if(category=="down"){
							actual.className="down"
							}
						else{
							actual.className="up"
							}
						}
			});

			if(markers){
							markers.sort(compareCats)
						}
		// === Store the category and name info as a marker properties ===
        marker.mycategory = category;
        marker.duration = duration;
		marker.local = point;
        marker.myname = name;
		marker.id=ident;
		markers.push(marker);
		});
		// == show or hide the categories initially ==
        hide("up");
        show("down");
		makeSidebar();
		mkcluster();
	});
	//funcao que chama o settimeout para fazer o refresh dos markers
	clearOverlays();
}

// == shows all markers of a particular category, and ensures the checkbox is checked ==
  function show(opcao) {
	for (var i=0; i<markers.length; i++) {
	  if (markers[i].mycategory == opcao) {
		markers[i].setVisible(true);
	  }
	}
	// == check the checkbox ==
	document.getElementById(opcao+"box").checked = true;
  }
// == hides all markers of a particular category, and ensures the checkbox is cleared ==
  function hide(opcao) {

	for (var i=0; i<markers.length; i++) {
	  if (markers[i].mycategory == opcao) {
		markers[i].setVisible(false);
	  }
	}
	// == clear the checkbox ==
	document.getElementById(opcao+"box").checked = false;
	iw.close();
  }
// == a checkbox has been clicked ==
  function boxclick(box,opcao) {
	if (box.checked) {
	  show(opcao);
	}
	else {
	  hide(opcao);
	}
	// == rebuild the sidebar
	makeSidebar();
	// == rebuild the markerclusterer
 	mkcluster();
  }
// == rebuilds the markerclusterer to match the markers currently displayed ==
  function mkcluster(){
		//create temp array for cluster
        var temp_markers = new Array();
        // if the markerClusterer object doesn't exist, create it with empty temp_markers
        if (markerCluster == null) {
            markerCluster = new MarkerClusterer(map, temp_markers, {
                imagePath: 'img/m'
            });
        }
        // clear all markers
        markerCluster.clearMarkers();
	for (var i=0; i<markers.length; i++) {
		if (markers[i].getVisible()) {
			// add marker to temp array, for clustering
			temp_markers.push(markers[i]);
		}
	}
	// add all current markers to cluster
    markerCluster.addMarkers(temp_markers);
  }

// == if myclick has been clicked ==
  function myclick(i) {
    google.maps.event.trigger(markers[i], "click");
    }

// == rebuilds the sidebar to match the markers currently displayed ==
  function makeSidebar() {
	var a;
	var side_bar_html = "";
	var latlngbounds = new google.maps.LatLngBounds();
	for(var i=0,d;d=markers[i];i++){
	  if (markers[i].getVisible()) {
		latlngbounds.extend(markers[i].local);
		var f=markers[i].mycategory;
		f=f.replace(/^./,f.charAt(0).toUpperCase());//
			if(a!=f)
				side_bar_html +='<br \/><div class=rotulo>'+f+'s<\/div><br \/>';
				side_bar_html += '<ul>';
				side_bar_html +='<li><a id="'+markers[i].id+'" class="'+markers[i].mycategory+'" href="javascript:myclick('+i+')" onmouseover="hover.over('+i+')" onmouseout="hover.out('+i+')">'+markers[i].myname+'<\/a></li>';
				side_bar_html += '</ul>';
				a=f
	  }
	}
	//condição para correção do erro qdo não tinha markers ou seja vazio.
	if (latlngbounds.isEmpty()){
		var myPlace1 = new google.maps.LatLng(1.098565,-58.670425);
		var myPlace2 = new google.maps.LatLng(-9.730714,-50.298843);
		latlngbounds.extend(myPlace1);
		latlngbounds.extend(myPlace2);
		side_bar_html += '<br \/><b>Nem um link fora ou categoria selecionada.<\/b><br \/>';
	}
	map.fitBounds(latlngbounds);
	document.getElementById("side_bar").innerHTML = side_bar_html;
  }

//##############################funcao que atribui a acao ao menu lista ####################################
function triggerClick(a){
	google.maps.event.trigger(glob.marks[a],"click")
}

//############################funcao que verifica se o botao esconde e mostra o sidebar foi clicado##########################
function togglePanel(a){
	var b=$id("minimize"),
	d=$id("leftpanel"),
	c=$id("gmap"),
	f=$id("panel-foot"),
	g=map.getCenter();
		if(a=="left"){
			b.style.display="block";
			d.className="hidden";
			c.style.marginLeft="0";
			f.style.display="none"
		}
		else{
			b.style.display="none";
			d.className="";
			c.style.marginLeft="374px";
			f.style.display="block"
		}
	google.maps.event.trigger(map,"resize");
	map.setCenter(g)
}

//#################################funçao que mostra as opçoes do sidebar##########################
function flipTab(a){
	var b=$id("panel-tabs").getElementsByTagName("span");
	var d=["listing",/*"favorites",*/"mysearches"];
		for(var c=0,f,g;g=d[c],f=b[c];c++){
			$id(g).style.display=(a==g)?"block":"none";
			f.style.backgroundColor=(a==g)?"#e7e7e7":"#f5f5f5"
		}
}

//##########################funcao que faz a pesquisa de cidade, local rua#####################
function showAddress(address){
	var geocoder = new google.maps.Geocoder();
	//corrigido o erro para cidade como santarem e altamira com a insercao da region: br
	geocoder.geocode({'address':address + 'Brasil', 'region':'BR'},function(results, status){
		if(status==google.maps.GeocoderStatus.OK){
			map.setCenter(results[0].geometry.location);
			map.setZoom(10)
			//var marker = new google.maps.Marker({
			//	map: map,
			//	position: results[0].geometry.location
			//});
		}
		else{
			alert(address+" não encontrado: "+ status);
		}
	});
}

//##########################BOTAO DE WEATHER, CLOUDS E SEARCH##################
 /* Returns true if a checkbox is still checked
 *  otherwise false
 */
function checkChecked() {
 var boxes = document.getElementsByName("box");
 for (var i = 0; i < boxes.length; i++) {
  if (boxes[i].checked) return true;
 }
 return false;
}
//###################################?????????????????##################################
function adaptButton(is_on) {
 var $ = function(_id) { return document.getElementById(_id) };
 var hider = $("remover");
 var text = $("clicktarget");

 if (is_on) {
   // Reset chosen array
   chosen.length = 0;
   // Highlight the link and make the button font bold
   hider.className ="highlight";
   text.style.fontWeight = "bold";
 }
 else {
   // Reset the link and the button when all checkboxes are unchecked
   if (!checkChecked()) {
     hider.blur();
     hider.className ="";
     text.style.fontWeight = "normal";
   }
 }
}

//###################################?????????????????????##########################
/*function switchLayer(is_on, id) {
  var layer = layers[id];
  //  Filter for Panoramio pictures
  if (layer.setTag) {
    layer.setTag("big");
    // layer.setUserId("12345678");
  }
  if (is_on) {
    layer.setMap(map);
  } else {
    layer.setMap(null);
  }
  adaptButton(is_on);
}
*/
//############################Enables and disables all pois#######################################
function setPois(is_on) {
  var style = {};
  style.featureType = "poi";
  style.stylers = [{visibility : (is_on ? "on" : "off") }];
  return [style];
}

//############################?????????????????################################
function shiftPois(is_on) {
  map.setOptions({styles: setPois(is_on) });
  adaptButton(is_on);
}

//##########################??????????????????###############################
/*function hideAll() {
 var boxes = document.getElementsByName("box");
 for (var i = 0, m; m = boxes[i]; i++) {
  if (m.checked) {
   m.checked = false;
   if (m.id != "pois") {
    switchLayer(false, m.id);
   } else {
    shiftPois(false);
   }
   // Store id's of turned off layers to make them recallable by button click
   chosen.push(m.id);
  }
 }
}

//###################################??????????????????????????##################################
function toggleLayers(e) {
  // Taking care of the clicked target
  // because every click on a checkbox may also be a button click.
  //  We only need real button clicks here
  var target = e ? e.target : window.event.srcElement;
  if (target.id != "clicktarget") return;

  if (chosen.length > 0 ) {
   // Make an independent copy of chosen array
   // since it possibly will be reset.

   var copy = chosen.slice();
   for (var i = 0, m; m = copy[i]; i++) {
     if (m != "pois") switchLayer(true, m);
     else shiftPois(true);
     document.getElementById(m).checked = true;
   }
  }
  else {
   hideAll();
  }
}

//############################## Função que cria o menu de previsao do tempo ##################################
function MoreControl() {
  //var me = this;
  var outer = document.createElement("div");
  outer.style.width = "93px";
  var inner = document.createElement("div");
  inner.id = "more_inner";
  inner.className = "button";
  //inner.title ="Show/Hide layers";
  var text = document.createElement("div");
  text.id = "clicktarget";
  text.appendChild(document.createTextNode("Previsao..."));
  inner.appendChild(text);
  outer.appendChild(inner);
  // Take care of the clicked target
  inner.onclick = toggleLayers;
  var swingmenu = document.getElementById("swingbox");
  inner.appendChild(swingmenu);
  outer.onmouseover = function() {
   if (this.timer) clearTimeout(this.timer);
    swingmenu.style.display = "block";
  };
  outer.onmouseout = function() {
   this.timer = setTimeout(function() {
   swingmenu.style.display = "none";
   }, 300);
  };
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(outer);
}
*/
 //#############################botao de position##################
 function storePos() {
 var f_change = function(str) {
   // Change font weight of button when stored position is displayed
   document.getElementById("posButton").firstChild.style.fontWeight = str;
 };
 stored.splice(0, 2, map.getCenter(), map.getZoom());
  f_change("bold");
  // Register map bounds listener
  if (!bounds_listener) {
   bounds_listener = google.maps.event.addListener(map, "bounds_changed", function() {
    var c = map.getCenter(), z = map.getZoom();
    if (c.equals(stored[0]) && z == stored[1]) {
     f_change("bold");
    }
    else {
    f_change("normal");
   }
  });
 }
}

//############################## Funçao que aproxima o mapa para uma posiçao padrao ou armazenado. ####################################
function showPos(a) {
 if (a) { // "Home" clicked
  map.setOptions({center: latlng, zoom: 6 });
 }
 else if (stored.length > 0) { // "Show" clicked
  map.setOptions({center: stored[0], zoom: stored[1] });
 }
}

//##################################### Funçao que cria o botao Posicao sobre o mapa #############################
function MDControl() {
  var container = document.createElement("div");
  container.style.width = "93px";
  var posButton = document.createElement("div");
  posButton.id = "posButton";
  posButton.className = "button";
  container.appendChild(posButton);
  // Take care of the clicked target
  var txt = document.createElement("a");
  //txt.title ="Store/Show position";
  txt.appendChild(document.createTextNode("Posicao"));
  // When a position is stored it's also possible
  // to click on the button to go to the stored position
  txt.onclick = function() { showPos() };
  posButton.appendChild(txt);
  var swingmenu = document.getElementById("swingmenu");
  posButton.appendChild(swingmenu);
  posButton.onmouseover = function() {
   if (this.timer) clearTimeout(this.timer);
    swingmenu.style.display = "block";
  };
  posButton.onmouseout = function() {
   this.timer = setTimeout(function() {
   swingmenu.style.display = "none";
   }, 300);
  };
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(container);
}

//#####################################criaçao dos poligonos#############################
function toggleKML(a, b)
{
	if (a)
	{
		var c = new google.maps.KmlLayer(kml[b].url);
		kml[b].obj = c;
		kml[b].obj.setMap(map);
		google.maps.event.addListenerOnce(c, "metadata_changed", function ()
		{
			kml[b].bounds = this.getDefaultViewport()
		})
	}
	else
	{
		kml[b].obj.setMap(null);
		delete kml[b].obj
	}
}

//##################################### funçao que faz aproximar o mapa sobre a mesoregiao clicada #############################
function zoomToOverlay(a, b)
{
	var c = document.forms["myform"].elements["box"][a];
	if (c.checked)
	{
		map.fitBounds(kml[b].bounds)
	}
	else
	{
		c.click()
	}
}

//##################################### Funçao que remove os a checked das mesoregioes #############################
function removeAll()
{
	for (var a in kml)
	{
		if (kml[a].obj)
		{
			kml[a].obj.setMap(null);
			delete kml[a].obj
		}
	}
	var b = document.getElementsByName("box");
	for (var c = 0, d; d = b[c]; c++)
	{
		d.checked = false
	}
}

//#####################################função que cria o menu das mesoregioes #############################
function createSidebar()
{
	var a = -1;
	var b = "<form name='myform' id='myform'>";
	for (var c in kml)
	{
		a++;
		b += "<p><input name='box' type='checkbox' id='" + c + "' onclick='toggleKML(this.checked, this.id)' \/>&nbsp;<a href='#' onclick=\"zoomToOverlay(" + a + ", '" + c + "');return false;\">" + kml[c].name + "<\/a><\/p>"
	}
	b += "<p><a href='#' onclick='removeAll();return false;'>Desmarcar Todos<\/a><\/p><\/form>";
	document.getElementById("Mesoregioes").innerHTML = b

	// == check the checkbox ==
	document.getElementById("a").checked = true
	if (document.getElementById("a").checked = true) MapPara();

}

function MapPara(){

	toggleKML('checked', 'a')
	zoomToOverlay('0', 'a')

}

//#####################################funcao que faz o refresh dos markers#############################
function clearOverlays() {

var checkbox = document.getElementById("chbx");

  if (checkbox.checked) {

	setTimeout(function() {

	limparMarkers()
	carregarPontos();
	}, 120000); //5000); //200000);

  }
}

function limparMarkers(){
	// for (i in markers) {
	for (i=0; i < markers.length; i++) {

      markers[i].setMap(null);

    }
    markers.length = 0;
}


// ###################################variavel que faz a ordenação do sidebar##############################
var compareCats=function(a,c){
	var b=a.myname;
	b=b.toLowerCase();
	b=b.replace(/ä/g,"a");
	b=b.replace(/ö/g,"o");
	b=b.replace(/ü/g,"u");
	b=b.replace(/ß/g,"s");
	var d=c.myname;
	d=d.toLowerCase();
	d=d.replace(/ä/g,"a");
	d=d.replace(/ö/g,"o");
	d=d.replace(/ü/g,"u");
	d=d.replace(/ß/g,"s");
	var f=a.mycategory;
	var j=c.mycategory;
		if(a.mycategory==c.mycategory){
			if(a.myname==c.myname){
				return 0
			}
		return(a.myname<c.myname)?-1:1
		}
	return(a.mycategory<c.mycategory)?-1:1
};

window.onload=init;
window.onresize=myresize;