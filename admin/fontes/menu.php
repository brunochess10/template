<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[1] = "Servi�o de Boletins";
	$menu[1][3] = "<table class=\"sub\" >
					<tr>
						<th>Fontes Autom�ticas</th>
					</tr>
					<tr>
						<td><a href=\"robo_detalhe.php?$sid_get&mod=fontes&key=1\" style=\"width:100%;\">Fontes autom�ticas</a></td>
					</tr>
				   </table>
				  ";				  
?>