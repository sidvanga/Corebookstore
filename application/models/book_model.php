<?php

class Book_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $min_book_feilds = 'id,title,author,cover_url,unit_price,qty';

    public function getCount($category_id = FALSE) {
        if ($category_id == FALSE) {
            return $this->db->count_all("book");
        } else {
            return $this->db->where('category_id', $category_id)->count_all_results('book');
        }
    }

    public function getBooks() {
        $this->db->select($this->min_book_feilds);
        $query = $this->db->get('book');
        return $query->result_array();
    }

    public function getBooksByCategory($category_id, $limit, $offset) {
        $this->db->select($this->min_book_feilds);
        $this->db->limit($limit, $offset);
        $query = $this->db->get_where('book', array('category_id' => $category_id));
        return $query->result_array();
    }

    public function getBookById($id) {
        $query = $this->db->get_where('book', array('id' => $id));
        return $query->row_array();
    }

    public function getBookById_minFields($id) {
        $this->db->select('id,title,author,cover_url,unit_price,qty');
        $query = $this->db->get_where('book', array('id' => $id));
        return $query->row_array();
    }

    public function getRelatedBooks($book_id, $visitor_id, $limit) {
        //Query to select visitors who viewed the book
        $select_visitors_query = 'SELECT DISTINCT visitor_id from book_view WHERE book_id=' . $book_id;
        //Query to select other books viewed by those visitors; Orders books by number of views
        $query = $this->db->query('SELECT b.id,b.title,b.author,b.cover_url,b.unit_price FROM book b join book_view v on b.id = v.book_id WHERE v.visitor_id IN (' . $select_visitors_query . ') AND (v.book_id<>' . $book_id . ' AND v.visitor_id<>' . '\'' . $visitor_id . '\'' . ') GROUP BY v.book_id ORDER BY COUNT(*) DESC LIMIT ' . $limit);
        return $query->result_array();
    }

    public function insertBookView($book_id, $visitor_id) {

        $data = array(
            'book_id' => $book_id,
            'visitor_id' => $visitor_id,
        );

        return $this->db->insert('book_view', $data);
    }

    public function add_book($cover_url/* Only passing cover url, getting other data by post */) {
        $data = array(
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
            'description' => $this->input->post('description'),
            'category_id' => $this->input->post('category'),
            'unit_price' => $this->input->post('unit_price'),
            'qty' => $this->input->post('qty'),
            'cover_url' => $cover_url
        );

        $this->db->insert('book', $data);

        return $this->db->insert_id();
    }

    public function search_book() {
        $search_phrase = $this->input->post('search_phrase');
        $query = $this->db->query("SELECT " . $this->min_book_feilds . " FROM book WHERE title LIKE '%" . $search_phrase . "%' OR author LIKE '%" . $search_phrase . "%' ");
        return $query->result_array();
    }

    public function get_visitior_statistics($book_id) {

        $total_views_query = $this->db->query('SELECT COUNT(*) as views FROM book_view WHERE book_id =' . $book_id);
        $month_query = $this->db->query('SELECT MONTH(date) as month, COUNT(*) as views FROM book_view WHERE book_id =' . $book_id . ' GROUP BY month ORDER BY month');

        $total_views = $total_views_query->row_array();

        $statistics['total_views'] = $total_views['views'];
        $statistics['views_by_month'] = $month_query->result_array();

        return $statistics;
    }
}
