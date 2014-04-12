<?php

class Galeria extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-1);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					
					####################################
                    # Carrega o Model
                    ####################################
                    $this->load->model("Galeria_model");
                    $this->conteudo["galeria"] = $this->Galeria_model->get_galeria();
					//echo ($this->conteudo["galeria"][0]->ARQUIVO);
					
					for ($i=0;$i<count($this->conteudo["galeria"]);$i++){
						$aux = explode('"',$this->conteudo["galeria"][$i]->ARQUIVO);
						$this->conteudo["galeria"][$i]->ARQUIVO=$aux[3];
						unset($aux);
					}
					
					################################################################################
                    #carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_galeria_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
    
        }
?>
