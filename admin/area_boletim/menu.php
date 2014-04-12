<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Serviço de Boletins";
	$menu[1][2] = "
				<table class=\"sub\" >
							<tr>
								<th>Áreas do boletim</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=area_boletim\" style=\"width:100%;\">Cadastrar áreas</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=area_boletim&makesearch=yes\" style=\"width:100%;\">Listar áreas</a></td>
							</tr>
				</table>
	";
?>