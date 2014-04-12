<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[4] = "Usuários";
	$menu[4][0] ="
					<table class=\"sub\" >
							<tr>
								<th>Usuários</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=admin_usuarios\" style=\"width:100%;\">Inserir usuário</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=admin_usuarios&makesearch=yes\" style=\"width:100%;\">Listar usuários</a></td>
							</tr>
					</table>
				";				  
?>