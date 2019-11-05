
String.prototype.replaceAll = function(de, para){
	var str = this;
	var splitStr = str.split(de);
	str = splitStr.join(para);
	return str;
};


function openQuestionConsultar(){
	
	$("#divQuestionConsultar").dialog({
		autoOpen: false,
		draggable: false,
		resizable: false,
		modal: true,
		height: "auto",
		width: "auto",
		title: "Consultar GNRE",
		buttons:[
		{
			text: "Cancelar",
			click: function(){
				$(this).dialog("close");
			}
		}]
		,
		open:function(){
			$("#aLinkNum").blur();
		}					
	});

	try {
		$("#divQuestionConsultar").dialog("open");
	}
	catch(exception){
		openQuestionConsultar();
	}
}
	
function abrirJanela(url, nomeJanela, larg, alt, scroll, resize, titlebar) {
	if ((scroll == '') || (scrool = undefined))
		scroll = 'yes';
	
	if (resize == undefined){
		resize = 'no';
	}
	
	if (titlebar == undefined){
		titlebar = 'yes';
	}
	
	var newWindow = window.open(url, nomeJanela,'width=' + larg + ',height=' + alt + ',top=' + (screen.height - alt)/2 + ',left=' + (screen.width - larg)/2 + ',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=' + scroll + ',resizable=' + resize + ',titlebar=' + titlebar, true);
	newWindow.focus();
	
	return newWindow;
}

/**
 * Valida se a string passada e um telefone, no formato "9999-9999"
 * */
function validaTel8(sTel){ 
	exp = /\d{4}\-\d{4}/;		
    return exp.test(sTel);
}

function validaEmail(mail){     
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	if(typeof(mail) == "string"){                
		if(er.test(mail)){ 
			return true; 
		}        
	}else if(typeof(mail) == "object"){
		if(er.test(mail.value)){
			return true;                                 
		}
	}
	return false;                
}

function validaValor(valor, decimal){
	if (decimal == '')
		decimal = 2;
	
	//var er1 = /^(0|\d{1,11}|[1-9]{1}\d{0,2}(\.\d{3}){1,2})(\,\d{2})/;
	var er = new RegExp("^(0|\\d{1,11}|[1-9]{1}\\d{0,2}(\\.\\d{3}){1,2})(\\,\\d{" + decimal + "})");
	//alert(er + "\n" + er1);
	if(typeof(valor) == "string"){                
		if(er.test(valor)){ 
			return true; 
		}        
	}else if(typeof(valor) == "object"){
		if(er.test(valor.value)){
			return true;                                 
		}
	}
	return false;                
}

function validaData(objeto) {
	var valor;
	if (objeto.val){
		valor = objeto.val();
	}
	else{
		valor = objeto.value;
	}
	var mValores = "312831303130313130313031";
	var retorno = false;
	var lastDate = 0;

	if (jsTrim(valor) == '') return true;
	if (valor.length < 10) retorno = false;
	if (valor.substr(6, 4) < 2000) {
		messageDialog('Validação da Data', 'O ano não pode ser inferior a 2000.', 'alert', 300, setFocus, objeto);
		return false;
	}
	else if (valor.substr(6, 4) > 2099) {
		messageDialog('Validação da Data', 'O ano não pode ser superior a 2099.', 'alert', 300, setFocus, objeto);
		return false;
	}

    dia  = parseInt(valor.substring(0,2),10);		// pega o dia
	mes  = parseInt(valor.substring(3,5),10); 		// pega o m?s
	ano  = parseInt(valor.substring(6,10),10);		// pega o ano
	
	if (mes == 2){
		if (anobissexto(ano)) {
			lastDate = 29;
		} else {
			lastDate = 28;
		}
	} else {
		lastDate = mValores.substring((mes-1)*2, (mes-1)*2+2);
	}
	
	if (valor.length < 8){
		retorno = false;
	} else if ((valor.substring(2,3) != "/" ) || (valor.substring(5,6) != "/") ) {
		retorno = false;
	} else if ( (isNaN(dia)) || (isNaN(mes)) || ( isNaN(ano)) ) {
		retorno = false;
	} else if ( (mes > 12) || (mes <= 0) ){
		retorno = false;
	} else if ( (dia > lastDate) || (dia <=0) ){
		retorno = false;
	} else if (valor.substring(6,10) < 4){
		retorno = false;
	} else {		
		retorno = true;
	}

	if (!retorno){
		//objeto.focus();
		//objeto.select();
		//alert("Data Inv�lida!");
		messageDialog('Validação da Data', 'Data Inválida!', 'alert', 300, setFocus, objeto);
	}

	return retorno;
}


function anobissexto (ano) { 
	if (((ano % 4)==0) && ((ano % 100)!=0) || ((ano % 400)==0)) { 
		return (true);
	} else return (false);
}

function verificarEhNumero(obj){
	var intStringLen = obj.value.length;
	var stringFinal = '';
	for (var intCur = 0; intCur < intStringLen; intCur++) {
		var schar = obj.value.charAt(intCur);
		var ichar = obj.value.charCodeAt(intCur);
		if(ichar >= 48 && ichar <= 57){
			stringFinal += schar;
			//alert("Esse campo s� aceita n�meros!");
			//obj.focus();
			//break;
		}
	}	
	obj.value = stringFinal;
}

