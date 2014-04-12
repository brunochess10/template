<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[3] = "Conteúdo do Web Site";
	$menu[3][1] ="
					<table class=\"sub\" >
							<tr>
								<th>Página serviços</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=servico\" style=\"width:100%;\">Inserir conteúdo</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=servico&makesearch=yes\" style=\"width:100%;\">Listar conteúdo</a></td>
							</tr>
					</table>
				";				  
?>