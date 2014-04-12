	function consiste(form){
		ClearListErrors();
		var str = "";
		
		str = form.user.value;
		str1 = str.trim();
		if( str1.length <= 0 ){
			AddError( "Você não digitou o usuário.", form.user );
		}
		
		str = form.pass	.value;
		str1 = str.trim();
		if( str1.length <= 0 ){
			AddError("Você não digitou a senha.", form.pass );
		}
		return ShowListErrors();		
	}

	function CarregaBody(){
		LoadErrorsServidor();
		document.formlogin.user.focus();
	}
	
