<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
#
# Projeto :  Lucato 
# Data : 20/02/2004
# 
# ROBO Detalhe
#

    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";
	
	
	
	$area = request("area");
	$emails = request("emails");
	
	if ($area==""){
		echo "<script>alert('Selecione pelo menos uma área')</script>";
		exit;
	}
	
	if ($emails==""){
		echo "<script>alert('Cadastre pelo menos um e-mail')</script>";
		exit;	
	}
	$data = date("Y-m-d");
	$hora = date("H:i:s");
	$ip = $_SERVER["REMOTE_ADDR"];
	
	
	$aux = explode("\n",$emails);
	$cont=0;
	foreach ($aux as $email){
		$email = trim($email);
		$email = str_replace(";","",$email);
		if (check_email_address($email)){
			$sql = "select * from mailing where usr_email='$email'";
			$CHECA = new QUERY($DATABASE,$sql);
			if (!$CHECA->NEXT()){
				$sql = "INSERT INTO mailing (usr_nome,usr_email,usr_data_cad,usr_hora_cad,usr_ip_cad,usr_bounce,usr_origem) VALUES ('$email','$email','$data','$hora','$ip','Importado: ferramenta de importação','2')";
				$MAILING = new QUERY($DATABASE, $sql);
				$novo_usuario = mysql_insert_id();
				
				for($a=0;$a<count($area);$a++) {
					$sql_areas = "INSERT INTO area_mailing (aru_id,aru_mailing_id,aru_area_id) VALUES ('','$novo_usuario','". $area[$a]. "')";
					$AREA = new QUERY($DATABASE, $sql_areas);
					unset( $AREA );
				}
				$cont++;	
			}	
		}
	}
?>
<script>
	window.parent.sucesso(<?php echo $cont ?>);
</script>
</body>
</html>