function jsTrim(pStr){
	var i;
	var strAux;
	var PosIni,PosFim;

	//PROCURA A PRIMEIRA POSI??O V?LIDA DIFERENTE DE ESPA?O EM BRANCO
	i=0;
	while ((i < pStr.length) && (pStr.charAt(i)==" ")){
		i++;
	}
	PosIni = i;

	//PROCURA A ULTIMA POSI??O V?LIDA DIFERENTE DE ESPA?O EM BRANCO
	i=pStr.length-1;
	while ((i >= 0) && (pStr.charAt(i)==" ")){
		i--;
	}
	PosFim = i + 1;
	
	// TESTA SE OS VALORES SE CRUZARAM
	if (PosIni < PosFim){
		strAux = pStr.substring(PosIni,PosFim);
	}
	else{
		strAux = "";
	}
		
	return strAux;
}

function EhNumeroSemPonto(evento){
	var codigo;
	codigo = evento.keyCode; 
	
	// 13 - <ENTER>
	if (codigo == 13) {
		return true;
	}
	
	if(codigo < 48 || codigo > 57){
		alert("Esse campo só aceita números !");
		evento.keyCode = 0;
		return false;
	}

}

function EhValor(evento){
	var codigo;
	codigo = evento.keyCode; 
	
	//O C?digo 44 ? correspondente a v?gula(,) usado para casas decimais.
	// 13 - <ENTER>
	if (codigo == 44 || codigo == 13) {
		return true;
	}
	
	if(codigo < 48 || codigo > 57){
		alert("Esse campo só aceita números !");
		evento.keyCode = 0;
		return false;
	}
}

function AbrirAjuda(nomePagina, nomeJanela) {
	var newWindow = window.open(nomePagina +'?hePopup=True', nomeJanela,'width=400,height=400,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');
	newWindow.focus();
}

//Limpa todos os objetos do form
function Limpar(frm){
	for (var i = 0; i < frm.elements.length; i++){
		if ((frm.elements[i].type != 'hidden') && 
				(frm.elements[i].type != 'button') &&
				(frm.elements[i].type != 'radio')){
			frm.elements[i].value = '';
		}		
	}
}

function UpDownClick(objeto, inc_dec){
	if (objeto.value == ''){
		return;
	}
	var valor = parseInt(objeto.value);
	valor = valor + inc_dec;
	objeto.value = valor.toString();
}
function DefinirAnoAtual(objeto) {
	if (objeto.value == '') {
		var d = new Date();
		objeto.value = d.getYear();
	}
}
/*
function abreRelatorio(sSistema, sNomeRelatorio, sParam){
  
  var settings =  'location=no,toolbar=no,directories=no,scrollbars,menubar=no,status=no,resizable=no,';
  settings = settings + 'left=0,top=0,width=800,height=600';

	var loc = document.location.toString();
	var pos = loc.indexOf('/' + sSistema);
	var server = loc.substring(0, pos);

 	var url = server + '/Relatorios/Report.asp?SISTEMA=' + sSistema + '&NOME_RELATORIO=' + sNomeRelatorio + '.rpt&LST_PARAMETROS=' + sParam;

  window.open(url,'',settings);
}

function abreRelatorioADO(sPagina){
  
  var settings =  "location=no,toolbar=no,directories=no,menubar=no,status=no,scrollbars=no,resizable=no,";
  settings = settings + "left=0,top=0,width=800,height=600";

  window.open(sPagina,'',settings);
}
*/
function mhHover(tr, cls)
{
	var t, d;
	if (document.getElementById)
		t = document.getElementById(tr);
	else
		t = document.all(tr);
	if (t == null) return;
	
	d = t.getElementsByTagName('TD');
	
	for (var i = 0; i < d.length; i++){
		d[i].className = cls;
	}
}

function intervaloCorreto(objetoIni, objetoFim) {
	var retorno = true;
	var diaI, diaF, mesI, mesF, anoI, anoF, mensagemD;
	
	if (objetoIni.value != "" && objetoFim.value != "") {
		mensagemD = "Intervalo das Datas está incorreto!";
		diaI = objetoIni.value.substring(0, 2);
		mesI = objetoIni.value.substring(3, 5);
		anoI = objetoIni.value.substring(6, 10);
	
		diaF = objetoFim.value.substring(0, 2);
		mesF = objetoFim.value.substring(3, 5);
		anoF = objetoFim.value.substring(6, 10);
	
		if (anoI > anoF) {
			alert(mensagemD);
			retorno = false;
		} else if (anoI == anoF) {
			if (mesI > mesF) {
				alert(mensagemD);
				retorno = false;
			} else if(mesI == mesF) {
				if (diaI > diaF) {
					alert(mensagemD);
					retorno = false;
				}
			  }
		}
	}
	
	if(!retorno){
		objetoIni.focus();
	}
    return retorno;
}

function NumeroDeMeses(anoI, mesI, anoF, mesF)
{
	var dAno = anoF - anoI;
	var dMes = mesF - mesI;
	return ((dAno * 12 + dMes) + 1);
}

function ultimoDiaMes(mes, ano){
	switch (mes){
	case 1:
	case 3:
	case 5:
	case 7:
	case 8:
	case 10:
	case 12:
		return 31;
	case 4:
	case 6:
	case 9:
	case 11:
		return 30;
	case 2:
		if (ano%4 == 0)
			return 29;
		else
			return 28;
	}
}

