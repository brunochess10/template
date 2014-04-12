<?
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_usuario_new = "_usuario_nv";
		$sufix_usuario_old ="_usuario_ov";

		
		$action = request("action");
		$ERRORS = "";
		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$nome = request("usuario" . $sufix_usuario_new );
				$confirmar_senha = request("confirmar_senha");
				
				if ( $nome == "" ) {
					$ERRORS .= LoadErrorsServidor_add("Escolha um nome para o Usuário", "document.formfields.usuario" . $sufix_usuario_new, "usuario" . $sufix_usuario_new  );
				}
				
				$senha = request("senha" . $sufix_usuario_new );
				if ( $senha == "" ) {
					$ERRORS .= LoadErrorsServidor_add("Digite a Senha", "document.formfields.senha" . $sufix_usuario_new, "senha" . $sufix_usuario_new );
				}
				
				if ( $senha != $confirmar_senha ) {
					$ERRORS .= LoadErrorsServidor_add("A senha não confere com a confirmação da senha", "document.formfields.senha" . $sufix_usuario_new, "senha" . $sufix_usuario_new );
				}
				
				//verifica se já existe um usuário com o mesmo nome
				if ($action=="insert"){
					$sql = "select * from site_usuario where usuario='$nome'";
					$VERIFICA = new QUERY($DATABASE,$sql);
					if ($VERIFICA->NEXT()){
						$ERRORS .= LoadErrorsServidor_add("Atenção já existe um usuário com o mesmo nome", "document.formfields.senha" . $sufix_usuario_new, "senha" . $sufix_usuario_new );
					}
				}
				
				
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "site_usuario", $key, $sufix_usuario_new, $sufix_usuario_old)) {
											$key = mysql_insert_id();
											//cadastrar nas áreas dos boletins
											do_redirect("robo_detalhe.php?$sid_get&mod=admin_usuarios&modulo_detail=admin_usuarios&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "site_usuario", $key, $sufix_usuario_new, $sufix_usuario_old)){
											//primeiro deleta todas as áreas que estavam marcadas e depois insere novament
											do_redirect("robo_detalhe.php?$sid_get&mod=admin_usuarios&modulo_detail=admin_usuarios&key=$key");
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