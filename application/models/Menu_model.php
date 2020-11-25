<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Menu_model extends CI_model
{

	public function getSubMenu()
	{
		$query = "SELECT user_sub_menu.* , user_menu.menu from user_sub_menu JOIN user_menu ON user_sub_menu.menu_id = user_menu.id";
		return $this->db->query($query)->result_array();
	}
	public function sendNotification($email, $subject, $msg)
	{
		$this->load->library('email');
		$user = 'support@freshcreativebook.com';
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.hostinger.co.id',
			'smtp_user' => $user,
			'smtp_pass' => 'Fresh987321',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from($user, 'Fresh Creative Studio');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($msg);
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
		}
	}
	public function deleteUserExpire()
	{
		$user = $this->db->get('user_token')->result_array();
		foreach ($user as $usr) {
			$user_token = $usr['date_created'];
			$email = $usr['email'];
			if (time() - $user_token > 86400) {
				$this->db->delete('user', ['email' => $email]);
				$this->db->delete('user_token', ['email' => $email]);
			}
		}
	}
}
