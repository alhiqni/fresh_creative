<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Alamat_model');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('desc_project.*, bidang.bidang, wilayah_kabupaten.nama');
        $this->db->from('desc_project');
        $this->db->join('bidang', 'bidang_id = bidang.id');
        $this->db->join('wilayah_kabupaten', 'location = wilayah_kabupaten.id');
        $data['project'] = $this->db->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('job/index', $data);
        $this->load->view('templates/footer');
    }
    public function specialist()
    {
        $data['title'] = "Specialist";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $this->form_validation->set_rules('specialist', 'Specialist', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('job/specialist', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bidang' => htmlspecialchars($this->input->post('specialist', true))
            ];
            if ($this->db->insert('bidang', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang ditambah!</div>');
                redirect('job/specialist', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bidang gagal ditambah!</div>');
                redirect('job/specialist', 'refresh');
            }
        }
    }
    public function specialist_del($id)
    {
        if ($this->db->delete('bidang', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bidang gagal dihapus</div>');
        }
        redirect('job/specialist', 'refresh');
    }
    public function add()
    {
        $data['title'] = "Add Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $data['kota'] = $this->db->query('SELECT * from wilayah_kabupaten order by nama asc')->result_array();
        $this->form_validation->set_rules('description', 'description', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('job/add', $data);
            $this->load->view('templates/footer');
        } else {
            $desc = [];
            foreach ($data['bidang'] as $b) {
                if ($this->input->post('desc_' . $b['id']) != '') {
                    $desc[$b['id']] = htmlspecialchars($this->input->post('desc_' . $b['id']));
                }
            }
            $expire = ($this->input->post('expire') * 86400) + time();
            $project = $this->input->post('project');
            $location = $this->input->post('location');
            $this->db->select('user_id, email');
            $this->db->from('user_address');
            $this->db->join('user', 'user_address.user_id = user.id');
            $this->db->where('kabupaten_id', $location);
            $this->db->where('role_id', 3);
            $member = $this->db->get()->result_array();
            $this->db->select('nama');
            $this->db->from('wilayah_kabupaten');
            $this->db->where('id', $location);
            $place = $this->db->get()->row_array()['nama'];
            $subject = 'Notice';
            //message email-------->
            $msg = read_file(base_url('assets/email/') . 'header.html');
            // subject
            $msg .= $subject;
            $msg .= read_file(base_url('assets/email/') . 'top.html');
            // tittle
            $msg .= "New Update Project";
            $msg .= read_file(base_url('assets/email/') . 'body1.html');
            // pesan
            $msg .= "Ada project baru di " . $place . " nih ayo segera cek di web kami. Agar kamu bisa memegang projek tersebut.";
            $msg .= read_file(base_url('assets/email/') . 'body2.html');
            // link
            $msg .= '<a href="' . base_url('auth') . '" class="btn btn-primary" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;text-decoration:none;color:#f3a333;padding:10px 15px;border-radius:30px;background:#f3a333;color:#ffffff;">Kunjungi</a>';
            $msg .= read_file(base_url('assets/email/') . 'footer.html');
            // message email------>
            foreach ($member as $mm) {
                $this->Menu_model->sendNotification($mm['email'], $subject, $msg);
            }
            foreach ($desc as $id => $description) {
                $data = [
                    'project' => $project,
                    'location' => $location,
                    'bidang_id' => $id,
                    'description' => $description,
                    'expire' => $expire,
                    'is_active' => 1
                ];
                $this->db->insert('desc_project', $data);
            }
            log_message('info', $user['user']['name'] . ' add project');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Project ditambah</div>');
            redirect('job');
        }
    }
    public function detail($id)
    {
        $data['title'] = "Detail Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('desc_project.*, bidang.bidang, wilayah_kabupaten.nama');
        $this->db->from('desc_project');
        $this->db->join('bidang', 'bidang_id = bidang.id');
        $this->db->join('wilayah_kabupaten', 'location = wilayah_kabupaten.id');
        $this->db->where('desc_project.id', $id);
        $data['project'] = $this->db->get()->row_array();
        $this->db->select('freelance_project.user_id, user.id, user.name');
        $this->db->from('freelance_project');
        $this->db->join('user', 'freelance_project.user_id = user.id');
        $this->db->where('project_id', $id);
        $data['freelance'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('job/detail', $data);
        $this->load->view('templates/footer');
    }
    public function delete($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id', $id);
        $this->db->delete('desc_project');
        $this->db->where('project_id', $id);
        $this->db->delete('freelance_project');
        log_message('info', $data['user']['name'] . ' delete project');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Project dihapus</div>');
        redirect('job');
    }
    public function resume($id)
    {
        $data['title'] = "Resume";
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
        $this->load->view('job/resume', $member);
        $this->load->view('templates/footer');
    }
    public function acc($user_id)
    {
        $project_id = $this->input->get('p');
        $freelance = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $project = $this->db->get_where('desc_project', ['id' => $project_id])->row_array();
        //message email-------->
        $msg = read_file(base_url('assets/email/') . 'header.html');
        // subject
        $msg .= 'Notification';
        $msg .= read_file(base_url('assets/email/') . 'top.html');
        // tittle
        $msg .= "Project \"" . $project['project'] . "\"";
        $msg .= read_file(base_url('assets/email/') . 'body1.html');
        // pesan
        $msg .= "Hai, " . $freelance['name'] . " kamu telah tergabung kedalam project \"" . $project['project'] . "\".<br><br>   Ayo segera bersiap diri untuk beraksi. Jangan lupa siapkan semua alat-alatmu ya. Sebentar lagi admin akan menguhungimu untuk mengatur penjadwalan.<br><br> Semangat bertugas " . $freelance['name'] . '!!';
        $msg .= read_file(base_url('assets/email/') . 'body2.html');
        // link
        $msg .= '<a href="' . base_url('freelance/on') . '" class="btn btn-primary" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;text-decoration:none;color:#f3a333;padding:10px 15px;border-radius:30px;background:#f3a333;color:#ffffff;">Lihat Project</a>';
        $msg .= read_file(base_url('assets/email/') . 'footer.html');
        // message email------>
        $this->Menu_model->sendNotification($freelance['email'], 'Notification', $msg);

        $data = ['is_active' => 1];
        $this->db->where('user_id', $user_id);
        $this->db->where('project_id', $project_id);
        $this->db->update('freelance_project', $data);

        $this->db->where('id', $project_id);
        $this->db->set('is_active', 0);
        $this->db->update('desc_project');

        $this->db->where('project_id', $project_id);
        $this->db->where('user_id !=', $user_id);
        $this->db->delete('freelance_project');
        log_message('info', $freelance['name'] . ' acc project');
        redirect('job/detail/' . $project_id);
    }
    public function finish($project_id)
    {
        $data['title'] = "Assessment";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('user_id');
        $this->db->from('freelance_project');
        $this->db->where('project_id', $project_id);
        $user_id = $this->db->get()->row_array()['user_id'];
        $data['freelance'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $this->db->select('desc_project.id,project, nama,bidang');
        $this->db->from('desc_project');
        $this->db->join('bidang', 'bidang.id = bidang_id');
        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = location');
        $this->db->where('desc_project.id', $project_id);
        $data['project'] = $this->db->get()->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('job/assessment', $data);
        $this->load->view('templates/footer');
    }
    public function evaluation()
    {
        $this->form_validation->set_rules('evaluation', 'Evaluation', 'trim|required');
        $this->form_validation->set_rules('ratingRadio', 'Rating', 'trim|required');
        if ($this->form_validation->run() == true) {
            $rating = htmlspecialchars($this->input->post('ratingRadio', true));
            $evaluation = htmlspecialchars($this->input->post('evaluation', true));
            $user_id = htmlspecialchars($this->input->post('user_id', true));
            $project_id = htmlspecialchars($this->input->post('project_id', true));
            $data = [
                'rating' => $rating,
                'active' => 1,
                'date_created' => time()
            ];
            $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
            $project = $this->db->get_where('history', ['project_id' => $project_id])->row_array();
            //message email-------->
            $msg = read_file(base_url('assets/email/') . 'header.html');
            // subject
            $msg .= 'Notification';
            $msg .= read_file(base_url('assets/email/') . 'top.html');
            // tittle
            $msg .= "Project \"" . $project['project'] . "\"";
            $msg .= read_file(base_url('assets/email/') . 'body1.html');
            // pesan
            $msg .= "Terima kasih " . $user['name'] . " sudah menyelesaikan project \"" . $project['project'] . "\" dengan baik.<br>";
            $msg .= "Ada pesan untuk kamu:<br><br> ";
            $msg .= '" ' . $evaluation . ' "<br><br>';
            $msg .= "Tetap semangat dan jadikan pesan ini menjadi pribadi yang lebih baik";
            $msg .= read_file(base_url('assets/email/') . 'body2.html');
            // link
            $msg .= '<a href="' . base_url('freelance') . '" class="btn btn-primary" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;text-decoration:none;color:#f3a333;padding:10px 15px;border-radius:30px;background:#f3a333;color:#ffffff;">Lihat Project Lainnya</a>';
            $msg .= read_file(base_url('assets/email/') . 'footer.html');
            // message email------>
            $this->Menu_model->sendNotification($user['email'], 'Notification', $msg);

            $this->db->where('user_id', $user_id);
            $this->db->where('project_id', $project_id);
            $this->db->update('history', $data);

            $this->db->where('id', $project_id);
            $this->db->delete('desc_project');
            $this->db->where('project_id', $project_id);
            $this->db->delete('freelance_project');
            log_message('info', $user['name'] . ' evaluation project ' . $project['project']);
            redirect('job');
        } else {
            $this->session->set_flashdata('radio', '<small class="text-danger pl-1">Pilih penilaian</small>');
            redirect('job/finish/' . $this->input->post('project_id'));
        }
    }
    public function history()
    {
        $data['title'] = "History";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('history.*, user.name');
        $this->db->from('history');
        $this->db->join('user', 'user.id = user_id');
        $this->db->where('active', 1);
        $data['history'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('job/history', $data);
        $this->load->view('templates/footer');
    }
    public function edit($id)
    {
        $data['title'] = "Edit Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $data['kota'] = $this->db->query('SELECT * from wilayah_kabupaten order by nama asc')->result_array();
        $this->db->select('desc_project.*, bidang.bidang, wilayah_kabupaten.nama');
        $this->db->from('desc_project');
        $this->db->join('bidang', 'bidang_id = bidang.id');
        $this->db->join('wilayah_kabupaten', 'location = wilayah_kabupaten.id');
        $this->db->where('desc_project.id', $id);
        $data['project'] = $this->db->get()->row_array();
        $this->db->select('freelance_project.user_id, user.id, user.name');
        $this->db->from('freelance_project');
        $this->db->join('user', 'freelance_project.user_id = user.id');
        $this->db->where('project_id', $id);
        $data['freelance'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('project', 'Project', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('job/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $project = $this->input->post('project');
            $location = $this->input->post('location');
            $description = $this->input->post('description');
            $time = $this->input->post('expire');
            $expire = $time * 86400 + time();
            $data = [
                'project' => $project,
                'location' => $location,
                'description' => $description,
                'expire' => $expire
            ];
            $this->db->where('id', $id);
            $this->db->update('desc_project', $data);
            log_message('info', $user['user']['name'] . ' edit project ' . $project['project']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Project dirubah</div>');
            redirect('job', 'refresh');
        }
    }
}
