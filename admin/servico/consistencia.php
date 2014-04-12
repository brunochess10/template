<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_servico_new = "_servico_nv";
		$sufix_servico_old ="_servico_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("titulo" . $sufix_servico_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título", "document.formfields.titulo" . $sufix_servico_new, "titulo" . $sufix_servico_new  );
				}
				
				$texto = request("texto" . $sufix_servico_new );
				if ( $texto == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o texto", "document.formfields.texto" . $sufix_servico_new, "texto" . $sufix_servico_new );
				}
				
				$publicar = request("publicar" . $sufix_servico_new );
				if ( $publicar == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Selecione o campo publicar", "document.formfields.publicar". $sufix_servico_new , "publicar" . $sufix_servico_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_servico", $key, $sufix_servico_new, $sufix_servico_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=servico&modulo_detail=servico&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_servico", $key, $sufix_servico_new, $sufix_servico_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=servico&modulo_detail=servico&key=$key");
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