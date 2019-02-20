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
		// Check Session
		$this->check_session();
		$kpi_name = null;
		// Get Selected KPI
		if($this->session->userdata('dashboard')!=null){
			$kpi_name = $this->session->userdata('dashboard');
		}

		if(@$_GET['select-kpi']!=null){
			$this->session->set_userdata('dashboard',urldecode(@$_GET['select-kpi']));
			$formula = $this->kpi->get_single('tb_kpi_name', 'kpi_name', urldecode(@$_GET['select-kpi']));
			$kpi_name = urldecode(@$_GET['select-kpi']);
			$this->session->set_userdata('formula',$formula->formula);
			if($this->session->userdata('month')==null){
				$this->session->set_userdata('month',intval(date('m')));
			}
			redirect('gmf','refresh');
		}

		if($this->session->userdata('month') == null){
			$month = intval(date('m'));
		}else{
			$month = $this->session->userdata('month');
		}
		// Generate Month to String
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$data['month'] = $dateObj->format('F');
		// Get Data using model
		$data['chart'] = $this->kpi->get_kpi_chart($kpi_name);
		$data['kpi'] = $this->kpi->get_kpi_join_employee($kpi_name);
		$data['nilai_kpi'] = $this->kpi->get_ikpi_all($this->session->userdata('month'),$kpi_name);
		$data['on_progress'] = $this->kpi->get_table_where('tb_kpi_name', 'status', 'on progress');
		// Get data kpi Parent
		$data['kpi1'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->result_array();
		$data['kpi2'] = $this->db->where('level',3)->where('kpi_name',$kpi_name)->get('tb_kpi')->result_array();
		// Get table
		$data['tb_kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		$data['tb_employee'] = $this->kpi->get_table('tb_pegawai');
		// Get Row for tree
		$data['row'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->num_rows();
		$data['row2'] = $this->db->where('level',2)->where('kpi_name',$kpi_name)->get('tb_kpi')->num_rows();
		// Loop to get score kpi latest
		// echo $this->session->userdata('formula');
		if($this->session->userdata('formula') == 'avg'){
			$nilai = 0;
        	for($i = 1; $i<=$this->session->userdata('month');$i++){
          		$score = $this->kpi->get_score_kpi_name($i,$this->session->userdata('dashboard'));
          		$nilai += $score['total'];
        	}
        	$data['score'] = $nilai/$this->session->userdata('month');	
        	$this->session->set_userdata('score',$data['score']);
		}else if($this->session->userdata('formula') == 'arcv'){
			$score = $this->kpi->get_score_kpi_name($this->session->userdata('month'),$this->session->userdata('dashboard'));	
			$data['score'] = $score['total'];
			$this->session->set_userdata('score',$data['score']);
		}else{
			$data['score'] = 0;
		}
		
        // Generate view to display
		$this->load->view('templates/header');
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
		$this->load->view('elements/chart', $data);
		$this->load->view('elements/datatable', $data);
		$this->load->view('elements/modals', $data);
	}

	public function chart(){
		$this->check_session();
		// Get data report using model
		$data['report'] = $this->kpi->get_report($this->session->userdata('dashboard'),$this->session->userdata('month'));
		$data['skor'] = array();
		if($this->session->userdata('formula') == 'avg'){
			$nilai = 0;
        	for($i = 1; $i<=$this->session->userdata('month');$i++){
          		$score = $this->kpi->get_score_kpi_name($i,$this->session->userdata('dashboard'));
          		$nilai += $score['total'];
        	}
        	$data['score'] = $nilai/$this->session->userdata('month');
		}else if($this->session->userdata('formula') == 'arcv'){
			$score = $this->kpi->get_score_kpi_name($this->session->userdata('month'),$this->session->userdata('dashboard'));	
			$data['score'] = $score['total'];
		}else{
			$data['score'] = 0;
		}
		// Generate view to display
		$this->load->view('templates/header');
		$this->load->view('chart');
		$this->load->view('templates/footer');
		$this->load->view('elements/chart_report',$data);
	}

	public function delete(){
		// Get values using url segment
		$kpi = urldecode($this->uri->segment(3));
		// Delete data record in database using model
		$this->kpi->delete('tb_kpi_structure','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi_name','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi_score','kpi_name',$kpi);
		redirect('gmf/list');
	}

	public function update_kpi(){
		// Get values using url segment
		$kpi = urldecode($this->uri->segment(3));
		// Update row using model
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
		// Check session
		$this->check_session();
		// if form not selected or null
		if($this->input->post('kpi_name')!=null){
			$kpi = $this->input->post('kpi');
			$kpi_name = $this->session->userdata('dashboard');
			$month = $this->session->userdata('month');
			$actual = $this->input->post('actual');
			$arcv = $this->input->post('arcv');
			$weight = $this->input->post('weight');
			// loop for insert row database using model
			$query = $this->kpi->get_kpi_join_score($kpi, $month, $kpi_name);
			$kpi = $query->kpi;
			if($month>1){
				$actual += $this->input->post('pre_act');
				$this->kpi->insert_score($kpi, $kpi_name, $month, $actual,$arcv);
			}else{
				$this->kpi->insert_score($kpi, $kpi_name, $month, $actual,$arcv);
			}
			$kpi_parent = $this->db->query("SELECT DISTINCT(kpi_parent),kpi_name FROM tb_kpi_structure WHERE kpi_name = '$kpi_name' AND kpi_parent != '$kpi_name'")->result();
			for($i = 0;$i < 2 ;$i++){
				foreach ($kpi_parent as $row) {
					$parent = $this->db->where('kpi',$row->kpi_parent)->get('tb_kpi')->row();
					$tbc = $this->kpi->get_score_parent($row->kpi_parent, $month, $parent->weight);
					// echo $tbc->kpi_parent." ";
					// echo $tbc->actual." ";
					// echo $tbc->total." ";
					// echo "<br>";
					$this->kpi->insert_score($tbc->kpi_parent, $kpi_name, $month, $tbc->actual,$tbc->total);
					$this->kpi->insert_score($row->kpi_parent, $kpi_name, $month, $tbc->actual,$tbc->total);
				// echo $row->kpi_parent;
				}		
			}
			
			redirect('gmf/score');
		}else{
			// form validation code igniter set kpi and month is required
			$this->form_validation->set_rules('kpi', 'KPI', 'required');
			$this->form_validation->set_rules('month', 'Month', 'required');

			if ($this->form_validation->run() === TRUE) {
				// if validation run false generate query get but not using parameter kpi name
				$this->session->set_userdata('month',$this->input->post('month'));
			}else{

			}
			$data['ikpi'] = $this->kpi->get_ikpi($this->session->userdata('month'),$this->session->userdata('dashboard'));
			// Get row table kpi name
			$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');
			// Generate view
			$this->load->view('templates/header');
			$this->load->view('score/list_score',$data);
			$this->load->view('templates/footer');
			$this->load->view('elements/datatable');
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
		$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[4]');
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
			'created_by' => $this->input->post('created'),
			'formula' => $this->input->post('formula')
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
		for($i = 1 ;$i <= $this->session->userdata('month');$i++){
			$data['report'][$i] = $this->kpi->get_report($this->session->userdata('dashboard'),$i);
			$data['column'] = sizeof($data['report'][$i]);
		}
		$data['table'] = $this->kpi->get_report($this->session->userdata('dashboard'),1);
		$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		if($this->session->userdata('formula')=='avg'){
			$data['report_ytd'] = $this->kpi->get_report_ytd($this->session->userdata('dashboard'),$this->session->userdata('month'));
		}else{
			$data['report_ytd'] = $this->kpi->get_report($this->session->userdata('dashboard'),$this->session->userdata('month'));
		}

		$this->load->view('templates/header');
		$this->load->view('report/list_report', $data, FALSE);
		$this->load->view('templates/footer');
	}

	
	public function check_session(){
		if($this->session->userdata('login')==null){
			redirect('gmf/login','refresh');
		}
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

	public function logout(){
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('color');
		redirect('gmf/login','refresh');
	}

	public function json_chart(){
		$name = $this->session->userdata('dashboard');
		$kpi = $this->input->post('id');
		$data = $this->db->query("SELECT tk.kpi_id,tk.target as y, ts.kpi as label, tk.target, tk.weight FROM tb_kpi_structure ts 
			JOIN tb_kpi tk ON tk.kpi  = ts.kpi_parent
			WHERE tk.kpi_name = '$name'
			AND ts.kpi_parent = '$kpi'")->result_array();
		echo json_encode($data);
	}

	public function json_score_tree(){
		$name = $this->session->userdata('dashboard');
		$kpi = $this->input->post('id');
		$month = $this->session->userdata('month');
		$data = $this->db->query("SELECT tk.target,tk.weight,ts.*,tc.arcv,tc.actual from tb_kpi tk
								  LEFT JOIN tb_kpi_structure ts ON tk.kpi = ts.kpi_parent
								  JOIN tb_kpi_score tc ON ts.kpi = tc.kpi
								  WHERE ts.kpi_parent = '$kpi'
								  AND tc.month = $month
								  AND tk.kpi_name = '$name'
								  ")->result_array();
		echo json_encode($data);
	}	

	public function print_report(){
		for($i = 1 ;$i <= $this->session->userdata('month');$i++){
			$data['report'][$i] = $this->kpi->get_report($this->session->userdata('dashboard'),$i);
			$data['column'] = sizeof($data['report'][$i]);
		}
		$data['table'] = $this->kpi->get_report($this->session->userdata('dashboard'),1);
		$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		if($this->session->userdata('formula')=='avg'){
			$data['report_ytd'] = $this->kpi->get_report_ytd($this->session->userdata('dashboard'),$this->session->userdata('month'));
		}else{
			$data['report_ytd'] = $this->kpi->get_report($this->session->userdata('dashboard'),$this->session->userdata('month'));
		}
		$this->load->view('report/print',$data);
	}

	function json_kpi($id){
		$this->db->where('kpi_id',$id);
		$data = $this->db->get('tb_kpi');
		echo json_encode($data->row_array());
	}

	function json_score(){
		$data = $this->kpi->get_report($this->session->userdata('dashboard'),$this->session->userdata('month'));
		echo json_encode(array('data' => $data));
	}

	function json_formula_avg(){
		$kpi = $this->input->post('kpi');
		$month = ($this->session->userdata('month')-1);
		$kpi_name = $this->session->userdata('dashboard');
		$query = $this->kpi->get_kpi_join_score($kpi, $month, $kpi_name);
		echo json_encode($query);
	}
}