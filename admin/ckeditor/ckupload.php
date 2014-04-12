<?php
$time = time();
$url = '../../arquivos/'.$time."_".$_FILES['upload']['name'];
 //extensive suitability check before doing anything with the file...
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
    {
       $message = "O arquivo não foi enviado ao servidor";
    }
    else if ($_FILES['upload']["size"] == 0)
    {
       $message = "O tamanho deste arquivo está zerado.";
    }
    //else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
    //{
    //   $message = "A imagem deve ser JPEG ou PNG ";
    //}
    else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
    {
       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
    }
    else {
      $message = "";
      $move = move_uploaded_file($_FILES['upload']['tmp_name'], $url);
      if(!$move)
      {
         $message = "Erro não foi possível subir o arquivo a pasta não está com permissão de leitura ou escrita.";
      }
	  $monta_url = explode("/",$_SERVER["SCRIPT_NAME"]);
	  
	  for ($i=1;$i<count($monta_url)-3;$i++){
	  	$end.=$monta_url[$i]."/";
	  }
	  
	  $url = "http://".$_SERVER["SERVER_NAME"]."/".$end."arquivos/".$time."_".$_FILES['upload']['name'];
    }
 
$funcNum = $_GET['CKEditorFuncNum'] ;
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>