<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Halaman User';
        $data['tbl_user'] = $this->db->get_where('tbl_user', ['kode_satker' => $this->session->userdata('kode_satker')])->row_array();
        $this->load->view('template/v_header', $data);
        $this->load->view('template/v_topbar', $data);
        $this->load->view('template/v_sidebar', $data);
        $this->load->view('user/index');
        $this->load->view('template/v_footer');
    }
}
