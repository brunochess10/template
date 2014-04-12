<?php

class Guias extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-9);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
		
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    $this->conteudo["conteudo_guias"] ="
                         <script type=\"text/javascript\" src=\"http://www.netcontabil.com.br/package_update/conteudo/conteudo_contabil.php?content=guias&uf=".$this->conteudo["estado"]."\"></script>
                    ";
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_guias_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
             
        }
?>
