<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_area_new = "_area_nv";
		$sufix_area_old ="_area_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("are_titulo" . $sufix_area_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título", "document.formfields.titulo" . $sufix_area_new, "titulo" . $sufix_area_new  );
				}
				
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "area_newsletter", $key, $sufix_area_new, $sufix_area_old)) {
											$key = mysql_insert_id();
											do_redirect("robo_detalhe.php?$sid_get&mod=area_boletim&modulo_detail=area_boletim&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_servico", $key, $sufix_servico_new, $sufix_servico_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=area_boletim&modulo_detail=area_boletim&key=$key");
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