function copyToClipboard(s)
{
	if( window.clipboardData && clipboardData.setData )
	{
		clipboardData.setData("Text", s);
	}
	else
	{
		// You have to sign the code to enable this or allow the action in about:config by changing user_pref("signed.applets.codebase_principal_support", true);
		netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
		
		var clip = Components.classes['@mozilla.org/widget/clipboard;[[[[1]]]]'].createInstance(Components.interfaces.nsIClipboard);
		if (!clip) return;
		
		// create a transferable
		var trans = Components.classes['@mozilla.org/widget/transferable;[[[[1]]]]'].createInstance(Components.interfaces.nsITransferable);
		if (!trans) return;
		
		// specify the data we wish to handle. Plaintext in this case.
		trans.addDataFlavor('text/unicode');
		
		// To get the data from the transferable we need two new objects
		var str = new Object();
		var len = new Object();
		
		var str = Components.classes["@mozilla.org/supports-string;[[[[1]]]]"].createInstance(Components.interfaces.nsISupportsString);
		
		var copytext=meintext;
		
		str.data=copytext;
		
		trans.setTransferData("text/unicode",str,copytext.length*[[[[2]]]]);
		
		var clipid=Components.interfaces.nsIClipboard;
		
		if (!clip) return false;
		
		clip.setData(trans,null,clipid.kGlobalClipboard);	   
	}
}

function configPopup(titulo, elemento, funcao, largura){	
  $("#dialog:ui-dialog").dialog("destroy");
  $("#" + elemento).dialog({
      autoOpen: false,
      draggable: false,
      resizable: false,
      modal: true,
      width: largura,
      height: 'auto',
      title: titulo,
      buttons: {
          ' Salvar ': function () {
  			if(!funcao()){
  				return;
  			}
  			
  			$(this).dialog("close");
          },
          'Cancelar': function (){
          	$(this).dialog("close");
          }
      }
  });
  
  
  $(window).scrollTop(0);
  //var sigla = $('#divSiglaUF').html();
  //linkOffset = $("#link" + sigla).position();
  //scrolltop = $(window).scrollTop();
  //alert(scrolltop);
  //$("#" + elemento).dialog("option", "position", [(linkOffset.left - 200/2) + linkWidth/2, linkOffset.top + linkHeight - scrolltop]);  
  //$("#" + elemento).dialog("option", "position", linkOffset);
}

function configurarPopup(titulo, funcaoSalvar, largura, divCadastro) {
    //tituloPopup = titulo;
//    if (largura == undefined) {
//        largura = 506;
//    }
	
	if (divCadastro == undefined){
		divCadastro = 'dvCadastro';
	}
	
    $("#dialog:ui-dialog").dialog("destroy");
    $('#' + divCadastro).dialog({
        autoOpen: false,
        draggable: false,
        resizable: false,
        modal: true,
        width: largura,
        height: 'auto',//altura,
        title: titulo,
        buttons: {
            ' Salvar ': function () {
                //$('#btnUpdate').trigger('click');
    			funcaoSalvar();
    			$(this).dialog("close");
            },
            'Cancelar': function () {
            	$(this).dialog("close");
            }
        }/*,
        open: function (type, data) {
            $(this).parent().appendTo("form");
        }*/
    });
}


/**
prop - propriedades do dialog
@param prop.mensagem
@param prop.largura
@param prop.caller

@param prop.tipo
Possiveis tipos: info, alert, question

@param prop.functionAfter
Metodo que sera executado junto com o botao "ok". Passe 'null' se nao quiser associar metodo algum.

@param prop.paramFunction1
Parametro que sera passado no metodo 'functionAfter' (se o mesmo nao for nulo), para a opção Sim/Ok.

@param prop.paramFunction2
Parametro que sera passado no metodo 'functionAfter' (se o mesmo nao for nulo), para a opção Não/Cancelar.

@param prop.event
Evento que originou a chamada do dialog.
Se esse parâmetro for passado, será acionado o método 'preventDefault', caso o usuário escolha a opção 'negativa' (Não/Cancelar)
*/
function messageDialogV2(prop) {
    if (prop.tipo == undefined) {
        prop.tipo = 'info';
    }

    var $dialog = $('<div></div>')
    .html('<div style="float: left; margin: 0 20px 20px 0"><span class="ui-icon32 ui-icon32-' + prop.tipo + '" style="float: left;"></span></div><div style="float:left; width:80%;display:block">' + prop.mensagem + '</div>')
    .dialog({
        autoOpen: false,
        resizable: false,
        position: { 
			my: "center", 
			at: "center", 
			of: window 
		},
        height: 'auto',
        width: prop.largura == undefined ? 'auto' : prop.largura,
        modal: true,
        title: prop.titulo,
		buttons:[
			{
				text: (prop.tipo != "question" ? "Ok" : "Sim"),
				click: function(){
					$(this).dialog("close");
					
					if(prop.functionAfter != undefined && prop.functionAfter != null){ 
						if (prop.paramFunction1 == null || prop.paramFunction1 == undefined)
							prop.functionAfter();
						else
							prop.functionAfter(prop.paramFunction1);
					}
				}
			}
			,
			{
				text: (prop.tipo != "question" ? "Cancelar" : "Não"),
				click: function(){
					if(prop.event != undefined && prop.event != null){
						prop.event.preventDefault();
					}

					$(this).dialog("close");
				}
			}
		]
    });

    $dialog.dialog('open');
}


