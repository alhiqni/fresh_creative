<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alamat_model');
        $this->load->model('Menu_model');
        is_logged_in();
    }
    public function resume()
    {
        $this->form_validation->set_rules('rumah', 'Address', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Province', 'trim|required');
        $this->form_validation->set_rules('kabupaten', 'District', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Sub-district', 'trim|required');
        $this->form_validation->set_rules('desa', 'Village', 'trim|required');
        $data['title'] = "My Resume";
        $data['provinsi'] = $this->Alamat_model->getDataProv();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['alamat'] = $this->Alamat_model->getDataAlamat($data['user']['id']);
        $data['pengalaman'] = $this->Alamat_model->getDataPengalaman($data['user']['id']);
        $data['alat'] = $this->db->get_where('user_tools', ['user_id' => $data['user']['id']])->result_array();
        $data['skill'] = $this->db->get_where('user_skill', ['user_id' => $data['user']['id']])->result_array();
        $data['school'] = $this->db->get_where('user_school', ['user_id' => $data['user']['id']])->result_array();
        $data['sosmed'] = $this->db->get_where('user_sosmed', ['user_id' => $data['user']['id']])->result_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/resume', $data);
            $this->load->view('templates/footer');
        } else {
            $user_id = $data['user']['id'];
            $data = [
                'user_id' => $user_id,
                'alamat' => htmlspecialchars($this->input->post('rumah', true)),
                'provinsi_id' => $this->input->post('provinsi'),
                'kabupaten_id' => $this->input->post('kabupaten'),
                'kecamatan_id' => $this->input->post('kecamatan'),
                'desa_id' => $this->input->post('desa')
            ];
            if (!$this->db->get_where('user_address', ['user_id' => $user_id])->result()) {

                if ($this->db->insert('user_address', $data)) {
                    log_message('info', $user['user']['name'] . ' update address ');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Alamat ditambah</div>');
                    redirect('user/resume', 'refresh');
                } else {
                    log_message('error', $user['user']['name'] . ' failed update address ');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Alamat gagal ditambah</div>');
                    redirect('user/resume', 'refresh');
                }
            } else {
                $this->db->where('user_id', $user_id);
                if ($this->db->update('user_address', $data)) {
                    log_message('info', $user['user']['name'] . ' update address ');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Alamat ditambah</div>');
                    redirect('user/resume', 'refresh');
                } else {
                    log_message('error', $user['user']['name'] . ' failed update address ');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Alamat gagal ditambah</div>');
                    redirect('user/resume', 'refresh');
                }
            }
        }
    }
    public function school($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->get('type') == 'add') {
            $data = [
                'user_id' => $id,
                'sekolah' => htmlspecialchars($this->input->post('sekolah', true)),
                'studi' => htmlspecialchars($this->input->post('studi', true)),
                'mulai' => htmlspecialchars($this->input->post('mulai', true)),
                'selesai' => htmlspecialchars($this->input->post('selesai', true))
            ];
            if ($this->db->insert('user_school', $data)) {
                log_message('info', $user['user']['name'] . ' update school ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan ditambah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed update school ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pendidikan gagal ditambah</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'delete') {
            if ($this->db->delete('user_school', ['id' => $id])) {
                log_message('info', $user['user']['name'] . ' delete school ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan dihapus</div>');
            } else {
                log_message('error', $user['user']['name'] . ' fail delete school ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pendidikan gagal dihapus</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'edit') {

            $data = [
                'sekolah' => htmlspecialchars($this->input->post('sekolah')),
                'studi' => htmlspecialchars($this->input->post('studi')),
                'mulai' => htmlspecialchars($this->input->post('mulai')),
                'selesai' => htmlspecialchars($this->input->post('selesai'))
            ];
            $this->db->where('id', $id);
            if ($this->db->update('user_school', $data)) {
                log_message('info', $user['user']['name'] . ' edit school ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan dirubah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed edit school ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pendidikan gagal dirubah </div>');
            }
            redirect('user/resume', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' suspicious and please check the code ');
            redirect('auth/blocked');
        }
    }
    public function sosmed($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->get('type') == 'add') {
            $data = [
                'user_id' => $id,
                'sosmed' => htmlspecialchars($this->input->post('sosmed')),
                'akun' => htmlspecialchars($this->input->post('akun'))
            ];
            if ($this->db->insert('user_sosmed', $data)) {
                log_message('info', $user['user']['name'] . ' add sosmed ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sosial Media ditambah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' fail add sosmed ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sosial Media gagal ditambah</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'delete') {
            if ($this->db->delete('user_sosmed', ['id' => $id])) {
                log_message('info', $user['user']['name'] . ' delete sosmed ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sosial Media dihapus</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed delete sosmed ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sosial Media gagal dihapus</div>');
            }
            redirect('user/resume', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' suspicious and please check the code ');
            redirect('auth/blocked');
        }
    }
    public function bidang()
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $bidang_id = htmlspecialchars($this->input->post('bidangId'));
        $user_id = htmlspecialchars($this->input->post('userId'));

        $data = [
            'user_id' => $user_id,
            'bidang_id' => $bidang_id
        ];
        $result = $this->db->get_where('user_job', $data);

        if ($result->num_rows() < 1) {
            log_message('info', $user['user']['name'] . ' add bidang ');
            $this->db->insert('user_job', $data);
        } else {
            log_message('info', $user['user']['name'] . ' delete bidang ');
            $this->db->delete('user_job', $data);
        }
    }
    public function skill($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->get('type') == 'add') {
            $data = [
                'user_id' => $id,
                'skill' => htmlspecialchars($this->input->post('skill'))
            ];
            if ($this->db->insert('user_skill', $data)) {
                log_message('info', $user['user']['name'] . ' add skill ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keahlian ditambah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed add skill ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Keahlian gagal ditambah</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'delete') {
            if ($this->db->delete('user_skill', ['id' => $id])) {
                log_message('info', $user['user']['name'] . ' delete skill ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keahlian dihapus</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed delete skill ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Keahlian gagal dihapus</div>');
            }
            redirect('user/resume', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' suspicious and please check the code ');
            redirect('auth/blocked');
        }
    }
    public function alat($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->get('type') == 'add') {
            $data = [
                'user_id' => $id,
                'tool' => htmlspecialchars($this->input->post('tool')),
                'type' => htmlspecialchars($this->input->post('type'))
            ];
            if ($this->db->insert('user_tools', $data)) {
                log_message('info', $user['user']['name'] . ' add alat ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Alat Pendukung ditambah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed add alat ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Alat Pendukung gagal ditambah</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'delete') {
            if ($this->db->delete('user_tools', ['id' => $id])) {
                log_message('info', $user['user']['name'] . ' delete alat ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Alat Pendukung dihapus</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed delete alat ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Alat Pendukung gagal dihapus</div>');
            }
            redirect('user/resume', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' suspicious and please check the code ');
            redirect('auth/blocked');
        }
    }
    public function pengalaman($id)
    {
        $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->get('type') == 'add') {
            $data = [
                'user_id' => $id,
                'pekerjaan' => htmlspecialchars($this->input->post('pekerjaan')),
                'perusahaan' => htmlspecialchars($this->input->post('perusahaan')),
                'lokasi' => htmlspecialchars($this->input->post('lokasi')),
                'mulai' => htmlspecialchars($this->input->post('mulai')),
                'ahir' => htmlspecialchars($this->input->post('ahir'))
            ];
            if ($this->db->insert('job_experience', $data)) {
                log_message('info', $user['user']['name'] . ' add pengalaman ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penglaman kerja ditambah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed add pengalaman ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Penglaman kerja gagal ditambah</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'delete') {
            if ($this->db->delete('job_experience', ['id' => $id])) {
                log_message('info', $user['user']['name'] . ' delete pengalaman ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penglaman kerja dihapus</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed delete alat ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Penglaman kerja gagal dihapus</div>');
            }
            redirect('user/resume', 'refresh');
        } elseif ($this->input->get('type') == 'edit') {
            $data = [
                'pekerjaan' => htmlspecialchars($this->input->post('pekerjaan')),
                'perusahaan' => htmlspecialchars($this->input->post('perusahaan')),
                'lokasi' => htmlspecialchars($this->input->post('lokasi')),
                'mulai' => htmlspecialchars($this->input->post('mulai')),
                'ahir' => htmlspecialchars($this->input->post('ahir'))
            ];
            $this->db->where('id', $id);
            if ($this->db->update('job_experience', $data)) {
                log_message('info', $user['user']['name'] . ' edit penglaman ');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penglaman kerja dirubah</div>');
            } else {
                log_message('error', $user['user']['name'] . ' failed edot pengalaman ');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Penglaman kerja gagal dirubah </div>');
            }
            redirect('user/resume', 'refresh');
        } else {
            log_message('error', $user['user']['name'] . ' suspicious and please check the code ');
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                    log_message('info', $data['user']['name'] . ' change photo');
                } else {
                    log_message('error', $data['user']['name'] . ' failed change photo');
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            if ($this->db->update('user')) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diupdate</div>');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil gagal diupdate</div>');
            }
            
            log_message('info', $data['user']['name'] . ' change profile');
            redirect('user');
        }
    }
    public function changepassword()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|required|min_length[5]|matches[new_password2]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $password1 = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                log_message('info', $data['user']['name'] . ' can\'t change pass');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $password1) {
                    log_message('info', $data['user']['name'] . ' can\'t change pass');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    log_message('info', $data['user']['name'] . ' change pass');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password dirubah</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
    public function getKabupaten()
    {
        $idprov = $this->input->post('id');
        $data = $this->Alamat_model->getDataKabupaten($idprov);
        $output = '<option value=""> --- Kabupaten/Kota --- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getKecamatan()
    {
        $id = $this->input->post('id');
        $data = $this->Alamat_model->getDataKecamatan($id);
        $output = '<option value=""> --- Kecamatan --- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getDesa()
    {
        $id = $this->input->post('id');
        $data = $this->Alamat_model->getDataDesa($id);
        $output = '<option value=""> --- Kelurahan/Desa --- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function check_bidang_kosong()
    {
        $user_id = $this->input->post('userId');
        $result = $this->db->get_where('user_job', ['user_id' => $user_id])->num_rows();
        if ($result > 0) {
            $result = 'd-none';
        } else {
            $result = '';
        }
        echo $result;
    }
    public function report()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $name = $data['user']['name'];
        $email = $data['user']['email'];
        $subject = "Laporan Atau Pertanyaan Webfree";
        $phone = $data['user']['phone'];
        $message = $this->input->post('msg');
        $msg = 'Kamu menerima pesan email dari website Freelance Fresh Creative Studio <br>';
        $msg .= 'yang berisi: <br>';
        $msg .= ' <dd> Nama: &nbsp;' . $name . '<br>';
        $msg .= ' <dd> Email: &nbsp;' . $email . '<br>';
        $msg .= ' <dd> No Hp: &nbsp;' . $phone . '<br>';
        $msg .= ' <dd> Pesan: &nbsp;' . $message . '<br>';
        if ($this->Menu_model->sendNotification('freshcreative.studio19@gmail.com', $subject, $msg)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan sudah terkirim</div>');
            //message email-------->
            $msg = read_file(base_url('assets/email/') . 'header.html');
            // subject
            $msg .= 'feedback';
            $msg .= read_file(base_url('assets/email/') . 'top.html');
            $msg .= read_file(base_url('assets/email/') . 'body1.html');
            // pesan
            $msg .= "Terima kasih " . $name . " atas atensi nya. <br> Kami sangat senang kamu mengirimkan kritik, pesan dan saran kepada kami. Laporan kamu akan segera kami tindak lanjuti. Terima Kasih atas kerjasamanya dan tetap semangat!";
            $msg .= read_file(base_url('assets/email/') . 'body2.html');
            $msg .= read_file(base_url('assets/email/') . 'footer.html');
            // message email------>
            $this->Menu_model->sendNotification($email, 'feedback', $msg);
            log_message('info', $data['user']['name'] . ' send a report');
            redirect('user');
        } else {
            log_message('error', $data['user']['name'] . ' can\'t send a report');
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Pesan gagal terkirim. Segera hubungi admin unutk masalah teknis ini</div>');
            redirect('user');
        }
    }
    public function reportResume()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $name = $data['user']['name'];
        $email = $data['user']['email'];
        $subject = "Website Freelance";
        $phone = $data['user']['phone'];
        $message = "\"Telah melakukan perubahan resume\"";
        $msg = 'Kamu menerima pesan email dari website Freelance Fresh Creative Studio <br>';
        $msg .= 'yang berisi: <br>';
        $msg .= ' <dd> Nama: &nbsp;' . $name . '<br>';
        $msg .= ' <dd> Email: &nbsp;' . $email . '<br>';
        $msg .= ' <dd> No Hp: &nbsp;' . $phone . '<br>';
        $msg .= ' <dd> Pesan: &nbsp;' . $message . '<br>';
        if ($this->Menu_model->sendNotification('freshcreative.studio19@gmail.com', $subject, $msg)) {
            log_message('info', $data['user']['name'] . ' send a report resume');
            redirect('user');
        } else {
            log_message('error', $data['user']['name'] . ' can\'t send a report');
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Pesan gagal terkirim. Segera hubungi admin unutk masalah teknis ini</div>');
            redirect('user');
        }
    }
}
