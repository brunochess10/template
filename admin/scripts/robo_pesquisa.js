	function CarregaBody(){
		window.document.formpesquisa.query.focus();
	}

	function order( field ) {
		window.document.formpesquisa.order.value = field;
		window.document.formpesquisa.submit();
	}
	
	function consiste(form){
		ClearListErrors();
		var str = "";
		/*
		str = form.query.value;
		str1 = str.trim();
		if( str1.length <= 0 ){
			AddError( "Digite uma palavra para ser pesquisada.", form.query );
		}
		*/
		var result = ShowListErrors();
		if ( result ) {
			var wait = document.getElementById("wait");
			if ( wait ) {
					wait.style.visibility = "visible";
			}
		}
		return result; 		
	}
