<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Servi�o de Boletins";
	$menu[1][1] = "
				<table class=\"sub\" >
							<tr>
								<th>Usu�rios do boletim</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=usuarios\" style=\"width:100%;\">Cadastrar usu�rios</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=usuarios&makesearch=yes\" style=\"width:100%;\">Listar Usu�rios</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_importar_netcontabil.php?$sid_get\">Importar usu�rios / Net Cont�bil</a></td>
							</tr>
							<tr>
								<td><a href=\"importacao.php?$sid_get\">Importar usu�rios / Lista</a></td>
							</tr>
				</table>
	";
?>