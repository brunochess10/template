<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<?php
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
	include $mod .  "/consistencia.php";

	include("includes/top_comum.php");

    //Adicionando java script de validação
	//------------------------------------------
?>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> <?php echo show($modules[$mod]["insert_titulo"])?></th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table><?include("includes/mensagem_erro.php");?>
	<form name="formfields" action="robo_inserir.php" method="post" onsubmit="return consiste(this)">
	<?php echo $sid_post?>
	<input type="hidden" name="mod" value="<?php echo request("mod")?>">
	<input type="hidden" name="key" value="<?php echo request("key")?>">
	<input type="hidden" name="action" value="insert">

	
	<?
			//aqui é onde irá o form de acordo com o design personalizado
			$mode = "insert";
			include $mod . "/form.php"; 
	?>

<div align="center">
	<? if ( is_allowed( request_session("USER_NIVEL"), request("mod"), "insert") ){?>
			<input type="submit" value="salvar registro" class="botaocontrole" onclick="javascript:this.disabled = 'disabled';this.form.submit();">
	<? } ?>        
	        <input type="button" value="cancelar" onclick="javascript:this.disabled = 'disabled';document.location='area_usuario.php?<?php echo $sid_get?>';" class="botaocontrole">
</div>	
	</form>
<br/>

<? 	include("includes/bottom_comum.php"); ?>
