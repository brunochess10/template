<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Servi�o de Boletins";
	$menu[1][2] = "
				<table class=\"sub\" >
							<tr>
								<th>�reas do boletim</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=area_boletim\" style=\"width:100%;\">Cadastrar �reas</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=area_boletim&makesearch=yes\" style=\"width:100%;\">Listar �reas</a></td>
							</tr>
				</table>
	";
?>