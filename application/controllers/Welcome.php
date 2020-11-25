<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Alamat_model');
    }
    public function index()
    {
        $this->load->view('welcome/index');
    }
    public function portofolio()
    {
        $this->load->view('welcome/gallery');
    }
    public function career()
    {
        $this->load->view('welcome/career');
    }
    public function sendemail()
    {
        $this->form_validation->set_rules(
            'name',
            'Name',
            'trim|required',
            array('min_length[5]' => 'Error Message min length 5 for this Name')
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email',
            array('valid_email' => 'Error Message on email, Email is not valid')
        );
        $this->form_validation->set_rules(
            'subject',
            'Subject',
            'trim|required|min_length[3]',
            array('min_length[4]' => 'Error Message min length 4 for this Subject')
        );
        $this->form_validation->set_rules(
            'phone',
            'Phone Number',
            'trim|required|numeric',
            array('numeric' => 'Error Message phone must be numbers')
        );
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $name =  htmlspecialchars($this->input->post('name', true));
            $email =  htmlspecialchars($this->input->post('email', true));
            $subject =  htmlspecialchars($this->input->post('subject', true));
            $phone =  htmlspecialchars($this->input->post('phone', true));
            $message =  htmlspecialchars($this->input->post('message', true));
            $msg = 'Kamu menerima pesan email dari website Fresh Creative Studio <br>';
            $msg .= 'yang berisi: <br>';
            $msg .= ' <dd> Nama: &nbsp;' . $name . '<br>';
            $msg .= ' <dd> Email: &nbsp;' . $email . '<br>';
            $msg .= ' <dd> No Hp: &nbsp;' . $phone . '<br>';
            $msg .= ' <dd> Pesan: &nbsp;' . $message . '<br>';
            if ($this->Menu_model->sendNotification('freshcreative.studio19@gmail.com', $subject, $msg)) {
                log_message('info', $name . ' send a message');
                $this->session->set_flashdata('message', '<div class="alert alert-light" role="alert">Pesan email terkirim</div>');
                redirect('welcome#contact');
            } else {
                log_message('info', $name . ' can\'t send a message');
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Pesan email gagal terkirim</div>');
                redirect('welcome#contact');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak valid, Silahkan isi formulir dengan benar</div>');
            redirect('welcome#contact');
        }
    }
}
