<?
#
# Projeto :  Lucato
# Data : 19/04/2005
#
# Popup Permiss�o dos Usu�rios
#

  //*******************************************************************
	// INCLUDES nao alterar a ordem dos includes
  //*******************************************************************
	include "includes/library.php";
	include "includes/session.php";
	//include "includes/ibase_empresa.php";
	$BANCO = new DATABASE();
	$id = request("id");
	$sql = "DELETE FROM PERMISSAO WHERE ID_USUARIO = '$id'";
	$OK = new QUERY($BANCO, $sql);
?>