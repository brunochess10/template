<?php

	//Declarações Funcões
	function mySerialize( $obj ) { 
		return base64_encode(serialize($obj)); 
	} 

	function myUnserialize( $txt ) { 
		return unserialize(base64_decode($txt)); 
	} 	
	

	function send_gateway( $object, $recipients, $method ){
		$ch = curl_init();
		$data = array('object' => mySerialize($object), 'recipients' => mySerialize($recipients), 'method' => $method );
		if ( ($object->SMTP_PORT == "25") || ($method == "mail") ) 
			$gateway_host = "http://www.jhscontabilidade.com.br/tools/netcontabil/gateway/gateway.php";
		else
			$gateway_host = "http://www.netcontabil.com.br/tools/gateway/gateway.php";
		curl_setopt($ch, CURLOPT_URL, $gateway_host);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ; 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$content = curl_exec($ch);		
		$result = myUnserialize( $content );
		$object->errors = $result["errors"];
		return $result["enviado"];
		
	}
?>