<?php
#
# Projeto :  Gerenciador do web site
# Data : 11/11/2011
# Modificado: 11/11/2011
#
# User Login
#
    //*******************************************************************
	// INCLUDES
    //*******************************************************************
	include "includes/library.php";
	
    //*******************************************************************
	// SOURCE
    //*******************************************************************
	$user = request("user");
	$pass = request("pass");
	$ERRORS = "";
	if ( (!empty($user)  ) && ( !empty($pass) )  ){
				
				/******************************************************************
				* Dá um include no arquivo base_dados.php
				* e coloca todos os SQL
				******************************************************************/
				include "base_dados.php";
				/******************************************************************
				* Dá um include no arquivo base_dados.php
				* e coloca todos os SQL
				******************************************************************/
				
				/******************************************************************
				/validar usuario e senha
				******************************************************************/
				$sql = "select * from site_usuario where usuario = '$user'";
				$USUARIO = new QUERY( $DATABASE,$sql);
				$USUARIO->NEXT();
				if(    ($USUARIO->BYNAME("senha") == $pass)   ){
					$login = true;
				} else {
					$login = false;
				}

				if($login) {
					
					//inicialização login
					$net_id =  md5(rand(0,9999999));

					session_name("net_id");
					session_id($net_id);
					session_start();

					set_session("USER", $user);
					set_session("USER_NOME", $USUARIO->BYNAME("PRIMEIRO_NOME")  . $USUARIO->BYNAME("ULTIMO_NOME") );
					set_session("USER_EMAIL", $USUARIO->BYNAME("EMAIL") );
					
					set_session("last_access", time() );
					
					set_session("USER_NIVEL", 1 );
					$USUARIO->FREE();

					do_redirect("area_usuario_controle.php?net_id=$net_id");
				} else {
					if ( $USUARIO->BYNAME("ID") <= 0 ) {
						$message = "Usuário inválido.";
						$field = "user";
					} elseif($hora_nao_permitida) {
						$message = "Horário não permitido.";
						$field = "pass";
					} else {
						$message = "Senha inválida.";
						$field = "pass";
					}

					$ERRORS = LoadErrorsServidor_add($message,"document.formlogin." . $field);
				}
				$USUARIO->FREE();
			//---

	} 
	
include( "includes/top.php" ); 
?>
<div style="backgroud-color:#FFFFFF">
<script language="javascript">
	function LoadErrorsServidor() {
		<?php echo $ERRORS?>
		ShowListErrors();
	}
</script>
<script type="text/javascript" src="scripts/user_login.js"></script>
<div style="position:absolute;z-index:4;text-aling:center;margin:20px;" >
<? include( "includes/mensagem_erro.php" ); ?>
</div>

<form name="formlogin" action="user_login.php"  method="post" onsubmit="return consiste(this);">
<table class="login" style="margin-top:250px;" >
<tbody>
	<tr>	
		<th colspan="2"></td>
	</tr>
	<tr>
		<th style="color:#359ecd;width:100px;padding-left:5px;" >Usuário</th>
		<td><input type="text" name="user" value="<?php echo show($user)?>" style='border-color:#359ecd'></td>
	</tr>
	<tr >
		<th style="color:#359ecd;padding-left:5px;">Senha</th>
		<td><input type="password" name="pass" value="" style='border-color:#359ecd'></td>
	</tr>
	<tr>	
		<th colspan="2"></td>
	</tr>
	<tr>
</tbody>
<tfoot>
	<tr >
		<td></td>
		<td><input type="submit" value="Logar" style="width: 100px;border-color:#359ecd;color:#359ecd;margin-bottom:4px;"><br></td>
	</tr>
</tfoot>
</table>

<br clear="all"/>
<br/>
</form>
<? include( "includes/bottom.php" ); ?>