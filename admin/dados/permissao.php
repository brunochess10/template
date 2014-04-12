<?php
//AUTOR ( EXEMPLO
//$modulos["autor"]["insert"] = "$administrador || $gerente || $atendente";
//$modulos["autor"]["edit"] =  "$administrador || $gerente || $atendente || $administradorEscritorio";
//$modulos["autor"]["delete"] =  "$administrador";
//$modulos["autor"]["report"] = "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["search"] =  "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["::group::"] = "Autor";

//DADOS DO ESCRITÓRIO
$modulos["dados"]["insert"] = "$supervisor";
$modulos["dados"]["edit"] =  "$supervisor";
$modulos["dados"]["delete"] =  "";
$modulos["dados"]["report"] = "$supervisor";
$modulos["dados"]["search"] =  "$supervisor";
$modulos["dados"]["::group::"] = "Dados do escritório";

?>