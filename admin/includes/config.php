<?php
#
# Projeto :  Novo Admin do Neo Site Cont�bil
# Data : 11/11/20011 
# Arquivo de configura��o do banco de dados
#
		
	/******************************************************************
	* Includde da configura��o de Database do CodeIgniter
	*******************************************************************/
	
	if (file_exists("personalizado.txt")){
		include "../application_custom/config/database.php";
		$personalizado = true;
	}else{
		$personalizado = false;
		include "../application/config/database.php";	
	}	
	//*******************************************************************
	// Configura��o MySQL
	//*******************************************************************
	$mysql_server = $db['default']['hostname'];
	$mysql_databasename = $db['default']['database'];
	$mysql_user = $db['default']['username'];
	$mysql_pass = $db['default']['password'];

	//headers
	//para sempre expirar a p�gina e sempre q for acessada fazer o download do servidor
	//header("Expires: 0"); 
	
	$sql  = "SHOW TABLES LIKE '%site_dados%'";
	$EXISTE = new QUERY($DATABASE,$sql);
	if ($EXISTE->NEXT()){
	
	//faz consulta apenas para definir as vari�veis constantes
	//faz consulta apenas para definir as vari�veis constantes
	//faz consulta apenas para definir as vari�veis constantes		
	$query="SELECT * FROM site_dados ORDER BY id LIMIT 0,1";
	$DADOS = new QUERY($DATABASE,$query);
	$DADOS->NEXT();
	//exemplo se voc� quiser o logradouro voc� deve colocar $DADOS->BYNAME("logradouro"]
	//exemplo se voc� quiser o logradouro voc� deve colocar $DADOS->BYNAME("cep"]
	//exemplo se voc� quiser o logradouro voc� deve colocar $DADOS->BYNAME("bairro"]
			
    
	//*******************************************************************
	// Configura��o Web Site
	//*******************************************************************
	define('ANO_SITE', date('Y'));
	define('TITULO_SITE', $DADOS->BYNAME("titulo_site"));
    define('NOME_FANTASIA', $DADOS->BYNAME("nome_fantasia"));
    define('ENDERECO', $DADOS->BYNAME("logradouro").", ".$DADOS->BYNAME("numero")." ".$DADOS->BYNAME("complemento")." ".$DADOS->BYNAME("bairro"));
	define('ENDERECO_GOOGLE',$DADOS->BYNAME("logradouro").", ".$DADOS->BYNAME("numero")." - ".$DADOS->BYNAME("cidade")." - ".$DADOS->BYNAME("estado"));
    define('CIDADE', $DADOS->BYNAME("cidade"));
	define('BAIRRO',$DADOS->BYNAME("bairro"));
    define('ESTADO', $DADOS->BYNAME("estado"));
	define('CEP', $DADOS->BYNAME("cep"));
    define('TEL',"<small>".$DADOS->BYNAME("ddd")."</small> ".$DADOS->BYNAME("telefone_1"));
    define('TEL2',"<small>".$DADOS->BYNAME("ddd")."</small> ".$DADOS->BYNAME("telefone_2"));
    define('TEL3',"<small>".$DADOS->BYNAME("ddd")."</small> ".$DADOS->BYNAME("telefone_3"));
    define('TEL4',"<small>".$DADOS->BYNAME("ddd")."</small> ".$DADOS->BYNAME("telefone_4"));
    define('FAX',"<small>".$DADOS->BYNAME("ddd")."</small> ".$DADOS->BYNAME("fax"));
    define('ATENDIMENTO',$DADOS->BYNAME("horario_funcionamento"));
	define('LOCALIZACAO',$DADOS->BYNAME("localizacao"));
	define('TOPO_BOLETIM',$DADOS->BYNAME("topo_boletim"));
	define('COR_BOLETIM',$DADOS->BYNAME("cor_boletim"));
	if ($DADOS->BYNAME("css_boletim")!=""){
		define('CSS_BOLETIM',$DADOS->BYNAME("css_boletim"));
	}else{
		define('CSS_BOLETIM',"border:solid 1px #000000");
	}
	define('CSS_BOLETIM_RODAPE',$DADOS->BYNAME("css_boletim_rodape"));	
	
	//********************************************************************
	//Chave de exporta��o do Net Cont�bil e dados para acesso do site
	//********************************************************************
	define('CHAVE_EXPORTACAO',$DADOS->BYNAME("chave_exportacao"));
	define('HTTPS_NETCONTABIL' , $DADOS->BYNAME("endereco_seguro"));
	define('ENDERECO_XML',$DADOS->BYNAME("endereco_netcontabil"));
    define('HTTP_CONTEUDOCONTABIL', "http://www.netcontabil.com.br/package_update/conteudo");
	//*******************************************************************	
	//*******************************************************************	
	
		
	//*******************************************************************
	//seleciona os dados para enviar o email e mostrar login do web mail na p�gina principal	
	//seleciona os dados para enviar o email 	
	//*******************************************************************
	$query="SELECT * FROM site_email ORDER BY id LIMIT 0,1";
	$EMAIL = new QUERY($DATABASE,$query);
	$EMAIL->NEXT();
	
	/*
	 * DOMINIO para o webmail
	 */
	define(DOMINIO,$EMAIL->BYNAME("dominio")); // dom�nio do site
	define(WEBMAIL,$EMAIL->BYNAME("webmail")); // dom�nio do site
	/*
	 * FIM DOMINIO para o webmail
	 */
	
	//*******************************************************************
	//fim do seleciona e-mail
	//fim do seleciona e-mail
	//*******************************************************************		

	//*******************************************************************
	// Configura��o ENVIO DE EMAILS BOLETINS
	//*******************************************************************
	define('EMAIL_FROM', $EMAIL->BYNAME("email"));
	if ($EMAIL->BYNAME("smtp_mail")==""){
		define('EMAIL_METHOD', "smtp");	
	}else{
		define('EMAIL_METHOD',$EMAIL->BYNAME("smtp_mail"));
	}
	
	define('CHARSET',$EMAIL->BYNAME("charset"));
	$smtp["use"] =  true;
	$smtp["host"] = $EMAIL->BYNAME("smtp");
	$smtp["port"] = $EMAIL->BYNAME("porta");
	$smtp["auth_type"] = $EMAIL->BYNAME("tipo_autenticacao");
	$smtp["hello"] = $EMAIL->BYNAME("dominio") ;
	$smtp["auth"] = true;
	$smtp["user"] = $EMAIL->BYNAME("usuario");
	$smtp["pass"] = $EMAIL->BYNAME("senha");
	if ($EMAIL->BYNAME("gateway")==""){
		$smtp["use_gateway"] = false;	
	}else{
		$smtp["use_gateway"] = true;
	}
	$smtp["charset"] = $EMAIL->BYNAME("charset");
	
	}
	//*******************************************************************
	// Setar Diret�rio Template 
	//*******************************************************************
	 $DIR_TEMPLATE = "templates/"; // sempre com barra no final


	//*******************************************************************
	// Setar configura��es para todas as p�ginas 
	//*******************************************************************
	

	//tempo de dura��o de uma session � de 1 hora
	ini_alter("session.cookie_lifetime", "3600");
	
	// for�ar para q o netcontabil de o comando de inicio de session
	ini_set("session.auto_start","Off");

	// for�ar register_globals para Off para manter compatibilidade entre vers�es PHP..
	ini_set ("register_globals", "Off");

	// for�ar os avisos para naum aparecerem para manter  compatibilidade entre vers�es PHP..
	//error_reporting(E_ALL & ~ E_NOTICE); 
	error_reporting(0); 

	// para naum colocar sozinho a variavel da session na URL
	ini_set("url_rewriter.tags","");
	
	// tempo de execu��o do script 2 minutos default
	set_time_limit( 120 );
	
?>
