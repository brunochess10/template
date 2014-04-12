<?php
		//--------------------------------------------------------
		//VARIAVEIS
		//--------------------------------------------------------
		$sufix_boletins_new = "_boletins_nv";
		$sufix_boletins_old ="_boletins_ov";

		$action = request("action");
		$ERRORS = "";

		
		if( ( $action == "edit") || ($action == "insert") ){
				$key = request("key");	
				$date = request("mail_data" . $sufix_boletins_new );
				
				$area = request("areas");
				$uniao = request("mail_uniao".$sufix_boletins_new);
				
				if (($area=="")&&($uniao!="")){
					$ERRORS .= LoadErrorsServidor_add("Você não pode gravar sem selecionar pelo menos uma área", "document.formfields.area" . $sufix_boletins_new, "mail_data" . $sufix_boletins_new  );
				}
				
				if ( $date == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Selecione uma data para o Boletim", "document.formfields.mail_data" . $sufix_boletins_new, "mail_data" . $sufix_boletins_new  );
				}
				
				$assunto = request("mail_assunto" . $sufix_boletins_new );
				if ( $assunto == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o assunto do Boletim", "document.formfields.mail_assunto" . $sufix_boletins_new, "mail_assunto" . $sufix_boletins_new );
				}
				
				$corpo = request("mail_corpo" . $sufix_boletins_new );
				if ( $corpo == "" ) {
						$ERRORS .= LoadErrorsServidor_add("Digite o corpo do boletim", "document.formfields.mail_corpo". $sufix_boletins_new , "mail_corpo" . $sufix_boletins_new );
				}
				
				if( $ERRORS == "" ){
							if ($action=="insert"){
									if (save_form($action,$mod, "mail", $key, $sufix_boletins_new, $sufix_boletins_old)) {
											$key = mysql_insert_id();
											$areas_boletim = request("areas");
											$area_consulta="";
											foreach($areas_boletim as $areas_string){
												$area_consulta.=$areas_string.",";
											}
                      
											$area_consulta_aux="";
											for($i=0;$i<strlen($area_consulta)-1;$i++){
												$area_consulta_aux.=$area_consulta[$i];
											}
                      
											for ($i=0;$i<count($areas_boletim);$i++){
												$sql = "INSERT INTO area_mail (arm_mail_id,arm_area_id) VALUES('".$key."','".$areas_boletim[$i]."')";
												$INSERE = new QUERY($DATABASE,$sql);
											}
											
										    #####################################
											# Inserir todos os e-mails na tabela log_mail
											# Depois o status de cada e-mail será gravado
											#####################################
											$uniao = request("mail_uniao" . $sufix_boletins_new );
											if ($uniao=="T"){
												$sql_users_enviar ="
												SELECT M.usr_id,M.usr_nome,M.usr_email,A.aru_mailing_id, COUNT(A.aru_mailing_id) AS TOT FROM area_mailing A 
												INNER JOIN mailing M ON(M.usr_id=A.aru_mailing_id) WHERE A.aru_area_id IN($area_consulta_aux) and (M.usr_status<>'N' OR M.usr_status IS NULL)
												GROUP BY A.aru_mailing_id HAVING (TOT>=2) ORDER BY M.usr_id ASC
												";		
											}else{
												$sql_users_enviar="
												SELECT distinct M.usr_id,M.usr_nome, M.usr_email 
												FROM mailing M LEFT JOIN area_mailing am ON (am.aru_mailing_id = M.usr_id)
												WHERE am.aru_area_id IN ($area_consulta_aux) AND ((M.usr_status<>'N') OR (M.usr_status IS NULL))  ORDER BY M.usr_id ASC;
												";
											}
											$LOG = new QUERY($DATABASE, $sql_users_enviar);
											while ($LOG->NEXT()){
												$sql = "INSERT INTO log_mail (mail_id,mailing_id,status) VALUES ('$key','".$LOG->BYNAME("usr_id")."','0')";
												$LOG_MAILING = new QUERY($DATABASE,$sql);
											}

											
											//$javascript = " window.opener.document.location = 'robo_detalhe.php?$sid_get&mod=cliente&modulo_detail=cliente_ticket&key=$id_cliente'; window.close();";
											do_redirect("robo_detalhe.php?$sid_get&mod=boletins&modulo_detail=boletins&key=$key");
									}else{
											echo "ERRRRRRRROOOOORRRRR";
									}
							}
							if ($action=="edit"){
									if (save_form($action,$mod, "mail", $key, $sufix_boletins_new, $sufix_boletins_old)){
											//deleta todas as áreas do boletim e acrescenta novamente
											$sql = "DELETE FROM area_mail WHERE arm_mail_id ='$key'";
											$LIMPA = new QUERY($DATABASE,$sql);
											$areas_boletim = request("areas");
											for ($i=0;$i<count($areas_boletim);$i++){
												$sql = "INSERT INTO area_mail (arm_mail_id,arm_area_id) VALUES('".$key."','".$areas_boletim[$i]."')";
												$INSERE = new QUERY($DATABASE,$sql);
											}
											//verifica se o status do Boletim é 0 se for deleta os e-mails no Log de disparo de e-mails e insere novamente
											$sql = "SELECT * FROM mail where mail_id ='$key'";
											$VERIFICAR = new QUERY($DATABASE,$sql);
											$VERIFICAR->NEXT();
											
											if ($VERIFICAR->BYNAME('mail_status')=="0"){
											
												//limpa o Log e insere todo mundo novamente na listagem
												$sql = "DELETE FROM log_mail WHERE mail_id = '$key'";
												$LIMPA = new QUERY($DATABASE,$sql);
												
												$areas_boletim = request("areas");
												$area_consulta="";
												foreach($areas_boletim as $areas_string){
													$area_consulta.=$areas_string.",";
												}
						  
												$area_consulta_aux="";
												for($i=0;$i<strlen($area_consulta)-1;$i++){
													$area_consulta_aux.=$area_consulta[$i];
												}
						  
												for ($i=0;$i<count($areas_boletim);$i++){
													$sql = "INSERT INTO area_mail (arm_mail_id,arm_area_id) VALUES('".$key."','".$areas_boletim[$i]."')";
													$INSERE = new QUERY($DATABASE,$sql);
												}
											
												#####################################
												# Inserir todos os e-mails na tabela log_mail
												# Depois o status de cada e-mail será gravado
												#####################################
												$uniao = request("mail_uniao" . $sufix_boletins_new );
												if ($uniao=="T"){
													$sql_users_enviar ="
													SELECT M.usr_id,M.usr_nome,M.usr_email,A.aru_mailing_id, COUNT(A.aru_mailing_id) AS TOT FROM area_mailing A 
													INNER JOIN mailing M ON(M.usr_id=A.aru_mailing_id) WHERE A.aru_area_id IN($area_consulta_aux) and (M.usr_status<>'N' OR M.usr_status IS NULL)
													GROUP BY A.aru_mailing_id HAVING (TOT>=2) ORDER BY M.usr_id ASC
													";		
												}else{
													//atualizar o campo de uniao dos e-mails
													$sql="UPDATE mail SET mail_uniao='' WHERE mail_id='$key'";
													$ATUALIZA_UNIAO = new QUERY($DATABASE,$sql);
												
													$sql_users_enviar="
													SELECT distinct M.usr_id,M.usr_nome, M.usr_email 
													FROM mailing M LEFT JOIN area_mailing am ON (am.aru_mailing_id = M.usr_id)
													WHERE am.aru_area_id IN ($area_consulta_aux) AND ((M.usr_status<>'N') OR (M.usr_status IS NULL))  ORDER BY M.usr_id ASC;
													";
												}
												$LOG = new QUERY($DATABASE, $sql_users_enviar);
												while ($LOG->NEXT()){
													$sql = "INSERT INTO log_mail (mail_id,mailing_id,status) VALUES ('$key','".$LOG->BYNAME("usr_id")."','0')";
													$LOG_MAILING = new QUERY($DATABASE,$sql);
												}
											}
											do_redirect("robo_detalhe.php?$sid_get&mod=boletins&modulo_detail=boletins&key=$key");
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