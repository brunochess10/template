<?php

class Avisos extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-6);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					
					
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    ###############################
					# Carrega o Model
					###############################
					$this->load->model("Aviso_model");
						
					######################################
					# Conteudo a ser apresentado na view
					######################################
					$this->conteudo["conteudo_aviso"] = $this->Aviso_model->get_aviso();
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_aviso_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
             
        }
?>
