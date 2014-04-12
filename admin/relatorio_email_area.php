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
			<th class="centro">Relatório e-mail por área</th>
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
	<legend>Relatório e-mail por área</legend>	
	<div id="texto">
	<p>
	
	</p>
	<h1>Relatório de e-mail por área</h1>
	<p>Neste relatório você poderá descobrir os e-mails cadastrados por área. Só aparecerão os e-mails ativos. Possa ser que um e-mail esteja em mais de uma área também.</p>
	<p>Selecione a área e clique em consultar:</p>
	<form action="relatorio_email_area.php" method="post">
		<?php echo $sid_post?>
		<select name="filtro">
		<option value=""></option>
			<?php
				$sql="SELECT * FROM area_newsletter ORDER BY are_id";
				$AREA = new QUERY($DATABASE,$sql);
				while ($AREA->NEXT()){
			?>
				<option value="<?php echo $AREA->BYNAME('are_id')?>"><?php echo $AREA->BYNAME('are_titulo') ?></option>
			<?php
				}
			?>
		</select>
		<input value="Consultar" class="botaofild"  type="submit">
	</form>
	<br>
	<?php 
		$filtro=request("filtro");
		if ($filtro!=""){
			$sql="select * from area_newsletter WHERE are_id='$filtro'";
			$AREA_NOME = new QUERY($DATABASE,$sql);
			$AREA_NOME->NEXT();
			echo "<h1>E-mails na área: ".$AREA_NOME->BYNAME("are_titulo")."</h1>";
			echo "<table>";
			echo "<tr><th style='width:300px;'>Nome</th><th style='width:300px;'>E-mail</th></tr>";
			$sql="select distinct M.usr_nome,M.usr_email from area_mailing A INNER JOIN mailing M ON (A.aru_mailing_id=M.usr_id)   where A.aru_area_id = '".$filtro."' AND (M.usr_status='S' OR M.usr_status IS NULL)";
			$CONSULTA = new QUERY($DATABASE,$sql);
			while($CONSULTA->NEXT()){
				echo "<tr><td >".$CONSULTA->BYNAME("usr_nome")."</td><td>".$CONSULTA->BYNAME("usr_email")."</td></tr>";
			}
			echo "<tr><th>Total</th><th>".$CONSULTA->NUMROWS()."</th></tr>";
			echo "</table>";
		}
	?>
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