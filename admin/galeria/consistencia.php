<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_galeria_new = "_galeria_nv";
		$sufix_galeria_old ="_galeria_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("TITULO" . $sufix_galeria_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título para foto", "document.formfields.TITULO" . $sufix_galeria_new, "TITULO" . $sufix_galeria_new  );
				}
				
				$arquivo = request("ARQUIVO" . $sufix_galeria_new );
			
				if ( $arquivo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha uma foto", "document.formfields.ARQUIVO" . $sufix_galeria_new, "ARQUIVO" . $sufix_galeria_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_galeria", $key, $sufix_galeria_new, $sufix_galeria_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=galeria&modulo_detail=galeria&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_galeria", $key, $sufix_galeria_new, $sufix_galeria_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=galeria&modulo_detail=galeria&key=$key");
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