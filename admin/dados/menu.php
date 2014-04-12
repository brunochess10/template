<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[0] = "Configurações Gerais";
	$menu[0][1]  = "
					<table class=\"sub\" >
							<tr>
								<th><a href=\"robo_detalhe.php?$sid_get&mod=dados&key=1\" style=\"width:100%;\">Dados do escritório / Layout</a></th>
							</tr>
					</table>
	";
?>