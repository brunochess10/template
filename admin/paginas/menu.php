<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[3] = "Conte�do do Web Site";
	$menu[3][2] ="
					<table class=\"sub\" >
							<tr>
								<th>Novas p�ginas</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=paginas\" style=\"width:100%;\">Inserir p�gina</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=paginas&makesearch=yes\" style=\"width:100%;\">Listar p�ginas</a></td>
							</tr>
					</table>
				";				  
?>