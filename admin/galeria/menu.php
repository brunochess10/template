<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[3] = "Conte�do do Web Site";
	$menu[3][3] ="
					<table class=\"sub\" >
							<tr>
								<th>Galeria de Fotos</th>
							</tr>
							<tr>
								<td><a href=\"robo_inserir.php?$sid_get&mod=galeria\" style=\"width:100%;\">Inserir foto</a></td>
							</tr>
							<tr>
								<td><a href=\"robo_pesquisa.php?$sid_get&mod=galeria&makesearch=yes\" style=\"width:100%;\">Listar Fotos da Galeria</a></td>
							</tr>
					</table>
				";				  
?>