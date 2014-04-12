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
						<td height="18"><a href="javascript:order('menu_pai')" >Categoria:</a> 
						</td>
						<td>
						<?php
							 if ($RESULT->BYNAME("menu_pai")=="1") echo "Institucional";
							 if ($RESULT->BYNAME("menu_pai")=="2") echo "Ferramentas";
						?>	
						</td>
					</tr>
					<tr>
						<td height="18"><a href="javascript:order('titulo_menu')" >Título menu:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("titulo_menu");
						?>	
						</td>
					</tr>
					<tr>
						<td height="18"><a href="javascript:order('titulo_pagina')" >Título página:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("titulo_pagina");
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
						<a href="robo_detalhe.php?<?php echo show($sid_get)?>&mod=paginas&key=<?php echo show($RESULT->BYNAME('id'))?>">Detalhe</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>