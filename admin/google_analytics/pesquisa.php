<?
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
						<td height="18"><a href="javascript:order('titulo')" >Título:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("titulo");
						?>	
						</td>
					</tr>
					<tr>
						<td><a href="javascript:order('texto')" >Texto:</a> </td>
						<td><?php echo $RESULT->BYNAME("texto")?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="robo_detalhe.php?<?php echo $sid_get ?>&mod=metatags&key=<?php echo $RESULT->BYNAME('serv_id')?>">Detalhe</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>