<?php

class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_admin($user_name,$password) {
        $query = $this->db->get_where('admin', array('user_name' => $user_name,'password' => $password));
        return $query->row_array();
    }

}