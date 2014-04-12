<?
#
# Projeto :  Lucato
# Data : 31/01/2005
#
# Popup CEP
#

// URL PARA CONSULTA NO SITE DOS CORREIOS -->> http://www.correios.com.br/servicos/cep/cep_generico.cfm?cep=03912010
// A PESQUISA RETORNA OS DADOS EM XML
function retira_acentos( $texto )
{
  $array1 = array(   "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
                     , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
  $array2 = array(   "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
                     , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
  return str_replace( $array1, $array2, $texto );
}
$estados = Array("AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ","RN","RO","RR","RS","SC","SE","SP","TO");
$tipos = Array("Rua","Avenida","Travessa","Quadra","Praça","Vila","Alameda","Estrada","Beco","Passagem","Viela","Servidão","Rodovia","Caminho","Conjunto");

  //*******************************************************************
	// INCLUDES nao alterar a ordem dos includes
  //*******************************************************************
	include "includes/library.php";
	include "includes/session.php";
	include "includes/ibase_common.php";
	$BANCO = new DATABASE();

	$modo = request("modo");
	if($modo == "logradouro") { // BUSCA O ENDEREÇO PELO CEP
		$cep = request("cep");
		// NOMES DOS CAMPOS ONDE AS INFORMAÇÕES DEVERÃO SER RETORNADAS
		$retorno_endereco = request("retorno_endereco");
		$retorno_bairro = request("retorno_bairro");
		$retorno_municipio = request("retorno_municipio");
		$retorno_estado = request("retorno_estado");
		$retorno_cep = request("retorno_cep");

		$cep = trim($cep);
		# if(!empty($cep)) { // SE O CEP NAO ESTIVER EM BRANCO FAZ A BUSCA
			$cep = str_replace("-","",$cep);
			# if(strlen($cep) == 8) { // SE O CEP ESTIVER COM OS DIGITOS CORRETOS, MONTA A QUERY
				$busca_cep = "ok";
				$sql = "
					select
						LG.ID_LOGR,
						LG.UFE as UF,
						LG.ID_LOCAL as LOG_ID_LOCAL,
						LG.NOME AS LOG_NOME,
						LG.ID_BAIRRO_INI,
						LG.CEP,
						LG.COMPLEMENTO,
						LG.TIPO,
						LC.ID_LOCAL,
						LC.NOME as LOC_NOME,
						BA.ID_BAIRRO,
						BA.NOME as BA_NOME
					from
						LOGR LG
					left outer join
						LOCAL LC
						on
							( LC.ID_LOCAL = LG.ID_LOCAL )
					left outer join
						BAIRRO BA
							on
								( BA.ID_BAIRRO = LG.ID_BAIRRO_INI )
					where
						LG.CEP = '$cep'
				"; // SQL PARA BUSCA POR CEP **** PRECISA ALTERAR, INCLUINDO CONSULTA NO BAIRRO E LOCAL!!!!!
				$CEP_R = new QUERY($BANCO, $sql);
			# }
		# }
	} elseif($modo == "cep") { // BUSCA O CEP PELO ENDEREÇO

		$logradouro = request("logradouro");
		$logradouro_busca = retira_acentos($logradouro);
		$logradouro_busca = strtoupper($logradouro_busca);
		$estado = request("estado");
		$cidade = request("cidade");
		$tipo = request("tipo");
		$cidade_busca = retira_acentos($cidade);
		$cidade_busca = strtoupper($cidade_busca);
		// NOME DO CAMPO ONDE O CEP DEVERÁ SER RETORNADO
		$retorno_cep = request("retorno_cep");
		$enviado = request("enviado");



		if(!empty($enviado)) {
			$sql_cidade = "SELECT * FROM LOCAL WHERE NOME_BUSCA = '$cidade_busca' AND UFE = '$estado'";
			$VER_CIDADE = new QUERY($BANCO, $sql_cidade);
			if($VER_CIDADE->NEXT()) {
				$id_local = $VER_CIDADE->BYNAME("ID_LOCAL");
			} else {
				echo "<script>alert('Cidade \"$cidade/$estado\" não cadastrada!')</script>";
			}
			if(!empty($tipo)) {
				$tipo_sql = " LG.TIPO = '$tipo' and ";
			} else {
				$tipo_sql = "";
			}
			$sql_busca = "
				select
					LG.ID_LOGR,
					LG.UFE as UF,
					LG.ID_LOCAL as LOG_ID_LOCAL,
					LG.NOME AS LOG_NOME,
					LG.NOME_BUSCA,
					LG.ID_BAIRRO_INI,
					LG.CEP,
					LG.COMPLEMENTO,
					LG.TIPO,
					BA.ID_BAIRRO,
					BA.NOME as BA_NOME
				from
					LOGR LG
				left outer join
					BAIRRO BA
						on
							( BA.ID_BAIRRO = LG.ID_BAIRRO_INI )
				where
					$tipo_sql
					LG.NOME_BUSCA LIKE '$logradouro_busca%' and
					LG.UFE = '$estado' and
					LG.ID_LOCAL = '$id_local'
			";
			$CEP_R = new QUERY($BANCO, $sql_busca);
		}
	}
?>
<script>
function retorna_logradouro(endereco, bairro, municipio, estado, cep) {
	opener.document.getElementById('<?php echo $retorno_endereco?>').value = endereco;
	opener.document.getElementById('<?php echo $retorno_bairro?>').value = bairro;
	opener.document.getElementById('<?php echo $retorno_municipio?>').value = municipio;
	opener.document.getElementById('<?php echo $retorno_estado?>').value = estado;
	opener.document.getElementById('<?php echo $retorno_cep?>').value = cep;
	this.window.close();
}

function retorna_cep(cep) {
	opener.document.getElementById('<?php echo $retorno_cep?>').value = cep;
	this.window.close();
}
</script>
<html>
<head>
	<title>Procura por CEP</title>
	<LINK REL="StyleSheet" HREF="css/lucato.css" type="text/css">
	<LINK REL="StyleSheet" HREF="css/rel_comum.css" type="text/css">
</head>
<body>
<center>
<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro" nowrap="nowrap"><?if($modo=="logradouro") echo "Consulta por CEP"; else echo "COnsulta por Logradouro";?></th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
</table>
<form name="frm_busca_cep" style="margin: 0px;padding: 0px;" id="frm_busca_cep" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
	<input type="hidden" name="enviado" id="enviado" value="ok" />
	<table class='formeditar' style='width:50%;'>
	<?
	if($modo == "logradouro") {
		echo "<input type=\"hidden\" name=\"modo\" id=\"modo\" value=\"logradouro\" />";
		echo $sid_post;
		echo "<input type=\"hidden\" name=\"retorno_endereco\" id=\"retorno_endereco\" value=\"".$retorno_endereco."\" />";
		echo "<input type=\"hidden\" name=\"retorno_bairro\" id=\"retorno_bairro\" value=\"".$retorno_bairro."\" />";
		echo "<input type=\"hidden\" name=\"retorno_municipio\" id=\"retorno_municipio\" value=\"".$retorno_municipio."\" />";
		echo "<input type=\"hidden\" name=\"retorno_estado\" id=\"retorno_estado\" value=\"".$retorno_estado."\" />";
		echo "<input type=\"hidden\" name=\"retorno_cep\" id=\"retorno_cep\" value=\"".$retorno_cep."\" />";
		$cep = (strlen($cep) == 8) ? substr($cep,0,5)."-".substr($cep,5,3) : "";
		echo "
		<tr>
			<th colspan='2'>Digite o CEP sem nenhuma separação</th>
		</tr>
		<tr>
			<td><input type=\"text\" name=\"cep\" id=\"cep\" value=\"$cep\" /></td>
			<td><input type=\"submit\" name=\"btn_envia\" id=\"btn_envia\" value=\" Pesquisar \" /></td>
		</tr>
		";
		if($busca_cep == "ok") {
			if($CEP_R->NEXT()) {
				$end = $CEP_R->BYNAME("TIPO")." ".$CEP_R->BYNAME("LOG_NOME");
				$bairro_enc = $CEP_R->BYNAME("BA_NOME");
				$mun = $CEP_R->BYNAME("LOC_NOME");
				$ufe = $CEP_R->BYNAME("UF");
				$complemento = $CEP_R->BYNAME("COMPLEMENTO");
				$cep = substr($CEP_R->BYNAME("CEP"),0,5)."-".substr($CEP_R->BYNAME("CEP"),5,3);
				echo "<tr><td colspan='2'><span id=\"retorna_valor\" onclick=\"retorna_logradouro('".strtoupper($end)."','".strtoupper($bairro_enc)."','".strtoupper($mun)."','".strtoupper($ufe)."','".strtoupper($cep)."')\" style=\"cursor: pointer\">$end";

				if(!empty($complemento)) echo " $complemento";
				echo "<br >$bairro_enc - $mun/$ufe</span>
				</td></tr>
				";


				while($CEP_R->NEXT()) {
					$end = $CEP_R->BYNAME("TIPO")." ".$CEP_R->BYNAME("LOG_NOME");
					$bairro_enc = $CEP_R->BYNAME("BA_NOME");
					$mun = $CEP_R->BYNAME("LOC_NOME");
					$ufe = $CEP_R->BYNAME("UFE");
					$complemento = $CEP_R->BYNAME("COMPLEMENTO");
					$cep = substr($CEP_R->BYNAME("CEP"),0,5)."-".substr($CEP_R->BYNAME("CEP"),5,3);
					echo "<tr><td colspan='2'><span id=\"retorna_valor\" onclick=\"retorna_logradouro('$end','$bairro_enc','$mun','$ufe','$cep')\" style=\"cursor: pointer\">$end";
					if(!empty($complemento)) echo " $complemento";
					echo "<br >$bairro_enc - $mun/$ufe</span></td></tr>";
				}
			} else {
				echo "<tr><td colspan='2'>Nenhum endereço localizado com o cep informado!</td></tr>";
			}
		}
	} elseif($modo == "cep") {
		echo "<input type=\"hidden\" name=\"retorno_cep\" id=\"retorno_cep\" value=\"".$retorno_cep."\" />";
		echo "<input type=\"hidden\" name=\"modo\" id=\"modo\" value=\"cep\" />";
		echo "<input type=\"hidden\" name=\"enviado\" id=\"enviado\" value=\"ok\" />";
		echo $sid_post;
		echo "<tr><th>Estado</th><th>Cidade</th><th>Logradouro</th><th>Tipo</th><th></th></tr><tr>";
		echo "<td><select name=\"estado\" id=\"estado\" /><option value=\"\"></option>";
		for($i=0;$i<count($estados);$i++) {
			echo "<option value=\"$estados[$i]\">$estados[$i]</option>";
		}
		echo "</select>";
		echo "</td>";
		echo "<td><input type=\"text\" name=\"cidade\" id=\"cidade\" /></td>";
		echo "<td><input type=\"text\" name=\"logradouro\" id=\"logradouro\" /></td>";
		echo "<td><select name=\"tipo\" id=\"tipo\" /><option value=\"tudo\"></option>";
		for($i=0;$i<count($tipos);$i++) {
			echo "<option value=\"$tipos[$i]\">$tipos[$i]</option>";
		}
		echo "</select></td>";
		echo "<td><input type=\"submit\" name=\"btn_envia\" id=\"btn_envia\" value=\" Pesquisar \" />";
		echo "</td></tr>";
		if(!empty($enviado)) {
			if($CEP_R->NEXT()) {
				$cidade = $VER_CIDADE->BYNAME("NOME");
				$estado = $CEP_R->BYNAME("UF");
				$logradouro = $CEP_R->BYNAME("TIPO")." ".$CEP_R->BYNAME("LOG_NOME");
				$complemento = $CEP_R->BYNAME("COMPLEMENTO");
				$bairro = $CEP_R->BYNAME("BA_NOME");
				$cep = substr($CEP_R->BYNAME("CEP"),0,5)."-".substr($CEP_R->BYNAME("CEP"),5,3);
				echo "<tr><td colspan='5'><span id=\"retorna_valor\" onclick=\"retorna_cep('$cep')\" style=\"cursor: pointer\">$logradouro";
				if(!empty($complemento)) echo " $complemento";
				echo "<br />$bairro $cidade-$estado $cep</span></td></tr>";
				while($CEP_R->NEXT()) {
					$cidade = $VER_CIDADE->BYNAME("NOME");
					$estado = $CEP_R->BYNAME("UF");
					$logradouro = $CEP_R->BYNAME("TIPO")." ".$CEP_R->BYNAME("LOG_NOME");
					$complemento = $CEP_R->BYNAME("COMPLEMENTO");
					$bairro = $CEP_R->BYNAME("BA_NOME");
					$cep = $CEP_R->BYNAME("CEP");
					echo "<tr><td colspan='5'><span id=\"retorna_valor\" onclick=\"retorna_cep('$cep')\" style=\"cursor: pointer\">$logradouro";
					if(!empty($complemento)) echo " $complemento";
					echo "<br />$bairro $cidade-$estado $cep</span></td></tr>";
				}
				echo"";
			} else {
				echo "<tr><td colspan='5'>A consulta não retornou nenhum resultado!</td></tr>";
			}
		}
	}
	?>
	</table>
</form>
</center>
</body>
</html>
