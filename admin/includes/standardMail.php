<?php
	
	function setSMTPParams( $host, $port, $hello, $auth, $auth_type, $user, $pass ){
	function setHtml($html, $text){
	function setSubject( $subject ){
	function setReturnPath( $return ){
		$this->EMAIL_RETURN_PATH = $return;
	}
	function setFrom( $from ){
	function setHeader( $name, $value ){
	function sendOnlyOne( $recipient, $method ){
			$m->sendThroughSMTP($this->SMTP_HOST, $this->SMTP_PORT, $this->SMTP_USER, $this->SMTP_PASS, $auth_type);
			$result = $mail->send( array($recipient), $method );
?>