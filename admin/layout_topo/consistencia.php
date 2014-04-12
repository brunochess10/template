<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_layout_new = "_layout_nv";
		$sufix_layout_old ="_layout_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				//$imagem = request("imagem" . $sufix_layout_new );
				
				//if ( $imagem == "" ) {
						//$ERRORS .= LoadErrorsServidor_add("Por favor escolha uma imagem", "document.formfields.titulo" . $sufix_layout_new, "titulo" . $sufix_layout_new  );
				//}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_layout_topo", $key, $sufix_layout_new, $sufix_layout_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=layout_topo&modulo_detail=layout_topo&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_layout_topo", $key, $sufix_layout_new, $sufix_layout_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=layout_topo&modulo_detail=layout_topo&key=$key");
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