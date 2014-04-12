<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[0] = "Configurações Gerais";
	$menu[0][3] = "
				<table class=\"sub\" >
					<tr>
						<th><a href=\"robo_detalhe.php?$sid_get&mod=avisos&key=1\" style=\"width:100%;\">Configurar Avisos</a></th>
					</tr>
				</table>
	";
?>
					