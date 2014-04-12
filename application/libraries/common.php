<?php
#
# Projeto :
# Data : 24/05/2002
# Autor : Theofilo Brito
# Arquivo com funções comuns
#
class common 
{
    
	function EnviaEmail($mail,$email,$method,$gateway){
		if ($gateway){
			return send_gateway($mail,$email,$method);
		}else{
			return $mail->send($email, $method );
		}
	}
	
    function mes_extenso($i)
    {
        $mes_extenso = array();
        $mes_extenso[1] = "Janeiro";
        $mes_extenso[2] = "Fevereiro";
        $mes_extenso[3] = "Março";
        $mes_extenso[4] = "Abril";
        $mes_extenso[5] = "Maio";
        $mes_extenso[6] = "Junho";
        $mes_extenso[7] = "Julho";
        $mes_extenso[8] = "Agosto";
        $mes_extenso[9] = "Setembro";
        $mes_extenso[10] = "Outubro";
        $mes_extenso[11] = "Novembro";
        $mes_extenso[12] = "Dezembro";
        return $mes_extenso[$i];
    }

    function dia_extenso($i)
    {
        $dia_extenso[0] = "Domingo";
        $dia_extenso[1] = "Segunda-feira";
        $dia_extenso[2] = "Terça-feira";
        $dia_extenso[3] = "Quarta-feira";
        $dia_extenso[4] = "Quinta-feira";
        $dia_extenso[5] = "Sexta-feira";
        $dia_extenso[6] = "Sábado";
        
        return $dia_extenso[$i];
    }

    function trimestre_extenso($i)
    {
        $trimestre_extenso[1] = "1o Trimestre";
        $trimestre_extenso[2] = "2o Trimestre";
        $trimestre_extenso[3] = "3o Trimestre";
        $trimestre_extenso[4] = "4o Trimestre";
        
        return $trimestre_extenso[$i];
    }

    
    function anti_injection($sql) 
    {
        // remove palavras que contenham sintaxe sql
	$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
	$sql = trim($sql); //limpa espaços vazio
	$sql = strip_tags($sql); //tira tags html e php
	$sql = addslashes($sql); //Adiciona barras invertidas a uma string
	
        return $sql;
    }

    function strip_html( $html ) 
    {
        $texto = preg_replace('/<(script|style)[^>]*>.+<\/(script|style)[^>]*>/is', '', $html);
        $texto = strip_tags( $texto );
        $texto = eregi_replace("&nbsp;", " ", $texto );
        return $texto;
    }

    function idade($data)
    {
	$dt = explode( "/" , $data );
	$dias = $dt[0];
	$mes = $dt[1];
	$anos = $dt[2];
		
         if ($anos >= 1970){ 
          $dias0 = mktime(0,0,0,$mes,$dias,$anos); 
          $dias1 = mktime(0,0,0,date("m"),date("d"),date("Y")); 
          $dataf = $dias1 - $dias0; 
          $dataf /= 86400; 
          $dataf /= 365.5; 
          $dataf  = floor($dataf); 
         }else{ 
          $anoresto = 1970 - $anos; 
          $anos   = 1970; 
          $dias0 = mktime(0,0,0,$mes,$dias,$anos); 
          $dias1 = mktime(0,0,0,date("m"),date("d"),date("Y")); 
          $dataf = $dias1 - $dias0; 
          $dataf /= 86400; 
          $dataf /= 365.5; 
          $dataf  = floor($dataf); 
          $dataf += $anoresto; 
         } 
         return $dataf; 
    } 

//ler um arquivo
function read_file($strfile) {
	if($strfile == "" || !file_exists($strfile)) return;
	$thisfile = file($strfile);
	while(list($line,$value) = each($thisfile)) {
		$value = str_replace("(\r|\n)","",$value);
		$result .= "$value\r\n";
	}
	return $result;
}

//retorna o ultimo dia
function forcelastday( $date ) {
	$mes = date("m",$date);
	$ano = date("Y",$date);

	$mes++;
	if($mes > 12){
		$mes = 1;
		$ano++;
	}

	$result = strtotime( $mes . "/01/" . $ano );
	return ( $result - 1 );
}

function currency( $value, $decimal = 2 ) {
	return ( number_format($value, $decimal , "," , ".") );
}

function do_redirect( $url ){
	header("Location: $url");
	$html = "<html>\n\r" .
	              "<head>\n\r" .
	              "</head>\n\r" .
	              "		<body onload=\"document.location='$url';\">\n\r" .
	              "		</body>\n\r" .
	              "</html>";
	echo $html;
	exit;
}


function LoadErrorsServidor_add($mess,$obj){
	return "	AddError(\"" . $mess . "\"," . $obj . ");\n\r";
}

	function request_post( $var ) {
		global $_POST;
		return $_POST[$var];
	}

	function request_get( $var ){
		global $_GET;
		return $_GET[$var];
	}

	function request_session( $var ){
		global $_SESSION;
		return $_SESSION[$var];
	}

	function request( $var ){
		global $_POST;
		global $_GET;
		$result = $_POST[$var];
		if ( !isset($result) ){
			$result = $_GET[$var];
		}
		return $result;
	}

	function set_session( $var , $value ){
		global $_SESSION;
		$_SESSION[$var] = $value;
	}

    function data_brasil($data){
            $aux = explode("-",$data);
            return "$aux[2]/$aux[1]/$aux[0]";
    }
	
