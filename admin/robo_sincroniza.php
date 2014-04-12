<?php
include "includes/database.php";
include "includes/config.php";
include "includes/functions.php";
include "includes/noticias_rss.php";

$data = date("Y-m-d");
$hora = date("H:i:s");
$ip = $_SERVER["REMOTE_ADDR"];
?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		
		<script language="JavaScript">
			//window.parent.fecha_sin();
		</script>
		
	<?php
	$importar_desativados = request("importar_desativados");
	$areas = request("area");
	print_r($areas);
	
	function exclui_email($email,$nome,$vetor_email){
		//passa o e-mail e o arquivo XML como parametro, se o e-mail não existir no arquivo XML, exclui o e-mail e retorna true se não retorna false
		for ($i=0;$i<=count($vetor_email["dadosusuarionetcontabil"]["usuario"]);$i++){
			$user = utf8_decode($vetor_email["dadosusuarionetcontabil"]["usuario"][$i]["razaosocial"]);
			if (($vetor_email["dadosusuarionetcontabil"]["usuario"][$i]["email"]==$email)&&($user==$nome)) {
				return false;
			}
		}
		return true;
	} 
	
	function insere_email($email){
		//passa o e-mail como parametro se NÃO existir o e-mail então retorna true caso contrário retorna false
		$sql = "SELECT * FROM mailing where usr_email ='$email'";
		$PROVA = new query($DATABASE,$sql);
		$PROVA->NEXT();
		if ($PROVA->BYNAME('usr_email')!=""){
			return false;
		}else{
			return true;
		}
	}
	
	
	//faz o download do XML
	$DOWN = new HTTPRequest_(ENDERECO_XML."/netcontabil/net_xml.php?pass=".CHAVE_EXPORTACAO);
	$xml = $DOWN->DownloadToString();
	echo ENDERECO_XML."/netcontabil/net_xml.php?pass=".CHAVE_EXPORTACAO;
	$usuarios = xml2array($xml);
	//echo "<pre>";
	//print_r($usuarios);
	//echo "</pre>";
	$lista_excluidos = array();
	$lista_inseridos = array();
	$j=0;
	
	//exclui e-mail
	$sql = "SELECT * FROM mailing WHERE usr_flag_net_contabil='T'";
	$LISTA_EMAIL = new QUERY($DATABASE,$sql);
	while ($LISTA_EMAIL->NEXT()){
		if (exclui_email($LISTA_EMAIL->BYNAME("usr_email"),$LISTA_EMAIL->BYNAME('usr_nome'),$usuarios)){
			if ($importar_desativados!="1"){
				$sql = "UPDATE  mailing SET usr_status='N', usr_bounce='Cliente desativado no Net Contábil' WHERE usr_flag_net_contabil='T' and usr_id ='".$LISTA_EMAIL->BYNAME("usr_id")."'";
				$DELETA_MAILING = new QUERY($DATABASE,$sql);
				$DELETA_MAILING->FREE();
				//$sql = "DELETE  FROM area_mailing WHERE aru_flag_net_contabil='T' and aru_mailing_id = '".$LISTA_EMAIL->BYNAME("usr_id")."'";
				//$DELETA_AREA= new QUERY($DATABASE,$sql);
				//$DELETA_AREA->FREE();
				$lista_excluidos[$j] = $LISTA_EMAIL->BYNAME('usr_email');
				$j++;
			}	
		}
	}
	//ativar todo mundo que está desativado e que tinha como origem o Net Contábil
	if ($importar_desativados=="1"){
		$sql = "update mailing set usr_status='S' WHERE usr_status='N' and usr_flag_net_contabil='T'";		
		$ATUALIZA = new QUERY($DATABASE,$sql);
	}
	
	//inclui o e-mail
	$w = 0 ;//zera o w
	
	for ($i=0;$i<count($usuarios["dadosusuarionetcontabil"]["usuario"]);$i++){
			//as vezes pode ter o ; então tem que dar um explode para verificas as contas de e-mail
			$aux_email = explode(";",$usuarios["dadosusuarionetcontabil"]["usuario"][$i]["email"]);
			foreach($aux_email as $email){	
				if (insere_email($email)){
					$razaosocial = addslashes(utf8_decode($usuarios["dadosusuarionetcontabil"]["usuario"][$i]["razaosocial"]));
					//$email = explode(";",$usuarios["dadosusuarionetcontabil"]["usuario"][$i]["email"]);
					$sql = "INSERT INTO mailing (usr_nome,usr_email,usr_data_cad,usr_hora_cad,usr_ip_cad,usr_flag_net_contabil,usr_origem) VALUES ('$razaosocial','$email','$data','$hora','$ip','T','4')";
					$INSERE = new QUERY($DATABASE,$sql);
					$INSERE->FREE();
					$novo_usuario = mysql_insert_id();
					for ($j=0;$j<count($areas);$j++){
								$sql_areas = "INSERT INTO area_mailing (aru_mailing_id,aru_area_id,aru_flag_net_contabil) VALUES ('$novo_usuario','$areas[$j]','T')";
								//echo $sql_areas."<br/>";
								$AREA = new QUERY($DATABASE,$sql_areas);
								$AREA->FREE();
					}	
					$lista_inseridos[$w] = $email;
					$w++;	
					}
			}	
	}	
	
	//limpa Divs
	echo "
		<script language=\"JavaScript\">
		    window.parent.document.getElementById('tabela').style.display='block';
			window.parent.document.getElementById('contagem').innerHTML='';
			window.parent.document.getElementById('emails_inseridos').innerHTML='';
			window.parent.document.getElementById('excluidos').innerHTML='';
			window.parent.document.getElementById('emails_excluidos').innerHTML='';
		</script>
	";
	
	//mostra e-mails inseridos
	echo "
		<script language=\"JavaScript\">
			window.parent.conta('".count($lista_inseridos)."');
		</script>
	";
	
	for ($i=0;$i<count($lista_inseridos);$i++){
		echo "
		<script language=\"JavaScript\">
			window.parent.emails_inseridos('".$lista_inseridos[$i]."');
		</script>
		";
	}
	
	//mostra e-mails EXCLUIDOS
	
	echo "
		<script language=\"JavaScript\">
			window.parent.conta_excluidos('".count($lista_excluidos)."');
		</script>
	";
	
	for ($i=0;$i<count($lista_excluidos);$i++){
		echo "
		<script language=\"JavaScript\">
			window.parent.emails_excluidos('".$lista_excluidos[$i]."');
		</script>
		";
	}
	
	
	?>
		
	<?php
		
		
		//deletar enderecos que possuem o flag do net contábil
		//deletar enderecos que possuem o flag do net contábil
		/*
		$sql = "DELETE  FROM mailing WHERE usr_flag_net_contabil='T'";
		$DELETA_MAILING = new QUERY($DATABASE,$sql);
		$DELETA_MAILING->FREE();
		
		$sql = "DELETE  FROM area_mailing WHERE aru_flag_net_contabil='T'";
		$DELETA_AREA= new QUERY($DATABASE,$sql);
		$DELETA_AREA->FREE();
		
		
		//começa sincronização 
		//começa sincronização
		
		$areas = request("area"); 
		//echo "<script>alert('".ENDERECO_XML."')</script>";
		$DOWN = new HTTPRequest_(ENDERECO_XML."/netcontabil/net_xml.php?pass=".CHAVE_EXPORTACAO);
		$xml = $DOWN->DownloadToString();

		
		$usuarios = xml2array($xml);
		echo $usuarios[dadosusuarionetcontabil][usuario][razaosocial];		
		
		$conta =0;	
		for ($i=0;$i<=count($usuarios[dadosusuarionetcontabil][usuario]);$i++)	{
				//comeca inserir no Admin
				//conexão com o banco de dados No Net Contábil
				//conexão com o banco de dados No Net Contábil  
				$razaosocial = $usuarios[dadosusuarionetcontabil][usuario][$i][razaosocial];
				$email = $usuarios[dadosusuarionetcontabil][usuario][$i][email];

				if ($razaosocial=="") $razaosocial = $usuarios[dadosusuarionetcontabil][usuario][razaosocial];
				if ($email=="") $email = $usuarios[dadosusuarionetcontabil][usuario][email];
				
				$sql_verifica= "SELECT * FROM mailing WHERE usr_email='$email'";
				//echo $sql_verifica;
				
				$VER = new QUERY($DATABASE,$sql_verifica);
				if (($VER->NEXT()==false)&&($razaosocial!="")&&($email!="")){
						$sql = "INSERT INTO mailing (usr_nome,usr_email,usr_data_cad,usr_hora_cad,usr_ip_cad,usr_flag_net_contabil) VALUES ('$razaosocial','$email','$data','$hora','$ip','T')";
						$INSERE = new QUERY($DATABASE,$sql);
						$INSERE->FREE();
						$conta;
						$novo_usuario = mysql_insert_id();
						for ($j=0;$j<count($areas);$j++){
							$sql_areas = "INSERT INTO area_mailing (aru_mailing_id,aru_area_id,aru_flag_net_contabil) VALUES ('$novo_usuario','$area[$j]','T')";
							echo $sql_areas;
							$AREA = new QUERY($DATABASE,$sql_areas);
							$AREA->FREE();
						}	
							$VER->FREE();
						$conta++;	
						echo "
						<script language=\"JavaScript\">
							window.parent.conta('$conta');
						</script>
						";
				}
		}
		
		//fim sincronização 
		//fim sincronização		
		*/
	?>	
	</body>
</html>