<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_avisos_new = "_avisos_nv";
		$sufix_avisos_old ="_avisos_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("titulo" . $sufix_avisos_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título", "document.formfields.titulo" . $sufix_avisos_new, "titulo" . $sufix_avisos_new  );
				}
				
				$texto = request("texto" . $sufix_avisos_new );
				if ( $texto == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o texto", "document.formfields.texto" . $sufix_avisos_new, "texto" . $sufix_avisos_new );
				}
				
				$publicar = request("publicar" . $sufix_avisos_new );
				if ( $publicar == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Selecione o campo publicar", "document.formfields.publicar". $sufix_avisos_new , "publicar" . $sufix_avisos_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_aviso", $key, $sufix_avisos_new, $sufix_avisos_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=avisos&modulo_detail=avisos&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_aviso", $key, $sufix_avisos_new, $sufix_avisos_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=avisos&modulo_detail=avisos&key=$key");
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