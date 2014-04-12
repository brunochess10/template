<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Indices extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
					$this->seo_pagina(-5);
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
		
		
                    ################################################################################
                    #  carrega as p�ginas no nosso layout e tamb�m passa os dados para as mesmas
                    ################################################################################
                    $this->conteudo["script_indices"] ="";
                    $this->conteudo["conteudo_indices"] ="
                         <ul>
                            <li><a href=\"tabela/1\">Sal�rio M�nimo</a></li>
                            <li><a href=\"tabela/2\">Hist�rico Moeda</a></li>
                            <li><a href=\"tabela/3\">TR</a></li>
                            <li><a href=\"tabela/4\">UFIR</a></li>
                            <li><a href=\"tabela/5\">SELIC</a></li>
                            <li><a href=\"tabela/6\">UFESP</a></li>
                            <li><a href=\"tabela/7\">Infla��o</a></li>
                        </ul>  
                    ";
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_indices_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
                function tabela($codigo_indice){
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
					$this->seo_pagina(-5);
					################################################################################
					#  Seta o ID do SEO da P�gina
					################################################################################
					
					$this->conteudo["script_indices"] = "<script type=\"text/javascript\" src=\"".$this->package_update."/server_indice_script.php?indice=$codigo_indice\"></script>";
                    $this->conteudo["conteudo_indices"] ="<script type=\"text/javascript\" src=\"".$this->package_update."/cliente_indice_js.php?indice=$codigo_indice \"></script>";
                            
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_indices_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);            
                }
             
        }

?>