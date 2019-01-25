<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Model {
	function get_table($table){
		return $this->db->get($table)->result();
	}

	function get_single($table, $column, $id){
		$this->db->where($column, $id);
		return $this->db->get($table)->row();
	}

	function get_kpi($object){
		return $this->db->where('kpi_name',$object)->get('tb_kpi')->result();
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

	function set_data($table, $object, $id){
		if($id == null){
			$this->db->insert($table, $object);
		}
	}

	function delete($table, $column, $id){
		$this->db->where($column, $id);
		$this->db->delete($table);
	}

	function insert_score($kpi, $kpi_name, $month, $skor){
		$this->db->where('kpi_name',$kpi_name);
		$this->db->where('kpi', $kpi);
		$this->db->where('month', $month);
		$this->db->update('tb_kpi_rating', array('skor' => $skor));
	}

	function get_ikpi($month, $kpi){
		return $this->db->query("SELECT k.*,r.month,r.skor from tb_kpi_rating r
								LEFT JOIN tb_kpi k on r.kpi = k.kpi
								LEFT JOIN tb_kpi_structure s on k.kpi = s.kpi_parent
								WHERE s.kpi_parent IS NULL
								AND k.kpi_name = '$kpi'
								AND r.month = '$month'")->result();
	}

	function get_ikpi_all($month, $kpi){
		return $this->db->query("SELECT k.*,r.month,r.skor from tb_kpi_rating r
								LEFT JOIN tb_kpi k on r.kpi = k.kpi
								WHERE k.kpi_name = '$kpi'
								AND r.month = '$month'")->result();
	}

	function get_score_parent($kpi_name, $month){
		return $this->db->query("SELECT ts.kpi_parent, sum(r.skor*tk.weight) AS total FROM tb_kpi tk 
								 JOIN tb_kpi_structure ts on tk.kpi = ts.kpi LEFT JOIN tb_kpi_rating r ON tk.kpi = r.kpi 
								 WHERE r.month = '$month' AND ts.kpi_parent != '$kpi_name'
								 GROUP BY ts.kpi_parent")->result();
	}

	function get_score_kpi_name($month, $kpi_name){
		return $this->db->query("SELECT ts.kpi_parent, sum(r.skor*tk.weight) AS total FROM tb_kpi tk 
								 JOIN tb_kpi_structure ts on tk.kpi = ts.kpi LEFT JOIN tb_kpi_rating r ON tk.kpi = r.kpi 
								 WHERE r.month = '$month' AND ts.kpi_parent = '$kpi_name'
								 GROUP BY ts.kpi_parent")->row_array();	
	}
}

/* End of file Kpi.php */
/* Location: ./application/models/Kpi.php */