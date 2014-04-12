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
			<th class="centro">Origem dos Usuários</th>
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
	<legend>Origem dos Usuários</legend>	
	<div id="texto">
	<p>
	
	</p>
	<h1>Origem dos usuários</h1>
	<p>Neste relatório você poderá descobrir a origem dos usuários, como esse relatório é novo, possa ser que muitos dos usuários estejam coma origem indefinida.
	<p>Selecione a origem e clique em consultar:</p>
	<form action="relatorio_usuarios_origem.php" method="post">
		<?php echo $sid_post?>
		<select name="filtro">
			<option value="0"></option>
			<option value="1">Cadastrado pelo Web Site</option>
			<option value="2">Cadastro pela Importação de Lista</option>
			<option value="3">Cadastro pela área administrativa</option>
			<option value="4">Importado pelo Net Contábil</option>
			<option value="9">Indefinido</option>
		</select>
		<input value="Consultar" class="botaofild"  type="submit">
	</form>
	<br>
	<?php 
		$filtro=request("filtro");
		$titulo[0]="";
		$titulo[1]="Origem: Cadastrado pelo Web Site";
		$titulo[2]="Origem: Cadastro pela Importação de Lista";
		$titulo[3]="Origem: Cadastro pela área administrativa";
		$titulo[4]="Origem: Importado pelo Net Contábil";
		$titulo[9]="Origem: Indefinido";

		$consulta[1]= "usr_origem ='1' ";
		$consulta[2]= "usr_origem ='2' ";
		$consulta[3]= "usr_origem ='3' ";
		$consulta[4]= "usr_origem ='4' or usr_flag_net_contabil='T' ";
		$consulta[9]= "usr_origem is null and usr_flag_net_contabil is null";
		
		if ($filtro!=0){
			echo "<h1>".$titulo[$filtro]."</h1>";
			echo "<table>";
			echo "<tr><th style='width:300px;'>Nome</th><th style='width:300px;'>E-mail</th></tr>";
			$sql="select * from mailing where ".$consulta[$filtro];
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