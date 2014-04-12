<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_midias_new = "_midias_sociais_nv";
		$sufix_midias_old ="_midias_sociais_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				/*
				Colocar alguma consistência caso necessário
				*/
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_midias", $key, $sufix_midias_new, $sufix_midias_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=midias_sociais&modulo_detail=midias_sociais&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_midias", $key, $sufix_midias_new, $sufix_midias_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=midias_sociais&modulo_detail=midias_sociais&key=$key");
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