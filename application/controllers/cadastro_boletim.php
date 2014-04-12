<?php
class Cadastro_boletim extends MY_Controller{
		function index(){
					
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-1);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
		
		
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    //$this->load->library('parser');
                    //$this->parser->parse('topo_view', $this->conteudo);
                    //$this->parser->parse('pagina_boletim_view', $this->conteudo);
                    //$this->parser->parse('rodape_view', $this->conteudo);
                    
                    $this->load->library('parser');
                    //recebe os dados vindos do formulario
                    $this->load->helper('array');

                    $nome  = $this->input->post("nome");
                    $email = $this->input->post("email_boletim");
                    $areas = $this->input->post("area");
                    
                    //print_r($_POST);
                    //valida a área em que a pessoa será cadastrada
                    //se não marcar nenhuma opção ele não pode se cadastrar para receber os boletins
                    
                    $valida_area = true;
                    if ((is_array($areas))||($areas)){
                        //echo "sim";
                        $valida_area = true;
                    }else{
                        //echo "nao";
                        $valida_area = false;
                    }
                    
                    
                    
                    //fazer a consistencia do boletim
                    
                    $this->load->helper(array('form','url'));
                    $this->load->library('form_validation');
                    
                    $this->form_validation->set_message('required', '*Preencha o campo %s');
                    $this->form_validation->set_message('valid_email', '*O e-mail não é válido');
                    $this->form_validation->set_message('is_unique', '*O e-mail já está cadastrado em nossa base de dados');
                    
                    $this->form_validation->set_rules('nome', 'Nome', 'required');
                    $this->form_validation->set_rules('email_boletim', 'E-mail', 'required|valid_email|is_unique[mailing.usr_email]');
                    $this->form_validation->set_rules('area','Área','Pelo menos uma das áreas é requerida', 'required');
                    
                    if (($this->form_validation->run())&&($valida_area)){
                        //depois de verificar tudo então grava do banco de dados
                        $this->load->model("Usuario_boletim_model");
                        $usuario_id = $this->Usuario_boletim_model->insert_usuario($nome,$email);
                    
                        //cadastra a área 
                        $this->load->model("Area_boletim_model");
                        $this->Area_boletim_model->insert_area_mailing($usuario_id,$areas);
                    
                        $this->parser->parse('topo_view', $this->conteudo);
                        $this->parser->parse('pagina_boletim_sucesso_view',$this->conteudo);
                        $this->parser->parse('rodape_view', $this->conteudo);
                    
                    }else{
                        //se a área também estiver errada posta a mensagem de erro de que
                        //nenhuma área foi selecionada
                        if (!$valida_area){
                            $this->conteudo["mensagem_area"]="<div id=\"erro\"><ul><li>*Por favor selecione ao menos uma área de interesse</li></ul></div>";
                        }else{
                            $this->conteudo["mensagem_area"]="";
                        }
                        
                        $this->parser->parse('topo_view', $this->conteudo);
                        $this->parser->parse('pagina_boletim_erro_view',$this->conteudo);
                        $this->parser->parse('rodape_view', $this->conteudo);
                    }
                }
                
        }
?>
