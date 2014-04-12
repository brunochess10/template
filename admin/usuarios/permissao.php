<?php
//AUTOR ( EXEMPLO
//$modulos["autor"]["insert"] = "$administrador || $gerente || $atendente";
//$modulos["autor"]["edit"] =  "$administrador || $gerente || $atendente || $administradorEscritorio";
//$modulos["autor"]["delete"] =  "$administrador";
//$modulos["autor"]["report"] = "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["search"] =  "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["::group::"] = "Autor";

//PÁGINA DE USUÁRIOS
$modulos["usuarios"]["insert"] = "$supervisor";
$modulos["usuarios"]["edit"] =  "$supervisor";
$modulos["usuarios"]["delete"] =  "";
$modulos["usuarios"]["report"] = "$supervisor";
$modulos["usuarios"]["search"] =  "$supervisor";
$modulos["usuarios"]["::group::"] = "Dados dos usuários";
?>