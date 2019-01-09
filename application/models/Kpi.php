<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Model {
	function get_kpi(){
		return $this->db->get('tb_kpi')->result();
	}

	function get_login($username, $password){
		$this->db->select('users.*, tb_pegawai.*');
		$this->db->from('users');
		$this->db->join('tb_pegawai','users.id_pegawai=tb_pegawai.id_pegawai');
		$this->db->where('users.username', $username);
		$this->db->where('users.password', md5($password));
		$data['login'] = $this->db->get()->row_array();
		return $data;
	}

}

/* End of file Kpi.php */
/* Location: ./application/models/Kpi.php */