<?php

class Home_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('category_model');
    }

    public function index() {

        $data['books'] = $this->book_model->getBooks();
        
        $data['categories'] = $this->category_model->getCategories();
        
        $data['books_in_categories'] = $this->getCategoriesAndBooks();

        $data['title'] = "Sample Title"; // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/jumbtron', $data);
        $this->load->view('templates/browse_by_category', $data);
        $this->load->view('templates/footer', $data);
    }

    private function getCategoriesAndBooks() {
        $categories = $this->category_model->getCategories();

        foreach ($categories as &$category) {
            $books = $this->book_model->getBooksByCategory($category['id'], 5, 0);
            $category['books'] = $books;
        }

        return $categories;
    }

}
