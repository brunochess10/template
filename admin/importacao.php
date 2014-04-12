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
		function sucesso(total){
			$("#texto").html("<h1>Foram importado(s)"+total+" e-mail(s)</h1>");
		}
	</script>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> Importação de e-mails</th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>
	<iframe name="importacao" style="display:none;"></iframe>	
<form action="importacao_process.php?<?php echo $sid_get ?>" target="importacao" method="post">	
<table class="formeditar" style="margin-left:10px;">
<tr>
	<td>
	<fieldset class="destaquefild">
	<legend>Importação de e-mails</legend>	
	<div id="texto">
	<p>Coloque um e-mail por linha, para que os mesmos possam ser importados para a base de dados, se o e-mail já existir o mesmo <b>não</b> será 
	importado para base de dados. Se o e-mail estiver desativado ele também <b>não</b> será importado para base de dados.<br>Exemplo:<br>
	joao@calcadosmaracaibo.com.br<br>
	maria@postodegasolina.com.br<br>
	</p>
	<p>Selecione a área para qual deseja importar os e-mails:</p>
	<?php
		$sql="select * from area_newsletter order by are_id";
		$AREA = new QUERY($DATABASE,$sql);
		while ($AREA->NEXT()){
	?>
			<input type="checkbox" name="area[]" value="<?php echo $AREA->BYNAME("are_id")?>"><?php echo $AREA->BYNAME("are_titulo")?><br>
	<?php	
		}
	?>
		<textarea name="emails" style="width:400px;height:150px;"></textarea>
	<br>
	<input value="Importar e-mails" class="botaofild"  type="submit">
	</fieldset>
	</div>
	</td>
</tr>
</table>	
</form>
</div>				
<br/>
<? 	include("includes/bottom_comum.php"); ?>

