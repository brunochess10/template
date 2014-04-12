<?php
class Dadoscliente_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_dados_cliente()
    {
        $query = $this->db->get("site_dados",1);
        return $query->result();
    }
}
?>
