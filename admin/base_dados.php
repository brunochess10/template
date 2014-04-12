<?php
					function verifica_campo($tabela,$campo){
						$sql = "show columns from $tabela";
						$VERIFICA = new QUERY($DATABASE,$sql);
						while ($VERIFICA->NEXT()){
							if ($VERIFICA->BYNAME('Field')==$campo){
								$VERIFICA->FREE();	
								return true;
							}
							
						}
						$VERIFICA->FREE();
						return false;
					}

					/***********************************************************
					* CRIA AS TABELAS CASO NÃO EXISTAM
					* CRIA AS TABELAS CASO NÃO EXISTAM
					************************************************************/
					
					/***********************************************************
					* CRIA A TABELA DO BANNER
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_aviso (
						   id int(11) NOT NULL auto_increment,
						   data date default NULL,
                           titulo varchar(255) default NULL,
                           texto text,
                           publicar char(1) default NULL,
                           PRIMARY KEY  (id)
                           ) ";
					
					$BANNER = new QUERY($DATABASE,$sql);
					$BANNER->FREE();
					
					$sql = "SELECT COUNT(*) AS TOTAL FROM site_aviso";
					$AVISO = new QUERY($DATABASE,$sql);
					$AVISO->NEXT();
					
					if ($AVISO->BYNAME("TOTAL")=="0"){
						$sql = "INSERT INTO site_aviso (titulo) VALUES('Titulo do Aviso')";
						$DADOS= new QUERY($DATABASE,$sql);
					}
					
					$AVISO->FREE();
					/***********************************************************
					* CRIA A TABELA AREA_MAIL
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS area_mail (
						   arm_id int(11) NOT NULL auto_increment,
						   arm_mail_id int(11) NOT NULL default '0',
						   arm_area_id int(11) NOT NULL default '0',
						   PRIMARY KEY  (arm_id)
					)";
					
					$AREA_MAIL = new QUERY($DATABASE,$sql);
					
					/***********************************************************
					* CRIA A TABELA AREA_MAILING
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS area_mailing (
						   aru_id int(11) NOT NULL auto_increment,
                           aru_mailing_id int(11) NOT NULL default '0',
                           aru_area_id int(11) NOT NULL default '0',
                           aru_flag_net_contabil char(1) default NULL,
                           PRIMARY KEY  (aru_id)
					)";
					
					$AREA_MAILING = new QUERY($DATABASE,$sql);					
					$AREA_MAILING->FREE();
					
					/***********************************************************
					* CRIA A TABELA AREA_NEWSLETTER
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS area_newsletter (
						   are_id int(11) NOT NULL auto_increment,
                           are_titulo varchar(200) NOT NULL default '',
						   PRIMARY KEY  (are_id)
					)";
					
					$AREA_NEWSLETTER = new QUERY($DATABASE,$sql);	
					$AREA_NEWSLETTER->FREE();
					
					$sql = "SELECT COUNT(*) AS TOTAL FROM area_newsletter";
					
					$DADOS = new QUERY($DATABASE,$sql);
					$DADOS->NEXT();
					
					if ($DADOS->BYNAME("TOTAL")=="0"){
						$sql = "INSERT INTO area_newsletter (are_titulo) VALUES('Geral')";
						$DADOS= new QUERY($DATABASE,$sql);
					}
					$DADOS->FREE();
					
					/***********************************************************
					* CRIA A TABELA LOG_MAIL
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS log_mail (
						   mail_id int(11) default NULL,
						   mailing_id int(11) default NULL,
						   status int(11) default NULL,
						   msg_erro text
					)";
					
					$LOG_MAIL = new QUERY($DATABASE,$sql);
					$LOG_MAIL->FREE();
					
					/************************************************************
					* ATUALIZA A TABELA LOG_MAIL para o Novo Neo Site contábil
					*************************************************************/
					//$sql = "show columns from log_mail where field='mailing_id'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'log_mail' AND COLUMN_NAME =  'mailing_id' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					if (!verifica_campo("log_mail","mailing_id")){
						$sql = "ALTER TABLE log_mail ADD mailing_id INT(11)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from log_mail where field='status'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'log_mail' AND COLUMN_NAME =  'status' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					if (!verifica_campo("log_mail","status")){
						$sql = "ALTER TABLE log_mail ADD status INT(11)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from log_mail where field='msg_erro'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'log_mail' AND COLUMN_NAME =  'msg_erro' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					if (!verifica_campo("log_mail","msg_erro")){
						$sql = "ALTER TABLE log_mail ADD msg_erro TEXT";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					/***********************************************************
					* CRIA A TABELA DE REENVIO DE E_MAIL  
					*************************************************************/
					$sql= "CREATE TABLE IF NOT EXISTS reenvio_mail (
						   mail_id int(11) default NULL,
						   mailing_id int(11) default NULL,
						   reenviado int(11) default NULL
					)";
					
					$EXECUTA = new QUERY($DATABASE,$sql);
					$EXECUTA->FREE();	
					
					/***********************************************************
					* CRIA A TABELA MAIL
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS mail (
						   mail_id int(11) NOT NULL auto_increment,
						   mail_data date NOT NULL default '0000-00-00',
                           mail_assunto varchar(255) NOT NULL default '',
                           mail_corpo longtext NOT NULL,
                           mail_status int(11) NOT NULL default '0',
                           mail_template int(11) NOT NULL default '0',
                           mail_uniao varchar(1) default NULL,
                           PRIMARY KEY  (mail_id),
                           KEY mail_status (mail_status)
					)";
					
					$MAIL = new QUERY($DATABASE,$sql);
					$MAIL->FREE();
					
					//$sql = "show columns from mail where field='mail_uniao'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'mail' AND COLUMN_NAME =  'mail_uniao' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("mail","mail_uniao")){
						$sql = "ALTER TABLE mail ADD mail_uniao VARCHAR(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}

					/***********************************************************
					* CRIA A TABELA MAILING
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS mailing (
						  usr_id int(11) NOT NULL auto_increment,
                          usr_nome varchar(150) NOT NULL default '',
                          usr_email varchar(100) NOT NULL default '',
                          usr_data_cad date NOT NULL default '0000-00-00',
                          usr_hora_cad time NOT NULL default '00:00:00',
                          usr_ip_cad varchar(15) NOT NULL default '',
                          usr_flag_net_contabil char(1) default NULL,
						  usr_status char(1) default NULL,
						  usr_bounce varchar(255) default NULL,
						  usr_origem varchar(10) default NULL,
                          PRIMARY KEY  (usr_id)
					)";
					
					//no usr_bounce será colocado o motivo pelo qualo usuário foi desativado
					
					$MAILING = new QUERY($DATABASE,$sql);	
					$MAILING->FREE();
					
					if (!verifica_campo("mailing","usr_flag_net_contabil")){
						$sql = "ALTER TABLE mailing ADD usr_flag_net_contabil CHAR(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					if (!verifica_campo("mailing","usr_status")){
						$sql = "ALTER TABLE mailing ADD usr_status CHAR(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					if (!verifica_campo("mailing","usr_bounce")){
						$sql = "ALTER TABLE mailing ADD usr_bounce VARCHAR(255)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					/*
					se usr_origem
					1 - Cadastro pelo Web Site
					2 - Cadastro pela Importação de Lista
					3 - Cadastro pela área administrativa
					4 - Importado pelo Net Contábil
					*/
					
					if (!verifica_campo("mailing","usr_origem")){
						$sql = "ALTER TABLE mailing ADD usr_origem VARCHAR(10)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					
					/***********************************************************
					* CRIA A TABELA MAILING
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_dados (
						   id int(11) NOT NULL auto_increment,
                           titulo_site varchar(255) default NULL,
                           nome_fantasia varchar(255) default NULL,
                           logradouro varchar(255) default NULL,
                           numero int(11) default NULL,
                           complemento varchar(255) default NULL,
						   cidade varchar(255) default NULL,
                           estado varchar(255) default NULL,
                           bairro varchar(100) default NULL,
                           cep varchar(10) default NULL,
                           ddd varchar(11) default NULL,
                           telefone_1 varchar(10) default NULL,
                           telefone_2 varchar(10) default NULL,
                           telefone_3 varchar(10) default NULL,
                           telefone_4 varchar(10) default NULL,
                           fax varchar(10) default NULL,
                           localizacao text,
						   topo_boletim text,
						   cor_boletim varchar(255),
						   logotipo text,
						   css_cor text,
						   pqec varchar(15),
						   pqec_iso varchar(15),
                           horario_funcionamento varchar(255) default NULL,
                           endereco_netcontabil varchar(255) default NULL,
                           chave_exportacao varchar(255) default NULL,
                           endereco_seguro varchar(255) default NULL,
						   visualizar_agenda CHAR(1),
						   visualizar_cotacao CHAR(1),  
						   visualizar_indices CHAR(1),
						   visualizar_noticias CHAR(1),
						   visualizar_boletins CHAR(1),
						   visualizar_pagina_ferramentas CHAR(1),
						   visualizar_pagina_ferramentas_indices CHAR(1),
						   visualizar_pagina_ferramentas_consultas CHAR(1),
						   visualizar_pagina_ferramentas_tabelas CHAR(1),
						   visualizar_pagina_ferramentas_certidoes CHAR(1),
						   visualizar_pagina_ferramentas_guias CHAR(1),
						   visualizar_pagina_boletins CHAR(1),
						   visualizar_pagina_institucional CHAR(1),
						   visualizar_pagina_institucional_empresa CHAR(1),
						   visualizar_pagina_institucional_servicos CHAR(1),
						   visualizar_pagina_galeria_fotos CHAR(1),
						   visualizar_pagina_comparacao CHAR(1),
						   personalizado CHAR(1),
						   css_boletim TEXT,
						   css_boletim_rodape TEXT,
						   certificados text,
						   codigo_coluna TEXT,
						   codigo_rodape TEXT,
                           PRIMARY KEY (id)
						)";
					
					$DADOS = new QUERY($DATABASE,$sql);												
					$DADOS->FREE();
					
					$sql = "SELECT COUNT(*) AS TOTAL FROM site_dados";
					$DADOS = new QUERY($DATABASE,$sql);
					$DADOS->NEXT();
					
					if ($DADOS->BYNAME("TOTAL")=="0"){
						$sql = "INSERT INTO site_dados (titulo_site) VALUES('preencha com os dados do seu web site')";
						$DADOS= new QUERY($DATABASE,$sql);
						$DADOS->FREE();
					}
					
					/***********************************************************
					* Criar novos campos caso não exista na tabela
					************************************************************/
					
					//$sql = "show columns from site_dados where field='topo_boletim'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'topo_boletim' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","topo_boletim")){
						$sql = "ALTER TABLE site_dados ADD topo_boletim text";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					if (!verifica_campo("site_dados","personalizado")){
						$sql = "ALTER TABLE site_dados ADD personalizado CHAR(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					if (!verifica_campo("site_dados","certificados")){
						$sql = "ALTER TABLE site_dados ADD certificados text";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='cor_boletim'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'cor_boletim' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","cor_boletim")){
						$sql = "ALTER TABLE site_dados ADD cor_boletim VARCHAR(255)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='logotipo'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'logotipo' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","logotipo")){
						$sql = "ALTER TABLE site_dados ADD logotipo TEXT";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='css_cor'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'css_cor' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","css_cor")){
						$sql = "ALTER TABLE site_dados ADD css_cor TEXT";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='pqec'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'pqec' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","pqec")){
						$sql = "ALTER TABLE site_dados ADD pqec varchar(15)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='horario_funcionamento'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'horario_funcionamento' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","horario_funcionamento")){
						$sql = "ALTER TABLE site_dados ADD horario_funcionamento varchar(255)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='visualizar_agenda'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_agenda' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_agenda")){
						$sql = "ALTER TABLE site_dados ADD visualizar_agenda char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						$EXECUTA->FREE();
					}
					
					//$sql = "show columns from site_dados where field='visualizar_cotacao'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_cotacao' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_cotacao")){
						$sql = "ALTER TABLE site_dados ADD visualizar_cotacao char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_indices'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_indices' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_indices")){
						$sql = "ALTER TABLE site_dados ADD visualizar_indices char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_noticias'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_noticias' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_noticias")){
						$sql = "ALTER TABLE site_dados ADD visualizar_noticias char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_boletins'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_boletins' ";	
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_boletins")){
						$sql = "ALTER TABLE site_dados ADD visualizar_boletins char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas' ";		
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas_indices'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas_indices' ";		
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas_indices")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas_indices char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas_consultas'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas_consultas' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas_consultas")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas_consultas char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas_tabelas'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas_tabelas' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas_tabelas")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas_tabelas char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas_certidoes'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas_certidoes' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas_certidoes")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas_certidoes char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_ferramentas_guias'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_ferramentas_guias' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_ferramentas_guias")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_ferramentas_guias char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_boletins'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_boletins' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_boletins")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_boletins char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_institucional'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_institucional' ";	
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_institucional")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_institucional char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_institucional_empresa'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_institucional_empresa' ";	
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_institucional_empresa")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_institucional_empresa char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_institucional_servicos'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_institucional_servicos' ";	
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_institucional_servicos")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_institucional_servicos char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_galeria_fotos'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_galeria_fotos' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_galeria_fotos")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_galeria_fotos char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='visualizar_pagina_comparacao'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'visualizar_pagina_comparacao' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","visualizar_pagina_comparacao")){
						$sql = "ALTER TABLE site_dados ADD visualizar_pagina_comparacao char(1)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='codigo_coluna'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'codigo_coluna' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","codigo_coluna")){
						$sql = "ALTER TABLE site_dados ADD codigo_coluna text";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_dados where field='codigo_rodape'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_dados' AND COLUMN_NAME =  'codigo_rodape' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					
					if (!verifica_campo("site_dados","codigo_rodape")){
						$sql = "ALTER TABLE site_dados ADD codigo_rodape text";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					if (!verifica_campo("site_dados","pqec_iso")){
						$sql = "ALTER TABLE site_dados ADD pqec_iso varchar(15)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					if (!verifica_campo("site_dados","css_boletim")){
						$sql = "ALTER TABLE site_dados ADD css_boletim text";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					if (!verifica_campo("site_dados","css_boletim_rodape")){
						$sql = "ALTER TABLE site_dados ADD css_boletim_rodape text";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					/***********************************************************
					* CRIA A TABELA SITE_LAYOUT_TOPO
					************************************************************/
					$sql = "CREATE TABLE IF NOT EXISTS site_layout_topo(
							id int(11) AUTO_INCREMENT,
							imagem VARCHAR(255),
							url	VARCHAR(255),	
							primeira_linha VARCHAR(255),
							segunda_linha VARCHAR(255),
							publicar char(1),
							primary key(id)
						)";
					$LAYOUT = new QUERY($DATABASE,$sql);
						
					$sql = "SELECT COUNT(*) AS TOTAL FROM site_layout_topo";
					
					$DADOS = new QUERY($DATABASE,$sql);
					$DADOS->NEXT();
					
					$caminho = explode("/",$_SERVER["SCRIPT_NAME"]);
					$caminho_aux ="";
					for($i=0;$i<count($caminho)-1;$i++){
						$caminho_aux.= $caminho[$i]."/";
					}
					$url_imagem = "http://".$_SERVER["SERVER_NAME"].$caminho_aux."arquivos";
					
					$total_imagem_topo = $DADOS->BYNAME("TOTAL");
					
					if ($DADOS->BYNAME("TOTAL")=="0"){
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('1','<img src=\"".$url_imagem."/fundo_header.png\" />','Slogan','Frase para o slogan','S')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('2','<img src=\"".$url_imagem."/fundo_header_2.png\" />','Slogan','Frase para o slogan','S')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('3','<img src=\"".$url_imagem."/fundo_header_3.png\" />','slogan','Frase para o slogan','S')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('4','<img src=\"".$url_imagem."/fundo_header_4.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('5','<img src=\"".$url_imagem."/fundo_header_5.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('6','<img src=\"".$url_imagem."/fundo_header_6.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('7','<img src=\"".$url_imagem."/fundo_header_7.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('8','<img src=\"".$url_imagem."/fundo_header_8.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('9','<img src=\"".$url_imagem."/fundo_header_9.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('10','<img src=\"".$url_imagem."/fundo_header_10.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('11','<img src=\"".$url_imagem."/fundo_header_11.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('12','<img src=\"".$url_imagem."/fundo_header_12.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('13','<img src=\"".$url_imagem."/fundo_header_13.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('14','<img src=\"".$url_imagem."/fundo_header_14.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						//$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('15','<img src=\"".$url_imagem."/fundo_header_15.png\" />','slogan','Frase para o slogan','N')";
						//$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('16','<img src=\"".$url_imagem."/fundo_header_16.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('17','<img src=\"".$url_imagem."/fundo_header_17.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('18','<img src=\"".$url_imagem."/fundo_header_18.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('19','<img src=\"".$url_imagem."/fundo_header_19.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('20','<img src=\"".$url_imagem."/fundo_header_20.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('21','<img src=\"".$url_imagem."/fundo_header_21.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
					}
					
					############################################################
					# Se existir somente 3 imagens acrescenta as novas imagens #
					############################################################
					
					if ($total_imagem_topo==3){
					
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('4','<img src=\"".$url_imagem."/fundo_header_4.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('5','<img src=\"".$url_imagem."/fundo_header_5.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('6','<img src=\"".$url_imagem."/fundo_header_6.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('7','<img src=\"".$url_imagem."/fundo_header_7.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('8','<img src=\"".$url_imagem."/fundo_header_8.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('9','<img src=\"".$url_imagem."/fundo_header_9.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('10','<img src=\"".$url_imagem."/fundo_header_10.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('11','<img src=\"".$url_imagem."/fundo_header_11.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('12','<img src=\"".$url_imagem."/fundo_header_12.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('13','<img src=\"".$url_imagem."/fundo_header_13.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('14','<img src=\"".$url_imagem."/fundo_header_14.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						//$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('15','<img src=\"".$url_imagem."/fundo_header_15.png\" />','slogan','Frase para o slogan','N')";
						//$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('16','<img src=\"".$url_imagem."/fundo_header_16.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('17','<img src=\"".$url_imagem."/fundo_header_17.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('18','<img src=\"".$url_imagem."/fundo_header_18.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('19','<img src=\"".$url_imagem."/fundo_header_19.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('20','<img src=\"".$url_imagem."/fundo_header_20.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);
						
						$sql = "INSERT INTO site_layout_topo (id,imagem,primeira_linha,segunda_linha,publicar) VALUES('21','<img src=\"".$url_imagem."/fundo_header_21.png\" />','slogan','Frase para o slogan','N')";
						$DADOS= new QUERY($DATABASE,$sql);	
					} 
	
	
					/***********************************************************
					* CRIA A TABELA EMAIL
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_email (
							id int(11) NOT NULL auto_increment,
							smtp varchar(255) default NULL,
							porta varchar(5) default NULL,
							tipo_autenticacao varchar(5) default NULL,
							email varchar(255) default NULL,
							usuario varchar(255) default NULL,
							senha varchar(255) default NULL,
							autenticacao varchar(8) default NULL,
							dominio varchar(255) default NULL,
							intervalo varchar(10) default NULL,
							charset varchar(15) default NULL,
							gateway varchar(10) default NULL,
							PRIMARY KEY  (id)
						)"; 
					
					$EMAIL = new QUERY($DATABASE,$sql);
					
					//se não existe o campo varchar cria o mesmo
					if (!verifica_campo("site_email","charset")){
						$sql = "ALTER TABLE site_email ADD charset varchar(15)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//se não existe o campo varchar cria o mesmo
					if (!verifica_campo("site_email","smtp_mail")){
						$sql = "ALTER TABLE site_email ADD smtp_mail VARCHAR(10);";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//se não existe o campo varchar cria o mesmo
					if (!verifica_campo("site_email","gateway")){
						$sql = "ALTER TABLE site_email ADD gateway VARCHAR(10);";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					
					$sql = "SELECT COUNT(*) AS TOTAL FROM site_email";
					
					$DADOS = new QUERY($DATABASE,$sql);
					$DADOS->NEXT();
					
					if ($DADOS->BYNAME("TOTAL")=="0"){
						$sql = "INSERT INTO site_email (smtp,intervalo) VALUES('smtp do seu domínio','30')";
						$DADOS= new QUERY($DATABASE,$sql);
					}
					
					/***********************************************************
					* Adicionar campos caso não exista
					************************************************************/
					
					//$sql = "show columns from site_email where field='tipo_autenticacao'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_email' AND COLUMN_NAME =  'tipo_autenticacao' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					if (!verifica_campo("site_email","tipo_autenticacao")){
						$sql = "ALTER TABLE site_email ADD tipo_autenticacao VARCHAR(5)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					//$sql = "show columns from site_email where field='intervalo'";
					//$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA =  '$mysql_databasename' AND TABLE_NAME =  'site_email' AND COLUMN_NAME =  'intervalo' ";
					//$VERIFICA = new QUERY($DATABASE,$sql);
					if (!verifica_campo("site_email","intervalo")){
						$sql = "ALTER TABLE site_email ADD intervalo VARCHAR(10)";
						$EXECUTA = new QUERY($DATABASE,$sql);
						
						/******************************************
						* Setar um intervalo de 30 segundos por padrão 
						*******************************************/
						
						$sql = "UPDATE site_email SET intervalo = '30'";
						$EXECUTA = new QUERY($DATABASE,$sql);
						
					}
					
					/***********************************************************
					* CRIA A TABELA EMPRESA
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_empresa (
							emp_id int(11) NOT NULL auto_increment,
							titulo varchar(255) default NULL,
							texto text,
							prioridade int(11) default NULL,
							publicar char(1) default NULL,
							PRIMARY KEY  (emp_id)
					) "; 
					
					$EMPRESA = new QUERY($DATABASE,$sql);
					
					/***********************************************************
					* CRIA A TABELA EMPRESA
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_empresa (
							emp_id int(11) NOT NULL auto_increment,
							titulo varchar(255) default NULL,
							texto text,
							prioridade int(11) default NULL,
							publicar char(1) default NULL,
							PRIMARY KEY  (emp_id)
					) "; 
					
					$EMPRESA = new QUERY($DATABASE,$sql);
					
					/***********************************************************
					* CRIA A TABELA SERVICOS
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_servico (
							serv_id int(11) NOT NULL auto_increment,
							titulo varchar(255) default NULL,
							texto text,
							prioridade int(11) default NULL,
							publicar char(1) default NULL,
							PRIMARY KEY  (serv_id)
					) ";
					
					$SERVICOS = new QUERY($DATABASE,$sql);
					
					/***********************************************************
					* CRIA A TABELA USUARIOS
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_usuario (
							id int(11) NOT NULL auto_increment,
							usuario varchar(20) default NULL,
							senha varchar(20) default NULL,
							PRIMARY KEY  (id)
					);
					";
					
					/***********************************************************
					* NÃO TIVER NENHUM USUARIO cadastra o usuário admin com a senha admin
					************************************************************/
					
					$USUARIOS = new QUERY($DATABASE,$sql);
					
					$sql = "select COUNT(*) AS TOTAL FROM site_usuario";
					$TOT = new QUERY($DATABASE,$sql);
					$TOT->NEXT();					
					if ($TOT->BYNAME("TOTAL")=="0"){
						$sql="INSERT INTO site_usuario (usuario,senha) VALUES ('admin','SuperSite')";
						$USUARIO = new QUERY($DATABASE,$sql);
					}
					
					/**************************************************************
					* AGENDA OBRIGACAO
					**************************************************************/
					
					$sql="CREATE TABLE IF NOT EXISTS agenda_obrigacao (
					AGENDA_OBRIGACAO_ID int(11) NOT NULL auto_increment,
					OBRIGACAO_ID int(11) default NULL,
					DATA date default NULL,
					MES int(11) default NULL,
					ANO int(11) default NULL,
					PRIMARY KEY  (AGENDA_OBRIGACAO_ID)
					)";
					
					$AGENDA = new QUERY($DATABASE,$sql);
					
					/**************************************************************
					* OBRIGACAO
					**************************************************************/
					
					$sql="CREATE TABLE IF NOT EXISTS obrigacao (
					OBRIGACAO_ID int(11) NOT NULL auto_increment,
					TITULO text NOT NULL,
					PRIMARY KEY  (OBRIGACAO_ID)
					)";

					$OBRIGACAO = new QUERY($DATABASE,$sql);
					
					
					/**************************************************************
					* PAGINAS ADICIONAID do WEB SITE
					* menu pai = 1- Institucional
					* menu pai = 2- Ferramentas
					**************************************************************/
					
					$sql="CREATE TABLE IF NOT EXISTS site_paginas(
					id int(11) auto_increment,
					menu_pai int(11),
					titulo_menu varchar(20),
					titulo_pagina varchar(255),
					texto text,
					primary key(id)
					);";
					
					$PAGINAS = new QUERY($DATABASE,$sql);
					
					/**************************************************************
					* MÍDIAS SOCIAIS - Twitter, Facebook
					* 
					**************************************************************/
					
					$sql ="CREATE TABLE IF NOT EXISTS site_midias (
					   id INT(11) AUTO_INCREMENT,
                       user_facebook_id VARCHAR(255),
					   url_fan_page VARCHAR(255),
					   ativar_facebook_comentario CHAR(1),
                       user_twitter_id VARCHAR(255),
                       ativar_twitter_posts CHAR(1),
					   ativar_seguir_twitter CHAR(1),
					   ativar_curtir_facebook CHAR(1),
                       primary key(id)
                     );";
					 
					$MIDIAS = new QUERY($DATABASE,$sql);
					
					$sql = "select COUNT(*) AS TOTAL FROM site_midias";
					$TOT = new QUERY($DATABASE,$sql);
					$TOT->NEXT();					
					if ($TOT->BYNAME("TOTAL")=="0"){
						$sql="INSERT INTO site_midias (ativar_facebook_comentario,ativar_twitter_posts,ativar_seguir_twitter,ativar_curtir_facebook) VALUES ('N','N','N','N')";
						$MIDIAS = new QUERY($DATABASE,$sql);
					}
					
					if (!verifica_campo("site_midias","url_fan_page")){
						$sql = "ALTER TABLE site_midias ADD url_fan_page char(255)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					/**************************************************************
					* SEO do web código do Google Analytics
					***************************************************************/
					
					$sql ="CREATE TABLE IF NOT EXISTS site_google_analytics (
					   id INT(11) AUTO_INCREMENT,
                       codigo TEXT,
					   primary key(id)
                     );";
					 
					$GOOGLE = new QUERY($DATABASE,$sql);
					 
					$sql = "select COUNT(*) AS TOTAL FROM site_google_analytics";
					$TOT = new QUERY($DATABASE,$sql);
					$TOT->NEXT();					
					if ($TOT->BYNAME("TOTAL")=="0"){
						$sql="INSERT INTO site_google_analytics (codigo) VALUES ('')";
						$MIDIAS = new QUERY($DATABASE,$sql);
					}
					
					/**************************************************************
					* Meta Tags
					***************************************************************/
					
					$sql ="CREATE TABLE IF NOT EXISTS site_metatags (
					   id INT(11) AUTO_INCREMENT,
					   id_pagina INT(11),
                       url_nome varchar(255),
					   title varchar(100),
					   description varchar(155),
					   keyword varchar(255),
					   primary key(id)
                     );";
					 
					$META = new QUERY($DATABASE,$sql); 
					 
					$sql = "select COUNT(*) AS TOTAL FROM site_metatags";
					$TOT = new QUERY($DATABASE,$sql);
					$TOT->NEXT();
					if ($TOT->BYNAME("TOTAL")==0){
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-1','Homepage do Site')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-2','Página Empresa')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-3','Página Serviços')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-4','Página de Boletins')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-5','Página de Índices')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-6','Página de Tabelas')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-7','Página de Consultas')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-8','Página de Certidões')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-9','Página de Guias')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-10','Página de Fale Conosco')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-11','Página de Agenda')";
						$METATAG = new QUERY($DATABASE,$sql);
						$sql="INSERT INTO site_metatags (id_pagina,url_nome) VALUES ('-12','Página de Comparacao')";
						$METATAG = new QUERY($DATABASE,$sql);
					}
					$METATAG = new QUERY($DATABASE,$sql);
					
					/***********************************************************
					* CRIA A TABELA DA GALERIA
					************************************************************/
					
					$sql= "CREATE TABLE IF NOT EXISTS site_galeria (
						   ID int(11) AUTO_INCREMENT,
						   TITULO VARCHAR(255) default NULL,
						   ARQUIVO TEXT default NULL,
						   PESO INT(11),
						   primary key(ID)
					)";
					
					$GALERIA = new QUERY($DATABASE,$sql);			
					
					if (!verifica_campo("site_galeria","PESO")){
						$sql = "ALTER TABLE site_galeria ADD PESO INT(11)";
						$EXECUTA = new QUERY($DATABASE,$sql);
					}
					
					/*****************************************************
					/*CRIA A TABELA DE FONTES AUTOMATICAS
					******************************************************/
					
					$sql = "CREATE TABLE IF NOT EXISTS site_fontes_boletins(
							ID int(11) AUTO_INCREMENT,
							CONTAS_EM_REVISTA CHAR(1),
							PRIMARY KEY(ID)
					)";
					
					$FONTE = new QUERY($DATABASE,$sql);
					
					$sql = "select COUNT(*) AS TOTAL FROM site_fontes_boletins";
					$TOT = new QUERY($DATABASE,$sql);
					$TOT->NEXT();					
					if ($TOT->BYNAME("TOTAL")=="0"){
						$sql="INSERT INTO site_fontes_boletins (ID,CONTAS_EM_REVISTA) VALUES ('','N')";
						$FONTES = new QUERY($DATABASE,$sql);
					}
					
					/*****************************************************
					/*CRIA A TABELA DE ALERTAS
					******************************************************/
					
					$sql = "
						CREATE TABLE IF NOT EXISTS site_alerta (
						ID int(11) NOT NULL auto_increment,
						TITULO varchar(255) default NULL,
						TEXTO text,
						PUBLICAR char(1) default NULL,
						PRIMARY KEY  (ID)
					)";
					
					$ALERTA = new QUERY($DATABASE,$sql);
					
										
?>