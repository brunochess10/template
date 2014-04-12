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
			<th class="centro">Usuários Ativos</th>
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
	<legend>Usuários Ativos</legend>	
	<div id="texto">
	<p>
	
	</p>
	<h1>Usuários Ativos</h1>
	<table>
		<tr>
			<th style='width:300px;'>Empresa / Nome</th>
			<th style='width:300px;'>E-mail</th>
		</tr>
	<?php
		$sql="select * from mailing WHERE usr_status='S' or usr_status IS NULL";
		$EMAIL = new QUERY($DATABASE,$sql);
		$i=0;
		while ($EMAIL->NEXT()){
		$i++;	
	?>
		<tr>
			<td><?php echo $EMAIL->BYNAME("usr_nome"); ?></td>
			<td><?php echo $EMAIL->BYNAME("usr_email"); ?></td>
		</tr>	
	<?php	
	
		}
	?>
		<tr>
			<th>Total:</th>
			<th><?php echo $i; ?></th>
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