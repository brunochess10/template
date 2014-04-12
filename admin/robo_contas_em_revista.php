<?php
	include "includes/database.php";
	include "includes/config.php";
	include "includes/functions.php";
	include "includes/httprequest_.php";
	
  
  
	$sql="SELECT * FROM site_fontes_boletins";
	$FONTE = new QUERY($DATABASE,$sql);
	$FONTE->NEXT();
	
	if ($FONTE->BYNAME("CONTAS_EM_REVISTA")=="S"){	
		//verificar se pode atualizar o contas em revista no web site
		//fazer consulta
		//$noticias = file_get_contents(HTTP_CONTEUDOCONTABIL."/contasemrevista/lista_noticias.php");
		$httprequest_noticia = new httprequest_();
    $httprequest_noticia->set_httprequest_(HTTP_CONTEUDOCONTABIL."/contasemrevista/lista_noticias.php");
    $noticias = $httprequest_noticia->DownloadToString();
		
		$noticias = json_decode($noticias);
  	$data = date("Y-m-d");
		for ($i=0;$i<count($noticias);$i++){
			$titulo = utf8_decode($noticias[$i]->titulo);
			$noticia = utf8_decode($noticias[$i]->texto);
			
			//Se não existir a notícia cadastrada insere no banco de dados
			//Se não existir a notícia cadastrada insere no banco de dados
			
			$sql = "SELECT * FROM mail WHERE mail_assunto='$titulo'";
			$VER = new QUERY($DATABASE,$sql);
			
			if (!$VER->NEXT()){
				$sql = "INSERT into mail (mail_data,mail_assunto,mail_corpo,mail_status) VALUES ('$data','$titulo','$noticia','0')";
				$INSERE = new QUERY($DATABASE,$sql);
				$INSERE->FREE();
			}	
		}
		echo "[ok]";
	}	
?>