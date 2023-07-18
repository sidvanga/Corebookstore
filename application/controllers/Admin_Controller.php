<?php

class Admin_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Check if user is logged in
        if (!$this->session->has_userdata('user')) {
            redirect('login');
            exit;
        }
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->load->model('category_model');
        $this->load->model('book_model');
    }

    public function index() {

        $data['categories'] = $this->category_model->getCategories();
        $jumbtron_data['title'] = "Welcome " . $_SESSION['user']['Fname'] . " !";
        $jumbtron_data['subtitle'] = "Admin panel for BookStore";

        $this->load->view('templates/header');
        $this->load->view('templates/navbar',$data);
        $this->load->view('templates/plain_jumbtron', $jumbtron_data);
        $this->load->view('pages/admin_home');
        $this->load->view('templates/footer');
    }

    public function create_category_view() {
        
    }

    public function create_category() {

        $this->form_validation->set_rules('name', 'Category name', 'required');
        $data['categories'] = $this->category_model->getCategories();

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar',$data);
            $this->load->view('pages/create_category');
            $this->load->view('templates/footer');
        } else {
            $this->category_model->add_category();
            redirect('/admin');
        }
    }

    public function add_book() {

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');
        //$this->form_validation->set_rules('book_cover', 'Book Cover', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['categories'] = $this->category_model->getCategories();
            $data['img_upload_err'] = '';
            $this->load->view('templates/header');
            $this->load->view('templates/navbar',$data);
            $this->load->view('pages/add_book', $data);
            $this->load->view('templates/footer');
        } else {

            //Upload file
            $config['upload_path'] = './assets/img/covers';
            $config['allowed_types'] = 'gif|jpg|png';
//            $config['max_size'] = 2000;
//            $config['max_width'] = 1024;
//            $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('book_cover')) {
                $data['categories'] = $this->category_model->getCategories();
                //If error, pass the error to form and reload
                $data['img_upload_err'] = $this->upload->display_errors();
                $this->load->view('templates/header');
                $this->load->view('templates/navbar',$data);
                $this->load->view('pages/add_book', $data);
                $this->load->view('templates/footer');
            } else {

                $filename = $this->upload->data('file_name');

                $book_id = $this->book_model->add_book($filename);
                
                $this->session->set_flashdata('success_msg', 'Book added successfully. '.'<a class="text-white" href="'.base_url('books/'.$book_id).'"> <u>View</u> </a>');
                
                redirect('add_book');
                //$this->load->view('upload_success', $data);
            }
        }
    }

}
