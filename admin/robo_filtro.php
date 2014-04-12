<?
#
# Projeto :  Lucato 
# Data : 20/02/2004
# 
# ROBO Filtro
#

    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";

	
	//recuperando variaveis da tela
	//-----------------------------------
	$mod = request("mod");
	
 	include("includes/top_comum.php");
	
	
	//Adicionando java script de validação
	//------------------------------------------
?>
	<script language="javascript">
		function LoadErrorsServidor() {
			<?php echo $ERRORS?>
			ShowListErrors();
		}
	</script>
	<script type="text/javascript" src="<?php echo show($mod)?>/filtro.js"></script>
	<script type="text/javascript" src="scripts/mask_format.js"></script>	
	<script type="text/javascript" src="scripts/robo_filtro.js"></script>	

	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> <?php echo show($modules[$mod]["report_titulo"])?></th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table><? 	include("includes/mensagem_erro.php"); ?>
	<form name="formfields" action="robo_relatorio.php" method="post" target="Report" onsubmit="return consiste(this);">
	<?php echo $sid_post?>
	<?
			include $mod . "/filtro.php";
	?>
<div align="center">
	<input type="hidden" name="mod" value="<?php echo $mod?>" >
	<input type="submit" value="relatório" class="botaocontrole">
	<input type="hidden" name="enviar" value="0">
	<input type="button" value="Enviar por email" onclick="return enviar_email();"  class="botaocontrole"> <input type="text" name="email" size="35">   
</div>		
	</form>
<br/>
<br/>
<? 	include("includes/bottom_comum.php"); ?>

