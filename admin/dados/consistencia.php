<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_dados_new = "_dados_nv";
		$sufix_dados_old ="_dados_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$titulo = request("titulo_site" . $sufix_dados_new );
				
				if ( $titulo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha um título para o web site", "document.formfields.titulo_site" . $sufix_dados_new, "titulo" . $sufix_dados_new  );
				}
				
				$nome_empresa = request("nome_fantasia" . $sufix_dados_new );
				if ( $nome_empresa == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o nome da empresa", "document.formfields.nome_fantasia" . $sufix_dados_new, "texto" . $sufix_dados_new );
				}
				
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_dados", $key, $sufix_dados_new, $sufix_dados_old)) {
											$key = mysql_insert_id();
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=dados&modulo_detail=dados&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_dados", $key, $sufix_dados_new, $sufix_dados_old)){
											do_redirect("robo_detalhe.php?$sid_get&mod=dados&modulo_detail=dados&key=$key");
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