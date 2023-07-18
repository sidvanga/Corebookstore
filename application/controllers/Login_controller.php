 <?php

class Login_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index() {
        
    }

    public function login() {
        $data['errmsg'] = $this->session->flashdata('errmsg');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/signin', $data);
        $this->load->view('templates/footer', $data);
    }

    public function login_authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Admin_model->get_admin($username, $password);

        if (empty($user)) {
            $this->session->set_flashdata('errmsg', 'Username or password does not match, please try again.');
            redirect('login');
        } else {
            unset($user['password']);
            $this->session->set_userdata('user', $user);
            redirect('admin');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect('login');
    }

}
