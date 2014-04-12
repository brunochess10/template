function is_function( key ){
		return (key == 9) || (key == 8) || (key == 13) || ( key == 35 ) || ( key == 36 ) || ( key == 37 ) || ( key == 39 );
}


function findNextFormElement( obj ) {
	var form = obj.form;
	for( i = 0; i < form.elements.length; i++)
		if ( obj.id == form.elements[ i ].id )	break;
	
	for( y = i+1; y < form.elements.length; y++)
	  	if ( form.elements[ y ].id ) {
				return form.elements[ y ];
				break;
		} 	
}

function currency_keypress(e, obj, decimals ){
		if ( document.all ) {
				var tr = document.selection.createRange();
				var text = obj.value;
				if ( tr.text == text ) {
						obj.value = "";
				}
		}
		
		if ( !decimals ){
			decimals = 2;
		}



		if (obj.value.length < 18) {
				var key;
				if(window.event || !e.which){ // IE
						key = e.keyCode; // for IE, same as window.event.keyCode
				} else if(e) {// netscape
						key = e.which;
				} 	else {
						return true;
				}

				if( (key > 47) && (key < 58)  ){
						NumDig = obj.value;
   						TamDig = NumDig.length;
   						Contador = 0;
						if (TamDig > 1) {
								numer = "";
								for (i = TamDig; (i >= 0); i--){
          								if ((parseInt(NumDig.substr(i,1))>=0) && (parseInt(NumDig.substr(i, 1))<=9)) {
												Contador++;
             									if ((Contador == decimals) && ((TamDig -i) < decimals+1)) {
														numer = ","+numer;
														Contador = 0;
												} else if (Contador == 3) {
														if ( numer.indexOf(",") > 0 ){
															numer = "."+numer;
															Contador = 0;
														}
												}
             									numer = NumDig.substr(i, 1)+numer;
            							} //fecha if #3
           						} //fecha for
      							obj.value = numer;
      					}; //fecha if #2
						return true;
				}  else if ( is_function( key ) || ( key == 46 ) ) {
					return true;
				} else
					return false;
		}
}

function integer_keypress(e, ConteudoCampo){
				var key;
				if(window.event || !e.which){ // IE
						key = e.keyCode; // for IE, same as window.event.keyCode
				} else if(e) {// netscape
						key = e.which;
				} 	else {
						return true;
				}
				return (  (key > 47) && (key < 58)  ) || ( is_function( key ) );
}

function remove_left_zero(dado, lookup){
		NumDig = dado.value;
		numer = dado.value;

		pos = NumDig.indexOf(",");

		if( ( pos == -1 ) || ( pos > 1 ) ) {
				for (var i = 0; i < NumDig.length - 1; i = i + 1) {
						if (NumDig.charAt(i) == "0" ) {
								numer = NumDig.substring(i+1, NumDig.length);
						}  else {
			 					break;
	  					}
	  			}
   				dado.value = numer;
		}
		if ( lookup == 1 ) onlookup( dado );
}


function mask_format_telefone(formato, e, objeto){
		var key;
		if(window.event || !e.which){ // IE
				key = e.keyCode; // for IE, same as window.event.keyCode
		} else if(e) {// netscape
				key = e.which;
		} 	else {
				return true;
		}

		campo = eval (objeto);
		// TELEFONE
				separador = '-';
				conjunto1 = 4;
				if (campo.value.length == conjunto1){
						if ( separador != String.fromCharCode( key ) ) {
								campo.value = campo.value + separador;
						}
				}
}

function mask_format_data(e, obj){
	var keyPressed;
	var valida_key = true;
	if(window.event || !e.which){ // IE
			keyPressed = e.keyCode; // for IE, same as window.event.keyCode
	} else if(e) {// netscape
			keyPressed = e.which;
	} 	else {
			return true;
	}

	

	//keyPressed = event.keyCode;
	valida_key = (  ((keyPressed > 47) && (keyPressed < 58)) || (is_function( keyPressed ))  );
	if((obj.value.length == 2 || obj.value.length == 5) && (keyPressed != 8 || keyPressed !=37 || keyPressed != 39)) obj.value += "/";
	if(   ( obj.value.length == 9 ) && ((keyPressed > 47) && (keyPressed < 58))   ) {
		obj.value += String.fromCharCode( keyPressed );
		valida_key = false;
		Focus( findNextFormElement(obj) );
	}
	return valida_key;
}

function mask_format_cep(e, obj){
		var key;
		if(window.event || !e.which){ // IE
				key = e.keyCode; // for IE, same as window.event.keyCode
		} else if(e) {// netscape
				key = e.which;
		} 	else {
				return true;
		}
		
		valida_traco = ( (String.fromCharCode( key ) == "-") && (obj.value.length == 5) );
		valida_key = (  ((key > 47) && (key < 58)) || (is_function( key )) || (valida_traco) );
		if (obj.value.length == 5){
				if ( "-" != String.fromCharCode( key ) ) {
						obj.value += "-";
				}
		}
		
		if(   ( obj.value.length == 8 ) && ((key > 47) && (key < 58))   ) {
			obj.value += String.fromCharCode( key );
			valida_key = false;
			Focus( findNextFormElement(obj) );
		}
		
		return   valida_key;
}

function mask_format_cpf(e, obj){
		var key;
		if(window.event || !e.which){ // IE
				key = e.keyCode; // for IE, same as window.event.keyCode
		} else if(e) {// netscape
				key = e.which;
		} 	else {
				return true;
		}

		valida_traco = ( (String.fromCharCode( key ) == "-") && (obj.value.length == 11) );
		valida_ponto = ( (String.fromCharCode( key ) == ".") && ((obj.value.length == 3) || (obj.value.length == 7) ));
		valida_key = (  ((key > 47) && (key < 58)) || (is_function( key )) || (valida_traco) || (valida_ponto) );

		//pontos
		if(  (obj.value.length == 3) ||(obj.value.length == 7)  ) {
				if ( "." != String.fromCharCode( key ) ) {
						obj.value += ".";
				}
		}
		//traco
		if(  (obj.value.length == 11)  ) {
				if ( "-" != String.fromCharCode( key ) ) {
						obj.value += "-";
				}
		}

		if(   ( obj.value.length == 13 ) && ((key > 47) && (key < 58))   ) {
			obj.value += String.fromCharCode( key );
			valida_key = false;
			Focus( findNextFormElement(obj) );
		}
		return   valida_key;
}


function max_memo(max,memo) {
	var content = memo.value;
	if ( content.length >= max ) {
	        memo.value = content.substr(0,max);
			return false;
	}
}

