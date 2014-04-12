	var style_blur = '#E6F9F8';
	var style_focus = '#d0e1e0';

	String.prototype.trim = function() {
    		var str = this.replace(/^\s*/, "");
    		str = str.replace(/\s*$/, "");
		return str;
	}


	function replace_str(inputString, fromString, toString) {
		var temp = inputString;
		if (fromString == "") {
			return inputString;
		}
		if (toString.indexOf(fromString) == -1) { // If the string being replaced is not a part of the replacement string (normal situation)
			while (temp.indexOf(fromString) != -1) {
				var toTheLeft = temp.substring(0, temp.indexOf(fromString));
				var toTheRight = temp.substring(temp.indexOf(fromString)+fromString.length, temp.length);
				temp = toTheLeft + toString + toTheRight;
      		}
   		} else { // String being replaced is part of replacement string (like "+" being replaced with "++") - prevent an infinite loop
      		var midStrings = new Array("~", "`", "_", "^", "#");
      		var midStringLen = 1;
      		var midString = "";
      		// Find a string that doesn't exist in the inputString to be used
      		// as an "inbetween" string
      		while (midString == "") {
         		for (var i=0; i < midStrings.length; i++) {
            		var tempMidString = "";
           			for (var j=0; j < midStringLen; j++) { tempMidString += midStrings[i]; }
           			if (fromString.indexOf(tempMidString) == -1) {
           				midString = tempMidString;
           				i = midStrings.length + 1;
           			}
       			}
      		} // Keep on going until we build an "inbetween" string that doesn't exist
      			// Now go through and do two replaces - first, replace the "fromString" with the "inbetween" string
      		while (temp.indexOf(fromString) != -1) {
         		var toTheLeft = temp.substring(0, temp.indexOf(fromString));
         		var toTheRight = temp.substring(temp.indexOf(fromString)+fromString.length, temp.length);
         		temp = toTheLeft + midString + toTheRight;
      		}
      		// Next, replace the "inbetween" string with the "toString"
      		while (temp.indexOf(midString) != -1) {
         		var toTheLeft = temp.substring(0, temp.indexOf(midString));
         		var toTheRight = temp.substring(temp.indexOf(midString)+midString.length, temp.length);
         		temp = toTheLeft + toString + toTheRight;
      		}
   		} // Ends the check to see if the string being replaced is part of the replacement string or not
   		return temp; // Send the updated string back to the user
	} // Ends the "replaceSubstring" function


	var div_active_id = "";
	function mostra_div( div_id ){
		var div = document.getElementById( div_id );
		if ( div ) {
				if ( div.id == div_active_id ) {
					div.style.display = "none";
					div_active_id = "";
				} else {
					div.style.display = "";
					div_active = document.getElementById(div_active_id);
					if( ( div_active ) ){
						div_active.style.display = "none";
					}
					div_active_id = div.id;
				}
		}
	}

	function mostrar( id, btn ) {
		var div = document.getElementById( id );
                            if ( div ) {
		if ( btn.value == "mostrar" ) {
			div.style.display = "";
			if ( btn ) {	btn.value ="esconder"; }
		} else if ( btn.value == "esconder" ) {
			div.style.display = "none";
			if ( btn ) { btn.value ="mostrar"; }
		}
                            }
	}

	function AutorizarMensagem( msg, url){
			var result = confirm( msg );
			if ( result ) {
				document.location = url;
			}
	}


	function Imprimir( frameToprint ){
		if(document.all){
			frameToprint.window.focus();
			frameToprint.window.print();
		} else {
			frameToprint.print();
		}
	}

	function existe_email(value) {
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)))
	   	{
    		return false;
	    }
		else
			return true;
	}

	function abre_janela(url,nome,str)
	{
		var win = window.open(url,nome,str+',status=no,toolbar=no,menubar=no,location=no,resizable=no');
	}

	function abre_sel_relatorio( url, height ){
			if ( !height ){
				height = 200;
			}
			var win = window.open(url,'sel_relatorio','status=no,toolbar=no,menubar=no,location=no,resizable=yes,scrollbars=yes,width=600,height='+ height);
	}

	function abre_relatorio( url ){
			var win = window.open(url,'relatorio','status=no,toolbar=yes,menubar=no,location=no,resizable=yes,scrollbars=yes');
	}


	// funções para manipulação de arrays
	function CreateArray () {
		this.length = -1;
	}

	function AddArray( array, value ){
		array.length++;
		array[ array.length ] = value;
		return array.length;
	}

	function CountArray( array ){
		return ( array.length );
	}

	function ClearArray( array ){
		array.length = -1;
	}

	//funções básicas para consistencia
	var list_erros = new CreateArray();


	function Focus( obj ){
		if ( (obj) && ( !obj.disabled ) ) {
			try {
				obj.focus();
			}
			catch(execption){
				alert('Desculpe, não posso enviar o foco para o campo pois ele está oculto.');
			}
		}
	}

	function FocusControl( index ){
		if ( list_erros[ index ][3] ) {
			var div = document.getElementById( list_erros[ index ][3] );
			if ( div ) {
					if ( div.style.display == "none" ) {
							mostra_div( list_erros[ index ][3] );
					}
			}
		}
		if ( list_erros[ index ][2] ) {
				var obj = document.getElementById( list_erros[ index ][2] );
				Focus( obj );
		} else {
				Focus( obj );
		}

	}

	function ClearListErrors(){
		ClearArray( list_erros );
	}

	function AddError( message, object, id, div ) {
		var index = AddArray(list_erros, "" );
		list_erros[ index ] = new CreateArray();
		AddArray(list_erros[ index ], message );
		AddArray(list_erros[ index ], object );
		AddArray(list_erros[ index ], id );
		AddArray(list_erros[ index ], div );
	}

	function ShowListErrors( msg ){
		var HTML = "";
		var TABLE_BEGIN        = "<fieldset class='errofild'><legend><img src='images/erro.gif'/></legend><table class='erro'>";
		var TABLE_END          = "</table></fieldset>";
		var TR_BEGIN           = "<tr>";
		var TR_END             = "</tr>";
		var TD_BEGIN           = "<td>";
		var TD_END             = "</td>";

		if( CountArray( list_erros ) > -1 ){
			HTML += TABLE_BEGIN;
		}

		for(i = 0; i <= CountArray( list_erros ); i++){
			HTML += TR_BEGIN;
			HTML += TD_BEGIN;
			HTML += "&nbsp;&nbsp;&nbsp;<b style='color:ff0000;'>•</b>&nbsp;" + list_erros[i][0] + "<a href='javascript:FocusControl(" + i +")' onclick='' ><b>&nbsp;&nbsp;&nbsp;CORRIGIR?</a></b>";
			HTML += TD_END;
			HTML += TR_END;

		}

		if( CountArray( list_erros ) > -1 ){
			HTML += TABLE_END;
		}

		if ( msg ){
			var divName = msg;
		} else {
			var divName = "message";
		}


		var result = ( CountArray( list_erros ) == -1 );
		var message = document.getElementById( divName );
		if( message ){
			message.innerHTML = HTML;
			if ( !result ) {
				message.style.display = "";
			}
		}
		return result;
	}



	function blob(memo,titulo)
	{
		var win = window.open("about:blank", "visualizar" ,"status=no,toolbar=no,menubar=no,location=no,resizable=yes");
		if ( win ) {
			win.document.write("<html><title>" + titulo + "</title><body style='margin:0 0 0 0px;padding:0 0 0 0px'><textarea style='border:solid 0px;font-family:arial;font-weight:bold;width:100%;height:100%' readonly>"  + memo.value +"</textarea></body></html>");
		}
	}


	function selected(cal, date) {
		if ( (cal.sel.readOnly == false)  )
			cal.sel.value = date; // just update the date in the input field.
		if (cal.dateClicked )
		    cal.callCloseHandler();
	}

	function closeHandler(cal) {
		cal.hide();                        // hide the calendar
		calendar = null;
	}

	function showCalendar(id) {
		var el = document.getElementById(id.name);
		if (calendar != null) {
		// we already have some calendar created
		calendar.hide();                 // so we hide it first.
		} else {
			// first-time call, create the calendar.
			var cal = new Calendar(false, null, selected, closeHandler);
			// uncomment the following line to hide the week numbers
			cal.loc = "geral";
			cal.weekNumbers = false;
	      	cal.showsTime = false;

		    cal.showsOtherMonths = true;

			calendar = cal;                  // remember it in the global var
			cal.setRange(1900, 2070);        // min/max year allowed.
			cal.create();
		}
		calendar.setDateFormat("%d/%m/%Y");    // set the specified date format
		calendar.parseDate(el.value);      // try to parse the text in field
		calendar.sel = el;                 // inform it what input field we use
		calendar.showAtElement(el);        // show the calendar below it

		return false;
	}

	function ativabtn( id ){
		var btn = document.getElementById( id );
		if ( btn ){
			btn.style.backgroundColor = "#f2f2f2";
		}
	}

	function  desativabtn( id ){
		var btn = document.getElementById( id );
		if ( btn ){
			btn.style.backgroundColor = "";
		}
	}

	function proc_cep(obj) {
		window.open(obj.urlpopup,'','width=400,height=180,scrollbars=yes');
	}
	function proc_log(obj) {
		window.open(obj.urlpopup,'','width=650,height=300,scrollbars=yes');
	}

	function entrada_campo(obj){
		obj2 = obj.parentElement.parentElement.children(0);
		obj2.style.backgroundColor = style_blur;
	}

	function saida_campo(obj){
		obj2 = obj.parentElement.parentElement.children(0);
		obj2.style.backgroundColor = style_focus;
	}
