<?php

class Book_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library("pagination");
        $this->load->helper('form');
        $this->load->model('category_model');
    }

    public function index() {
    }

    public function view($book_id = NULL) {

        //If visitor id not set, set new visitor id
        if (!isset($_SESSION['visitor_id'])) {
            $_SESSION['visitor_id'] = uniqid($prefix = "vis");
        }

        //Get relavent book
        $data['book'] = $this->book_model->getBookById($book_id);
        $data['categories'] = $this->category_model->getCategories();


        if (empty($data['book'])) {
            //if the book id does not match show 404
            show_404();
        } else {
            //Count the view
            $this->book_model->insertBookView($book_id, $_SESSION['visitor_id']);

            //If admin get statistics
            if ($this->session->has_userdata('user')) {
                $data['statistics'] = $this->book_model->get_visitior_statistics($book_id);
            } else {
                //Get related books
                $data['related_books'] = $this->book_model->getRelatedBooks($book_id,$_SESSION['visitor_id'], 5);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/book', $data);
        if(isset($data['statistics'])){$this->load->view('templates/stat_chart', $data);}
        if(isset($data['related_books'])){$this->load->view('pages/related_books', $data);}
        $this->load->view('templates/footer', $data);
    }

    public function viewByCategory($category_id) {

        //Pagination config
        $config["base_url"] = base_url() . "category/" . $category_id;
        $config["total_rows"] = $this->book_model->getCount($category_id);
        $config["per_page"] = 8;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['category'] = $this->category_model->getCategoryById($category_id);
        $data['categories'] = $this->category_model->getCategories();
        $data['books'] = $this->book_model->getBooksByCategory($category_id, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $jumbtron_data['title'] = $data['category']['name'];
        $jumbtron_data['subtitle'] = $data['category']['description'];


        $this->load->view('templates/header');
        $this->load->view('templates/navbar',$data);
        $this->load->view('templates/plain_jumbtron', $jumbtron_data);
        $this->load->view('templates/books', $data);
        $this->load->view('templates/footer');
    }

    public function search_book() {

        $data['books'] = $this->book_model->search_book();
        $searchphrase = $this->input->post('search_phrase');
        $data['categories'] = $this->category_model->getCategories();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar',$data);

        if (!empty($data['books'])) {
            $data['search_details'] = 'Search results for "' . $searchphrase . '"';
            $this->load->view('pages/search', $data);
            $this->load->view('templates/books', $data);
        } else {
            $data['search_details'] = 'Sorry! No results found for "' . $searchphrase . '"';
            $this->load->view('pages/search', $data);
        }

        $this->load->view('templates/footer');
    }

}
