<?
#
# Projeto :  Lucato
# Data : 08/04/2005
#
# Popup Permissão dos Usuários
#

  //*******************************************************************
	// INCLUDES nao alterar a ordem dos includes
  //*******************************************************************
	include "includes/library.php";
	include "includes/session.php";
	//include "includes/ibase_empresa.php";
	$BANCO = new DATABASE();
	include "includes/ibase_common.php";
	$BANCO_COMUM = new DATABASE();

if(request("enviado") == "ok") {
	$id_user = request("id_user");
	$sql = "DELETE FROM PERMISSAO WHERE ID_USUARIO = '$id_user'";
	$APAGA = new QUERY($BANCO, $sql);
	foreach($_POST as $chave => $valor) {
		if(strpos($chave, "--") !== false) {
			$pedacos = explode("--",$chave);
			$modulo = $pedacos[0];
			$action = $pedacos[1];
			$sql = "INSERT INTO PERMISSAO (ID_PERMISSAO,ID_USUARIO,MODULO,PERMISSAO) VALUES (GEN_ID(GERADOR,1),'$id_user','$modulo','$action')";
			$INSERE = new QUERY($BANCO, $sql);
		}
	}
	echo "<script>alert('Dados atualizados!');</script>";
	die();
}

?>
<html>
<head>
<title>Office Web</title>
</head>
<LINK REL="StyleSheet" HREF="css/lucato.css" type="text/css">
<LINK REL="StyleSheet" HREF="css/rel_comum.css" type="text/css">

<body>
<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"  nowrap="nowrap"> Permissões do Usuário</th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>

<script>
function de_select_all(modo) {
	var coll = document.forms[0];
	if (coll!=null) {
		for (i=0; i<coll.length; i++) {
			if(coll.item(i).type == 'checkbox') {
				if(modo == 'desmarca') {
					coll.item(i).checked = '';
				} else {
					coll.item(i).checked = 'checked';
				}
			}
		}
	}
}
</script>

