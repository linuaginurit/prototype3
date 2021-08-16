<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('kode_satker', 'KodeSatker', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = ('Login');
            $this->load->view('template/v_auth_header', $data);
            $this->load->view('auth/v_login');
            $this->load->view('template/v_auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $kode_satker = $this->input->post('kode_satker');
        $password = $this->input->post('password');
        $user = $this->db->get_where('tbl_user', ['kode_satker' => $kode_satker])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'kode_satker' => $user['kode_satker'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                wrong password!
              </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            You are not registered!
          </div>');
            redirect('Auth');
        }
    }
    public function registration()
    {
        $this->form_validation->set_rules('kode_satker', 'KodeSatker', 'required|trim|is_unique[tbl_user.kode_satker]', [
            'is_unique' => 'This Satker has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Doesnt match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('template/v_auth_header', $data);
            $this->load->view('auth/v_registration');
            $this->load->view('template/v_auth_footer');
        } else {
            $data = [
                'kode_satker' => $this->input->post('kode_satker', true),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1
            ];
            $this->db->insert('tbl_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            Congratulation your account has been created. Please Login!
          </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('kode_satker');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logout!
      </div>');
        redirect('Auth');
    }

    public function blocked()
    {

        $this->load->view('auth/blocked');
    }
}
