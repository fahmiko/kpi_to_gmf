<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmf extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/gmf
	 *	- or -
	 * 		http://example.com/index.php/gmf/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/gmf/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kpi');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->check_session();
		$kpi_name = null;
		if($this->session->userdata('dashboard')!=null){
			$kpi_name = $this->session->userdata('dashboard');
		}

		if(@$_GET['select-kpi']!=null){
			$this->session->set_userdata('dashboard',urldecode(@$_GET['select-kpi']));
			$kpi_name = urldecode(@$_GET['select-kpi']);
			redirect('gmf','refresh');
		}

		$month = intval(date('m'));
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$data['month'] = $dateObj->format('F');

		$data['chart'] = $this->kpi->get_kpi_chart($kpi_name);
		$data['kpi'] = $this->kpi->get_kpi_join_employee($kpi_name);
		$data['nilai_kpi'] = $this->kpi->get_ikpi_all($month,$kpi_name);
		$data['on_progress'] = $this->kpi->get_table_where('tb_kpi_name', 'status', 'on progress');

		$data['kpi1'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->result_array();
		$data['kpi2'] = $this->db->where('level',3)->where('kpi_name',$kpi_name)->get('tb_kpi')->result_array();

		$data['tb_kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		$data['tb_employee'] = $this->kpi->get_table('tb_pegawai');

		$data['row'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->num_rows();
		$data['row2'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->num_rows();

		$nilai = 0;
        for($i = 1; $i<=intval(date('m'));$i++){
          $score = $this->kpi->get_score_kpi_name($i,$this->session->userdata('dashboard'));
          $nilai += $score['total'];
        }
        $data['score'] = $nilai/intval(date('m'));

		$this->load->view('templates/header');
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
		$this->load->view('elements/chart', $data);
		$this->load->view('elements/datatable', $data);
		$this->load->view('elements/tree', $data);
		$this->load->view('elements/modals', $data);
	}

	public function chart(){
		$this->check_session();
		$data['report'] = $this->kpi->get_report($this->session->userdata('dashboard'),intval(date('m')));
		$data['skor'] = array();

		$this->load->view('templates/header');
		$this->load->view('chart');
		$this->load->view('templates/footer');
		$this->load->view('elements/chart_report',$data);
	}

	public function delete(){
		$kpi = urldecode($this->uri->segment(3));

		$this->kpi->delete('tb_kpi_structure','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi_name','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi_score','kpi_name',$kpi);
		redirect('gmf/list');
	}

	public function update_kpi(){
		$kpi = urldecode($this->uri->segment(3));
		$this->kpi->set_data(array('column'=>'kpi_name','table'=>'tb_kpi_name'), array('status'=>'finish'), $kpi);
		redirect('gmf/list');
	}

	public function list(){
		$this->check_session();
		$data['kpi'] = $this->kpi->get_table('tb_kpi_name');
		$this->load->view('templates/header');
		$this->load->view('structure/list_kpi', $data);
		$this->load->view('templates/footer');
		$this->load->view('elements/datatable');
	}

	public function score(){
		$this->check_session();
		if($this->input->post('kpi_name')!=null){
			$kpi = $this->input->post('kpi');
			$kpi_name = $this->input->post('kpi_name');
			$month = $this->input->post('month');
			$skor = $this->input->post('nilai');
			for($i = 0;$i<2;$i++){
				$this->kpi->insert_score($kpi, $kpi_name, $month, $skor);
				$data['parent'] = $this->kpi->get_score_parent($kpi_name, $month);
					foreach ($data['parent'] as $row) {
						$this->kpi->insert_score($row->kpi_parent, $kpi_name, $month, ($row->total));
				}	
			}
			redirect('gmf/score');
		}else{
			$this->form_validation->set_rules('kpi', 'KPI', 'required');
			$this->form_validation->set_rules('month', 'Month', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['month'] = intval(date('m'));
				$data['skpi_name'] = $this->kpi->get_single("tb_kpi_name", "kpi_name", $this->session->userdata('dashboard'));
				$data['ikpi'] = $this->kpi->get_ikpi($data['month'],$this->session->userdata('dashboard'));
				$data['ikpi_all'] = $this->kpi->get_ikpi_all($data['month'],$this->session->userdata('dashboard'));
				$data['score_kpi'] = $this->kpi->get_score_kpi_name($data['month'],$this->session->userdata('dashboard'));
			} else {
				$data['ps_month'] = $this->input->post('month');
				$data['ps_kpi'] = $this->input->post('kpi');
				$data['month'] = $this->input->post('month');
				$data['skpi_name'] = $this->kpi->get_single("tb_kpi_name", "kpi_name", $this->input->post('kpi'));
				$data['ikpi'] = $this->kpi->get_ikpi($this->input->post('month'),$this->input->post('kpi'));
				$data['ikpi_all'] = $this->kpi->get_ikpi_all($this->input->post('month'),$this->input->post('kpi'));
				$data['score_kpi'] = $this->kpi->get_score_kpi_name($this->input->post('month'),$this->input->post('kpi'));
			}

			$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');

			$this->load->view('templates/header');
			$this->load->view('score/list_score',$data);
			$this->load->view('templates/footer');
		}
	}

	public function create_structure(){
		$this->check_session();
		$this->form_validation->set_rules('KPI', 'kpi_name', 'required');
		if ($this->form_validation->run() == TRUE) {
			redirect('gmf','refresh');
		} else {
			$data = array(
				'kpi_name' => $this->input->post('kpi_name'),
				'level2' => $this->input->post('level2'),
				'level3' => $this->input->post('level3'),
				'level4' => $this->input->post('level4')
			);
			$data['pic'] = $this->kpi->get_table('tb_pegawai');
			$this->session->set_userdata('structure',$data);
			$this->load->view('templates/header');
			$this->load->view('structure/create', $data);
			$this->load->view('templates/footer');
			}
		}

	public function employee(){
		$this->check_session();
		$data['employee'] = $this->kpi->get_table('tb_pegawai');
		$this->load->view('templates/header');
		$this->load->view('employee/list_employee',$data);
		$this->load->view('templates/footer');
		$this->load->view('elements/datatable');
	}

	public function manage_employee(){
		$this->check_session();
		if($this->input->post('manage')=="insert"){
			$this->form_validation->set_rules('id_pegawai', 'Id Pegawai', 'required|is_unique[tb_pegawai.id_pegawai]');
		}else{
			$this->form_validation->set_rules('id_pegawai', 'Id Pegawai', 'required');
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['employee'] = $this->kpi->get_table('tb_pegawai');
			$this->load->view('templates/header');
			$this->load->view('employee/list_employee',$data);
			$this->load->view('templates/footer');
			$this->load->view('elements/datatable');
		} else {
			if($this->input->post('manage')=="insert"){
				// Data Insert Pegawai
				$data['query'] = array(
					'id_pegawai' => $this->input->post('id_pegawai'),
					'nama' => $this->input->post('nama'),
					'password' => md5($this->input->post('password')),
					'jabatan' => $this->input->post('jabatan'),
					'status' => $this->input->post('akses')
				);
				// Insert User & Pegawai
				$this->kpi->set_data('tb_pegawai',$data['query'],null);
				$this->session->set_flashdata('alert_success', "Berhasil Insert Pegawai");
			}else if($this->input->post('manage')=="update"){
				// Data Update Pegawai
				$data['query'] = array(
					'nama' => $this->input->post('nama'),
					'jabatan' => $this->input->post('jabatan')
				);

				$this->kpi->set_data(array('table'=>'tb_pegawai','column' => 'id_pegawai'),
										$data['query'],
										$this->input->post('id_pegawai'));
				$this->session->set_flashdata('alert_success', "Berhasil Update Pegawai");
			}else if($this->input->post('manage')=="delete"){
				$this->kpi->delete('tb_pegawai', 'id_pegawai',$this->input->post('id_pegawai'));
				$this->session->set_flashdata('alert_success', "Berhasil menghapus Pegawai");
			}
		}
		redirect('gmf/employee','refresh');
	}

	public function insert_structure(){
		$this->check_session();
		$structure = $this->session->userdata('structure');
		// echo "insert kpi_name = ".$level['level']['kpi_name'];
		// Insert to table tb_kpi_name
		$insert = array(
			'kpi_name' => $structure['kpi_name'],
			'created_by' => $this->input->post('created')
		);
		$this->kpi->set_data('tb_kpi_name',$insert, null);

		for($j = 2;$j <= 4; $j++){
			$lv = "level".$j;
			for($i = 0;$i < $structure[$lv];$i++){
				$kpi_lv = "kpi_lv".$j."_".$i;
				$kpi_weight = "weight_lv".$j."_".$i;
				$remarks = "remarks_lv_".$j."_".$i;
				$pic = "pic_lv_".$j."_".$i;
				$target = "target_lv".$j."_".$i;
				$insert = array(
					'kpi'      => $this->input->post($kpi_lv),
					'kpi_name' => $structure['kpi_name'],
					'level'    => $j,
					'weight'   => ($this->input->post($kpi_weight)/100),
					'pic'      => $this->input->post($pic),
					'target'   => $this->input->post($target),
					'remarks'  => $this->input->post($remarks)
				);
				$this->kpi->set_data('tb_kpi',$insert, null);
			}	
		}

		for($i = 0;$i < $structure['level2'];$i++){
			$insert = array(
				'kpi_name' => $structure['kpi_name'],
				'kpi' => $this->input->post("kpi_lv2_$i"),
				'kpi_parent' => $structure['kpi_name']
			);
			$this->kpi->set_data('tb_kpi_structure',$insert, null);
		}

		for($j = 3;$j <= 4; $j++){
			$lv = "level".$j;
			for($i = 0;$i < $structure[$lv];$i++){
				$kpi_lv = "kpi_lv".$j."_".$i;
				$kpi_parent = "parent_lv".$j."_".$i;
				$insert = array(
					'kpi_name'	 => $structure['kpi_name'],
					'kpi'        => $this->input->post($kpi_lv),
					'kpi_parent' => $this->input->post($kpi_parent)
				);
				$this->kpi->set_data('tb_kpi_structure',$insert, null);	
			}	
		}
		
		for($k = 1;$k <= 12; $k++){
			for($j = 2;$j <= 4; $j++){
				$lv = "level".$j;
				for($i = 0;$i < $structure[$lv];$i++){
					$kpi_lv = "kpi_lv".$j."_".$i;
					$insert = array(
						'kpi'      => $this->input->post($kpi_lv),
						'kpi_name' => $structure['kpi_name'],
						'month'    => $k
					);
					$this->kpi->set_data('tb_kpi_score',$insert, null);
				}	
			}
		}

		redirect('gmf','refresh');
	}

	public function report(){
		$this->check_session();
		$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		$data['report'] = $this->kpi->get_report($this->session->userdata('dashboard'),intval(date('m')));
		$data['report_all'] = $this->kpi->get_report_ytd($this->session->userdata('dashboard'),intval(date('m')));

		$this->load->view('templates/header');
		$this->load->view('report/list_report', $data, FALSE);
		$this->load->view('templates/footer');
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('login');
		} else {
			$data['kpi'] = $this->kpi->get_login($this->input->post('username'),$this->input->post('password'));
			$data['row'] = sizeof($data['kpi']['login']);
			if(sizeof($data['kpi']['login']) != 0){
				$this->session->set_userdata("login",$data['kpi']['login']);
				$data['user'] = $data['kpi']['login'];
				$data['status'] = "TRUE";
				function random_color_part() {
 				   return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
				}

				function random_color() {
    				return random_color_part() . random_color_part() . random_color_part();
				}

				$data['color'] = array('bg' => random_color(),
									   'status' => random_color());
				$this->session->set_userdata('color',$data['color']);
				echo json_encode($data);
			}else{
				$data['status'] = "FALSE";
				echo json_encode($data);
			}
		}
	}

	public function check_session(){
		if($this->session->userdata('login')==null){
			redirect('gmf/login','refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('login');
		redirect('gmf/login','refresh');
	}

	public function json_chart(){
		$name = $this->session->userdata('dashboard');
		$kpi = $this->input->post('id');
		$data = $this->db->query("SELECT tk.target as y, ts.kpi as label FROM tb_kpi_structure ts 
			JOIN tb_kpi tk ON tk.kpi  = ts.kpi_parent
			WHERE tk.kpi_name = '$name'
			AND ts.kpi_parent = '$kpi'")->result_array();
		echo json_encode($data);
	}
}