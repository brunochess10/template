<?php
error_reporting(0);
$supervisor = 1;

$modulos = array();

//AUTOR ( EXEMPLO
//$modulos["autor"]["insert"] = "$administrador || $gerente || $atendente";
//$modulos["autor"]["edit"] =  "$administrador || $gerente || $atendente || $administradorEscritorio";
//$modulos["autor"]["delete"] =  "$administrador";
//$modulos["autor"]["report"] = "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["search"] =  "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["::group::"] = "Autor";

//verificar as permissoes de todos os modulos
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";
$path="";
$path_os = (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") ? "\\" : "/";
$aux_dir = explode($path_os,dirname(__FILE__));
for ($i=0;$i<count($aux_dir)-1;$i++){
	$path.=$aux_dir[$i].$path_os ;
}

//$path = $path;
$diretorio = dir($path);
while($arquivo = $diretorio->read()){
	  if ((file_exists($path.$arquivo."/permissao.php"))&&($arquivo!="includes")){	
		include $path.$arquivo."/permissao.php";
	  }
}
$diretorio->close();

//Verifica se é permitido
function is_allowed( $user_nivel, $mod, $action, $id_user = "0" ) {
		global $modulos;
		$result = false;
		$niveis = explode( " || ", $modulos[$mod][$action] );
		for ( $i = 0; $i < count($niveis); $i++){
			if ( $niveis[ $i ] == $user_nivel ) {
				$result = true;
			}
		}
	return $result;
}
?>