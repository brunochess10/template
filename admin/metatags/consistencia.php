<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_meta_new = "_meta_nv";
		$sufix_meta_old ="_meta_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				
				$url = request("url_nome" . $sufix_meta_new );
				
				if ( $url == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o nome da página", "document.formfields.mail_assunto" . $sufix_boletins_new, "mail_assunto" . $sufix_boletins_new );
				}
				
				
				/*$titulo = request("title" . $sufix_meta_new );
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Por favor digite o título da página", "document.formfields.url" . $sufix_meta_new, "url" . $sufix_meta_new  );
				}
				
				
				$description = request("description" . $sufix_meta_new );
				if ( $description == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite a descrição da página", "document.formfields.description". $sufix_meta_new , "description" . $sufix_meta_new );
				}
				
				$keyword = request("keyword" . $sufix_meta_new );
				if ( $keyword == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite as palavras chaves", "document.formfields.description". $sufix_meta_new , "description" . $sufix_meta_new );
				}*/
			
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_metatags", $key, $sufix_meta_new, $sufix_meta_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=metatags&modulo_detail=metatags&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_metatags", $key, $sufix_meta_new, $sufix_meta_old)){
											//deleta todas as áreas do boletim e acrescenta novamente
											do_redirect("robo_detalhe.php?$sid_get&mod=metatags&modulo_detail=metatags&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
				 }
		}	 
?>
<script language="javascript">
	function LoadErrorsServidor(){
		<?php echo $ERRORS ?>
		ShowListErrors();
	}
</script>
<script type="text/javascript" src="<?php echo show($mod)?>/consistencia.js"></script>
<script type="text/javascript" src="scripts/mask_format.js"></script>