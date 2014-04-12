<?php
error_reporting(0);
#
# Projeto :  Lucato
# Data : 14/02/2004
# Modificado : 14/09/2004
#
# Arquivo com estrutura dos modulos de cadastros
#

##############################
# MODULO AUTOR ( EXEMPLO )
##############################
//$modules["autor"]["pesquisa_titulo"] = "Pesquisa de Autor/Réu";
//$modules["autor"]["pesquisa_tabela"] = "AUTOR";
//$modules["autor"]["pesquisa_campos"] = "RE,NOME, NOME_PESQUISA";
//$modules["autor"]["pesquisa_ordem"] = "NOME";
//$modules["autor"]["edit_key"] = "ID_AUTOR";
//$modules["autor"]["edit_titulo"] = "Editar Autor/Réu";

//$modules["autor"]["detail_titulo"] = "Detalhe do Autor/Réu";

//$modules["autor"]["insert_titulo"] = "Inserir novo Autor/Réu";

//$modules["autor"]["report_titulo"] = "Relatório Autor/Réu";

//$modules["autor"]["delete_titulo"] = "Excluir Autor/Réu";
###############################
$path_modulo="";
$path_os = (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") ? "\\" : "/";
$aux_dir_modulo = explode($path_os,dirname(__FILE__));
for ($i=0;$i<count($aux_dir_modulo)-1;$i++){
	$path_modulo.=$aux_dir_modulo[$i].$path_os;
}

//$path = $path;
$diretorio = dir($path_modulo);

while($arquivo = $diretorio->read()){
	  if ((file_exists($path_modulo.$arquivo."/modulo.php"))&&($arquivo!="includes")){	
		include $path_modulo.$arquivo."/modulo.php";
	  }
}
$diretorio->close();



?>