/**
@param tipo: Possiveis tipos: info, alert, question
@param largura: Se nao quiser definir a largura, passe 'null'.
@param functionAfter - Metodo que sera executado junto com o botao "ok". Passe 'null' se nao quiser associar metodo algum.
@param paramFunction - Parametro que sera passado no metodo 'functionAfter', se o mesmo nao for nulo.
*/
function messageDialog(titulo, mensagem, tipo, largura, functionAfter, paramFunction) {
    if (tipo == undefined) {
        tipo = 'info';
    }

    var $dialog = $('<div></div>')
    .html('<div style="float: left; margin: 0 20px 20px 0"><span class="ui-icon32 ui-icon32-' + tipo + '" style="float: left;"></span></div><div style="float:left; width:80%;display:block">' + mensagem + '</div>')
    .dialog({
        autoOpen: false,
        resizable: false,
        draggable: false,
        position: { 
			my: "center", 
			at: "center", 
			of: window 
		},
        height: 'auto',
        width: largura == null ? 'auto' : largura,
        modal: true,
        title: titulo,
        buttons: {
            'Ok': function () {
                $(this).dialog("close");                
                
                if(functionAfter != null && functionAfter != undefined){ 
                	if (paramFunction == null || paramFunction == undefined)
                		functionAfter();
                	else
                		functionAfter(paramFunction);
                }
            }
        }
    });

    $dialog.dialog('open');
}

function setFocus(objeto){
	if(objeto != undefined){
		if (objeto.val)
			objeto.trigger('focus');
		else
			objeto.focus();
	}
}

function confirmDialog(titulo, mensagem, largura, functionAfter, paramFunction) {
	
    var $dialog = $('<div></div>')
    .html('<span class="ui-icon32 ui-icon32-question" style="float: left; margin: 0 7px 20px 0;"></span>' + mensagem)
    .dialog({
        autoOpen: false,
        resizable: false,
        height: 'auto',
        width: largura == null ? 'auto' : largura,
        modal: true,
        title: titulo,
        buttons: {
            'Ok': function () {
                $(this).dialog("close");                
                
                if(functionAfter != null){                	
                	if (paramFunction == null)
                		functionAfter();
                	else
                		functionAfter(paramFunction);
                }
            },
    		'Cancelar': function () {
                $(this).dialog("close");               
            }
        }
    });

    $dialog.dialog('open');
}

function popupDialog(divPopup, titulo, largura, fecharOk, functionOk) {
	$("#dialog:ui-dialog").dialog("destroy");
    var $dialog = $('#' + divPopup)
    .dialog({
        autoOpen: false,
        resizable: false,
        height: 'auto',
        width: largura == null ? 'auto' : largura,
        modal: true,
        title: titulo,
        buttons: {
            'Ok': function () {
    			if (fecharOk){
    				$(this).dialog("close");                
    			}
    			
                if(functionOk != null){                	
                	functionOk();
                }
            },
    		'Cancelar': function () {
                $(this).dialog("close");                
            }
        }
    });

    $dialog.dialog('open');
}



/**================================================================================================
 * Cria um popup modal, que serve como um alerta. Ex: 'Carregando...'
 * */
function openLoading(texto){
	var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/",2));

	if (texto == undefined){
		texto = 'Carregando';
	}
	
	//$("#dialog:ui-dialog").dialog("destroy");
	if ($('#gLoading').length == 0){
		$('<div>', {
			id: 'gLoading',
			appendTo: 'body',
			append: [
			    $('<span>', {
			    	id: 'spTextoLoading',
			    	text: texto
			    }),
			    $('<img>', {
					attr: {
						'border': '0',
						'src': url + "/imagens/loading_24.gif"
					}
				})
			]
		}).dialog({
			autoOpen: true,
			resizable: false,
			closeOnEscape: false,
			modal: true,
			height: 55,
			width: 'auto',
			create: function( event, ui ) {
				$('.ui-dialog-titlebar').hide();
			}
		});
	}
	else{
		$('#spTextoLoading').text(texto);
		$('#gLoading').dialog('open');
	}
}


/**================================================================================================
 * Fecha a tela descrita acima.
 * */
function closeLoading(){
	if ($('#gLoading').length != 0){
		$('#gLoading').dialog('close');
	}
}

function formatarTabela(id){
	if ($('#' + id).hasClass('footable-loaded')){
		$('#' + id).trigger('footable_redraw');
	}
	else{
		$('#' + id).footable({
			pageSize: 10,
			limitNavigation: 5,
			breakpoints: { // The different screen resolution breakpoints
				phone1: 360,
		        phone: 480,
		        tablet: 600,
		        tablet2: 700
		    }
		}).bind('footable_sorted', function(e){
			$('#' + id + ' > tbody > tr').removeClass('odd even');
			$('#' + id + ' > tbody > tr:odd').addClass('odd');
			$('#' + id + ' > tbody > tr:even').addClass('even');
		}).bind('footable_breakpoint', function(e){
			if ($('.pagination').is(":hidden")){
				$('.pagination').show();
			}
		});
	}
	
	$('#' + id + ' > tbody > tr').removeClass('odd even');
	$('#' + id + ' > tbody > tr:odd').addClass('odd');
	$('#' + id + ' > tbody > tr:even').addClass('even');
	
	if ($('.pagination').is(":hidden")){
		$('.pagination').show();
	}

	//$(".desabilitado").prop("disabled", true);
	$(".desabilitado").attr("disabled", "disabled");
}

