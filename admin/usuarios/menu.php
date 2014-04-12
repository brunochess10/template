<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Serviço de Boletins";
	$menu[1][1] = "
				<table class=\"sub\" >
							<tr>
								<th>Usuários do boletim</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=usuarios\" style=\"width:100%;\">Cadastrar usuários</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=usuarios&makesearch=yes\" style=\"width:100%;\">Listar Usuários</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_importar_netcontabil.php?$sid_get\">Importar usuários / Net Contábil</a></td>
							</tr>
							<tr>
								<td><a href=\"importacao.php?$sid_get\">Importar usuários / Lista</a></td>
							</tr>
				</table>
	";
?>