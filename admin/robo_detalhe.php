<?
#
# Projeto :  Lucato 
# Data : 20/02/2004
# 
# ROBO Detalhe
#

    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";
 	include("includes/top_comum.php");
	
	//recuperando variaveis da tela
	//-----------------------------------
	$mod = request("mod");
	include $mod .  "/consistencia.php";
	
	
	$last_url = request_session("LAST_URL");
	if ( empty($last_url) ){
			$last_url = "area_usuario.php?$sid_get";
	} 
	//Adicionando java script de validação
	//------------------------------------------
?>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> <?php echo show($modules[$mod]["detail_titulo"])?></th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>

	<form name="formfields" action="robo_editar.php" method="post" onsubmit="return consiste(this)">
	<?php echo $sid_post?>
	
	<input type="hidden" name="mod" value="<?php echo request("mod")?>">
	<input type="hidden" name="key" value="<?php echo request("key")?>">

	
	

    <?php
			//aqui é onde irá o form de acordo com o design personalizado
			$mode = "detail";
			include $mod . "/form.php";
	?>

<div align="center">
	<? if ( is_allowed( request_session("USER_NIVEL"), request("mod"), "edit") ){?>
			<input type="submit" value="alterar registro" class="botaocontrole" onclick="javascript:this.disabled = 'disabled';this.form.submit();">
	<? } ?>
	
	<? if ( is_allowed( request_session("USER_NIVEL"), request("mod"), "delete") ){
				$mod = request("mod");
				$key = request("key");
				$url = "robo_excluir.php?$sid_get&mod=$mod&key=$key";
	?>
			<input type="button" value="excluir registro" class="botaocontrole" onclick="javascript:this.disabled = 'disabled';document.location='<?php echo $url?>&url=<?php echo urlencode($last_url)?>';">
	<? } ?>
	
	        <input type="button" value="cancelar" onclick="javascript:this.disabled = 'disabled';document.location='<?php echo $last_url?>';" class="botaocontrole">
</div>				
	</form>
<br/>
<? 	include("includes/bottom_comum.php"); ?>

