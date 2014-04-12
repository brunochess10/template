<?php
class Descadastro_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function descadastro_boletim($email)
    {
		$this->db->query("UPDATE mailing SET usr_status='N', usr_bounce='Descadastrado pelo web site' WHERE usr_email='$email'");
		//$this->db->where("usr_email",$email);
		//$this->db->delete("mailing");
		//$this->db->last_query();
		//echo "Email:".$email."<br>";
		//echo "Consulta:".$this->db->last_query();
		//return true;
    }
	
	function verificar_se_email_existe($email){
		$this->db->where("usr_email",$email);
		$query = $this->db->get("mailing");
        return $query->num_rows();
	}
}
?>