<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_auth extends CI_Controller
{

	public function index()
	{
		$this->_login();
	}
	private function _login()
	{
		if ($this->session->userdata('username')) {
			redirect('C_Pelanggan');
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
			'required' => 'harus diisi'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'harus diisi'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_index');
		} else {
			$username = htmlspecialchars($this->input->post('username', true), ENT_QUOTES);
			$password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);

			$u = $this->db->get_where('user', ['username' => $username])->row();
			if ($u) {
				if (password_verify($password, $u->password)) {
					$data = [
						'id_user' => $u->id_user,
						'nama_user' => $u->nama_user,
						'username' => $u->username,
						'level' => $u->level,
						'id_outlet' => $u->id_outlet
					];
					$this->session->set_userdata($data);
					if ($this->session->userdata('level') == 'owner') {
						redirect('C_Laporan');
					} else {
						redirect('C_Pelanggan');
					}
				} else {
					$this->session->set_flashdata('pesan', 'password salah!!!');
					redirect('C_Auth');
				}
			} else {
				$this->session->set_flashdata('pesan', 'username tidak terdaftar!!!');
				redirect('C_Auth');
			}
		}
	}
	public function logout()
	{
		session_destroy();
		redirect('C_Auth');
	}
}
