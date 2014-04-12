<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function index() {
		################################################################################
        #  Seta o ID do SEO da Página
        ################################################################################
		$this->seo_pagina(-1);
		################################################################################
        #  Seta o ID do SEO da Página
        ################################################################################
	
        $this->conteudo['avisos'] = $this->avisos();
        $this->conteudo["noticias"] = "
    		<script>
    			$(document).ready(function(){
    				$('#lista_noticias').load('".site_url()."/load_noticias/');
    			})
    		</script>
    		";
    		
        if ($this->db->count_all("mail")>=5){    		
          $this->conteudo["boletim"] = $this->boletins(4);
        }else if($this->db->count_all("mail")==0){
          $this->conteudo["boletim"] = $this->boletins(0);
          //Se não existe boletins não mostra nada na página principal
          $this->conteudo["visualizar_boletins"]="N";
        }else{
          $this->conteudo["boletim"] = $this->boletins($this->db->count_all("mail"));
        }
        
        $this->conteudo["twitter"] = $this->twitter();
        
        if ($this->conteudo["twitter"]){
            $this->conteudo["twitter_aumentar_lateral"] = "<div style=\"height:140px\"></div>";
        }
        
		$this->conteudo["alerta"] = $this->alerta();
		
        ################################################################################
        #  carrega as páginas no nosso layout e também passa os dados para as mesmas
        ################################################################################
        
        $this->load->library('parser');
        $this->parser->parse('topo_view', $this->conteudo);
        $this->parser->parse('pagina_home_view', $this->conteudo);
        $this->parser->parse('rodape_view', $this->conteudo);
		
    }

	
	function avisos() {
        $this->load->model("Aviso_model");
        $conteudo_aviso["aviso"] = $this->Aviso_model->get_aviso();
        if ($conteudo_aviso["aviso"][0]->publicar == "S") {
            $conteudo = "<b>".common::data_brasil($conteudo_aviso["aviso"][0]->data) . "</b><br/><b>" . $conteudo_aviso["aviso"][0]->titulo . "</b><br/>" . common::maximo_palavras($conteudo_aviso["aviso"][0]->texto,35);
        } else {
            $conteudo = "Bem-Vindos ao nosso site, este é mais um canal que disponibilizamos para estreitar ainda mais o nosso relacionamento. Disponibilizamos aqui, uma série de ferramentas e informações que podem ajudar você e à sua empresa. Qualquer dúvida, por favor entre em contato.";
        }
        return $conteudo;
    }
    
    function boletins($num_boletim){
        $boletim_aux="";
        $this->load->model("Mail_model");
        $boletim["dados"] = $this->Mail_model->get_boletins($num_boletim);
        for ($i=0;$i<$num_boletim;$i++){
            $boletim_aux[$i]["mail_id"] = $boletim["dados"][$i]->mail_id."/".sanitize_title_with_dashes($boletim["dados"][$i]->mail_assunto);
            $boletim_aux[$i]["mail_data"] = common::data_brasil($boletim["dados"][$i]->mail_data);
			$boletim_aux[$i]["mail_assunto"] = $boletim["dados"][$i]->mail_assunto;
        }
        return $boletim_aux;
    }
  
    function twitter(){
        $this->load->model("Midias_model");
        $resultado = $this->Midias_model->get_conteudo_midias();
        if ($resultado[0]->ativar_twitter_posts=="S"){
            $twitter = "
			<script>
			$(document).ready(function(){
				$('#lista_twitter').load('".site_url()."/load_twitter/?conta_twitter=".$resultado[0]->user_twitter_id."');
			})
			</script>
			<div class=\"twitter\" ><h1>Twitter</h1><div id=\"lista_twitter\"><b class=\"carregar\">Carregando...</b></div>
			</div>";
        }else{
            $twitter="";
        }
        return $twitter;
    }

	
	function alerta(){
		$this->load->model("Alerta_model");
		$resultado = $this->Alerta_model->get_conteudo_alerta();
		if ($resultado[0]->PUBLICAR=="P"){
			$alerta ="
			<script>
				$(document).ready(function(){
					abre();
				})
			</script>
			<div id=\"alerta\" title=\"Alerta!\" style=\"display:none;\"><h1>".$resultado[0]->TITULO."</h1>".$resultado[0]->TEXTO."</div>
			";
		}else{
			$alerta="";
		}
		return $alerta;
	}
}