<?php

class Login extends CI_Controller{
    public function _construct(){
        parent::_construct();
        $this->load->library('session');
    }
    public function index(){

        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $where = array(
                    'username' => $user,
                    'password' =>md5($pass)
        );


        $this->load->model('usermodel');
        $cek= $this->usermodel->cek_login("admin", $where)->num_rows();

        if($cek > 0){
            $this->session->set_userdata('username', $user);

            redirect('login/admin_page');
        }else
        {
            $this->load->view('login/index');
        }
    }
    public function admin_page(){

        $this->load->view('login/admin_page');

    }
    public function logout(){
        $this->session->unset_userdata(array('username' => ''));

        redirect('login/index');
    }
}