	function consiste(form){
		ClearListErrors();
		var str = "";

		str = form.usuario.value;
		str1 = str.trim();
		if( str1.length <= 0 ){
			AddError( "Voc� n�o digitou o usu�rio.", form.usuario );
		}

		return ShowListErrors();
	}

	function CarregaBody(){
		LoadErrorsServidor();

		var value = document.formlogin.apelido.value;
		if ( value != "" ) {
			document.formlogin.usuario.focus();
		} else {
			document.formlogin.apelido.focus();
		}
	}

