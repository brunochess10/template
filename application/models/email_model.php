<?php
class Email_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_email()
    {
        $query = $this->db->get("site_email",1);
        return $query->result();
    }
}
?>
