<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Serviço de Boletins";
	$menu[1][0] = "
				<table class=\"sub\" >
							<tr>
								<th>Boletins</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=boletins\" style=\"width:100%;\">Criar Boletim</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=boletins&&makesearch=yes&\" style=\"width:100%;\">Disparar Boletim</a></td>
							</tr>
				</table>
	";
?>
					