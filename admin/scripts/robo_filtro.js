	function consiste(form){
		ClearListErrors();
		var str = "";
		
		str = form.email.value;
		if ( form.enviar.value == "1" ) {
			if( !existe_email( str )  ){
				AddError( "Email inválido. Preencha o campo e tente novamente.", form.email );
			}
		}
		return ShowListErrors();		
	}

	function enviar_email() {
			document.formfields.enviar.value = "1";
			if( consiste( document.formfields ) ){
				document.formfields.submit();
			}
			document.formfields.enviar.value = "0";

	}

	
