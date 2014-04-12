<?php

class MY_Controller extends CI_Controller
{
    var $conteudo = array();
    //var $config_email = array();
	var $smtp;
    var $package_update = "http://www.netcontabil.com.br/package_update";
	
    function __construct()
    {
         parent::__construct();
         ######################################
		 # Conteudo a ser apresentado na view
		 ######################################
         $dados = common::dados_do_escritorio();
         //echo "<pre>";
         //print_r($dados);
         //echo "</pre>";
		 $this->conteudo["package_update"] = $this->package_update; 			
         $this->conteudo["twitter_seguir"] = Tweetaki::seguir_twitter();
         $this->conteudo["facebook_curtir"] = $this->curtir_facebook();
         
         #páginas a mais institucionais com url amigável
         $this->conteudo["institucional"] = $this->paginas_institucional();
         for($i=0;$i<count($this->conteudo["institucional"]);$i++){
             $this->conteudo["institucional"][$i]->url_amigavel = sanitize_title_with_dashes($this->conteudo["institucional"][$i]->titulo_menu);
         }
         
         #página a mais de ferramentas com url amigável
         $this->conteudo["ferramentas"] = $this->paginas_ferramentas();
         for($i=0;$i<count($this->conteudo["ferramentas"]);$i++){
             $this->conteudo["ferramentas"][$i]->url_amigavel = sanitize_title_with_dashes($this->conteudo["ferramentas"][$i]->titulo_menu);
         }
         
         $this->conteudo["apresentacao_topo"] = common::apresentacao_topo();
         $this->conteudo["titulo_site"] = $dados["dados_do_escritorio"][0]->titulo_site;
         $this->conteudo["endereco_seguro"] = $dados["dados_do_escritorio"][0]->endereco_seguro;
         $this->conteudo["nome_fantasia"] = $dados["dados_do_escritorio"][0]->nome_fantasia;
         $this->conteudo["logradouro"] =  $dados["dados_do_escritorio"][0]->logradouro;
		 $this->conteudo["numero"] = $dados["dados_do_escritorio"][0]->numero;
         $this->conteudo["complemento"] = $dados["dados_do_escritorio"][0]->complemento;
         $this->conteudo["bairro"] = $dados["dados_do_escritorio"][0]->bairro;
         $this->conteudo["cidade"] = $dados["dados_do_escritorio"][0]->cidade;
         $this->conteudo["estado"] = $dados["dados_do_escritorio"][0]->estado;
         $this->conteudo["cep"] = $dados["dados_do_escritorio"][0]->cep;
         $this->conteudo["ddd"] = $dados["dados_do_escritorio"][0]->ddd;
         $this->conteudo["telefone_1"] = $dados["dados_do_escritorio"][0]->telefone_1;
		 $this->conteudo["css_cor"] = str_replace("url(", "url(".base_url(), $dados["dados_do_escritorio"][0]->css_cor );
         if ($dados["dados_do_escritorio"][0]->fax){
             $this->conteudo["fax"] ="Fax: ".$dados["dados_do_escritorio"][0]->ddd." ".$dados["dados_do_escritorio"][0]->fax;
         }else{
			 $this->conteudo["fax"] = "";
		 }
         $this->conteudo["telefones"] = $dados["telefones"];
         $this->conteudo["email"] = $dados["email_contato"][0]->email;
         $this->conteudo["ano"] = date('Y');
		 
		 //layout das páginas
		 
		 $this->conteudo["visualizar_agenda"]  = $dados["dados_do_escritorio"][0]->visualizar_agenda;
		 $this->conteudo["visualizar_cotacao"] = $dados["dados_do_escritorio"][0]->visualizar_cotacao; 
		 $this->conteudo["visualizar_indices"] = $dados["dados_do_escritorio"][0]->visualizar_indices; 
		 $this->conteudo["visualizar_noticias"] = $dados["dados_do_escritorio"][0]->visualizar_noticias;
		 $this->conteudo["visualizar_boletins"] = $dados["dados_do_escritorio"][0]->visualizar_boletins;				   
		 $this->conteudo["visualizar_pagina_ferramentas"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas;
		 $this->conteudo["visualizar_pagina_ferramentas_indices"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas_indices;
		 $this->conteudo["visualizar_pagina_ferramentas_consultas"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas_consultas;
		 $this->conteudo["visualizar_pagina_ferramentas_tabelas"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas_tabelas;
		 $this->conteudo["visualizar_pagina_ferramentas_certidoes"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas_certidoes;
		 $this->conteudo["visualizar_pagina_ferramentas_guias"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_ferramentas_guias;
		 $this->conteudo["visualizar_pagina_boletins"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_boletins;
		 $this->conteudo["visualizar_pagina_institucional"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_institucional;
		 $this->conteudo["visualizar_pagina_institucional_empresa"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_institucional_empresa;
		 $this->conteudo["visualizar_pagina_institucional_servicos"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_institucional_servicos;				   
		 $this->conteudo["visualizar_pagina_galeria_fotos"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_galeria_fotos;
		 $this->conteudo["visualizar_pagina_comparacao"] = $dados["dados_do_escritorio"][0]->visualizar_pagina_comparacao;
		 $this->conteudo["codigo_coluna"] = $dados["dados_do_escritorio"][0]->codigo_coluna;
		 $this->conteudo["codigo_rodape"] = $dados["dados_do_escritorio"][0]->codigo_rodape;	
		 $this->conteudo["funcionamento"] = ($dados["dados_do_escritorio"][0]->horario_funcionamento!=""? "".$dados["dados_do_escritorio"][0]->horario_funcionamento:"Para entrar em contato conosco ligue para o(s) nosso(s) telefone(s)");
		 $this->conteudo["certificados"] = $dados["dados_do_escritorio"][0]->certificados;
		 $this->conteudo["alerta"] ="";
		 
		 #########################
		 # início último boletim
		 #########################
		 
		 $this->conteudo["id_header"] = "id='paginasinternas'";
		 $this->load->model("Mail_model");
		 if ($this->db->count_all("mail")>0){
			 $boletim_home = $this->Mail_model->get_last();
			 //print_r($boletim_home);
			 $this->conteudo["assunto_boletim_home"] = $boletim_home[0]->mail_assunto;
			 //echo $boletim_home[0]->mail_assunto;
			 $aux_corpo = htmlspecialchars_decode($boletim_home[0]->mail_corpo);
			 if ($aux_corpo!=""){
				 $aux_corpo = strip_tags($aux_corpo);
				 //echo $aux_corpo;
				 $this->conteudo["texto_boletim_home"]="";
				 $aux_corpo = explode(" ",$aux_corpo);
				 for ($i=0;$i<100;$i++){
					if ($i==count($aux_corpo)-1) break;
					$this->conteudo["texto_boletim_home"].=" ".$aux_corpo[$i];
				 }
				 $this->conteudo["texto_boletim_home"].="... <a href=".site_url()."boletim/texto/".$boletim_home[0]->mail_id."/".sanitize_title_with_dashes($boletim_home[0]->mail_assunto).">Saiba Mais</a>";
			 }
		 }
		 #########################
		 # Fim do último boletim
		 #########################
		 //caminho da agenda
		 $segmento="";
		 if ($this->uri->segment(2)!=""){
			$segmento.="/".$this->uri->segment(2);
		 }
		 if ($this->uri->segment(3)!=""){
			$segmento.="/".$this->uri->segment(3);
		 }
		 if ($this->uri->segment(4)!=""){
			$segmento.="/".$this->uri->segment(4);
		 }
		 
		 $pos = strpos(site_url(), "index.php");
         if ($pos){
            $barra_final="";
         }else{
			$barra_final="/";
		 }
		 
         $this->conteudo["agenda_obrigacao"] = common::carregar_agenda_obrigacoes($this->conteudo['estado'],"");
         $this->conteudo["base_url"] = base_url();
         
         $this->conteudo["site_url"] = site_url();
         $pos = strpos(site_url(), "index.php");
         if ($pos){
            $this->conteudo["site_url"] = $this->conteudo["site_url"]."/";
         }
         
         if ($dados["dados_do_escritorio"][0]->logotipo){
             $this->conteudo["logotipo"]=".logo{background-image:url(".common::caminho_imagem($dados["dados_do_escritorio"][0]->logotipo).");background-repeat:no-repeat;}";
         }else{
             $this->conteudo["logotipo"]="";
         }
		 
         //pqec - iso
		 //pqec - iso
		 
		 if (($dados["dados_do_escritorio"][0]->pqec)&&($dados["dados_do_escritorio"][0]->pqec_iso=="")){
            $this->conteudo["pqec"]=".pqec{background-image:url(".$this->package_update."/conteudo/pqec/".$dados["dados_do_escritorio"][0]->pqec."/pqec.png)}";
         }
		 //pqec + iso
		 //pqec + iso
		 if (($dados["dados_do_escritorio"][0]->pqec_iso)&&($dados["dados_do_escritorio"][0]->pqec=="")){
            $this->conteudo["pqec"]=".pqec{background-image:url(".$this->package_update."/conteudo/pqec_iso/".$dados["dados_do_escritorio"][0]->pqec_iso."/pqec.png)}";
         }	
		 
		 //sem pqec
		 //sem pqec
		 if (($dados["dados_do_escritorio"][0]->pqec_iso=="")&&($dados["dados_do_escritorio"][0]->pqec=="")){
            $this->conteudo["pqec"]="";
         }
		 
         $this->conteudo["link_logo"] = common::caminho_imagem($dados["dados_do_escritorio"][0]->logotipo);
         $this->conteudo["twitter_aumentar_lateral"] ="";
         
         //carrega os itens para cadastrar os boletins
         //carrega os itens para cadastrar os boletins
         $this->conteudo["area_boletim"]="";
         $lista_area = $this->area_boletim();
         foreach($lista_area as $item_lista){
             $this->conteudo["area_boletim"].="<input type=\"checkbox\" value=\"".$item_lista->are_id."\" name=\"area[]\" checked>".$item_lista->are_titulo."<br/>";
         }
		 
		 //ver se existe a configuração do google analytics
		 $google_analytics = $this->google_analytics();
		 $this->conteudo["google_analytics"] = $google_analytics[0]->codigo; 		
		 
		 //ver se tem título personalizado da página e também metatags personalizadas
		 /*$metatag="";
		 $link = site_url()."/".$this->uri->segment(1).$segmento."/";
		 $metatag = $this->seo_pagina(trim($link));
		 //echo $this->db->last_query();	
		 if ($metatag){  
			$this->conteudo["titulo_site"] = $metatag[0]->title;
			$this->conteudo["description"] = "<meta name=\"description\" content=\"".$metatag[0]->description."\">";
			$this->conteudo["keyword"] = "<meta name=\"keywords\" content=\"".$metatag[0]->keyword."\" />";
		 }else{
			$this->conteudo["description"] = "";
			$this->conteudo["keyword"] = "";
		 } 	
		 */
		 
         //fazer a configuração para disparar os e-mails que por ventura existem no site
         //fazer a configuração para disparar os e-mails que por vendura existem no site
         
		 /******************************************************
		 * Utilizando o sistema de envio do Code Igniter
		 *******************************************************
         $this->config_email['protocol']='smtp';
         $this->config_email['charset'] = 'iso-8859-1';
         $this->config_email['smtp_host'] = $dados["email_contato"][0]->smtp;
         $this->config_email['smtp_port'] = $dados["email_contato"][0]->porta;
         $this->config_email['smtp_user'] = $dados["email_contato"][0]->email;
         $this->config_email['smtp_pass'] = $dados["email_contato"][0]->senha;
         $this->config_email['validate'] = true;
         $this->config_email['_smtp_auth'] = true;
         $this->config_email['mailtype'] = 'html';
         $this->email->initialize($this->config_email);
		 */
		 
		$this->smtp["EMAIL_FROM"] = $dados["email_contato"][0]->email;
		if ($dados["email_contato"][0]->smtp_mail==""){
			$this->smtp["EMAIL_METHOD"]= "smtp";
		}else{
			$this->smtp["EMAIL_METHOD"]= $dados["email_contato"][0]->smtp_mail;
		}	
		$this->smtp["use"] =  true;
		$this->smtp["host"] = $dados["email_contato"][0]->smtp;
		$this->smtp["auth_type"] = $dados["email_contato"][0]->tipo_autenticacao;
		$this->smtp["port"] = $dados["email_contato"][0]->porta;
		$this->smtp["hello"] = $dados["email_contato"][0]->dominio;
		$this->smtp["auth"] = true;
		$this->smtp["user"] = $dados["email_contato"][0]->email;
		$this->smtp["pass"] = $dados["email_contato"][0]->senha;
		if ($dados["email_contato"][0]->gateway==""){
			$this->smtp["use_gateway"] = false;	
		}else{
			$this->smtp["use_gateway"] = true;
		}
		$this->smtp["charset"] = $dados["email_contato"][0]->charset;
	}
    
    function paginas_institucional(){
        $this->load->model("Paginas_model");
        return $this->Paginas_model->get_institucional();
    }
    
    function paginas_ferramentas(){
        $this->load->model("Paginas_model");
        return $this->Paginas_model->get_ferramentas();
    }
    
    
    function curtir_facebook(){
        $this->load->model("Midias_model");
        $resultado = $this->Midias_model->get_conteudo_midias();
        
        if ($resultado[0]->ativar_curtir_facebook=="S"){
            $curtir_facebook = Facebook::curtir();
        }else{
            $curtir_facebook = "";
        }
        return $curtir_facebook;
    }
    
    function area_boletim(){
        $this->load->model("Area_boletim_model");
        return $this->Area_boletim_model->get_area();
    }
    
	function google_analytics(){
		$this->load->model("Google_analytics_model");
        return $this->Google_analytics_model->get_google_analytics();
	}
	
	function seo_pagina($id){
		$this->load->model("Metatag_model");
		$metatag = $this->Metatag_model->get_metatag($id);
		if ($metatag){  
			if ($metatag[0]->title!=""){
				$this->conteudo["titulo_site"] = $metatag[0]->title;
			}
			$this->conteudo["description"] = "<meta name=\"description\" content=\"".$metatag[0]->description."\">";
			$this->conteudo["keyword"] = "<meta name=\"keywords\" content=\"".$metatag[0]->keyword."\" />";
		}else{
			$this->conteudo["description"] = "";
			$this->conteudo["keyword"] = "";
		}
	}
	
	function set_params_smtp( $mail ){
			if( $this->smtp["use"] ) {
					$mail->setSMTPParams( $this->smtp["host"], $this->smtp["port"], $this->smtp["hello"], $this->smtp["auth"], $this->smtp["auth_type"] , $this->smtp["user"], $this->smtp["pass"]);
			}
	}
	
}

?>