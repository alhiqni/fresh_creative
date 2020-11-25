<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freelance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Project Freelance";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('desc_project.*, bidang.bidang, wilayah_kabupaten.nama');
        $this->db->from('desc_project');
        $this->db->join('bidang', 'bidang_id = bidang.id');
        $this->db->join('wilayah_kabupaten', 'location = wilayah_kabupaten.id');
        $this->db->where('is_active', 1);

        $data['project'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('userId', 'User', 'required|numeric');
        $this->form_validation->set_rules('projectId', 'Project', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('freelance/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'user_id' => htmlspecialchars($this->input->post('userId')),
                'project_id' => htmlspecialchars($this->input->post('projectId')),
                'is_active' => 0
            ];

            if ($this->db->insert('freelance_project', $data)) {
                log_message('info', $user['user']['name'] . ' register project');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu telah terdaftar, silahkan tunggu persetujuan dari admin!</div>');
                redirect('freelance', 'refresh');
            } else {
                log_message('error', $user['user']['name'] . ' can\'t register');
                $this->session->set_flashdata('message', '<div class="alert alert-danget" role="alert">Gagal mendaftar, silahkan hubungi admin untuk menyampaikan masalah ini</div>');
                redirect('freelance', 'refresh');
            }
        }
    }
    public function on()
    {
        $data['title'] = "On Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $this->db->select('freelance_project');
        $this->db->from('freelance_project');
        $this->db->join('desc_project', 'desc_project.id = project_id');
        $this->db->join('bidang', 'desc_project.bidang_id = bidang.id');
        $this->db->join('wilayah_kabupaten', 'location = wilayah_kabupaten.id');
        $this->db->where(['user_id' => $data['user']['id'], 'freelance_project.is_active' => 1]);
        $data['project'] = $this->db->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('freelance/on', $data);
        $this->load->view('templates/footer');
    }
    public function finish($user_id)
    {
        $project =  htmlspecialchars($this->input->post('project'));
        $location =  htmlspecialchars($this->input->post('location'));
        $bidang =  htmlspecialchars($this->input->post('bidang'));
        $project_id =  htmlspecialchars($this->input->post('project_id'));
        // notif for admin when freelance finished the project
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $name = $data['user']['name'];
        $email = $data['user']['email'];
        $subject = "Project Completed";
        $phone = $data['user']['phone'];
        $projectMsg = $this->db->get_where('desc_project', ['id' => $project_id])->row_array();
        $msg = 'Kamu menerima pesan email dari website Freelance Fresh Creative Studio <br>';
        $msg .= ' <dd> Nama: &nbsp;' . $name . '<br>';
        $msg .= ' <dd> Email: &nbsp;' . $email . '<br>';
        $msg .= ' <dd> No Hp: &nbsp;' . $phone . '<br>';
        $msg .= ' <dd> Telah menyelesaikan tugasnya di project "' . $projectMsg['project'] . '"<br>';
        $this->Menu_model->sendNotification('freshcreative.studio19@gmail.com', $subject, $msg);
        $data = [
            'user_id' => $user_id,
            'project_id' => $project_id,
            'project' => $project,
            'location' => $location,
            'bidang' => $bidang,
            'rating' => 0,
            'active' => 0
        ];
        if ($this->db->insert('history', $data)) {
            $object = ['is_active' => 2];
            $this->db->where('project_id', $project_id);
            $this->db->update('freelance_project', $object);
            $object = ['is_active' => 2];
            $this->db->where('id', $project_id);
            $this->db->update('desc_project', $object);
            log_message('info', $user['user']['name'] . ' finished project');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Terimakasih telah menyelesaikan tugasmu dengan baik, admin akan memberimu evaluasi agar kamu menjadi pribadi yang lebih baik lagi</div>');
            redirect('freelance/on', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' can\'t report finished project');
            $this->session->set_flashdata('message', '<div class="alert alert-danget" role="alert">Gagal mengirimkan laporan. <br> Segera hubungi admin untuk masalah ini</div>');
            redirect('freelance/on', 'refresh');
        }
    }
}
