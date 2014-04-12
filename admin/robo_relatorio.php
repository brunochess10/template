<?
#
# Projeto :  Lucato 
# Data : 16/04/2004
# 
# RElatório de Autor e seus processos
#
    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";
	
	
	//--------------------------------------------------------
	//SOURCE
	//--------------------------------------------------------
	//include "includes/ibase_empresa.php";
	
$report_all = "
	
<html>
<head>
<title></title>
<style>

table{
margin:10px;
}

.tt{
width:90%;
border-collapse:collapse;
font-family:verdana;
}

.tt td{
border:double 3px #000000;
background-color:#408080;
color:#ffffff;
font-size:11px;
font-weight:bold;
}

.relatorio{
width:90%;
border-collapse:collapse;
font-family:verdana;
font-size:10px;
}
.relatorio th{
text-align:left;
border:solid 1px #000000;
}
.relatorio td{
text-align:left;
border:solid 1px #000000;
}
</style>
</head>
<body>
<center>
";

	$mod = request("mod");
	include $mod . "/report.php";
	
$report_all .= "
</center>
</body>
</html>
"; 


$enviar = request("enviar");
if ( $enviar == "1" ) {
	//enviar por email
    include "includes/htmlMimeMail.php";
	
	
		//seta variaveis
		//----------------------------------------
		$user_email =  request_session("USER_EMAIL");
		$user_nome = request_session("USER_NOME");	
		$assunto = $modules[$mod]["report_titulo"];

		//enviar email para CLIENTE
		//--------------------------------------------------------------
		$html = $report_all;
		$texto = $html;
		$texto = preg_replace('/<(script|style)[^>]*>.+<\/(script|style)[^>]*>/is', '', $texto);
		$texto = strip_tags($texto,"<br></br>");
		$texto = preg_replace('/<(br|br\/)[^>]*>/is','\n\r',$texto);
		
        $mail = new htmlMimeMail();
   		$mail->setHtml($html, $texto);
		$mail->setReturnPath($user_email);
		$mail->setFrom("\"$user_nome\"  <$user_email>");
		$mail->setSubject( $assunto . " enviador por [".  request_session("EMP_NOME") . "]" );
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		$sendmail = $mail->send(array($_POST["email"]), 'mail');


		if( $sendmail ) {
				echo "<html><body > Email enviado com sucesso!</body></html>";
				exit;
		} else {
				echo "<html><body> Não foi possível enviar o email!</body></html>";
				exit;
		}
	
} else {
	// mostrar relatóro para impressão
	echo $report_all;
}
?>

