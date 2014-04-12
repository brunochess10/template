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
						<td height="18"><a href="javascript:order('imagem')" >Imagem:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("imagem");
						?>	
						</td>
					</tr>
					<tr>
						<td><a href="javascript:order('texto')" >Url do texto do slogan:</a> </td>
						<td><?php echo $RESULT->BYNAME("url")?></td>
					</tr>
					<tr>
						<td><a href="javascript:order('primeira_linha')" >Primeira Linha:</a> </td>
						<td><?php echo $RESULT->BYNAME("primeira_linha")?></td>
					</tr>
					<tr>
						<td><a href="javascript:order('segunda_linha')" >Segunda Linha:</a> </td>
						<td><?php echo $RESULT->BYNAME("segunda_linha")?></td>
					</tr>
					<tr>
						<td><a href="javascript:order('publicado')" >Publicado:</a> </td>
						<td><?php
							if ($RESULT->BYNAME("publicar")=="S"){
								echo "<img src='images/certo.png' />";
							}else{
								echo "<img src='images/erro_email.png' />";
							}
						
						?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="robo_detalhe.php?<?php echo show($sid_get)?>&mod=layout_topo&key=<?php echo show($RESULT->BYNAME('id'))?>">Detalhe</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>