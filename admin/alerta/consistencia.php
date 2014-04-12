<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_alerta_new = "_alerta_nv";
		$sufix_alerta_old ="_alerta_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("TITULO" . $sufix_alerta_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título", "document.formfields.titulo" . $sufix_empresa_new, "titulo" . $sufix_empresa_new  );
				}
				
				$texto = request("TEXTO" . $sufix_alerta_new );
				if ( $texto == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o texto", "document.formfields.texto" . $sufix_empresa_new, "texto" . $sufix_empresa_new );
				}
				
				$publicar = request("PUBLICAR" . $sufix_alerta_new );
				if ( $publicar == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Selecione o campo publicar", "document.formfields.publicar". $sufix_empresa_new , "publicar" . $sufix_empresa_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_alerta", $key, $sufix_alerta_new, $sufix_alerta_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=alerta&modulo_detail=alerta&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_alerta", $key, $sufix_alerta_new, $sufix_alerta_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=alerta&modulo_detail=alerta&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
				 }
		}	 
?>
<script language="javascript">
	function LoadErrorsServidor(){
		<?php echo $ERRORS?>
		ShowListErrors();
	}
</script>
<script type="text/javascript" src="<?php echo show($mod)?>/consistencia.js"></script>
<script type="text/javascript" src="scripts/mask_format.js"></script>