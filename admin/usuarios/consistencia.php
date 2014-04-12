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
				$nome = request("usr_nome" . $sufix_usuario_new );
				
				if ( $nome == "" ) {
					$ERRORS .= LoadErrorsServidor_add("Escolha um nome para o Usuário", "document.formfields.usr_nome" . $sufix_usuario_new, "usr_nome" . $sufix_usuario_new  );
				}
				
				$email = request("usr_email" . $sufix_usuario_new );
				if ( $email == "" ) {
					$ERRORS .= LoadErrorsServidor_add("Digite o e-mail", "document.formfields.usr_email" . $sufix_usuario_new, "usr_email" . $sufix_usuario_new );
				}
				
				if ($action=="insert"){
						$sql = "SELECT * FROM mailing where usr_email='$email'";
						$VERIFICA_EMAIL = new QUERY($DATABASE,$sql);
						if ($VERIFICA_EMAIL->NEXT()){
							$ERRORS .= LoadErrorsServidor_add("Esse e-mail já existe em nossa base de dados", "document.formfields.usr_email" . $sufix_usuario_new, "usr_email" . $sufix_usuario_new  );	
						}
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "mailing", $key, $sufix_usuario_new, $sufix_usuario_old)) {
											$key = mysql_insert_id();
											//origem cadastro
											$sql = "UPDATE mailing SET usr_origem='3' WHERE usr_id='$key'";
											$ORIGEM = new QUERY($DATABASE,$sql);
											//cadastrar nas áreas dos boletins
											$areas_usuario = request("areas");
											for ($i=0;$i<count($areas_usuario);$i++){
												 $sql = "INSERT INTO area_mailing (aru_mailing_id, aru_area_id) VALUES ('".$key."','".$areas_usuario[$i]."') ";	
												 $INSERE_AREA_MAILING = new QUERY($DATABASE,$sql);
												 $INSERE_AREA_MAILING->FREE();
											}
											do_redirect("robo_detalhe.php?$sid_get&mod=usuarios&modulo_detail=usuarios&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "mailing", $key, $sufix_usuario_new, $sufix_usuario_old)){
											//primeiro deleta todas as áreas que estavam marcadas e depois insere novament
											$sql = "DELETE FROM area_mailing where aru_mailing_id ='$key'";
											$DEL = new QUERY($DATABASE,$sql);
											$areas_usuario = request("areas");
											for ($i=0;$i<count($areas_usuario);$i++){
												 $sql = "INSERT INTO area_mailing (aru_mailing_id, aru_area_id) VALUES ('".$key."','".$areas_usuario[$i]."') ";	
												 $INSERE_AREA_MAILING = new QUERY($DATABASE,$sql);
												 $INSERE_AREA_MAILING->FREE();
											}
											do_redirect("robo_detalhe.php?$sid_get&mod=usuarios&modulo_detail=usuarios&key=$key");
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