<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alamat_model');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);

            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            log_message('info', $data['user']['name'] . ' add role');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role baru ditambahkan!</div>');
            redirect('admin/role', 'refresh');
        }
    }
    public function deleterole($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('user_role', ['id' => $id]);
        log_message('info', $data['user']['name'] . ' delete role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role Dihapus!</div>');
        redirect('admin/role', 'refresh');
    }
    public function changerole($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'role' => htmlspecialchars($this->input->post('role', true))
        ];
        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
        log_message('info', $user['user']['name'] . ' change role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role dirubah!</div>');
        redirect('admin/role', 'refresh');
    }
    public function roleAccess($role_id)
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id != ', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" > Role akses dirubah!</div>');
    }
    public function user()
    {
        $data['title'] = "User";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $this->db->select('user.*, role');
        $this->db->from('user');
        $this->db->join('user_role', 'role_id = user_role.id');
        $this->db->where('is_active', 1);
        $this->db->where('user.id!=', 4);
        $this->db->where('role_id <', 3);
        $this->db->order_by('name', 'ASC');
        $data['fresh'] = $this->db->get()->result_array();
        $this->db->select('user.*, role');
        $this->db->from('user');
        $this->db->join('user_role', 'role_id = user_role.id');
        $this->db->where('is_active', 1);
        $this->db->where('role_id', 3);
        $this->db->order_by('name', 'ASC');
        $data['freelance'] = $this->db->get()->result_array();
        $this->db->select('user.*, role');
        $this->db->from('user');
        $this->db->join('user_role', 'role_id = user_role.id');
        $this->db->where('is_active', 1);
        $this->db->where('role_id', 4);
        $this->db->order_by('name', 'ASC');
        $data['member'] = $this->db->get()->result_array();
        $this->db->select('user.*, role');
        $this->db->from('user');
        $this->db->join('user_role', 'role_id = user_role.id');
        $this->db->where('is_active', 0);
        $this->db->order_by('name', 'ASC');
        $data['off'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }
    public function useraccessrole($id_member)
    {
        $role_id = $this->input->post('roleAccess');
        $this->db->where('id', $id_member);
        $this->db->set('role_id', $role_id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role dirubah!</div>');
        redirect('admin/user', 'refresh');
    }
    public function detail($id)
    {
        $data['title'] = "Detail";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $member['member'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $data['alamat'] = $this->Alamat_model->getDataAlamat($id);
        $data['pengalaman'] = $this->Alamat_model->getDataPengalaman($id);
        $data['alat'] = $this->db->get_where('user_tools', ['user_id' => $id])->result_array();
        $data['skill'] = $this->db->get_where('user_skill', ['user_id' => $id])->result_array();
        $data['school'] = $this->db->get_where('user_school', ['user_id' => $id])->result_array();
        $data['sosmed'] = $this->db->get_where('user_sosmed', ['user_id' => $id])->result_array();
        $data['bidang'] = $this->Alamat_model->getDataBidangMember($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail', $member);
        $this->load->view('templates/footer');
    }
}
