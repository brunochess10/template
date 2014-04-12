<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_fontes_new = "_fontes_nv";
		$sufix_fontes_old ="_fontes_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				/*
				Colocar alguma consistência caso necessário
				*/
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_fontes_boletins", $key, $sufix_fontes_new, $sufix_fontes_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=fontes&modulo_detail=fontes&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_fontes_boletins", $key, $sufix_fontes_new, $sufix_fontes_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=fontes&modulo_detail=fontes&key=$key");
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