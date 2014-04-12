<?php
#
# Projeto :  Novo Admin do Neo Site Contábil
# Data : 14/11/2011
#
# PESQUISA DO BANCO

?>
<script>
	function verifica_quantidade(numero){
		if (numero=="0"){
			alert("Para disparar o Boletim você deve primeiro ter uma fila de envio do mesmo, siga os passos:\n -Clique em 'Detalhe' \n -Clique em 'Alterar' \n -Marque as áreas do Boletim e clique em 'Salvar Registro'");
			return false;
		}else{
			return true;
		}
	}
</script>	
		<table class="resultado" align="center">
				<thead>
					<tr>
						<td style="width:25%;"></td>
						<td style="width:75%;"></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td height="18"><a href="javascript:order('mail_data')" >Data:</a> 
						</td>
						<td>
						<?php
							 echo data_brasil($RESULT->BYNAME("mail_data"));
						?>	
						</td>
					</tr>
					<tr>
						<td><a href="javascript:order('mail_assunto')" >Assunto:</a> </td>
						<td><?php echo $RESULT->BYNAME("mail_assunto")?></td>
					</tr>
					<tr>
						<td><a href="javascript:order('mail_status')" >Status:</a> </td>
						<?php
							if ($RESULT->BYNAME("mail_status")=="0"){
								$mensagem="Não enviado";
							}else if ($RESULT->BYNAME("mail_status")=="1"){
								$mensagem="Envio em aberto";
							}else{
								$mensagem="Enviado";
							}
						?>	
						<td>
							<?php echo $mensagem?>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						<table>
							<tr>
						<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
								<td><img src="images/editar.png" /> </td><!--&nbsp;&nbsp;&nbsp;&nbsp;-->
						<?php
							if ($RESULT->BYNAME("mail_status")!="2"){
						?>	
								<td><img src="images/boletim.png" /></td><!--&nbsp;&nbsp;&nbsp;&nbsp;-->
							</tr>
							<tr>
								<td><a href="robo_detalhe.php?<?php echo show($sid_get)?>&mod=boletins&key=<?php echo show($RESULT->BYNAME('mail_id'))?>" >Detalhe</a></td>
								<?php
									$sql = "select * from log_mail where mail_id='".$RESULT->BYNAME("mail_id")."'";
									$TOTAL = new QUERY($DATABASE,$sql);
								?>
								<td><a href="robo_envia_email.php?<?php echo show($sid_get)?>&key=<?php echo show($RESULT->BYNAME('mail_id'))?>" onclick="return verifica_quantidade('<?php echo $TOTAL->NUMROWS()?>')">Enviar Boletim [ Lista com <?php echo $TOTAL->NUMROWS(); ?> e-mail(s) ]</a></td>
							</tr>	
						</table>	
						<?php
							}else{
							$sql = " SELECT * FROM log_mail WHERE mail_id ='".$RESULT->BYNAME('mail_id')."' AND status = '1'";
							$SUCESSO = new QUERY($DATABASE,$sql);
							
							$sql=  " SELECT * FROM log_mail WHERE mail_id ='".$RESULT->BYNAME('mail_id')."' AND status = '2'";
							$FALHA = new QUERY($DATABASE,$sql);
						?>
						
								<td><img src="images/certo.png" ></td>
								<td><img src="images/erro_email.png" ></td>
								<td><img src="images/reenviar.png" ></td>
							</tr>
							<tr>
								<td><a href="robo_detalhe.php?<?php echo show($sid_get)?>&mod=boletins&key=<?php echo show($RESULT->BYNAME('mail_id'))?>" >Detalhe</a></td>
								<td><a href="rel_email_sucesso.php?<?php echo show($sid_get)?>&mail_id=<?php echo $RESULT->BYNAME('mail_id') ?>" >[E-mails enviados com sucesso (<?php echo $SUCESSO->NUMROWS() ?>) ] </a></td>
								<td><a href="rel_email_falha.php?<?php echo show($sid_get)?>&mail_id=<?php echo $RESULT->BYNAME('mail_id') ?>" > [E-mails com problemas (<?php echo $FALHA->NUMROWS() ?>) ] </a></td>
								<td><a href="reenviar_email_falha.php?<?php echo show($sid_get)?>&mail_id=<?php echo $RESULT->BYNAME('mail_id') ?>" > [Tentar reenviar e-mail com falha (<?php echo $FALHA->NUMROWS() ?>) ] </a></td>
							</tr>	
						</table>	
						<?php
							}
						?>
						</td>
					</tr>
				</tfoot>
				</table>