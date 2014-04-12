<?php
#
# Projeto :  Novo Admin do Neo Site Contábil
# Data : 14/11/2011
#
# PESQUISA DO BANCO

if ($_SESSION["USER"]=="admin"){
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
						<td height="18"><a href="javascript:order('titulo')" >Usuário:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("usuario");
						?>	
						</td>
					</tr>
					<!--
					<tr>
						<td><a href="javascript:order('texto')" >Senha:</a> </td>
						<td><?php echo md5($RESULT->BYNAME("senha"))?></td>
					</tr>
					-->
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="robo_editar.php?<?php echo show($sid_get)?>&mod=admin_usuarios&key=<?php echo show($RESULT->BYNAME('id'))?>">Trocar Senha</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>
<?php
}else if (($_SESSION["USER"]!="admin")&&($RESULT->BYNAME("usuario")!="admin")){
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
						<td height="18"><a href="javascript:order('titulo')" >Usuário:</a> 
						</td>
						<td>
						<?php
							 echo $RESULT->BYNAME("usuario");
						?>	
						</td>
					</tr>
					<!--
					<tr>
						<td><a href="javascript:order('texto')" >Senha:</a> </td>
						<td><?php echo md5($RESULT->BYNAME("senha"))?></td>
					</tr>
					-->
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="robo_editar.php?<?php echo show($sid_get)?>&mod=admin_usuarios&key=<?php echo show($RESULT->BYNAME('id'))?>">Trocar Senha</a>&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
				</tfoot>
				</table>
<?php
}
?>