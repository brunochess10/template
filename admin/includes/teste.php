<?php
   $path = "../";
   $diretorio = dir($path);
   echo "Lista de Arquivos do diret�rio '<strong>".$path."</strong>':<br />";    
   while($arquivo = $diretorio -> read()){
      echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
   }
   $diretorio -> close();
?>
