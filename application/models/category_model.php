<?php

class Category_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $min_category_feilds = 'id,name';

    public function getCategories() {
        $this->db->select($this->min_category_feilds);
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function getCategoryById($id) {
        $query = $this->db->get_where('category', array('id' => $id));
        return $query->row_array();
    }

    public function add_category() {
        
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        return $this->db->insert('category', $data);
    }
}
