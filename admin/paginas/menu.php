<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[3] = "Conteúdo do Web Site";
	$menu[3][2] ="
					<table class=\"sub\" >
							<tr>
								<th>Novas páginas</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=paginas\" style=\"width:100%;\">Inserir página</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=paginas&makesearch=yes\" style=\"width:100%;\">Listar páginas</a></td>
							</tr>
					</table>
				";				  
?>