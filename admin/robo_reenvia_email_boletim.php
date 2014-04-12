<?php
	
	include "includes/database.php";
	include "includes/config.php";
	include "includes/functions.php";
	include "includes/htmlMimeMail.php";
	
	function monta_email($arquivo){
		$aux = file($arquivo);
		for ($i=0;$i<count($aux);$i++){
			$aux_arq.=$aux[$i];
		}
		return $aux_arq;
	}
		
	##########################################################################
	# Variávels recuperadas
	##########################################################################	
	
	$email_teste = request("teste");
	$mail_id = request("mail_id");
	$email_enviar_id = request("email");
	$final=request("final");
	
	
	###########################################################################
	# Bloco Monta o Boletim
	###########################################################################
		$topo_boletim = monta_email("template_boletim/contato_topo.html");
		$bottom_boletim = monta_email("template_boletim/contato_bottom.html");
		$sql = "SELECT * FROM mail WHERE mail_id='$mail_id'";
		$CONTEUDO = new QUERY($DATABASE,$sql);
		$CONTEUDO->NEXT();
		$assunto=$CONTEUDO->BYNAME("mail_assunto");
		
		$corpo_boletim = $topo_boletim.$CONTEUDO->BYNAME("mail_corpo").$bottom_boletim;
		$corpo_boletim = str_replace("__IMAGEM_DO_TOPO__",TOPO_BOLETIM,$corpo_boletim);
		$corpo_boletim = str_replace("__COR__",COR_BOLETIM,$corpo_boletim);
		$corpo_boletim = str_replace("__TITULO_BOLETIM__",$CONTEUDO->BYNAME("mail_assunto"),$corpo_boletim);
		$corpo_boletim = str_replace("__DATA__",data_brasil($CONTEUDO->BYNAME("mail_data")),$corpo_boletim);

		$linha1 = NOME_FANTASIA . " © " . ANO_SITE . "-" . date("Y") . ". Todos os direitos reservados.";
	    $linha2 = ENDERECO . " - " . CIDADE . " - " . ESTADO . " - " . CEP;
    	$linha3 = "Tel.:". TEL;
	    
		$corpo_boletim = str_replace("__BOTTOM_LINHA1__", "$linha1", $corpo_boletim);
    	$corpo_boletim = str_replace("__BOTTOM_LINHA2__", "$linha2", $corpo_boletim);
		$corpo_boletim = str_replace("__BOTTOM_LINHA3__", "$linha3", $corpo_boletim);
	
	if ($email_teste!=""){
		
		###########################################################################
		# Enviar email teste
		###########################################################################
		
		$mail = new htmlMimeMail();
		set_params_smtp($mail);
		$mail->setCharSet(CHARSET);
		$mail->setHtml($corpo_boletim, $corpo_boletim);
		$mail->setReturnPath(EMAIL_FROM);
		$mail->setFrom("\"" . NOME_FANTASIA . "\"  <" .  EMAIL_FROM . ">" );
		$mail->setSubject($assunto);
		$mail->setHeader("X-Mailer", "Newsletter - Powered by NeoSolutions (http://www.neosolutions.com.br)");
		$email[0]=$email_teste;
		
		$result = $mail->send($email, EMAIL_METHOD );
		
		if ($result){
			echo "OK";
		}else{
			echo "ERRO";
		}
		
	}else{
		###########################################################################
		# Enviar e-mail normal
		###########################################################################	
		
		###########################################################################
		# Atualiza tabela mail
		###########################################################################
		$sql = "SELECT * FROM mail WHERE mail_id = '$mail_id'";
		$MAIL = new QUERY($DATABASE,$sql);
		$MAIL->NEXT();
		/*if ($MAIL->BYNAME("mail_status")=="0"){
			$sql = "UPDATE mail SET mail_status ='1' WHERE mail_id='$mail_id'";
			$MAIL_UPDATE = new QUERY($DATABASE,$sql);
		}*/
		
		###########################################################################
		# Ve qual é o ID do e-mail
		###########################################################################	
		$sql = "SELECT R.*, M.usr_email,M.usr_id FROM reenvio_mail R INNER JOIN mailing M ON(R.mailing_id=M.usr_id) WHERE R.mail_id='$mail_id' ORDER BY M.usr_id LIMIT $email_enviar_id,1";
		$MAILING = new QUERY($DATABASE,$sql);
		$MAILING->NEXT();
		$id_mailing = $MAILING->BYNAME("usr_id");
		
		###########################################################################
		# Enviar o email
		###########################################################################	
		
		$mail = new htmlMimeMail();
		set_params_smtp($mail);
		$mail->setCharSet(CHARSET);
		$mail->setHtml($corpo_boletim, $corpo_boletim);
		$mail->setReturnPath(EMAIL_FROM);
		$mail->setFrom("\"" . NOME_FANTASIA . "\"  <" .  EMAIL_FROM . ">" );
		$mail->setSubject($assunto);
		$mail->setHeader("X-Mailer", "Newsletter - Powered by NeoSolutions (http://www.neosolutions.com.br)");
		
		unset($email);
		$email[0]=$MAILING->BYNAME("usr_email");
		
		$result = $mail->send($email, EMAIL_METHOD );
		
		if ($result){
			$status="1";	
			$msg_erro = "";
		}else{
			$status="2";
			foreach($mail->errors as $erro){
				$msg_erro.=$erro."<br/>";
			}
		}
		
		###########################################################################
		# Atualizar dados no LOG
		###########################################################################	
		$sql="UPDATE log_mail SET status ='$status', msg_erro = '$msg_erro' WHERE mail_id ='$mail_id' AND mailing_id ='$id_mailing'";
		$LOG = new QUERY($DATABASE,$sql);
		
		###########################################################################
		# Atualizar dados na tabela de reenvio de e-mail
		###########################################################################	
		$sql="UPDATE reenvio_mail SET reenviado ='1' WHERE mail_id ='$mail_id' AND mailing_id ='$id_mailing'";
		$LOG = new QUERY($DATABASE,$sql);
		
		
	}
?>