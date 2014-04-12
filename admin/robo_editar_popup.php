<?
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# ROBO Editar
#
    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";

	//recuperando variaveis da tela
	//-----------------------------------
        
	$mod = request("mod");

	include("includes/top_comum_popup.php");

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
			<th class="centro"> <?php echo show($modules[$mod]["edit_titulo"])?></th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table><?include("includes/mensagem_erro.php");?>
	<form name="formfields" action="robo_editar.php" method="post" onsubmit="return consiste(this)">
	<?php echo $sid_post?>
	<input type="hidden" name="mod" value="<?php echo request("mod")?>">
	<input type="hidden" name="key" value="<?php echo request("key")?>">
	<input type="hidden" name="action" value="edit">

	
	<?
			//aqui é onde irá o form de acordo com o design personalizado
			$mode = "edit";
			include $mod . "/form.php"; 
	?>

	
<div align="center">
	<? if ( is_allowed( request_session("USER_NIVEL"), request("mod"), "edit") ){?>
			<input type="submit" value="salvar registro" class="botaocontrole" onclick="javascript:this.disabled = 'disabled';this.form.submit();">
	<? } ?>        
	        <input type="button" value="cancelar" onclick="javascript:this.disabled = 'disabled'; window.close();" class="botaocontrole">
</div>		
	</form>
<br/>

	
<? 	include("includes/bottom_comum_popup.php"); ?>