/*
 - desabilitar a paginação: passar prop.pageSize = 0
 */
function formatarTabela2(id, prop){
	if ($('#' + id).hasClass('footable-loaded')){
		$('#' + id).trigger('footable_redraw');
	}
	else{
		$('#' + id).footable({
			pageSize: prop.pageSize == undefined ? 10 : prop.pageSize,
			paginate: prop.pageSize == 0 ? false : true,
			limitNavigation: 5,
			breakpoints: { // The different screen resolution breakpoints
				phone1: 360,
		        phone: 480,
		        tablet: 600,
		        tablet2: 700
		    }
		}).bind('footable_sorted', function(e){
			$('#' + id + ' > tbody > tr').removeClass('odd even');
			$('#' + id + ' > tbody > tr:odd').addClass('odd');
			$('#' + id + ' > tbody > tr:even').addClass('even');
		}).bind('footable_breakpoint', function(e){
			if ($('.pagination').is(":hidden")){
				$('.pagination').show();
			}
		});
	}
	
	$('#' + id + ' > tbody > tr').removeClass('odd even');
	$('#' + id + ' > tbody > tr:odd').addClass('odd');
	$('#' + id + ' > tbody > tr:even').addClass('even');
	
	if ($('.pagination').is(":hidden")){
		$('.pagination').show();
	}

	//$(".desabilitado").prop("disabled", true);
	$(".desabilitado").attr("disabled", "disabled");
}

function formatarCNPJ(cnpj){
	var result = cnpj; 
	if (cnpj != undefined && cnpj != null && cnpj.length == 14){
		result = cnpj.slice(0,2) + '.' +
					 cnpj.slice(2,5) + '.' +
					 cnpj.slice(5,8) + '/' +
					 cnpj.slice(8,12) + '-' +
					 cnpj.slice(-2);
	}
	
	return result;
}

function formatarCPF(cpf){
	var result = cpf; 
	if (cpf != undefined && cpf != null && cpf.length == 11){
		result = cpf.slice(0,3) + '.' +
					cpf.slice(3,6) + '.' +
					cpf.slice(6,9) + '-' +
					cpf.slice(-2);
	}
	
	return result;
}	

function formatarCEP(cep){
	var result = cep;
	if (cep != undefined && cep != null && cep.length == 8){
		result = cep.slice(0,5) + '-' +
					cep.slice(-3);
	}
	
	return result;
}

function formatarTelefone(telefone){
	var result = telefone;
	if (telefone != undefined && telefone != null){
		if (telefone.length == 10){
			result = '(' + telefone.slice(0,2) + ')' +
						telefone.slice(2,6) + '-' +
						telefone.slice(-4);
		}
		else if (telefone.length == 11){
			if (telefone.slice(0,4) == '0800' || telefone.slice(0,4) == '0300'){
				result = telefone.slice(0,4) + ' ' +
							telefone.slice(4,7) + ' ' +
							telefone.slice(-4);
			}
			else if (telefone.slice(0,1) == '0'){
				result = '(' + telefone.slice(0,3) + ')' +
							telefone.slice(3,7) + '-' +
							telefone.slice(-4);
			}
			else{
				result = '(' + telefone.slice(0,2) + ')' +
							telefone.slice(2,7) + '-' +
							telefone.slice(-4);
			}
		}
		else if (telefone.length == 8){
			result = telefone.slice(0,4) + '-' +
						telefone.slice(-4);
		}
		else if (telefone.length == 9){
			result = telefone.slice(0,5) + '-' +
						telefone.slice(-4);
		}
	}
	
	return result;
}

/**================================================================================================*/
function getNomeMes(mes) {
	nomeMes = "";

	var iMes = parseInt(mes);
	
	switch (iMes) {
		case 1:
			nomeMes = "Janeiro";
			break;
		case 2:
			nomeMes = "Fevereiro";
			break;
		case 3:
			nomeMes = "Março";
			break;
		case 4:
			nomeMes = "Abril";
			break;
		case 5:
			nomeMes = "Maio";
			break;
		case 6:
			nomeMes = "Junho";
			break;
		case 7:
			nomeMes = "Julho";
			break;
		case 8:
			nomeMes = "Agosto";
			break;
		case 9:
			nomeMes = "Setembro";
			break;
		case 10:
			nomeMes = "Outubro";
			break;
		case 11:
			nomeMes = "Novembro";
			break;
		case 12:
			nomeMes = "Dezembro";
			break;
	}
	return nomeMes;
}


/**================================================================================================
 * Formata um n�mero de telefone, no seguinte formato:
 * quatro primeiros caracteres + '-' + resto dos caracteres.
 * */
function formatTel(n){
	n = n.substr(0,4) + '-' + n.substr(4, n.length);
	return n;
}	


/**===============================================================================================
 *dt = Data, no formado DD/MM/AAAA*/
