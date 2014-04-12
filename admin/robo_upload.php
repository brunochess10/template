<?php
//*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";
	
	include "includes/top_comum_popup.php";
	$caminho = $_SERVER["HTTP_HOST"];
	$path_link = explode("/",$_SERVER["PHP_SELF"]);
	for ($i=0;$i<count($path_link)-1;$i++){
		$caminho.= $path_link[$i]."/";
	}
	$caminho.="arquivos/";
	//echo "<pre>";
	//print_r($_SERVER);
	//echo "</pre>";
?>
	

	<script>
		function link(nome_link){
			var tot_link = '<?php echo "http://".$caminho?>'+nome_link;
			document.getElementById('link').innerHTML='<a href='+tot_link+'>'+tot_link+'</a>';
		}
	</script>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> Gerador de Link de arquivos</th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>
	<iframe name="upload" style='display:none'></iframe>
	<form name="formfields" action="upload_arquivo.php" method="post" target="upload" enctype="multipart/form-data">
		<table class="formeditar">
			<tr>
				<td>Arquivo</td>
				<td><input name="arquivo" type="file" > </td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Fazer upload" class="botaocontrole" id="botao_upload"></td>
			</tr>
			<tr>
				<td colspan="2">
				Copie e cole o link que será gerado abaixo no texto para que o seu cliente faça o download do arquivo
				<br/>
				<b id="link"></b>
				</td>
			</tr>
		</table>
	</form>
<br/>


<?
	include "includes/bottom_comum_popup.php";
?>
