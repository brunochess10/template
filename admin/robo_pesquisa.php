<?php
#
# Projeto :  Lucato
# Data : 10/02/2004
#
# ROBO pesquisa
#
		//*******************************************************************
		// INCLUDES nao alterar a ordem dos includes
		//*******************************************************************
		// INCLUDES SEPARADOS PARA TER A OPÇÃO DE MUDAR O WHERE
		// DA PESQUISA DE ACORDO COM O NIVEL DO USUARIO
		include "includes/database.php";
		include "includes/config.php";
		include "includes/functions.php";
		include "includes/htmlMimeMail.php";
		include "includes/permissao.php";
		include "includes/session.php";
		include "includes/modules.php";
		
		//armazernar o link para o botao cancelar das telas
		$last_url = $_SERVER["PHP_SELF"] . "?" .$_SERVER["QUERY_STRING"];
		set_session("LAST_URL", $last_url);

		//recuperar variaveis da tela
		//---------------------------------
		$mod = request("mod");
		$allwords = request("allwords");
		if ( ($allwords == "yes") ){
				$check = "checked";
		} else {
				$check = "";
		}

		$pesqinicial = request("pesqinicial");
		if ( ($pesqinicial == "yes") ){
				$pi = "checked";
		} else {
				$pi = "";
		}
		//fim------------------------------

	//---------------------------------------------
	//SOURCE
	//---------------------------------------------
	$query = request("query");
	$makesearch = request("makesearch");
	if ( $makesearch == "yes" ){
			if ( $modules[$mod]["include"] ) {
					include $modules[$mod]["include"];
			} 

			$navbar["url_default"] = "robo_pesquisa.php?" . show($sid_get) . "&mod=" . show($mod) . "&allwords=$allwords&pesqinicial=$pesqinicial";
			$navbar["max_row"] = 10;
			$navbar["max_page"] = 8;
	        $navbar["page"] = request("page");
			$navbar["action"] = request("action");

			$order = request("order");
			if( empty($order)  ) $order = $modules[$mod]["pesquisa_ordem"];

			$RESULT = get_dataset_search($DATABASE, $modules[$mod], $query , $navbar, request("allwords"), request("pesqinicial"), $order );
	}



		// começa a imprimir a tela
		include("includes/top_comum.php");
 		// Arquivo javascript com as consistencias da tela e o que precisar de java script
		//----------------------------------------------------------------------------------------------
		echo "<script type=\"text/javascript\" src=\"scripts/robo_pesquisa.js\"></script>";
?>
<script language="JavaScript">
		function set_pesquisa( form ) {
				if ( consiste( form ) ){
						if ( form.allwords.checked ) {
								var words = form.allwords.value;
						} else {
								var words = "";
						}
						if ( form.pesqinicial.checked ) {
								var pi = form.pesqinicial.value;
						} else {
								var pi = "";
						}
						document.location = 'robo_pesquisa.php?<?php echo $sid_get?>&mod=' + form.mod.value + '&order=' + form.order.value + '&mult_page_start=' + form.mult_page_start.value + '&rows=' + form.rows.value + '&query=' + form.query.value + '&allwords=' + words + '&pesqinicial=' + pi + '&makesearch=' + form.makesearch.value;
				}
				return false;
		}
</script>
		<!--FORMULARIO DE PESQUISA-->
<table class="titulo">
<thead>
	<tr>
		<td rowspan="2" class="esquerdo"></td>
		<th class="centro"><?php echo show($modules[$mod]["pesquisa_titulo"])?></th>
		<td rowspan="2" class="direito"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</thead>
</table>
<form name="formpesquisa" action="robo_pesquisa.php" method="post" onsubmit="return set_pesquisa(this);">
<table class="pesquisa"><!-- style="margin-top:40px;"-->
<tbody>
	<tr>
		<td>
		<?php echo $sid_post?><!--%este pode ser mostrado sem o show pois é um input%-->
		<input type="hidden" name="mod" value="<?php echo show($mod)?>">
		<input type="hidden" name="order" value="<?php echo request("order")?>">
		<input type="hidden" name="makesearch" value="yes">
		<!--<input type="hidden" name="page" value="<?//=request("page")?>">-->
		<input type="hidden" name="mult_page_start" value="<?php echo request("mult_page_start")?>">
		<input type="hidden" name="rows" value="<?php echo request("rows")?>">
		<input type="text" class="textao" name="query" value="<?php echo show(request("query"))?>" size="25" maxlength="30" /><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="checkbox" name="allwords" value="yes" <?php echo show($check)?> > Conter todas as palavras<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="checkbox" name="pesqinicial" value="yes" <?php echo show($pi)?> > Pesquisa Inicial<br />
		</td>
		<td> <input type="submit" value="Pesquisar" class="botao"/></td>
	</tr>
</tbody>
</table>
</form>
<div id="wait">
<b>Aguarde enquanto a pesquisa é processada...</b>
</div>
<? include("includes/mensagem_erro.php"); ?>
<br/>
<?
	if ( $makesearch == "yes" ){
?>
			<!-- Resultado da Pesquisa solicitada -->
			<div class="mensagem">Resultado: encontrado(s) <b><?php echo show($navbar["rows"])?></b> registro(s) com a(s) palavra(s) <b><?php echo show($query)?></b></div><br/>


<?php
			echo "<div class='paginacao'>". $navbar["url_nav"] . "</div>";

			while ( $RESULT->NEXT() ) {
					// aqui vai o  design personalizado
					include $mod . "/pesquisa.php";
			}

			$RESULT->FREE();

			echo "<div class='paginacao'>". $navbar["url_nav"] . "</div>";
	}
?>
<br/>
<br/>
<? include("includes/bottom_comum.php"); ?>

