<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[3] = "Conteúdo do Web Site";
	$menu[3][0] ="
				<table class=\"sub\" >
						<tr>
							<th>Página empresas</th>
						</tr>
						<tr>
							<td><a href=\"robo_inserir.php?$sid_get&mod=empresa\" style=\"width:100%;\">Inserir conteúdo</a></td>
						</tr>
						<tr>
							<td><a href=\"robo_pesquisa.php?$sid_get&mod=empresa&makesearch=yes\" style=\"width:100%;\">Listar conteúdo</a></td>
						</tr>
					</table>
				";				  
?>