	function consiste(form){
		ClearListErrors();
		var str = "";

		str = form.usuario.value;
		str1 = str.trim();
		if( str1.length <= 0 ){
			AddError( "Você não digitou o usuário.", form.usuario );
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

