<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Model {
	function get_table($table){
		return $this->db->get($table)->result();
	}

	function get_table_where($table, $column, $id){
		$this->db->where($column, $id);
		return $this->db->get($table)->result();
	}

	function get_single($table, $column, $id){
		$this->db->where($column, $id);
		return $this->db->get($table)->row();
	}

	function get_kpi_chart($kpi_name){
		return $this->db->query("SELECT (weight*100) AS y,kpi AS label FROM tb_kpi WHERE kpi_name='$kpi_name' AND level = 2")->result_array();
	}

	function get_kpi($object){
		return $this->db->where('kpi_name',$object)->get('tb_kpi')->result();
	}

	function get_kpi_join_employee($kpi_name){
		return $this->db->query("SELECT * FROM tb_kpi tk 
								JOIN tb_pegawai tp 
								ON tk.pic = tp.id_pegawai
								WHERE tk.kpi_name = '$kpi_name'")->result();
	}

	function get_target_kpi($kpi_name,$kpi){
		return $this->db->where('kpi_name',$kpi_name)->where('kpi',$kpi)->get('tb_kpi')->row();
	}

	function get_score_chart($kpi_name,$kpi,$month){
		return $this->db->query("SELECT * FROM tb_kpi_score 
								WHERE kpi = '$kpi'
								AND kpi_name = '$kpi_name'
								AND month   = $month
								")->row();
	}

	function get_login($username, $password){
		$this->db->select('*');
		$this->db->from('tb_pegawai');
		$this->db->where('id_pegawai', $username);
		$this->db->where('password', md5($password));
		$data['login'] = $this->db->get()->row_array();
		return $data;
	}

	function set_data($table, $object, $id){
		if($id == null){
			$this->db->insert($table, $object);
		}else{
			$this->db->where($table['column'], $id);
			$this->db->update($table['table'], $object);
		}
	}

	function delete($table, $column, $id){
		$this->db->where($column, $id);
		$this->db->delete($table);
	}

	function insert_score($kpi, $kpi_name, $month, $actual, $arcv){
		$this->db->where('kpi_name',$kpi_name);
		$this->db->where('kpi', $kpi);
		$this->db->where('month', $month);
		$this->db->update('tb_kpi_score', array(
											'actual' => $actual,
											'arcv' => $arcv)
						 );
	}

	function get_kpi_join_score($kpi_id, $month, $kpi_name){
		return $this->db->query("SELECT ts.kpi,ts.actual,ts.arcv FROM tb_kpi_score ts 
									JOIN tb_kpi tk ON tk.kpi = ts.kpi 
									WHERE tk.kpi_id = $kpi_id
									AND ts.`month` = $month
									AND ts.kpi_name = '$kpi_name'")->row();
	}

	function get_report($kpi_name,$month){
		return $this->db->query("SELECT tk.*,ts.* FROM tb_kpi tk 
								LEFT JOIN tb_kpi_score ts 
								ON tk.kpi = ts.kpi 
								WHERE ts.`month` = $month
								AND tk.kpi_name = '$kpi_name'
								AND tk.`level` = 2
								GROUP BY tk.kpi
								")->result();
	}

	function get_report_ytd($kpi_name,$month){
		return $this->db->query("SELECT tk.kpi, sum(ts.arcv/$month) as avg FROM tb_kpi tk 
								LEFT JOIN tb_kpi_score ts 
								ON tk.kpi = ts.kpi 
								WHERE ts.`month` <= $month
								AND tk.kpi_name = '$kpi_name'
								AND tk.`level` = 2
								GROUP BY ts.kpi")->result();
	}

	function get_ikpi($month, $kpi){
		return $this->db->query("SELECT k.*,r.month,r.arcv from tb_kpi_score r
								LEFT JOIN tb_kpi k on r.kpi = k.kpi
								LEFT JOIN tb_kpi_structure s on k.kpi = s.kpi_parent
								WHERE s.kpi_parent IS NULL
								AND k.kpi_name = '$kpi'
								AND r.month = '$month'")->result();
	}

	function get_ikpi_all($month, $kpi){
		return $this->db->query("SELECT k.*,r.month,r.arcv from tb_kpi_score r
								LEFT JOIN tb_kpi k on r.kpi = k.kpi
								WHERE k.kpi_name = '$kpi'
								AND r.month = '$month'")->result();
	}

	function get_score_parent($kpi_name, $month, $weight){
		return $this->db->query("SELECT ts.kpi_parent,
										r.arcv,
										sum(r.actual) AS actual,
										sum(((actual/tk.target)*$weight)*100) AS total
									FROM
										tb_kpi tk
									JOIN tb_kpi_structure ts ON tk.kpi = ts.kpi
									RIGHT JOIN tb_kpi_score r ON tk.kpi = r.kpi
									WHERE
										r. MONTH = $month
									AND ts.kpi_parent = '$kpi_name'
									GROUP BY ts.kpi_parent")->row();
	}

	function get_score_kpi_name($month, $kpi_name){
		return $this->db->query("SELECT ts.kpi_parent, sum(r.arcv*tk.weight) AS total FROM tb_kpi tk 
								 JOIN tb_kpi_structure ts on tk.kpi = ts.kpi LEFT JOIN tb_kpi_score r ON tk.kpi = r.kpi 
								 WHERE r.month = '$month' AND ts.kpi_parent = '$kpi_name'
								 GROUP BY ts.kpi_parent")->row_array();	
	}
}

/* End of file Kpi.php */
/* Location: ./application/models/Kpi.php */