function isValidDate(dt){
	var expReg = /^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30\/(0[13-9]|1[0-2])|31\/(0[13578]|1[02]))\/(19|20)?\d{2}$/;
	var aRet = true;

	if(dt.match(expReg) && (dt != "")){
		var dia = dt.substring(0,2);
		var mes = dt.substring(3,5);
		var ano = dt.substring(6,10);

		if((mes == 4 || mes == 6 || mes == 9 || mes == 11 ) && dia > 30) 
			aRet = false;
		else
			if((ano % 4) != 0 && mes == 2 && dia > 28) 
				aRet = false;
		  else
			  if((ano%4) == 0 && mes == 2 && dia > 29)
				  aRet = false;
	}else
		aRet = false;

	return aRet;
}


/**===============================================================================================*/
String.prototype.toDateBR = function(){
	var dh = this.split(' ');
	var d = dh[0].split('/');
	
	var dataBR = new Date(d[2], d[1] - 1, d[0], 0, 0, 0, 0);
	
	return dataBR;
};

String.prototype.toDateTimeBR = function(){
	var dh = this.split(' ');
	var d = dh[0].split('/');

	var h = 0;
	var m = 0;
	var s = 0;
	if (dh[1]){
		var t = dh[1].split(':');
		h = parseInt(t[0]);
		m = parseInt(t[1]);
		s = parseInt(t[2]);		}
	
	var dataBR = new Date(parseInt(d[2]), parseInt(d[1]) - 1, parseInt(d[0]), h, m, s, 0);

	return dataBR;
};

Date.prototype.toDateStringBR = function(){
	var mes = this.getMonth() + 1;
	if (mes < 10){
		mes = '0' + mes;
	}
	var dia = this.getDate();
	if (dia < 10){
		dia = '0' + dia;
	}
	
	var retorno = dia + '/' + mes + '/' + this.getFullYear();
	
	return retorno;
};

Date.prototype.toDateTimeStringBR = function(){
	var mes = this.getMonth() + 1;
	if (mes < 10){
		mes = '0' + mes;
	}
	var dia = this.getDate();
	if (dia < 10){
		dia = '0' + dia;
	}
	
	var retorno = dia + '/' + mes + '/' + this.getFullYear();
	
	var t = this.toTimeString().substring(0, 8);
	
	retorno += ' ' + t;
	
	return retorno;
};

String.prototype.padLeft = function (n,str){
    return Array(n-this.length+1).join(str||'0')+this;
};

String.prototype.padRigth = function (n,str){
    return this + Array(n-this.length+1).join(str||'0');
};

//Retorna um array com fatias do String com o tamanho (de cada fatia) informado
String.prototype.splitLength = function (n){
	var result = [],
		ini = 0,
		fin = n;
	while (true){
		if (fin != 0){
			result.push(this.slice(ini, fin));
		}
		else{
			result.push(this.slice(ini));
			break;
		}
		ini = fin;
		fin = ini + n;
		if (fin > this.length){
			fin = 0;
		}
		if (ini == this.length){
			break;
		}
	}
	return result;
};

Number.prototype.padLeft = function (n,str){
    return Array(n-String(this).length+1).join(str||'0')+this;
};

