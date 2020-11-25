<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function changesub($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $is_active = ($this->input->post('is_active') == 1) ? 1 : 0;
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'is_active' => $is_active

        ];
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
        log_message('info', $user['user']['name'] . ' edit submenu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu dirubah!</div>');
        redirect('menu/submenu', 'refresh');
    }
    public function change($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        log_message('info', $user['user']['name'] . ' edit menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu dirubah!</div>');
        redirect('menu', 'refresh');
    }
    public function deletesub($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->delete('user_sub_menu', ['id' => $id]);
        log_message('info', $data['user']['name'] . ' delete submenu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu dihapus!</div>');
        redirect('menu/submenu', 'refresh');
    }
    public function delete($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->delete('user_menu', ['id' => $id]);
        log_message('info', $data['user']['name'] . ' delete menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu dihapus!</div>');
        redirect('menu', 'refresh');
    }
    public function index()
    {
        $data['title'] = "Menu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            log_message('info', $data['user']['name'] . ' add menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru ditambah!</div>');
            redirect('menu', 'refresh');
        }
    }
    public function submenu()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('is_active') == 1) {
                $is_active = $this->input->post('is_active');
            } else {
                $is_active = 0;
            }
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'is_active' => $is_active

            ];
            $this->db->insert('user_sub_menu', $data);
            log_message('info', $user['user']['name'] . ' Add submenu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu baru ditambah!</div>');
            redirect('menu/submenu', 'refresh');
        }
    }
}
