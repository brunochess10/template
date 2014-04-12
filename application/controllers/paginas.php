<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Paginas extends MY_Controller{
		function index(){
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                }
                
                function texto($id){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina($id);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
				
				
                    ####################################
                    # Carrega o Model
                    ####################################
                    $this->load->model("Paginas_model");
                    $pagina = $this->Paginas_model->get_one_page($id);
                    $this->conteudo["titulo_pagina"] = $pagina[0]->titulo_pagina;
                    $this->conteudo["texto_pagina"] = $pagina[0]->texto;
                    
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_pagina_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
        }

?>