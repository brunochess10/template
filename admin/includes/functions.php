<?php
#
# Projeto :  Lucato
# Data : 29/01/2004
#
# Arquivo com funções comuns
#

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

$trimestre_extenso[1] = "1o Trimestre";
$trimestre_extenso[2] = "2o Trimestre";
$trimestre_extenso[3] = "3o Trimestre";
$trimestre_extenso[4] = "4o Trimestre";

function EnviaEmail($mail,$email,$method,$gateway){
  if ($gateway){
      return send_gateway($mail,$email,$method);
  }else{
      return $mail->send($email, $method );
  }
}

function set_params_smtp( $mail ){
			global $smtp;
			if( $smtp["use"] ) {
					$mail->setSMTPParams( $smtp["host"], $smtp["port"], $smtp["hello"], $smtp["auth"], $smtp["auth_type"] , $smtp["user"], $smtp["pass"]);
			}
}

function valor_extenso($valor=0) {
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
	$z=0;

	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

	return($rt ? $rt : "zero");
}


$debug_process = false;
function debug($str){
		global $debug_process;
		if ( $debug_process ) {
				$filename = "includes/debug.txt";
				$handle = fopen ($filename, "a+");
				$conteudo = fread ($handle, filesize ($filename));

				$conteudo .= "PAGE: " . $_SERVER["SCRIPT_NAME"]. "=>" . $str . "<br>\n\r";
				fwrite( $handle, $conteudo );

				fclose ($handle);
		}
}

