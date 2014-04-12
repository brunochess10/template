<?php
#
# Projeto :  Novo Admin do Neo Site Contábil
# Data : 14/11/2011
#
# PESQUISA DO BANCO

?>

				<table class="resultado" align="center">
				<thead>
					<tr>
						<td style="width:25%;"></td>
						<td style="width:75%;"></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td height="18"><a href="javascript:order('usr_nome')" >Nome:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("usr_nome");
						?>	
						</td>
					</tr>
					<tr>
						<td><a href="javascript:order('usr_email')" >E-mail:</a> </td>
						<td><?php echo $RESULT->BYNAME("usr_email")?></td>
					</tr>
					<tr>
						<td><a href="javascript:order('usr_status')" >Status:</a> </td>
						<td><?php 
								if ($RESULT->BYNAME("usr_status")=="N"){
							?>
								<img src="images/cancelado.jpg" style="float:left;"> <br/>Desativado - Motivo: <?php echo $RESULT->BYNAME("usr_bounce")?>
							<?php		
								}else{
							?>
								<img src="images/certo.png" style="float:left;"> <br/>Ativado
							<?php
								}
							?>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="robo_detalhe.php?<?php echo show($sid_get)?>&mod=usuarios&key=<?php echo show($RESULT->BYNAME('usr_id'))?>">Detalhe</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>