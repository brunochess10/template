<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Empresa extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
					$this->seo_pagina(-2);
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
		
		
                    ####################################
                    # Carrega o Model
                    ####################################
                    $this->load->model("Empresa_model");
                    $this->conteudo["conteudo_empresa"] = $this->Empresa_model->get_conteudo_empresa();
                    
                    ################################################################################
                    #  carrega as p�ginas no nosso layout e tamb�m passa os dados para as mesmas
                    ################################################################################
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_empresa_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
        }

?>