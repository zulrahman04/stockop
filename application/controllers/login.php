<?php
class Login extends CI_Controller
{
    public $data = array(
        'halaman' => '',
        'main_view' => ''
    );


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
    }

    public function index()
    {
        $responce = new StdClass;

        if ($this->input->post('username') && $this->input->post('password')) {
            if ($this->login->login($this->input->post('username'), $this->input->post('password'))) {
                $responce->result = 'Login Berhasil';
                echo json_encode($responce);
                return;
            } else {
                $responce->result = 'Login gagal. Username atau password salah.';
                echo json_encode($responce);
                return;
            }
        }

        if (!$this->session->userdata('user_id')) {
            $this->load->view('login_form');
        } else {
            redirect(base_url('dashboard'));
        }
    }

    public function error()
    {
        redirect();
    }

    public function logout()
    {
        $this->login->logout();
        redirect();
    }

    public function override()
    {
        $this->load->view('404_page');
    }

    public function forbidden()
    {
        $this->load->view('403_page');
    }
}