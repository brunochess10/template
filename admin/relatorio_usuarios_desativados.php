<?php
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
 	include "includes/top_comum.php";
	
?>
	<script>
		function CarregaBody(){
			
		}
	</script>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro">Usu�rios Desativados</th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>
<table class="formeditar" style="margin-left:10px;">
<tr>
	<td>
	<fieldset class="destaquefild">
	<legend>Usu�rios Desativados</legend>	
	<div id="texto">
	<p>
	
	</p>
	<h1>Usu�rios Desativados</h1>
	<table>
		<tr>
			<th style='width:300px;'>Empresa / Nome</th>
			<th style='width:300px;'>E-mail</th>
			<th style='width:300px;'>Motivo</th>
		</tr>
	<?php
		$sql="select * from mailing WHERE usr_status='N'";
		$EMAIL = new QUERY($DATABASE,$sql);
		$i=0;
		while ($EMAIL->NEXT()){
		$i++;	
	?>
		<tr>
			<td><?php echo $EMAIL->BYNAME("usr_nome"); ?></td>
			<td><?php echo $EMAIL->BYNAME("usr_email"); ?></td>
			<td><?php echo $EMAIL->BYNAME("usr_bounce"); ?></td>
		</tr>	
	<?php	
	
		}
	?>
		<tr>
			<th>Total:</th>
			<th colspan="2"><?php echo $i; ?></th>
		</tr>
	</table>
	<br>
	</fieldset>
	</div>
	</td>
</tr>
</table>	
</div>				
<br/>
<?php 	
include("includes/bottom_comum.php"); 
?>