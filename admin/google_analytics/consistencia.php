<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_google_new = "_google_nv";
		$sufix_google_old ="_foofle_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				
				$ERRORS ="";
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_google_analytics", $key, $sufix_google_new, $sufix_google_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=google_analytics&modulo_detail=google_analytics&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_google_analytics", $key, $sufix_google_new, $sufix_google_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=google_analytics&modulo_detail=google_analytics&key=$key");
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