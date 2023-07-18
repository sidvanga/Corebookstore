<?php

class Cart_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->model('category_model');
        $this->load->helper('url_helper');
        $this->load->library("pagination");
        $this->load->helper('form');
    }

    public function index() {
        $data['items'] = $this->session->cart;
        $data['categories'] = $this->category_model->getCategories();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/shopping_cart', $data);
        $this->load->view('templates/footer', $data);
//        $data['total'] = $this->total();
//        $this->load->view('cart/index', $data);
    }

    public function addToCart($book_id) {
        
        $redirect=true;
        $qty = $this->input->post('qty');
        
        if(!isset($qty)){
            $qty = 1;
            $redirect=false;
        }

        $this->addItem($book_id, $qty, true);
        
    }

    public function addItem($book_id, $qty, $redirectTocart = TRUE) {

        if (!isset($book_id, $qty)) {
            redirect('cart');
        }

        $book = $this->book_model->getBookById_minFields($book_id);

        $book['bqty'] = $qty;

        if (!$this->session->has_userdata('cart')) {
            $cart = array($book);
            $this->session->set_userdata('cart', $cart);
        } else {
            $index = $this->exists($book_id);
            $cart = $this->session->cart;
            if ($index == -1) {
                array_push($cart, $book);
                $this->session->set_userdata('cart', $cart);
            } else {
                $cart[$index]['bqty'] += $qty;
                $this->session->set_userdata('cart', $cart);
            }
        }
        
        if($redirectTocart){
            redirect('cart');
        }
    }
    
    public function updateQty($id){
        $qty = $this->input->post('qty');
        $index = $this->exists($id);
        $cart = $this->session->cart;
        $cart[$index]['bqty'] = $qty;
        $cart = array_values($cart); // 'reindex' array
        $this->session->set_userdata('cart', $cart);
        redirect('cart');
    }

    public function removeFromCart($id) {
        $index = $this->exists($id);
        $cart = $this->session->cart;
        print_r($cart);
        unset($cart[$index]);
        $cart = array_values($cart); // 'reindex' array
        $this->session->set_userdata('cart', $cart);
        redirect('cart');
    }

    private function exists($id) {
        $cart = $this->session->cart;
        for ($i = 0; $i < count($cart); $i ++) {
            if ($cart[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }

   private function total() {
       $items = array_values(unserialize($this->session->userdata('cart')));
       $s = 0;
       foreach ($items as $item) {
           $s += $item['price'] * $item['quantity'];
       }
       return $s;
   }
}
