<?php
#
# Projeto :  Lucato 
# Data : 29/01/2004
# 
# Session padrao
#

/************************
CÓDIGO
*************************/
	
	$net_id = request("net_id");
	session_name("net_id");
	session_id($net_id);
	$sid_get = "net_id=$net_id";
	$sid_post = "<input type=\"hidden\" name=\"net_id\" value=\"" . show($net_id) . "\">";
	
   	session_start();
   	$permission = request_session("USER");

	// calcula a expiração da session
	//=====================
	$agora = time();
	//$expire_session = $agora -  request_session("last_access" ); //|| ($expire_session > 14400)
	set_session("last_access",$agora );

	if( ( !$permission )  ){
		$sid_get = "";
		$sid_post = "";
		$apelido = request_session("EMP_APELIDO");
		if ( empty($apelido) ){ $apelido = request("apelido"); }
   			session_unset();
   			session_destroy();
			do_redirect("session_expired.php?apelido=". $apelido);
			//se o tempo for maior que 20(1200 segundos )  minutos expirar sessão.
		}

?>