Number.prototype.format = function(c, d, t){
	var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "," : d, 
	    t = t == undefined ? "." : t, 
	    s = n < 0 ? "-" : "", 
	    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

Number.prototype.formatMoney = function(c, d, t, s){
	var n = this.format(c,d,t);
	    s = (s == undefined ? "R$": s) + " ";

    return s + n;
};

function nextCaptcha(obj) {
    var now = new Date();
    //var newSrc = 'jcaptcha.jsp?' + now.getTime() + '&height=50&width=200&fontSize=80';
    var newSrc = 'codigoValidacao.jpg?' + now.getTime();
    if (document.images) {
        document.images.captcha.src = newSrc;
    }
    obj.focus();
    obj.select();
}

function atualizarCaptcha(idImg, idText, path) {
    var now = new Date();
    var newSrc = 'codigoValidacao.jpg?' + now.getTime();
    if (path != undefined){
    	newSrc = path + newSrc;
    }
    
    $('#' + idImg).get(0).src = newSrc;
    
    var obj = $('#' + idText).get(0);
    obj.focus();
    obj.select();
}

function onlyNumber(e, obj){
	var thisVal = obj.val(); 
	var tempVal = "";
	keyCode = e.which ? e.which : (e.keyCode ? e.keyCode : 0);
	for(var i = 0; i<thisVal.length; i++){
		if(RegExp(/^[0-9]$/).test(thisVal.charAt(i))){ 
			tempVal += thisVal.charAt(i); 
	
			if(keyCode == 8){
				tempVal = thisVal.substr(0,i); 
			}						
		}
	}			
	obj.val(tempVal); // ao terminar, atribuo o valor validado ao valor do campo passado para testar
}

function validarDocumentoOrigem(codigo, valor){
	if ($.trim(valor) == ''){
		return true;
	}
	
	return true;
	
	if (codigo == '4'){ //DI
		if (valor.length != 10){
			return false;
		}
		//0123456789
		//AANNNNNNND
		var digitoInfo = valor.substr(9, 1);
		var digitoCalc = modulo11('2' + valor.substring(0, 9));
		if (digitoInfo != digitoCalc){
			return false;
		}
	}
	else if (codigo == '6'){ //DSI
		if (valor.length != 10){
			return false;
		}
		//0123456789
		//AANNNNNNND
		var digitoInfo = valor.substr(9, 1);
		var digitoCalc = modulo11('4' + valor.substring(0, 9));
		if (digitoInfo != digitoCalc){
			return false;
		}
	}
	return true;
}

function validarCPF(objeto){
	var fach = 1;
	var cdig;
	var cpf;
	if (objeto.val){
		cpf = objeto.val();
	}
	else{
		cpf = objeto.value;
	}
	
	cpf = limpaFormatacaoCPF(cpf);
	var pdig = cpf.substring(0,1);
	
	if (jsTrim(cpf) == '') {
		return true;
	}
	
	if (cpf.length != 11) {
		messageDialog('Validação do CPF', 'CPF inválido', 'alert', 300, setFocus, objeto);
		//objeto.focus();
		return false;
	}

	for(i = 1; i < cpf.length ;i++){
		cdig = cpf.substring(i,i+1);
		if(pdig == cdig ){ 
			fach=fach+1;
		}
	}
    
	if(fach == cpf.length){ 
		messageDialog('Validação do CPF', 'CPF inválido', 'alert', 300, setFocus, objeto);
		//objeto.focus();
		return false; 
	}

	x = 0;
	soma = 0;
	dig1 = 0;
	dig2 = 0;
	texto = "";
	cpf1="";
	len = cpf.length; x = len -1;
	// var cpf = "12345678909";
	for (var i=0; i <= len - 3; i++) {
		y = cpf.substring(i,i+1);
		soma = soma + ( y * x);
		x = x - 1;
		texto = texto + y;
	}
	dig1 = 11 - (soma % 11);
	if (dig1 == 10) dig1=0 ;
	if (dig1 == 11) dig1=0 ;
	cpf1 = cpf.substring(0,len - 2) + dig1 ;
	x = 11; soma=0;
	for (var i=0; i <= len - 2; i++) {
		soma = soma + (cpf1.substring(i,i+1) * x);
		x = x - 1;
	}
	dig2= 11 - (soma % 11);
	if (dig2 == 10) dig2=0;
	if (dig2 == 11) dig2=0;
	if ((dig1 + "" + dig2) == cpf.substring(len,len-2))
	{
		return true;
	}else{
		messageDialog('Validação do CPF', 'CPF inválido', 'alert', 300, setFocus, objeto);
		//objeto.focus();
		return false;
	}

}

function modulo11(str) {
   	soma=0;
   	ind=2;
   	for(pos=str.length-1;pos>-1;pos=pos-1) {
   		soma = soma + (parseInt(str.substring(pos, pos + 1)) * ind);
   		ind++;
   		if(ind>9) 
   			ind=2;
	}
   	var resto = soma % 11;
   	
   	if (resto < 2)
   		digito = 0;
   	else
   		digito = 11 - resto;
   	
   	return digito;
}

function modulo10(str) {
    var flag=2;
    str = str.substring(0,str.length - 1);
    var soma = 0;
    for (var i = str.length-1; i >= 0; i--)
    {
        var valor = str.substr(i, 1) * flag;
        if (valor > 9)
        {
        	soma = soma + parseInt(valor.toString().substr(0, 1)) + parseInt(valor.toString().substr(1));
        }
        else
        {
            soma = soma + valor;
        }
        if (flag == 2){
        	flag = 1;
        }
        else{
        	flag = 2;
        }
    }
    var digito = soma % 10;
    digito = 10 - digito;
    if (digito == 10)
    {
        digito = 0;
    }
    return digito;
}

function modulo(str) {
   	soma=0;
   	ind=2;
   	for(pos=str.length-1;pos>-1;pos=pos-1) {
   		soma = soma + (parseInt(str.substring(pos, pos + 1)) * ind);
   		ind++;
   		if(str.length>11) {
   			if(ind>9) ind=2;
   		}
	}
   	resto = soma - (Math.floor(soma / 11) * 11);
   	if(resto < 2) {
    	return 0;
   	}
   	else {
   		return 11 - resto;
   	}
}

function validarCNPJ(objeto, exibirMsg) {
	
	if (exibirMsg == undefined){
		exibirMsg = true;
	}
	
	var cnpj;
	if (objeto.val){
		cnpj = objeto.val();
	}
	else if (objeto.value){
		cnpj = objeto.value;
	}
	else{
		cnpj = objeto;
	}
	cnpj = removerMascara(cnpj);
	
	if (jsTrim(cnpj) == '')
		return true;
	
	if (cnpj.length != 14){
		if (exibirMsg){
			messageDialog('Validação do CNPJ', 'CNPJ inválido!', 'alert', 300, setFocus, objeto);
		}

		return false;
	}
	
	var valor = cnpj;
	primeiro=valor.substr(0,1);
	falso=true;
	size=valor.length;
	for (i=1; i<size; ++i){
		proximo=(valor.substr(i,1));
		if (primeiro!=proximo) {
			falso=false;
			break;
		}
	}
	
	if (falso){
		if (exibirMsg){
			messageDialog('Validação do CNPJ', 'CNPJ inválido', 'alert', 300, setFocus, objeto);
		}
		return false;
	}
	
	var dig1 = modulo(valor.substring(0, valor.length - 2)) + "";
	var dig2 = modulo(valor.substring(0, valor.length - 2) + "" + dig1) + "";
	
   	if ((dig1 + dig2) != valor.substring(valor.length - 2)) {
   		if (exibirMsg){
			messageDialog('Validação do CNPJ', 'CNPJ inválido', 'alert', 300, setFocus, objeto);
   		}
		return false;
   	}
   	return true;
}

/*
 * Remove todos os caracteres nao numericos
 */
function removerNaN(objeto){
	var resultado;
	if (objeto.val){
		resultado = objeto.val();
	}
	else if (objeto.value){
		resultado = objeto.value;
	}
	else{
		resultado = objeto;
	}

	m = resultado.match(/\d/g);
	if (m != null){
		return m.join('');
	}
	else{
		return resultado;
	}
}

function limpaFormatacaoCPF(objeto) {
	return removerNaN(objeto);
}

function limpaFormatacaoCNPJ(objeto) {
	return removerNaN(objeto);
}

/**=================================================================================
 * Retorna a data de hoje, no formato: DD/MM/YYYY
 * tags: today hoje data date atual current getdate gettoday
 * */	
function getDateToday(){
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth();
	var curr_year = d.getFullYear();
	
	return curr_date + "/" + (curr_month + 1) + "/" + curr_year;		
}	

function desabilitar(id){
	var obj = id;
	if (!id.val){
		obj = $('#' + id);
	}
	obj.prop('disabled', true);
	obj.addClass('desabilitado');
}

function habilitar(id){
	var obj = id;
	if (!id.val){
		obj = $('#' + id);
	}
	obj.prop('disabled', false);
	obj.removeClass('desabilitado');
}


function isNotUndefinedOrEmpty(valor){
	return (typeof(valor) !== 'undefined' && 
			((typeof(valor) == 'boolean' && valor !== '') ||
			 (typeof(valor) == 'string' && valor !== '') ||
			 (typeof(valor) == 'number' && valor !== 0)) ||
			 (typeof(valor) == 'object'));
}

function getElementsByClassName(obj, tag, classe){
	if (obj.getElementsByClassName){
		return obj.getElementsByClassName(classe);
	}
	else{
		var objs = [];
	    var elements = obj.getElementsByTagName(tag); // pega todos os os elements daquela tag
	    for(var i=0;i<=elements.length;i++) {
	    	if (elements[i] != undefined){
		        if(elements[i].className == classe) { // se tem uma class especifica (no seu caso centralizar), muda a propriedade width.
		            objs.push(elements[i]);            
		        }
	    	}
	    }
		return objs;
	}
}

function removerAcentos(strToReplace) {
	str_acento = "áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ";
	str_sem_acento = "aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC";
	var nova = "";
	for (var i = 0; i < strToReplace.length; i++) {
	    if (str_acento.indexOf(strToReplace.charAt(i)) != -1) {
	        nova += str_sem_acento.substr(str_acento.search(strToReplace.substr(i, 1)), 1);
	    } else {
	        nova += strToReplace.substr(i, 1);
	    }
	}
	return nova;
}

function validarDocumentoEletronico(objeto, tipo){
	var valor = '';
	
	if (objeto.val){
		valor = objeto.val();
	}
	else{
		valor = objeto.value;
	}
	
	var descTipo = (tipo == 'C'? 'da NFe': (tipo == 'E'? 'do CTe/CTe-OS': 'da NFe ou do CTe/CTe-OS'));
	var b = false;
	
	if (valor.length == 44){
		b = /[0-9]{44}?/.test(valor);
	}
	
	if (!b){
		messageDialog('GNRE', 'A chave ' + descTipo + ' deve ter 44 dígitos', 'alert', 300, setFocus, objeto);
		return false;
	}
	else{
		//Validar dígito verificador
		//Validando modelo do documento eletrônico
		var modelo = valor.substring(20, 22);
		
		if ((tipo == 'C' && modelo != '55') ||
				(tipo == 'E' && (modelo != '57' && modelo != '67')) ||
				(tipo == 'F' && (modelo != '55' && modelo != '57' && modelo != '67'))){
			messageDialog('GNRE', 'Modelo do documento eletrônico da chave ' + descTipo + ' é inválido!', 'alert', 300, setFocus, objeto);
			return false;
		}

		var chave = valor.substring(0, 43);
		var digito = valor.substring(43);
		
		if (modulo11(chave) != digito){
			messageDialog('GNRE', 'Dígito verificador da chave ' + descTipo + ' inválido!', 'alert', 300, setFocus, objeto);
			return false;
		}
		
		//Validando a UF da chave NFe/CTe/CTe-OS
		var codUf = valor.substring(0, 2);
		var ufs = ['11','12','13','14','15','16','17','21','22','23','24','25','26','27','28','29','31','32','33','35','41','42','43','50','51','52','53'];
		
		if (ufs.indexOf(codUf) == -1){
			messageDialog('GNRE', 'UF da chave ' + descTipo + ' informada é inválida!', 'alert', 300, setFocus, objeto);
			return false;
		}

		//Validando CNPJ do emitente da NFe/CTe/CTe-OS
		var cnpj = valor.substring(6, 20);
		if (!validarCNPJ(cnpj, false)){
			messageDialog('GNRE', 'CNPJ do emitente da chave ' + descTipo + ' informada é inválido!', 'alert', 300, setFocus, objeto);
			return false;
		}
	}

	return true;
}


function removerMascara(valor){
	return valor.replace(/\D/g, "");
}

function isEmptyObject(obj){
	return Object.keys(obj).length === 0 && obj.constructor === Object;
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function isObject(val) {
    if (val === null) { return false;}
    return ( (typeof val === 'function') || (typeof val === 'object') );
}

function reloadPage(){
	location.reload();
}
