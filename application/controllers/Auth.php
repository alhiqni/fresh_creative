<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Menu_model');
    }

    public function index()
    {

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->Menu_model->deleteUserExpire();
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_header');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        if ($this->session->userdata('email')) {

            redirect('user', 'refresh');
        }
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $data = $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        log_message('info', $user["name"] . ' login');
                        redirect('admin', 'refresh');
                    } else {
                        log_message('info', $user["name"] . ' login');
                        redirect('user', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Salah Password</div>');
                    redirect('auth', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email ini belum aktif, silahkan cek email kamu <br> Terkadang email masuk dalam <strong>spam</strong> atau <strong>promosi</strong> pindahkan email ke inbox agar kamu dapat menerima informasi lebih nyaman</div>');
                redirect('auth', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar<br>  Silahkan daftarkan dirimu</div>');
            redirect('auth', 'refresh');
        }
    }
    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah pernah di daftarkan!'
        ]);
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[11]|max_length[14]|numeric');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Sistem Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_header');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 0,
                'date_create' => time(),
                'phone' => htmlspecialchars($this->input->post('phone', true)),
                'sex' => $this->input->post('sex')
            ];
            log_message('info', $data["name"] . ' registrasion');
            // create random code
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'token' => $token,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!! Akunmu sudah berhasil dibuat, silahkan cek email kamu dan segera aktivasi akun kamu <br> Terkadang email masuk dalam <strong>spam</strong> atau <strong>promosi</strong> pindahkan email ke inbox agar kamu dapat menerima informasi lebih nyaman </div>');
            redirect('auth', 'refresh');
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token =  $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < 86400) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    log_message('info', $user["email"] . ' verify success');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' Aktivasi Berhasil! </div>');
                    redirect('auth', 'refresh');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    log_message('info', $user["email"] . ' verify failed');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Akun gagal! <br> Link sudah kadaluarsa! <br>Silahkan lakukan pendaftaran ulang</div>');
                    redirect('auth', 'refresh');
                }
            } else {
                log_message('info', $user["email"] . ' verify failed');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Akun gagal! <br>Link tidak valid!</div>');
                redirect('auth', 'refresh');
            }
        } else {
            log_message('info', $user["email"] . ' verify failed');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Akun gagal! <br>Link tidak valid!</div>');
            redirect('auth', 'refresh');
        }
    }
    private function _sendEmail($token, $type)
    {
        $email = $this->input->post('email');
        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.hostinger.co.id',
            'smtp_user' => 'support@freshcreativebook.com',
            'smtp_pass' => 'Fresh987321',
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from('support@freshcreativebook.com', 'Fresh Creative Studio');
        $this->email->to($email);
        if ($type == 'verify') {
            $link = base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token);
            //message email-------->
            $msg = read_file(base_url('assets/email/') . 'header.html');
            // subject
            $msg .= 'Account';
            $msg .= read_file(base_url('assets/email/') . 'top.html');
            // tittle
            $msg .= "Account Verification";
            $msg .= read_file(base_url('assets/email/') . 'body1.html');
            // pesan
            $msg .= "Hanya beberapa langkah lagi sebelum kamu dapat menggunakan akun kamu.<br>klik link berikut atau copy paste pada browser kamu<br><br>" . $link . "<br><br>Atau gunakan tombol dibawah ini untuk memverifikasi email kamu.";
            $msg .= read_file(base_url('assets/email/') . 'body2.html');
            // link
            $msg .= '<a href="' . $link . '" class="btn btn-primary" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;text-decoration:none;color:#f3a333;padding:10px 15px;border-radius:30px;background:#f3a333;color:#ffffff;">Kunjungi</a>';
            $msg .= read_file(base_url('assets/email/') . 'footer.html');
            // message email------>
            $this->email->subject('Account Verification');
            $this->email->message($msg);
            log_message('info', 'email verify made');
        } else if ($type == 'forgot') {
            $link = base_url() . 'auth/resetpassword?email=' . $email . '&token=' . urlencode($token);
            //message email-------->
            $msg = read_file(base_url('assets/email/') . 'header.html');
            // subject
            $msg .= 'Account';
            $msg .= read_file(base_url('assets/email/') . 'top.html');
            // tittle
            $msg .= "Reset password";
            $msg .= read_file(base_url('assets/email/') . 'body1.html');
            // pesan
            $msg .= "klik link berikut atau copy paste pada browser kamu untuk mereset password kamu<br><br>" . $link . "<br><br>Atau gunakan tombol dibawah ini.";
            $msg .= read_file(base_url('assets/email/') . 'body2.html');
            // link
            $msg .= '<a href="' . $link . '" class="btn btn-primary" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;text-decoration:none;color:#f3a333;padding:10px 15px;border-radius:30px;background:#f3a333;color:#ffffff;">Kunjungi</a>';
            $msg .= read_file(base_url('assets/email/') . 'footer.html');
            // message email------>
            $this->email->subject('Reset password');
            $this->email->message($msg);
            log_message('info', ' email forgot password made');
        }

        if ($this->email->send()) {
            log_message('info', ' email sent');
            return true;
        } else {
            // echo $this->email->print_debugger();
            log_message('error', ' email failed to send');
        }
    }

    public function logout()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        log_message('info', $data['user']['name'] . ' logout');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu telah berhasil logout</div>');
        redirect('auth', 'refresh');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_header');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            log_message('info', $email . ' forgot pass');
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Segera cek email kamu untuk menganti password!</div>');
                redirect('auth', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar atau aktif</div>');
                redirect('auth/forgotpassword', 'refresh');
            }
        }
    }
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token =  $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
                log_message('info', $email . ' pass changed');
            } else {
                log_message('info', $email . ' pass failed change');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Link tidak valid</div>');
                redirect('auth', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Link tidak valid</div>');
            redirect('auth', 'refresh');
        }
    }
    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/changepassword', $data);
            $this->load->view('templates/auth_header');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->db->delete('user_token', ['email' => $email]);
            $this->session->unset_userdata('reset_email');
            log_message('info', $email . ' change pass ');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan login</div>');
            redirect('auth', 'refresh');
        }
    }
}