<?

	$id_user = request("id");
	$sql_nivel = "SELECT * FROM USUARIO WHERE ID_USUARIO = '$id_user'";
	$NIVEL_USER = new QUERY($BANCO_COMUM, $sql_nivel);
	$NIVEL_USER->NEXT();
	$nivel = $NIVEL_USER->BYNAME("NIVEL");
	$sql_permissoes = "SELECT * FROM PERMISSAO WHERE ID_USUARIO = '$id_user'";
	$PERMISSOES = new QUERY($BANCO, $sql_permissoes);
	$permissoes_usuario = Array();
	$achou_bd = false;
	while($PERMISSOES->NEXT()) {
		$achou_bd = true;
		$permissoes_usuario[$PERMISSOES->BYNAME("MODULO")][] = $PERMISSOES->BYNAME("PERMISSAO");
	}
	# print($achou_db);
	# var_dump($permissoes_usuario);
	# die();
	function is_allowed_especial( $user_nivel, $mod, $action) {
		global $modulos;
		global $permissoes_usuario;
		global $achou_bd;
		$result = false;

		if($achou_bd) {
			for($a=0;$a<count($permissoes_usuario[$mod]);$a++) {
				# var_dump($permissoes_usuario[$mod][$a]);
				# die();
				if($permissoes_usuario[$mod][$a] == $action) {
					$result = true;
					break;
				}
			}
		} else {
			$niveis = explode( " || ", $modulos[$mod][$action] );
			for ( $i = 0; $i < count($niveis); $i++){
				if ( $niveis[ $i ] == $user_nivel ) {
					return true;
				}
			}
		}

		return $result;
	}

	$translate = Array("insert" => "Inserir","edit" => "Editar","delete"=>"Deletar","report"=>"Relatório","search"=>"Pesquisa","hour"=>"Horário","permission"=>"Permissão");
	$bunt = Array(
	"autor"=>"Autor",
	"autorizar_autor"=>"Autorizar",
	"autor_herdeiro"=>"Herdeiro",
	"autor_pagamento"=>"Pagamento",
	"autor_atendimento"=>"Atendimento",
	"processo"=>"Processo",
	"processo_autor"=>"Autor",
	"processo_pericia"=>"Perícia",
	"processo_analise"=>"Análise",
	"processo_advogado"=>"Advogado",
	"processo_andamento"=>"Andamento",
	"processo_parcela"=>"Parcela",
	"resumo_individual"=>"Resumo Individual",
	"resumo"=>"Resumo",
	"parcela"=>"Parcela",
	"parcela_pagamento"=>"Pagamento Parcelas",
	"usuario"=>"Usuário",
	"planilha"=>"Planilha",
	"banco"=>"Banco",
	"tabelas"=>"Tabelas",
	"irrf"=>"IRRF",
	"cpmf"=>"CPMF",
	"indice"=>"Índice",
	"inss"=>"INSS",
	"grupo"=>"Grupo",
	"grade"=>"Grade de Acesso",
	"juiz"=>"Juiz",
	"insuficiencia"=>"Insuficiência"
	);

	$unicas = Array(0=>"lufas");

	foreach($modulos as $chave => $valor) { // MONTA ARRAY COM OS MODULOS E AS ACOES
		$mods[] = $chave;
		$command = '$' . $chave . '[] = "lufas";';
		EVAL($command);
		foreach($valor as $perm => $valor2) {
			if($perm != "::group::") {
				$comando = '$' . $chave . '[] = "' . $perm . '";';


				$achou = false;
				for( $y = 0; $y < count($unicas); $y++ ){
						if( $unicas[ $y ] == $perm ){
								$achou = true;
								break;
						}
				}
				if(!$achou) $unicas[] = $perm;


				EVAL( $comando );
			} else {
				$grupos[] = $valor2;
			}
		}
	}
	# echo "<pre>";
	# var_dump($mods);
	# die();
	$total_permissoes = count($unicas);
	echo "<iframe name=\"hiddenProcess\" id=\"hiddenProcess\" style=\"display: none\"></iframe>";
	echo "<form name=\"frm_permissao\" id=\"frm_permissao\" style=\"padding:0px;margin:0px;\" target=\"hiddenProcess\" method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\"><input type=\"hidden\" name=\"id_user\" id=\"id_user\" value=\"$id_user\" /><input type=\"hidden\" name=\"enviado\" id=\"enviado\" value=\"ok\" />";
	echo $sid_post;
	echo "
	<table class=\"formeditar\" align=\"center\">
		<tr>
			<th>Modo de Seleção</th>
			<td align=\"center\">
			<input type=\"button\" value=\"Marcar todos\" onclick=\"de_select_all('marca')\" class=\"botaocontrole\" style=\"cursor:pointer;width:100px;\"\>
			<input type=\"button\" value=\"Desmarcar todos\"onclick=\"de_select_all('desmarca')\" class=\"botaocontrole\" style=\"cursor:pointer;width:110px;\"\>
			</td>
		</tr>

	</table>";

	echo "<table class=\"formeditar\" align=\"center\"><tbody>";
	$grupo_anterior = "";
	$colspan = $total_permissoes;
	for($i=0;$i<count($mods);$i++) { // MONTA A TABELA COM O NOME DOS MODULOS E AS ACOES DISPONIVEIS PARA AQUELE MODULO
		$grupo_atual = $grupos[$i];
		$name_mod = $mods[$i];
		$name_mod_exib = $bunt[$name_mod];
		if($grupo_atual != $grupo_anterior) {
			echo "<tr><th><strong style='text-transform: uppercase;height:16px;'>$grupo_atual</strong></th>";
			for($x=1;$x<$total_permissoes;$x++) { // ESCREVE O TOPO DA TABELA COM O NOME DAS ACOES
				$var2 = $unicas[$x];
				echo "<td align=\"center\"><span style='padding-left:4px;padding-right:2px;color:#346767;border:solid 1px #BBBBBB;background-color:#f3f3f3;font-family:tahoma;'>$translate[$var2]</span></td>";
			}
			echo "</tr>";
			$grupo_anterior = $grupo_atual;
		}
		echo "<tr><th>$name_mod_exib</th>";
		for($a=1;$a<$total_permissoes;$a++) {
			echo "<td align=\"center\">";
				if(array_search($unicas[$a],$$name_mod)) {
					echo "<input type=\"checkbox\" id=\"".$name_mod."--".$unicas[$a]."\" name=\"".$name_mod."--".$unicas[$a]."\" ";
					if(is_allowed_especial($nivel, $name_mod, $unicas[$a])) { // VERIFICA SE O USUÁRIO TEM PERMISSAO E "CHECA" O CHECKBOX
						echo "checked ";
					}
					echo "/>\n";
				} else {
					echo "&nbsp;";
				}
			echo "</td>";
		}
		echo "</tr>";
	}

	echo "<tr><td colspan=\"8\" align=\"center\"><br/><input type=\"submit\" name=\"btn_enviar\" id=\"btn_enviar\" value=\" Enviar \"/><br/><br/></td></tr>";
	echo "</tbody></table>";
	echo "</form>";

?>
</body>
</html>
