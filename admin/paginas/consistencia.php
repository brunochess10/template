<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_paginas_new = "_paginas_nv";
		$sufix_paginas_old ="_paginas_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				
				$categoria = request("menu_pai" . $sufix_paginas_new );
				if ( $categoria == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Escolha uma categoria", "document.formfields.titulo" . $sufix_paginas_new, "menu_pai" . $sufix_paginas_new  );
				}
				
				$titulo_menu = request("titulo_menu" . $sufix_paginas_new );
				if ( $titulo_menu == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Preencha com o título do menu", "document.formfields.texto" . $sufix_paginas_new, "titulo_menu" . $sufix_paginas_new );
				}
				
				$titulo_pagina = request("titulo_pagina" . $sufix_paginas_new );
				if ( $titulo_pagina == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Preencha com o texto da página", "document.formfields.publicar". $sufix_paginas_new , "titulo_pagina" . $sufix_paginas_new );
				}
				
				$texto = request("texto" . $sufix_paginas_new );
				if ( $texto == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Preencha com o texto da página", "document.formfields.publicar". $sufix_paginas_new , "texto" . $sufix_paginas_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_paginas", $key, $sufix_paginas_new, $sufix_paginas_old)) {
											$key = mysql_insert_id();
											###################################################################
											# Inserir na página de Metatags
											###################################################################
											$sql = "INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('$key','$titulo_pagina')";
											$META = new QUERY($DATABASE,$sql);											
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=paginas&modulo_detail=paginas&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_paginas", $key, $sufix_paginas_new, $sufix_paginas_old)){
											###################################################################
											# Atualizar página de Metatags
											###################################################################
											$sql = "UPDATE site_metatags SET url_nome='$titulo_pagina' WHERE id_pagina='$key' ";
											$META = new QUERY($DATABASE,$sql);											
											do_redirect("robo_detalhe.php?$sid_get&mod=paginas&modulo_detail=paginas&key=$key");
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