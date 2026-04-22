<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function index() {
        $data['active'] = 'login';
        $this->load->view('login/login', $data);
    }

    public function login() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
    $data['active'] = 'login';
            $this->load->view('login/login', $data);

        } else {
            print_r($this->input->post());
            die;
            $this->load->model('Admin_model');

            $user = $this->Admin_model->login(
                $this->input->post('username'),
                $this->input->post('password')
            );

            if ($user) {
                echo "<h1>Admin Dashboard</h1>";
            } else {
                $this->session->set_flashdata('error', 'Invalid Username or Password');
                redirect('LoginController');
            }
        }
    }
}