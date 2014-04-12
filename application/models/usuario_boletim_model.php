<?php
class Usuario_boletim_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function insert_usuario($nome,$email)
    {
        $this->db->set("usr_nome",$nome);
        $this->db->set("usr_email",$email);
        $this->db->set("usr_data_cad",date("Y-m-d"));
        $this->db->set("usr_ip_cad",$_SERVER["REMOTE_ADDR"]);
        $this->db->set("usr_hora_cad",date("h:i:s"));
		$this->db->set("usr_origem","1");
        $this->db->insert("mailing");
        return $this->db->insert_id();
    }
    
    
}
?>