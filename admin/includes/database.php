<?php

//variavel global para debug
$debug_report  = true;

// Classe para tratamento de conexão.
class DATABASE {
      // propriedades
      var $ID;
      var $DB_ID;
      // constructor
      function DATABASE() {
               global $mysql_server;
               global $mysql_databasename;
               global $mysql_user;
               global $mysql_pass;
               $this->ID = @mysql_connect($mysql_server, $mysql_user, $mysql_pass);
               if (!$this->ID) {
                   //não conectou
                   //kalefe begin
                   echo "<html><body>Não foi possível conectar ao servidor de banco de dados.<br> " . mysql_errno() . ": " . mysql_error() . "</body></html>";
                   exit;
               }

               $this->DB_ID = @mysql_select_db($mysql_databasename, $this->ID);
               if (!$this->DB_ID) {
                   //não conectou
                   //kalefe begin
                   echo "<html><body>Não foi possível conectar a base de dados.<br> " . mysql_errno() . ": " . mysql_error() . "</body></html>";
                   exit;
               }
               return ( ($this->ID) && ($this->DB_ID) );
      }
      function CLOSE() {
              $close = @mysql_close($this->ID);
               if (!$close) {
                   //não fechou
                   //kalefe begin
                   echo "<html><body>Não foi possível desconetar ao banco de dados.<br> " . mysql_errno() . ": " . mysql_error() . "</body></html>";
                   exit;
               }
               return $close;
      }
}

class QUERY {
      // propriedades
      var $DATABASE;
      var $DATASET = null;
      var $FIELDS;
	  var $FIELDCOUNT;
	  var $RECORDCOUNT;
      // constructor
      function QUERY( &$pdatabase, $sql = null ) {

               // caso não tenha instanciado o Database aqui ele faz automaticamente
               if( isset($pdatabase)){
                   $this->DATABASE = $pdatabase;
               } else {
                   $pdatabase = new DATABASE();
                   $this->DATABASE = $pdatabase;
               }

               if( isset($sql) ){
                   $this->EXECUTE( $sql );
               }
      }

      function EXECUTE( $sql ) {
    		   global $debug_report;
               $this->DATASET = @mysql_query($sql, $this->DATABASE->ID);
               if (!$this->DATASET) {
				  if ( $debug_report ) { $query = "sql: $sql"; } else { $query = ""; }
                   echo "<html><body>Não foi possível executar a query.<br> " . mysql_errno() . ": " . mysql_error() . "<br> $query</body></html>";

                   exit;
               } else {
			   		$this->FIELDCOUNT = @mysql_num_fields($this->DATASET);
					$this->RECORDCOUNT = @mysql_num_rows($this->DATASET);
			   }
               return $this->DATASET;
      }

      function NEXT() {
               $this->FIELDS = @mysql_fetch_object($this->DATASET);
               return $this->FIELDS;
      }

	  function BYINDEX ( $index) {
	  	     return $this->BYNAME( $this->FIELDNAME( $index ) );
	  }

	  function BYNAME ( $name ) {
	  		   return $this->FIELDS->{$name};
	  }

	  function FIELDNAME( $index ){
			   return mysql_field_name($this->DATASET, $index);
	  }

	  function NUMROWS() {
			return mysql_num_rows($this->DATASET);
	  }
      function FREE(){
               @mysql_free_result($this->DATASET);
               $this->DATASET = null;
      }
	  
	  function FIELDINFO( $index ){
	            $aux = mysql_fetch_field($this->DATASET,$index); 
				$col_info["name"] = $aux->name ;
				$col_info["alias"] = $aux->name;
                $col_info["relation"] ="";
                $col_info["length"] = mysql_field_len($this->DATASET,$index);
				$col_info["blob"] = $aux->blob;
				$col_info["type"] = $aux->type;
				
								
				//echo $col_info["length"]." - ".$col_info["name"]." - ".$col_info["type"]."<br/>";
				
				if ($col_info["type"]=="string"){
					$col_info["length"]="255";
				}
				
				
				if ($col_info["type"]=="date"){
					$col_info["type"]="DATE";
				}
				
				if (($col_info["type"]=="blob")||($col_info["blob"]=="1")){
					$col_info["type"]="BLOB";
				}
				
				if ($col_info["type"]=="real"){
					$col_info["type"]="DOUBLE";				
				}
				
				if ($col_info["type"]=="int"){
					$col_info["type"]="LONG";	
				}
				return $col_info;
	  }
	  
	  
}
?>
