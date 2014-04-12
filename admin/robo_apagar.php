<?
#
# Projeto :  Lucato
# Data : 14/04/2004
#
# Apagar ROBO
#

    //*******************************************************************
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************
	include "includes/library.php";
	include "includes/session.php";

	//--------------------------------------------------------
	//SOURCE
	//--------------------------------------------------------
	$key = request("key");
	$mod = request("mod");

			if ( $modules[$mod]["include"] ) {
					include $modules[$mod]["include"];
			} else {
					//include "includes/ibase_empresa.php";
			}



	$url = urldecode( request("url") );

	if ( !empty( $url ) ) {
		    $campo = $modules[$mod]["edit_key"];
			$tabela  = $modules[$mod]["pesquisa_tabela"];
			$sql = "delete from $tabela where $campo = '$key'";
			$UPD = new QUERY($DATABASE,$sql);
			$UPD->FREE();
			if($mod == "usuario") {
				//include "includes/ibase_empresa.php";
				$sql_del_grupo = "DELETE FROM GRUPO_MEMBRO WHERE ID_USUARIO = '$key'";
				$UPD_GRUPO = new QUERY($BANCO_GRUPO, $sql_del_grupo);
				$UPD_GRUPO->FREE();
			}
			do_redirect($url);
	} else {
			do_redirect("area_usuario.php?$sid_get");
	}


?>
