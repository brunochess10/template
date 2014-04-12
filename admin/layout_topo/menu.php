<?php
	#O primeiro Array indica a qual grupo pertence e a ordem que vai aparecer no menu, aquele item
	#O Segundo Array indica um item daquele subgrupo
	
	$grupo[0] = "Configurações Gerais";
	$menu[0][2] = "
					<table class=\"sub\" >
							<tr>
								<th><a href=\"robo_pesquisa.php?$sid_get&mod=layout_topo&makesearch=yes\" style=\"width:100%;\">Apresentação do Topo</a></th>
							</tr>
					</table>
	";
?>