function read_debug(){
		$filename = "includes/debug.txt";
		$conteudo = readfile( $filename );
		echo htmlspecialchars( $conteudo );

		$handle = fopen($filename, "w");
		fwrite( $handle, "", 0);
		fclose($handle);
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

//verifica se a data ´e valida
function datevalid( $date ) {
                $day = substr($date,0,2);
                $month = substr($date,3,2);
                $year = substr($date,6,4);
				if ( strlen( $year ) < 4 )
						return false;
				else
		                return checkdate($month, $day, $year);
}

function currency( $value, $decimal = 2 ) {
	return ( number_format($value, $decimal , "," , ".") );
}

function str_to_currency( $value ){

			while ( strpos($value, ".") > 0 ){
					$prefix = substr($value,0, strpos($value, ".") );
					$sufix = substr( $value, strpos($value, ".")+1 , strlen($value) - strpos($value,".") -1);
					$value =  $prefix . $sufix;
			}
            $value = str_replace( "," ,  "." , $value );


			$value = floatval($value);
			return  (float)$value;
}

function do_redirect( $url ){
	header("Location : $url ");
	$html = "<html>\n\r" .
	              "<head>\n\r" .
	              "</head>\n\r" .
	              "		<body onload=\"document.location='$url';\">\n\r" .
	              "		</body>\n\r" .
	              "</html>";
	echo $html;
	exit;
}

function LoadErrorsServidor_add($mess,$obj, $id = "", $div = ""){
	if ( $id == "" ) {
			return "	AddError(\"" . $mess . "\"," . $obj . ");\n\r";
	} else {
			if ( $div != "" ) {
					return "    AddError(\"" . $mess . "\"," . $obj . ", \"$id\",\"" . $div . "\");\n\r";
			} else {
					return "	AddError(\"" . $mess . "\"," . $obj . ", \"$id\");\n\r";
			}
	}
}

function strip_html( $html ) {
  $texto = preg_replace('/<(script|style)[^>]*>.+<\/(script|style)[^>]*>/is', '', $html);
  $texto = strip_tags( $texto );
  $texto = str_replace("&nbsp;", " ", $texto );
  return $texto;
}

function show( $str ) {
		$temp = htmlspecialchars( $str );
		$temp = stripSlashes( $temp );
		return $temp;
}


	//*******************************************************************
	// Aqui começam as funções para trabalhar com as globais dependendo da versão do PHP
	//*******************************************************************
 	/*
	//Versão 4.0.*
	function request_post( $var ) {
		global $HTTP_POST_VARS;
		return $HTTP_POST_VARS[$var];
	}

	function request_get( $var ){
		global $HTTP_GET_VARS;
		return $HTTP_GET_VARS[$var];
	}

	function request_session( $var ){
		global $HTTP_SESSION_VARS;
		return $HTTP_SESSION_VARS[$var];
	}

	function request( $var ){
		global $HTTP_POST_VARS;
		global $HTTP_GET_VARS;
		$result = $HTTP_POST_VARS[$var];
		if ( !isset($result) ){
			$result = $HTTP_GET_VARS[$var];
		}
		return $result;
	}

	function get_global_post(){
		global $HTTP_POST_VARS;
		return $HTTP_POST_VARS;
	}

	function get_global_get(){
		global $HTTP_GET_VARS;
		return $HTTP_GET_VARS;
	}

	function set_session( $var , $value ){
		global $HTTP_SESSION_VARS;
		$HTTP_SESSION_VARS[$var] = $value;
	}

	function set_post( $var , $value ){
		$HTTP_POST_VARS[$var] = $value;
	}

	function set_get( $var, $value ){
		$HTTP_GET_VARS[$var] = $value;
	}

	//fim da versão 4.0.*

	*/

	//Versão 4.1.*
	//inicio das funções comentadas
	function request_post( $var ) {
		return $_POST[$var];
	}

	function request_get( $var ){
		return $_GET[$var];
	}

	function request_session( $var ){
		return $_SESSION[$var];
	}

	function request( $var ){
		$result = $_POST[$var];
		if ( !isset($result) ){
			$result = $_GET[$var];
		}
		return $result;
	}

	function get_global_post(){
		return $_POST;
	}

	function get_global_get(){
		return $_GET;
	}

	function set_session( $var , $value ){
		$_SESSION[$var] = $value;
	}

	function set_post( $var , $value ){
		$_POST[$var] = $value;
	}

	function set_get( $var, $value ){
		$_GET[$var] = $value;
	}

	 // fim das funções comentadas
	//fim da versão 4.1.*



	// ------------------------------------------------------
	// Funções para relatorios
	//---------------------------------------------------------
	//
	function start_splash(){
			?>

		<center>
		<div id="splash_report" style="width:80%;display:none;">
		<fieldset class='mensagemfild'><legend><img src='images/mensagem.gif'/></legend>
		Preparando . . .
		</fieldset>
		</div>
		</center>
		<script type="text/javascript">
				var div = document.getElementById("splash_report");
				if ( div ) {
						div.style.display ="";
				}
		</script>

			<?
	}

	function finish_splash(){
			?>
					<script type="text/javascript">
							var div = document.getElementById("splash_report");
							if ( div ) {
									div.style.display ="none";
							}
					</script>
			<?
	}






	// ------------------------------------------------------
	// Funções para trabalhar com a classe QUERY INICIO
	//---------------------------------------------------------
	//		$navbar["max_row"] = 5;
	//		$navbar["max_page"] = 3;
	//      $navbar["page"] = request("page");
	//		$navbar["mult_page_start"] = request("mult_page_start");
	//		$navbar["action"] = request("action");
	//      $navbar["rows"] = ;

	function strtoupperforsearch( $str ){
			$result = strtoupper( $str );
			# Convert values from Lower to Upper
   			$arrayLower=array('ç'
   			,'â','ã','à','á','ä'
   			,'é','è','ê','ë'
			,'í','ì','î','ï'
		    ,'ó','ò','ô','õ','ö'
		    ,'ú','ù','û','ü');

		    $arrayUpper=array('Ç'
		    ,'Â','Ã','Á','À','Ä'
		    ,'É','È','Ê','Ë'
		    ,'Í','Ì','Î','Ï'
		    ,'Ó','Ò','Õ','Ô','Ö'
		    ,'Ú','Ù','Û','Ü');

			if($result == ''){
				   return $result;
			}

		   $result = str_replace( $arrayLower, $arrayUpper, $result);

		   return($result);
	}

	function retiraacento( $str ){
			$result = $str;
   			$arrayLower=array('ç'
   			,'â','ã','à','á','ä'
   			,'é','è','ê','ë'
			,'í','ì','î','ï'
		    ,'ó','ò','ô','õ','ö'
		    ,'ú','ù','û','ü');

   			$arrayLowerSem=array('c'
   			,'a','a','a','a','a'
   			,'e','e','e','e'
			,'i','i','i','i'
		    ,'o','o','o','o','o'
		    ,'u','u','u','u');

		    $arrayUpper=array('Ç'
		    ,'Â','Ã','Á','À','Ä'
		    ,'É','È','Ê','Ë'
		    ,'Í','Ì','Î','Ï'
		    ,'Ó','Ò','Õ','Ô','Ö'
		    ,'Ú','Ù','Û','Ü');

		    $arrayUpperSem=array('C'
		    ,'A','A','A','A','A'
		    ,'E','E','E','E'
		    ,'I','I','I','I'
		    ,'O','O','O','O','O'
		    ,'U','U','U','U');


			if($result == ''){
				   return $result;
			}

		   $result = str_replace($arrayUpper,  $arrayUpperSem, $result);
		   $result = str_replace($arrayLower,  $arrayLowerSem, $result);

		   return($result);

	}

	function arrange_query( $query ){
		$query = stripslashes( $query );
		$query = str_replace("'", "''", $query );
		return $query;
	}

	function get_dataset_search( &$database, $module, $query , &$navbar, $allwords, $pi,$order){
			$query = arrange_query( $query );
			$table = $module["pesquisa_tabela"];
			if ( empty( $module["pesquisa_campos"] ) ){
					$fields = "*";
			} else {
					$fields = $module["pesquisa_campos"];
			}

			$first_and = true;

			if ( empty( $module["where"] ) ) {
					$where = " where ";
			} else {
					 $command = " \$where = \" where " . $module["where"] . ";";
					$first_and = false;

					 eval( $command );
			}

			if ( $allwords == "yes" ){ 	$allword = " and ";} else {$allword = " or ";	}

			$words = split(" ", $query );

			$fields_search = split(",", $fields);
			for( $k = 0; $k < count( $words ); $k++ ) {
					if ( !empty($words[ $k ]) ) {
							if ( $first_and )  { $first_and = false; $and = "  "; } else { $and = " $allword "; }
							$where .= " $and ( ";
							$first_or = true;
							for ( $i = 0; $i < count($fields_search) ; $i++ ) {
									if ( $first_or ) { $first_or = false; $or = "  "; } else { $or = " or "; }
										$where .= " $or ( upper(" . $fields_search[ $i ] . ") like ('";
										if($pi != "yes") $where .= "%";
										$where .= strtoupperforsearch($words[ $k ]) . "%') )";
										if( strtoupperforsearch($words[ $k ]) != retiraacento( strtoupperforsearch($words[ $k ]) ) ){
												$where .= " or ( upper(" . $fields_search[ $i ] . ") like ('";
												if($pi != "yes") $where .= "%";
												$where .= strtoupper( retiraacento( $words[ $k ]) ). "%') )";
										}

							}
							$where .= " ) ";
					}
			}


			// buscar o total de registros que contem
			//-----------------------------------------------
			$result = new QUERY($database);
			$select = " select  * from $table  ";
			if( $where != " where " ) {	$result->SQL = $select . " " . $where . " order by " . $order; } else { $result->SQL = $select . " order by " . $order; }


			//$rows = $navbar["rows"];
			//if ( empty($rows) ){
					$result->EXECUTE($result->SQL);
					$navbar["rows"] = $result->NUMROWS();
					$result->FREE();
					$result = new QUERY($database);
			//}
			//----------------------------------------------


			// limitar a consulta
			// ---------------------
			if ( empty($navbar["page"]) ) { // caso naum tiver selecionado pagina alguma fora a primeira pagina
				$limit = " LIMIT 0,". $navbar["max_row"];
				$navbar["page"] = 1;
			} else { // se foi setado a pagina multiplicar pelo numero de registros que cabem em uma pagina formando o range
				$range_start = ( ($navbar["page"]-1) * $navbar["max_row"]);
				$limit = " LIMIT $range_start," . $navbar["max_row"];
			}
			// fim da montagem do limite
			//----------------------------------


			//calculos para multi paginação
			//-----------------------------------
			$tot_pages = ceil($navbar["rows"] / $navbar["max_row"]);

			$navbar["url_nav"] = "";

			//pagina inicial e final
			$metade = floor( $navbar["max_page"] / 2 );
			$restometade = ( $navbar["max_page"] % 2 );
			$outrametade =  $metade  + $restometade;

			$pagina_inicial = $navbar["page"] - $metade;
			if ( $pagina_inicial  <= 0 ) {
					$pagina_inicial = 1;
					$pagina_final = $outrametade + $navbar["page"] -1;
			} else {
					$pagina_inicial = $navbar["page"] - $metade;
					$pagina_final = $navbar["page"] + $outrametade -1;
			}
			if ( ($pagina_final - $pagina_inicial + 1) < $navbar["max_page"] ) $pagina_final += $navbar["max_page"] - ($pagina_final - $pagina_inicial + 1);
			if( $pagina_final > $tot_pages ) {
					$pagina_inicial -= ( $pagina_final - $tot_pages );
					if( $pagina_inicial <= 0) $pagina_inicial = 1;
					$pagina_final = $tot_pages;
			}
			//fim da pagina inicial e final

			if ( $navbar["page"] > 1 ) {// monta as setas de navegação primeira e anterior
							$navbar["url_nav"] .= " <a href=\"" . $navbar["url_default"] . "&page=1&query=$query&order=$order&allwords=$allwords&pesqinicial=$pi&makesearch=yes\"><<</a> ";
							$voltar = $navbar["page"]-1;
							$navbar["url_nav"] .= " <a href=\"" . $navbar["url_default"] . "&page=$voltar&query=$query&order=$order&allwords=$allwords&pesqinicial=$pi&makesearch=yes\"><</a> ";
			}

			for ( $i = $pagina_inicial; ( $i <= $pagina_final ) ; $i++){//// monta as paginas navegações númericas
					if ( $i == $navbar["page"] ) {
							$navbar["url_nav"] .= " $i ";
					} else {
							$navbar["url_nav"] .= " <a href=\"" . $navbar["url_default"] . "&page=$i&query=$query&order=$order&allwords=$allwords&pesqinicial=$pi&makesearch=yes\">$i</a> ";
					}
			}
			if ( $navbar["page"] < $tot_pages ) { // monta as setas de navegação proxima e ultima
							$voltar = $navbar["page"]+1;
							$navbar["url_nav"] .= " <a href=\"" . $navbar["url_default"] . "&page=$voltar&query=$query&order=$order&allwords=$allwords&pesqinicial=$pi&makesearch=yes\">></a> ";
							$navbar["url_nav"] .= " <a href=\"" . $navbar["url_default"] . "&page=$tot_pages&query=$query&order=$order&allwords=$allwords&pesqinicial=$pi&makesearch=yes\">>></a> ";
			}

			if( $navbar["url_nav"] == " 1 " ){ $navbar["url_nav"] = ""; }



			// fim dos calculos de navegação
			//-------------------------------------



			$select = " select * from $table ";
			if( $where != " where " ) {
					$result->EXECUTE( $select . " " . $where . " order by $order $limit" );
			} else {
					$result->EXECUTE( $select . "  order by $order $limit" );
			}

			return ( $result );
	}

	function get_param( $params, $fieldname ){
			for( $i=0; $i < count($params); $i++ ){
					if ( $params[$i]["name"] == $fieldname ) {

							return $params[ $i ];
					}
			}
			return false;
	}

	function mount_help( $help ) {
				return	"<img src=\"images/ajuda.jpg\" alt=\"". $help . " \" title=\"". $help . " \" > ";

	}

	function mount_input( $info, $newvalue, $oldvalue, &$param, $disabled,$sufixnew,$sufixold, $master = true, $index = 0 ){
			global $sid_get;
			//tipos de campos
			$date = "DATE";
			$currency = "DOUBLE";
			$integer = "LONG";
			$cep = "CEP";
			$cpf = "CPF";
			$select = "SELECT";
			$memo = "TEXT";
			$hidden = "HIDDEN";
			$blob = "BLOB";
			$autoinc = "AUTOINC";
			$numeric = "NUMERIC";
			$checkbox = "CHECKBOX";
			$senha = "PASSWORD";


			// Cuidados ao exibir
			$newvalue = show( $newvalue );
			$oldvalue = show( $oldvalue );

			//if ( $param["lookup"] ) $info["name"] = $param["lookup_local"];
			//-----------------------------------------------------------

			// organiza os parametros do input
			//---------------------------------------------
			$id = " id=\"" . $info["name"] . $sufixnew . "_" . $index . "\" ";
			$id_natural = $info["name"] . $sufixnew . "_" . $index;
			$id_result = $info["name"] . $sufixnew . "_" . $index . "_result";
			$get_this = " document.getElementById('". $info["name"] . $sufixnew . "_" . $index ."') ";
			if (!empty($disabled) ) $style = "style=\"background-color:#f2f2f2\"";
			$parametro = $disabled . " " . $id .  "  "  . $style;
			//---------------------------------------------------------------
			// Caso for Checkbox
			if($param["checked_value"] == $newvalue) {
				$checked = "checked=\"checked\"";
			} else {
				$checked = "";
			}
			//---------------------------------------------------------------
			//Se tiver lookup
			//---------------------------------------------------
					if( $param["lookup"] ){
							if( ( $param["type"] == $integer )  ) {
								$onblur = "onblur=\"remove_left_zero(this,1)\"";
							} else {
								$onblur = "onblur=\"onlookup(this);\"";
							}
							$onlookup .= "  " . $onblur . " ";
							$input_result = "&nbsp;<input type=\"text\" id=\"". $id_result ."\" disabled=\"disabled\" size=\"40\">";
					} else {
							$onlookup = "";
							$input_result = "";
					}
			//-----------------------------------------------------------------
			//Se tiver OnBlur
				$on_blur = "";
				if($param["onblur"]) {
					$on_blur = "onblur=\"".$param["onblur"]."\"";
				}

			// Se tiver OnFocus
				$on_focus = "";
				if($param["onfocus"]) {
					$on_focus = "onfocus=\"".$param["onfocus"]."\"";
				}
			//-------------------------------------------------------------------
			//ajusta variaveis
			//-------------------------------------------------------------
			if ( !$master ) {
					$sufixnew .= "[]";
					$sufixold .= "[]";
			}

			//Se tiver Parametro SIZE
			//-------------------------------
			if ( $param["size"] ) { $size = $param["size"]; } else { $size = $info["length"];}
			//--------------------------------

			//Se tiver Parametro maxlength
			if ( $param["maxlength"] ) { $maxlength = $param["maxlength"]; } else { $maxlength = $info["length"]; }
			if ( ($param["type"] == $integer) && empty($param["maxlength"])) {	$maxlength = 9; }
			if ( ($param["type"] == $integer) && empty($param["size"])) {$size = 9; }

			//Se tiver tipo tipo campo
			//-------------------------------
			if ( $param["type"] ) { $type = $param["type"]; } else { $type = $info["type"]; }
			//--------------------------------



			$input = "";

			if ( $type == $date ) { // input de DATA
					if ($newvalue[2]=="/"){
						$data_arrumada=$newvalue;
					}else{	
						$data_brasil = explode("-",$newvalue);
						$data_arrumada = $data_brasil[2]."/".$data_brasil[1]."/".$data_brasil[0];					
					}
					$input = "<input type=\"text\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"10\" value=\"$data_arrumada\"  size=\"12\"  onkeypress=\"return mask_format_data(event,this)\" value=\"$newvalue\"  $parametro  />&nbsp;&nbsp;<input style=\"border:solid 1px #346767; font: 11px Verdana;\" type=\"button\" " .
			             "onclick=\"return showCalendar( this );\"  value=\"...\" name=\"$id_natural\"/>";
					if( empty($param["help"]) ){ $param["help"] = "formato (DD/MM/AAAA)"; }
					
			} else if ( $type == $currency ){ // input VAlores
					if ($param["decimals"] ){ $dec = " , " . $param["decimals"];	} else { $dec = "";}
		  			$input = "<input type=\"text\" style=\"text-align:right;\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"18\"  size=\"15\"  onkeypress=\"return currency_keypress(event,this $dec)\"  onblur=\"remove_left_zero(this)\"  value=\"$newvalue\"  $parametro />" ;
					if( empty($param["help"]) ){ $param["help"] = "formato (1.000,00)"; }
			} else if( $type == $integer ) { // input de inteiros
		  			$input = "<input type=\"text\" style=\"text-align:right;\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"". $maxlength . "\" value=\"$newvalue\"  size=\"". $size . "\" onkeypress=\"return integer_keypress(event, this)\"  $onblur value=\"$newvalue\" $parametro />";
					if( empty($param["help"]) ){ $param["help"] = "digite somente números"; }
			} else if( $type == $numeric ) {
		  			$input = "<input type=\"text\" style=\"text-align:right;\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"". $maxlength . "\" value=\"$newvalue\"  size=\"". $size . "\" onkeypress=\"return integer_keypress(event, this)\"  $onblur value=\"$newvalue\" $parametro />";
					if( empty($param["help"]) ){ $param["help"] = "digite somente números"; }
			} else if( $type == $cep ) { // input com mascara de CEP
		  			$url_cep = "robo_cep.php?retorno_endereco=".$param["return"]["endereco"]."".$sufixnew."_".$index;
						$url_cep .= "&retorno_bairro=".$param["return"]["bairro"]."".$sufixnew."_".$index;
						$url_cep .= "&retorno_municipio=".$param["return"]["municipio"]."".$sufixnew."_".$index;
						$url_cep .= "&retorno_estado=".$param["return"]["estado"]."".$sufixnew."_".$index;
						$url_cep .= "&retorno_cep=".$param["return"]["cep"]."".$sufixnew."_".$index;
						$url_cep .= "&$sid_get&modo=logradouro";
						$url_log = "robo_cep.php?retorno_cep=".$param["return"]["cep"]."".$sufixnew."_".$index;
						$url_log .= "&$sid_get&modo=cep";
						$input = "<input type=\"text\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"9\" value=\"$newvalue\"  size=\"" .  $size . "\" value=\"$newvalue\"  onkeypress=\"return mask_format_cep(event, this)\"  $parametro /> <input type=\"button\" id=\"btn_cep_0\" value=\"CEP\"  urlpopup=\"$url_cep\" onclick=\"proc_cep(this)\" class=\"botaofild\"> <input type=\"button\" id=\"btn_log_0\" value=\"LOGRADOURO\"  urlpopup=\"$url_log\" onclick=\"proc_log(this)\" class=\"botaofild\">";
					if( empty($param["help"]) ){ $param["help"] = "formato (99999-999)"; }
			} else if( $type == $cpf ) { // input com mascara de CPF
		  			$input = "<input type=\"text\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"14\" value=\"$newvalue\"  size=\"" .  $size . "\" value=\"$newvalue\"  onkeypress=\"return mask_format_cpf(event, this)\"  $parametro />";
					if( empty($param["help"]) ){ $param["help"] = "formato (999.999.999-99)"; }
			} else if( $type == $select ) {	// input select
					$input = "<select name=\"" . $info["name"] . "$sufixnew\"  $parametro >";
					$input .= "<option value=\"\" > Escolha </option>";
					for ( $i = 0; $i < count($param["options"]); $i++){
							$option = $param["options"][$i];
							($newvalue == $option["value"] )?($selected = " selected "):($selected = "");
							$input .= "<option value=\"" . $option["value"] . "\"".   $selected  . "  > " . $option["caption"] . "</option>";
					}
					$input .= "</select>";
					if( empty($param["help"]) ){ $param["help"] = "escolha uma opção"; }
			} else if ( $type == $memo ) { // input MEMO
					$input = "<textarea name=\"" . $info["name"] . "$sufixnew\" rows=\"5\" cols=\"70\"  $parametro  onkeypress=\"return max_memo($maxlength,this)\"  onblur=\"return max_memo($maxlength,this)\" >" .  $newvalue   . "</textarea>";
					if( empty($param["help"]) ){ $param["help"] = "máx. de $maxlength caracteres"; }
			} else if ( $type == $blob ) { // input BLOB
					if ( !empty($disabled) ) $ler_texto = "<br/><a href=\"javascript:blob($get_this, 'visualizar texto')\"> ler texto </a>";
					$input = "<textarea name=\"" . $info["name"] . "$sufixnew\" rows=\"5\" cols=\"70\"  $parametro  >" .  $newvalue   . "</textarea> $ler_texto";
			} else if ( $type == $hidden ) { // inpput HIDDEN
		  			$input = "<input type=\"hidden\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"" . $maxlength . "\" value=\"$newvalue\"  size=\"" .  $size . "\" value=\"$newvalue\" $parametro />";
			} else if ( $type == $autoinc ) { // input AUTOINC
		  			$input = "<input type=\"hidden\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"" . $maxlength . "\" value=\"$newvalue\"  size=\"" .  $size . "\" value=\"$newvalue\" $parametro />";
			} elseif ( $type == $checkbox ){ // input CHECKBOX
		  			$input = "<input type=\"checkbox\" $checked name=\"". $info["name"] . "$sufixnew\" value=\"".$param["checked_value"]."\"  $parametro />";
			} elseif ( $type == $senha){
					$input = "<input type=\"password\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"" . $maxlength . "\"  size=\"" .  $size . "\"  $parametro  $onlookup  $on_blur  $on_focus/>";		
			} else { // default
		  			$input = "<input type=\"text\" name=\"". $info["name"] . "$sufixnew\" maxlength=\"" . $maxlength . "\" value=\"$newvalue\"  size=\"" .  $size . "\" value=\"$newvalue\"  $parametro  $onlookup  $on_blur  $on_focus/>";
					if( empty($param["help"]) ){ $param["help"] = "máx. de $maxlength caracteres"; }
			}

			if( $input != "" ) {
					$input .= $input_result;
					$input .= " <input type=\"hidden\" name=\"" . $info["name"] . "$sufixold\" value=\"" . $oldvalue . "\">";
					$input .= " <input type=\"hidden\" name=\"" . $info["name"] . "_type\" value=\"" . $type . "\">";
					if ( $param["lookup"] ) {
							$input .="<input type=\"hidden\" name=\"" . $info["name"] . "_lookup\" value=\"" .  $param["lookup_result"] . ";" . $param["lookup_key"] . ";". $param["lookup_table"] . ";". $param["lookup_include"].  "\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_field\" value=\"". $param["lookup_key"] ."\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_table\" value=\"". $param["lookup_table"] ."\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_field_result\" value=\"". $param["lookup_field_show"] ."\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_id_result\" value=\"". $id_result ."\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_sid_get\" value=\"". $sid_get ."\">";
							$input .= "<input type=\"hidden\" id=\"" . $id_natural . "_include\" value=\"" . $param["lookup_include"] . "\">";
					}
			}

			return $input;
	}

	function get_inputs( $query, $params, $mode,$sufixnew,$sufixold, $master = true) {
			if( !$master ) {
					$sufixnew .= "[]";
					$sufixold .= "[]";
			}

			$index = 0;
			$hiddens = array();
			$index_hidden = 0;


			for ( $i = 0; $i < $query->FIELDCOUNT; $i++ ){
					$info = $query->FIELDINFO( $i );
					
					if ( empty($info["name"]) ) $info["name"] = $info["alias"];
					$param = get_param( $params, $info["name"] );
					if ($param["invisible"]) continue;
					//Se tiver tipo tipo campo
					//-------------------------------
					if ( $param["type"] ) { $type = $param["type"]; } else { $type = $info["type"]; }
					switch ( $type ) {
						case "DOUBLE":
							$value =  currency( $query->BYNAME( $info["name"] ) );
							break;
						case "BLOB":
							$value = $query->BYNAME( $info["name"] );
							break;
						default :
							$value = sql_to_text( $query->BYNAME( $info["name"] ) );
							
					}


					$newvalue="";
					if( ( ( $mode == "edit" ) || ( $mode == "detail" )) && ( $master ) ){
							$oldvalue  = $value;
							$request_field = request( $info["name"] . $sufixnew ) ;
							
							( isset($request_field))?( $newvalue = $request_field):( $newvalue  = $value );
							//debug("name: " . $param["name"] . "| value: $value ");

							( ($mode == "detail") || $param["disabled"] )?( $disabled = "readonly"):($disabled = "");
							if( !empty($disabled) && (($type == "SELECT") || ($type == "CHECKBOX")) ) $disabled = "disabled";
					}else if ($master) {
							$oldvalue = "";
                            $request_field =  request( $info["name"] . $sufixnew ) ;
                            ( isset($request_field))?( $newvalue = $request_field):( $newvalue  = "" );
							( $param["disabled"] )?( $disabled = "readonly"):($disabled = "");
					}

					if ( isset($param["default"]) ){;
							$request_field = "";
							$newvalue = $param["default"];
							$oldvalue = "";
					}

					$input_aux = mount_input( $info, $newvalue, $oldvalue, $param, $disabled,$sufixnew ,$sufixold );

					if( ( $param["type"] == "HIDDEN" ) || ( $param["type"] == "AUTOINC")  ) {
						$hiddens[ $index_hidden ] = $input_aux;
						$index_hidden = $index_hidden+1;
					} else {
						$input[$index]["input"] = $input_aux;
						if (!empty($param["caption"])) {
								$input[$index]["caption"] = $param["caption"];
						} else {
								$input[$index]["caption"] = $info["name"];
						}

						$input[$index]["help"] = $param["help"];

						$index = $index+1;
					}
			}


			$input_hidden = "";
			for( $j = 0; $j < count($hiddens); $j++){
					$input_hidden .= $hiddens[ $j ];
			}

			//if( $master ){
			$input[ count($input) -1 ]["input"] .= $input_hidden;
			//}


			return $input;
	}

	function get_inputs_detail( $query, $params, $sufixnew,$sufixold) {


			$index = 0;
			$inputs = array();

			for ( $i = 0; $i < $query->FIELDCOUNT; $i++ ){
					$info = $query->FIELDINFO( $i );
					if ( empty($info["name"]) ) $info["name"] = $info["alias"];

					$param = get_param( $params, $info["name"] );

					if ($param["invisible"]) continue;

					//Se tiver tipo tipo campo
					//-------------------------------



					if ( $param["type"] ) { $type = $param["type"]; } else { $type = $info["type"]; }


					if ($type == "DOUBLE"){
						$value =  currency( $query->BYNAME( $info["name"] ) );
					} else {
						$value = $query->BYNAME( $info["name"] );
					}

					if (!empty($param["caption"])) {
							$inputs[$index]["caption"] = $param["caption"];
					} else {
							$inputs[$index]["caption"] = $info["name"];
					}

					$inputs[$index]["info"] = $info;
					$inputs[$index]["newvalue"] = $newvalue;
					$inputs[$index]["oldvalue"] = $oldvalue;
					$inputs[$index]["param"] = $param;

					$index = $index+1;
			}



			//debug( $inputs[0]["info"]["name"] . $sufixnew );
			$filed = array();

			$field = request_post( $inputs[0]["info"]["name"] . $sufixnew );
			$count_reg = count($field );
			$index_form = 0;
			for( $y = 0; $y < $count_reg; $y++ ){
					$index_input = 0;
					$index_hidden = 0;
					$hiddens = array();
					for( $k = 0; $k < count( $inputs ); $k++ ){

							$field = request( $inputs[$k]["info"]["name"] . $sufixnew );
							$inputs[$k]["param"] = get_param( $params, $inputs[$k]["info"]["name"] );


							$input_aux = mount_input( $inputs[$k]["info"], $field[$y], $field[$y], $inputs[$k]["param"], "",$sufixnew  , $sufixold , false, $y );

							if ( ($inputs[$k]["param"]["type"] == "HIDDEN") || ($inputs[$k]["param"]["type"] == "AUTOINC")) {
									$hiddens[ $index_hidden ] = $input_aux;
									$index_hidden++;
							} else {
									$input[$index_input]["input"] = $input_aux;


									if (!empty($inputs[$k]["param"]["caption"])) {
											$input[$index_input]["caption"] = $inputs[$k]["param"]["caption"];
									} else {
											$input[$index_input]["caption"] = $inputs[$k]["info"]["name"];
									}
									$input[$index_input]["help"] = $inputs[$k]["param"]["help"];
									$index_input++;
							}
							///=================
					}

					$input_hidden = "";
					for( $j = 0; $j < count($hiddens); $j++){
							$input_hidden .= $hiddens[ $j ];
					}

					if( !$master ){
							$input[ count($input) -1 ]["input"] .= $input_hidden;
					}

					$forms[$index_form]["form"] = $input;
					$index_form ++;
			}
			return $forms;
	}

	function sql_to_text( $value ){
			return stripSlashes( $value );
	}


	function str_mysql( $value ){
			$char = "'";
			$new = $value;

			$i = -1;
			while( $i < strlen( $new ) ){
					$i++;
					if( $new[$i] == $char ){
							$part1 = substr($new,0,$i);
							$part2 =  substr($new,$i,strlen($new)-$i);
							$new =  $part1 . $char . $part2;
							$i++;
							$i++;
					}
			}
			return $new;
	}

	function text_to_sql( $value, $type ) {
			switch ( $type ) {
			case "DOUBLE" :
					while ( strpos($value, ".") > 0 ){

						$prefix = substr($value,0, strpos($value, ".") );

						$sufix = substr( $value, strpos($value, ".")+1 , strlen($value) - strpos($value,".") -1);

						$value =  $prefix . $sufix;
					}

                    $value = str_replace( "," ,  "." , $value );

					return "'" . $value . "'";
					break;
			case "DATE":
                 	if( empty($value) ){
                 			return $value;
                 	} else {
							return "'" .substr($value,6,4). "-" .substr($value,3,2). "-" .substr($value,0,2). "'" ;
					}
					break;
			/*		
			case "BLOB":
					return "?";
					break;
			*/		
			default:
					$temp = stripSlashes( $value );
					$temp = str_mysql( $temp );
					return "'" . $temp . "'";
			}
	}

	function save_form($action, $mod, $table, $key,$sufixnew,$sufixold, $master = true ){
				global $modules;
				$post_vars = get_global_post();
				$DATABASE = new DATABASE();
				$params = array();
				$param_index = -1;
				if ( $action == "edit" ){
						$sql = "update ".  $table  ." set ";
						
						$fields = array();
						$newvalue = array();
						$oldvalue = array();
						$type = array();
						
						
						reset($post_vars);
						while (list($name, $value) = each($post_vars)) {
								
								$pos = strpos($name, "$sufixnew");
								if(  $pos > 0 ){
										$newvalue[ substr($name,0,$pos) ] = $value ;
										$fields[ substr($name,0,$pos) ] = $value;
								}
								$pos = strpos($name, "$sufixold");
								if( $pos > 0 ) $oldvalue[ substr($name,0,$pos) ] = $value;

								$pos = strpos($name, "_type");
								if($pos > 0 ) $type[ substr($name,0,$pos) ] = $value;
								
						}
						reset($fields);
						$havefield = false;
						$coma = "";
						while (list($name, $value) = each($fields)) {
								if(($newvalue[$name] != $oldvalue[$name])) {
										if ( !isset($newvalue[$name] ) ) {
												$sql .= " $coma $name = null ";
										} else {
												$sql .= " $coma $name = " . text_to_sql($newvalue[ $name ], $type[ $name ]);
										}
										/*if ( $type[$name] == "BLOB" ) {
												$blob_id = ibase_blob_create($DATABASE->ID);
												ibase_blob_add($blob_id, $newvalue[ $name ] );
												$blob_id_str = ibase_blob_close($blob_id);
												$params[$param_index++] = $blob_id_str;
										}*/
										//BLOB
										if ( !$havefield ) {
												$havefield = true;
												$coma = ",";
										}
								}
						}
						$sql = "$sql where " . $modules[$mod]["edit_key"] . "='$key'";
						
						if ( $havefield ) {
								$SAVE = new QUERY( $DATABASE, $sql, $params );
								$SAVE->FREE();
						}
						return true;
				} else if ( $action == "insert" ){
						$sql = "insert into ".  $table  ." ( ";
						$fields = array();
						$newvalue = array();
						$oldvalue = array();
						$type = array();
						reset($post_vars);
						while (list($name, $value) = each($post_vars)) {
								$pos = strpos($name, "$sufixnew");
								if(  $pos > 0 ){
										$newvalue[ substr($name,0,$pos) ] = $value ;
										$fields[ substr($name,0,$pos) ] = $value;
								}
								$pos = strpos($name, "$sufixold");
								if( $pos > 0 ) $oldvalue[ substr($name,0,$pos) ] = $value;

								$pos = strpos($name, "_type");
								if($pos > 0 ) $type[ substr($name,0,$pos) ] = $value;
						}

						reset($fields);
						$havefield = false;
						$coma = "";
						while (list($name, $value) = each($fields)) {
								$sql .= " $coma $name ";
								if ( !$havefield ) {
										$havefield = true;
										$coma = ",";
								}
						}

						$sql .= " ) values ( ";


						reset($fields);
						$havefield = false;
						$coma = "";
						while (list($name, $value) = each($fields)) {
								// se for autoinc fazer o generator automatico
								/*if ( $type[ $name ] == "AUTOINC" ) {
										$newvalue[ $name ] = generator( "GERADOR" );
										set_post( $name . $sufixnew, $newvalue[ $name ] );
								}*/


								if ( empty($newvalue[$name] ) ) {
										$sql .= " $coma null ";
								} else {
										$sql .= " $coma  " . text_to_sql($newvalue[ $name ], $type[ $name ]);
								}
								/*			
								if ( $type[ $name ] == "BLOB" ) {
										$blob_id = ibase_blob_create( $DATABASE->ID );
										ibase_blob_add($blob_id, $newvalue[ $name ] );
										$blob_id_str = ibase_blob_close($blob_id);
										$params[$param_index++] = $blob_id_str;
								}*/

								if ( !$havefield ) {
										$havefield = true;
										$coma = ",";
								}
						}

						$sql .= " ) ";
						$SAVE = new QUERY($DATABASE, $sql, $params);
						$SAVE->FREE();
						return true;
				} else {
						return false;
				}
	}

	function save_form_itens($action, $table, $sufixnew,$sufixold){
				global $modules;
				$post_vars = get_global_post();

				$ib_atual = $ib_databasename;
				$DATABASE = new DATABASE();

				if ( $action == "insert" ){
						$sql = "insert into ".  $table  ." ( ";

						$fields = array();
						$type = array();

						reset($post_vars);
						while (list($name, $value) = each($post_vars)) {
								$pos = strpos($name, "$sufixnew");
								if(  $pos > 0 ){
										$fields[ substr($name,0,$pos) ] = $name;
								}
								$pos = strpos($name, "_type");
								if($pos > 0 ) $type[ substr($name,0,$pos) ] = $value;
						}

						$havefield = false;
						$coma = "";
						reset($fields);
						while (list($name, $value) = each($fields)) {
								$sql .= " $coma " . $name;
								if ( !$havefield ) {
										$first_field_name = $value;
										$havefield = true;
										$coma = ",";
								}
						}

						$sql .= " ) values ( ";

						$first_field = request( $first_field_name );
						for( $k = 0 ; $k < count($first_field); $k++ ){

								$params = array();
								$param_index = -1;

								$insert = $sql;


								reset($fields);
								$havefield = false;
								$coma = "";
								while (list($name, $value) = each($fields)) {
										$newvalue = request( $value );

										$lookupnew = request( $name . "_lookup");
										if ( !empty($lookupnew) ){
												$lookup = split(";",$lookupnew);
												//0 - result
												//1 - key
												//2 - table
												//3 - include
												if ( $lookup[3] == "common" ){include "includes/ibase_common.php";} else {include "includes/ibase_empresa.php";}
												$wl = text_to_sql($newvalue[ $k ], $type[ $name ]);
												if (  $wl == "''" ){$wl = " is null ";} else {$wl = " = " . $wl  ;}

												$sqllk = "select " . $lookup[0] . " as RESULT from " . $lookup[2] . " where " . $lookup[1] . " $wl " ;

												if( $ib_atual != $ib_databasename ) {
														$LOOKUP = new QUERY($COMMON,$sqllk);
												} else {
														$LOOKUP = new QUERY($DATABASE,$sqllk);
												}
												$LOOKUP->NEXT();
												$result_lookup = $LOOKUP->BYNAME("RESULT");

												if( empty( $result_lookup ) ) {
														$result_lookup = "null";
												} else {
														$result_lookup = "'" . $result_lookup . "'";
												}
												$insert .= " $coma $result_lookup ";
												$LOOKUP->FREE();
												//include "includes/ibase_empresa.php";

										} else if ( empty($newvalue[$k] )  ) {
												$insert .= " $coma null ";
										} else {
												$insert .= " $coma  " . text_to_sql($newvalue[ $k ], $type[ $name ]) . "";
										}

										if( ( $type[ $name ] == "BLOB" ) && ( !empty($newvalue[$k] ) ) ){
												$blob_id = ibase_blob_create( $DATABASE->ID );
												ibase_blob_add($blob_id, $newvalue[ $k ] );
												$blob_id_str = ibase_blob_close($blob_id);
												$param_index++;
												$params[$param_index] = $blob_id_str;
										}


										if ( !$havefield ) {
												$havefield = true;
												$coma = ",";
										}
								}

								$insert .= " ) ";
								$SAVE = new QUERY($DATABASE, $insert, $params);
								$SAVE->FREE();
								
						}
						return true;
				} else {
						return false;
				}
	}

	function mount_report( $query, $individual = false ) {
			$first = false;

			$reg = 0;
			$report = array();
			if ( $individual ) {
			//individual
					if ( !$first ) {

							$fields = array();
							for ( $i = 0; $i < $query->FIELDCOUNT; $i++ ){
									$info = $query->FIELDINFO( $i );
									//if ( empty($info["name"]) )
                                    $info["name"] = $info["alias"];
									$fields[$i] = $info["name"];

							}

							$first = true;
					}

					$field = array();
					for( $y = 0 ; $y < count($fields); $y++ ) {
							$field[$y]["name"] = $fields[ $y ];
							$field[$y]["value"] = $query->BYNAME( $fields[ $y ] );
							//echo "<br>name : " . $field[$y]["name"];
							//echo "<br>value : " . $field[$y]["value"] . "<hr>";

					}
					$report[ $reg++ ] = $field;
			} else {
			// de todos
			while ( $query->NEXT() ) {
					if ( !$first ) {

							$fields = array();
							for ( $i = 0; $i < $query->FIELDCOUNT; $i++ ){
									$info = $query->FIELDINFO( $i );
									//if ( empty($info["name"]) )
                                    $info["name"] = $info["alias"];
									$fields[$i] = $info["name"];

							}

							$first = true;
					}

					$field = array();
					for( $y = 0 ; $y < count($fields); $y++ ) {
							$field[$y]["name"] = $fields[ $y ];
							$field[$y]["value"] = $query->BYNAME( $fields[ $y ] );
							//echo "<br>name : " . $field[$y]["name"];
							//echo "<br>value : " . $field[$y]["value"] . "<hr>";

					}
					$report[ $reg++ ] = $field;
			}
			}
			return $report;
	}

	function print_report( $report , $titulo ){
			$result = "
			<table class='tt'><tr><td>$titulo</td></tr></table>
			";

			for( $reg = 0; $reg < count($report); $reg++){
					$result .= "
					<table class='relatorio'>
					<col width='20%'/>
					";

					for( $fields = 0; $fields < count($report[$reg]); $fields++) {
							$result .= "
							<tr>
									<th>". $report[$reg][$fields]["name"]  . "</th>
									<td>". $report[$reg][$fields]["value"]  . "</td>
							</tr>
							";
					}

					$result .= "
					</table>
					<table class='tt'><tr><td></td></tr></table>
					";
			}
			return $result;
	}

	function generator( $gen, $value = 1){
			$sql = 'select GEN_ID('  .  $gen . ","  .  $value . ') as NEWID from RDB$DATABASE';
			$QUERY = new QUERY($DB,$sql);
			$QUERY->NEXT();
			$result = $QUERY->BYNAME("NEWID");
			$QUERY->FREE();
			$DB->CLOSE();
			return $result;
	}
	// ------------------------------------------------------
	// Funções para trabalhar com a classe QUERY FIM
	//---------------------------------------------------------

	// ------------------------------------------------------
	// Funções para trabalhar com emails
	//---------------------------------------------------------
	function notification( $from, $to, $subject, $body ) {
			$mail = new htmlMimeMail();

			$texto = $html;
			$texto = preg_replace('/<(script|style)[^>]*>.+<\/(script|style)[^>]*>/is', '', $texto);
			$texto = strip_tags($texto,"<br></br>");
			$texto = preg_replace('/<(br|br\/)[^>]*>/is','\n\r',$texto);


			$mail->setHtml($body, $body);
			$mail->setReturnPath($from);
			$mail->setFrom("\"$from\"  <$from>");
			$mail->setSubject( $subject );
			$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
			return $mail->send(array($to), 'mail');
	}
	
	function data_brasil($data){
		$aux = explode("-",$data);
		return "$aux[2]/$aux[1]/$aux[0]";
	}
	
	function check_email_address($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }

?>
