	
	var NetContabil
	
	function abre_login( form ) {
		window.document.form_login.target = "NetContabil";
		window.document.form_login.usuario.value = form.usuario.value;
		window.document.form_login.senha.value = form.senha.value;

		if(navigator.appName.indexOf("Netscape") != -1)
	   		NetContabil = window.open("", "NetContabil","toolbar=1,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=0,screenX=0,screenY=0,left=0,top=0,width=780,height=480");
		else
   			NetContabil = window.open("", "NetContabil","toolbar=1,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,screenX=0,screenY=0,left=0,top=0,width=780,height=480");

		if(NetContabil)
		{
			window.document.form_login.submit();
			form.reset();
		}

		return false;
	}
	
	function abre_esqueci(url) {

		if(navigator.appName.indexOf("Netscape") != -1)
	   		NetContabil = window.open(url, "NetContabil","toolbar=1,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=0,screenX=0,screenY=0,left=0,top=0,width=780,height=480");
		else
   			NetContabil = window.open(url, "NetContabil","toolbar=1,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,screenX=0,screenY=0,left=0,top=0,width=780,height=480");

		return false;
	}
	
	function existe_email(campo) {
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(campo.value)))
   					{
			return false;
		} else	return true;
	}
		
	function consiste(form){
		var div = document.getElementById("iframe_boletim_id");
		if( div ) div.innerHTML = "<iframe name=\"iframe_boletim\" style=\"display:none\" ></iframe>"; 
		
		var message = "";
		var nome = form.nome.value;
		if( nome.length <= 2 ){
			message += "O campo nome é de preenchimento obrigatório.\n";
		}
		
		if( !existe_email(  form.email ) ){
			message += "O email informado é inválido.\n";
		}
		
		var assinado = false;
		var checks = 0;
		
		for( i = 0; i < form.elements.length; i++){
			if ( form.elements[ i ].type == "checkbox"){
				checks++;
				if( form.elements[ i ].checked ) {
					assinado = true;
					break;
				}
			}
		}
		if ( checks == 0 ) assinado = true;
		
		if( !assinado  ){
			message += "Escolha uma área de seu interesse.\n"
		}	
		
		
		if( message != ""){
			message += "\n\r\nCorrija os erros e tente novamente."
			alert( message );
		} else {
			form.target = "iframe_boletim";
		}
		return ( message == "");
		
	}
	
	function reset_form_boletim(){
		document.boletim.reset();
		alert('Assinatura efetuada com sucesso. Obrigado!');
	}
	
	function consiste_contato(form){
		var div = document.getElementById("iframe_contato_id");
		if( div ) div.innerHTML = "<iframe name=\"iframe_contato\" style=\"display:none\" ></iframe>"; 
		

		var message = "";
		
		var empresa = form.empresa.value;
		if( empresa.length < 3){
			message += "O campo empresa é de preenchimento obrigatório.\n";
		}
		
		var contato = form.contato.value;
		if( contato.length < 3){
			message += "O campo contato é de preenchimento obrigatório.\n";
		}
		
		if( !existe_email(  form.email ) ){
			message += "O email informado é inválido.\n";
		}
		
		var assunto = form.assunto.value;
		if( assunto.length <3 ){
			message += "O campo assunto é de preenchimento obrigatório.\n";
		}
		
		var comentario = form.comentario.value;
		if( comentario.length < 3 ){
			message += "O campo comentário é de preenchimento obrigatório.\n";
		}

		if( message != ""){
			message += "\n\r\nCorrija os erros e tente novamente."
			alert( message );
		} else {
			
			form.target = "iframe_contato";
		}

		return ( message == "");
	}
	
	function reset_form_contato(){
		document.contato.reset();
		
	}
	
	function consiste_remove(form){
		var div = document.getElementById("iframe_remove_id");
		if( div ) div.innerHTML = "<iframe name=\"iframe_remove\" style=\"display:none\" ></iframe>"; 
		

		var message = "";
		
		if( !existe_email(  form.email ) ){
			message += "O email informado é inválido.\n";
		}
		
		
		if( message != ""){
			message += "\n\r\nCorrija os erros e tente novamente."
			alert( message );
		} else {
			form.target = "iframe_remove";
		}

		return ( message == "");
	}
	
	function reset_form_remove(){
		document.remove.reset();
	}
	
	function fechar(){
		var Div = document.getElementById("banner_flutuante");
		Div.style.display = "none";
	}		
	
	function loginnetcontabil(){
		$("#login_netcontabil").submit();
		$("#login_netcontabil")[0].reset();
	}

	function abre(){
				$('#alerta').dialog({
					modal: true,
					resizable:true,
					closeText:"Clique aqui para fechar",
					width:500,
					height:400
				});	
	}