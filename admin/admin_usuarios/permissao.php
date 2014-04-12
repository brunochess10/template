<?php
//AUTOR ( EXEMPLO
//$modulos["autor"]["insert"] = "$administrador || $gerente || $atendente";
//$modulos["autor"]["edit"] =  "$administrador || $gerente || $atendente || $administradorEscritorio";
//$modulos["autor"]["delete"] =  "$administrador";
//$modulos["autor"]["report"] = "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["search"] =  "$administrador || $gerente || $atendente || $administradorEscritorio || $advogado";
//$modulos["autor"]["::group::"] = "Autor";


//PÁGINA DE USUARIOS DO ADMIN
$modulos["admin_usuarios"]["insert"] = "$supervisor";
$modulos["admin_usuarios"]["edit"] =  "$supervisor";
$modulos["admin_usuarios"]["delete"] =  "$supervisor";
$modulos["admin_usuarios"]["report"] = "$supervisor";
$modulos["admin_usuarios"]["search"] =  "$supervisor";
$modulos["admin_usuarios"]["::group::"] = "Dados dos Usuários do Web Site";
?>