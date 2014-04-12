<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Serviço de Boletins";
	$menu[1][4] = "<table class=\"sub\" >
					<tr>
						<th>Relatórios</th>
					</tr>
					<tr>					
						<td><a href=\"relatorio_email_area.php?$sid_get\" style=\"width:100%;\">E-mail por área</a></td>
					</tr>
					<tr>
						<td><a href=\"relatorio_usuarios_origem.php?$sid_get\" style=\"width:100%;\">Origem dos Usuários</a></td>
					</tr>
					<tr>	
						<td><a href=\"relatorio_usuarios_ativos.php?$sid_get\" style=\"width:100%;\">Usuários Ativos</a></td>
					</tr>
                    <tr>					
						<td><a href=\"relatorio_usuarios_desativados.php?$sid_get\" style=\"width:100%;\">Usuários Desativados</a></td>
					</tr>
				   </table>
				  ";				  
?>