		public function dados_do_escritorio(){
				#################################################
				# Carrega os Models necessários
				#################################################
        $this->load->model("Dadoscliente_model");
        $this->load->model("Email_model");
                
				#################################################
				# inicializar Variável
				#################################################
				$result="";				                
				
				#################################################
				# coloca os dados na variável data
				#################################################
				
				$data['dados_do_escritorio'] = $this->Dadoscliente_model->get_dados_cliente();
				
				if ($data["dados_do_escritorio"][0]->telefone_1){
					$result=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_1."<br/>";
				}
				
				##########################################
				# Resolver o problema dos 4 telefones
				##########################################
				if ($data["dados_do_escritorio"][0]->telefone_2){
				$result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_2."<br/>";
				}
				if ($data["dados_do_escritorio"][0]->telefone_3){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_3."<br/>";
				}
				/*if ($data["dados_do_escritorio"][0]->telefone_4){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_4."<br/>";
				}*/
				/*if ($data["dados_do_escritorio"][0]->fax){
					$result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->fax."<br/>";
				}*/
				
				$data['telefones'] = $result;
                $data["email_contato"] = $this->Email_model->get_email();
                
				return $data;
		}
		
		
		
		/*public function contato($data)
        {
            if ($data["dados_do_escritorio"][0]->telefone_1){
                $result=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_1." ";
            }
			
			##########################################
			# Resolver o problema dos 4 telefones
			##########################################
            /*if ($data["dados_do_escritorio"][0]->telefone_2){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_2."<br/>";
            }
            if ($data["dados_do_escritorio"][0]->telefone_3){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_3."<br/>";
            }
            if ($data["dados_do_escritorio"][0]->telefone_4){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->telefone_4."<br/>";
            }
            if ($data["dados_do_escritorio"][0]->fax){
                $result.=$data["dados_do_escritorio"][0]->ddd." ".$data["dados_do_escritorio"][0]->fax."<br/>";
            }
            return $result;
        }   */
		
		function carregar_agenda_obrigacoes($uf,$path_calendar)
		{
				####################################################
				# Recupera os dados da agenda passados por parâmetro
				####################################################
				$month="";
				$year="";
				$mun="";
				if ($this->input->get('month')) $month=$this->input->get('month');
				if ($this->input->get('year')) $year=$this->input->get('year');
				if ($this->input->get('mun')) $mun=$this->input->get('mun');
				
				##################################################
				# Prepara os dados que serão passados para View
				##################################################	
				$url_agenda = site_url(); 
				//faz isso por causa do windows 
        $pos = strpos(site_url(),"index.php");
        if ($pos){
           $url_agenda."/";
        }       
                 return "
                    <script>
                        $(document).ready(function(){
                            $('#bloco_agenda').load('".$url_agenda."/load_agenda/index/?month=$month&year=$year&mun=$mun&uf=$uf&path_calendar=$path_calendar');
                        });
                    </script>
                ";
		}
                
                function apresentacao_topo(){
                    $this->load->model("Layouttopo_model");
                    $aux_conteudo = $this->Layouttopo_model->get_topo_site();
                    $total_topo = count($aux_conteudo)-1;
                    
                    $conteudo_topo="
                        <script>
                        var photos = [";
                    $i=1;
                    foreach($aux_conteudo as $conteudo_item){
                        
                        $imagem_aux= explode("\"",$conteudo_item->imagem);
                        $conteudo_topo.=
                          "{
                          \"image\" : \"". $imagem_aux[1]."\",
                          \"url\" : \"".$conteudo_item->url."\",
                          \"firstline\" : \"".$conteudo_item->primeira_linha."\",
		          \"secondline\" : \"".$conteudo_item->segunda_linha."\"}
                          ";
                        if($i<=$total_topo){
                        $conteudo_topo.=",";    
                        }
                        $i++;
                        
                        unset($imagem_aux);
		    }
                    $conteudo_topo.="]</script>";
                    return $conteudo_topo;
                }
                
      function caminho_imagem($imagem){
                $caminho_aux = "";
                $caminho_aux_1 = "";
                $caminho_aux = explode('src="',$imagem);
                if (count($caminho_aux)>1){
                  $caminho_aux_1 = explode('"',$caminho_aux[1]);
                  return $caminho_aux_1[0];
                }else{
                  return ;
                }  
         }

		// Função para transformar strings em Maiúscula ou Minúscula com acentos
		// $palavra = a string propriamente dita
		// $tp = tipo da conversão: 1 para maiúsculas e 0 para minúsculas
		function convertem($term, $tp) {
			if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïğñòóôõö÷øùüúşÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚŞß");
			elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚŞß","àáâãäåæçèéêëìíîïğñòóôõö÷øùüúşÿ");
			return $palavra;
		}
		
		// Exemplo
		// $text = "this is a sentence. this is another sentence! this is the fourth sentence? no, this is the fourth sentence.";
		//$text = sentence_cap(". ",$text);
		//$text = sentence_cap("! ",$text);
		//$text = sentence_cap("? ",$text);
		
		function sentence_cap($impexp, $sentence_split) {
			$textbad=explode($impexp, $sentence_split);
			$newtext = array();
			foreach ($textbad as $sentence) {
				$sentencegood=ucfirst(strtolower($sentence));
				$newtext[] = $sentencegood;
			}
			$textgood = implode($impexp, $newtext);
			return $textgood;
		}	
		
		function maximo_palavras($frase,$numero){
			$aux = explode(" ",$frase);
			$resultado="";
			for ($i=0;$i<$numero;$i++){
				$resultado.=$aux[$i]." ";
			}
			if (count($aux)>$numero){
				$resultado.=$aux[$i]." ... <a href='".$this->conteudo["site_url"]."avisos'>Veja Mais</a>";
			}
			return  $resultado;
		}
}
	
	
?>