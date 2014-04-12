<?php
    class Faleconosco extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-10);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
		
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    $this->load->library('parser');
					$this->load->helper('gatewaymail');
                    $this->parser->parse('topo_view', $this->conteudo);
                    
                    //carregar o helper do formulario
                    //carregar o helper do para consistência
                    //$this->load->helper(array('form', 'url'));
                    $this->load->library('form_validation');
                    $this->form_validation->set_message('required', '*Preencha o campo %s');
                    
                    $this->form_validation->set_rules('empresa', 'Empresa', 'required|min_length[4]');
                    $this->form_validation->set_rules('contato', 'Nome/Contato', 'required|min_length[2]');
                    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
                    $this->form_validation->set_rules('assunto', 'Assunto', 'required|min_length[4]');
                    $this->form_validation->set_rules('comentario', 'Comentário', 'required|min_length[5]');
                    
                    
                    if ($this->form_validation->run() == FALSE)
                    {
                      $this->parser->parse('pagina_contato_view',$this->conteudo);
                    }
                    else
                    {
                        //eniviar o e-mail

                        /*$this->email->from($this->conteudo["email"],$this->conteudo["titulo_site"]);
                        $this->email->to($this->conteudo["email"]);
                        $this->email->subject('Email enviado pelo fale conosco do web site');*/
						
						
                        //monta a mensagem que vai para o e-mail de contato da empresa
                        $message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
				<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
				<title>Email enviado pelo site</title>
				<style>
				table{
					margin:auto;
					width:650px;
					border-collapse:collapse;
					}
				table,th,td{border:solid 1px #CCC;padding:5px;font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333;}
				thead th{background-color:#f2f2f2;}
				tfoot th{background-color:#f2f2f2;text-align:left;vertical-align:top;}
				tbody th{background-color:#f2f2f2;text-align:left;}
				
				</style>
				
				</head>
				
				<body>
				
				<table>
				<thead>
				<tr>
                                <th colspan=\"2\">
					Email enviado pelo fale conosco do web site
				</th>
                                </tr>    
				</thead>
				<tbody>
                                <tr>
                                    <th>Empresa</th><td>".$this->input->post("empresa")."</td>
                                </tr>
                                <tr>
                                    <th>Contato</th><td>".$this->input->post("contato")."</td>
                                </tr>
                                <tr>
                                    <th>E-mail</th><td>".$this->input->post("email")."</td>
                                </tr>
                                <tr>
                                    <th>Assunto</th><td>".$this->input->post("assunto")."</td>
                                </tr>
                                <tr>
                                    <th>Comentário</th><td>".$this->input->post("comentario")."</td>
                                </tr>
                                </tbody>
                                </table>
                                </body>
                                </html>
				";
                        
						$mail = new htmlMimeMail();
						$this->set_params_smtp($mail);
						$mail->setHtml($message, $message);
						$mail->setReturnPath($this->smtp["EMAIL_FROM"]);
						$mail->setFrom("\"" . $this->conteudo["titulo_site"] . "\"  <" .  $this->smtp["EMAIL_FROM"] . ">" );
						$mail->setSubject("E-mail enviado pelo fale conosco do web site");
						$mail->setHeader("X-Mailer", "Newsletter - Powered by NeoSolutions (http://www.neosolutions.com.br)");
						$email[0]=$this->smtp["EMAIL_FROM"];
						$common = new Common();
						$result = $common->EnviaEmail($mail,$email,$this->smtp["EMAIL_METHOD"],$this->smtp["use_gateway"]);
						//$result = $mail->send($email, $this->smtp["EMAIL_METHOD"] );
						
						//print_r($mail);						
                        
						if ($result){
                            $this->load->view('pagina_contato_sucesso_view');
                        }else{
                            $this->load->view('pagina_contato_erro_view');
                        }
                    }
                    
                    //$this->parser->parse('pagina_contato_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
             
        }
?>
