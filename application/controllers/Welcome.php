<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kpi');
		if(empty($this->session->userdata('login'))){

		}
	}

	public function index()
	{
		$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');
		if($this->input->post('kpi_name')!=null){
			$data['kpi'] = $this->kpi->get_kpi($this->input->post('kpi_name'));
			$data['kpi_index'] = $this->input->post('kpi_name');
		}else{
			$data['kpi_index'] = "NO DATA";
		}
		// $this->load->view('templates/header');
		$this->load->view('dashboard', $data);
		// $this->load->view('templates/footer');
	}

	public function show(){
		$data['kpi_name'] = $this->input->post('kpi_name');	
		$data['kpi'] = $this->db->where('level',2)->where('kpi_name',$data['kpi_name'])->get('tb_kpi')->result_array();
		$data['row'] = $this->db->where('level',2)->where('kpi_name',$data['kpi_name'])->get('tb_kpi')->num_rows();
		$data['kpi2'] = $this->db->where('level',3)->where('kpi_name',$data['kpi_name'])->get('tb_kpi')->result_array();
		$data['row2'] = $this->db->where('level',3)->where('kpi_name',$data['kpi_name'])->get('tb_kpi')->num_rows();
		$this->load->view('show_structure', $data, FALSE);
	}

	public function delete(){
		$kpi = $this->input->post('kpi_name');
		$this->kpi->delete('tb_kpi_structure','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi','kpi_name',$kpi);
		$this->kpi->delete('tb_kpi_name','kpi_name',$kpi);
		redirect('welcome');
	}

	public function create(){
		$this->load->view('create_kpi');
	}

	public function create_structure(){
		/*
		if($this->input->post('structure')!=null){
			$data['get_level'] = $this->session->userdata('structure_level');
			$data['structure'] = array(
				'kpi_name' => $this->input->post('kpi_name'),
				'level2' => array(),
				'level3' => array(),
				'level4' => array()
			);
			// Input array level 2
			for($i = 0;$i < $data['get_level']['level']['level2'];$i++){
				$data['structure']['level2'] += array(
					$i => array(
						'name' => $this->input->post("kpi_lv2_$i"),
						'weight' => ($this->input->post("weight_lv2_$i")/100)
					)
				);
			}
			//Input array level 3
			for($i = 0;$i < $data['get_level']['level']['level3'];$i++){
				$data['structure']['level3'] += array(
					$i => array(
						'name' => $this->input->post("kpi_lv3_$i"),
						'weight' => ($this->input->post("weight_lv3_$i")/100)
					)
				);
			}
			//Input array Level 4
			for($i = 0;$i < $data['get_level']['level']['level4'];$i++){
				$data['structure']['level4'] += array(
					$i => array(
						'name' => $this->input->post("kpi_lv4_$i"),
						'weight' => ($this->input->post("weight_lv4_$i")/100)
					)
				);
			}
			$data['select']['level2'] = array();
			$data['select']['level3'] = array();

			for($i = 0; $i < $data['get_level']['level']['level2'];$i++){
				$data['select']['level2'][$i] = "<option value='".$data['structure']['level2'][$i]['name']."'>".$data['structure']['level2'][$i]['name']."</option>";
			}

			for($i = 0; $i < $data['get_level']['level']['level3'];$i++){
				$data['select']['level3'][$i] = "<option value='".$data['structure']['level3'][$i]['name']."'>".$data['structure']['level3'][$i]['name']."</option>";
			}

			$this->session->set_userdata('structure',$data['structure']);
			$this->load->view('m_structure', $data);
		}else{*/
			$data = array(
				'kpi_name' => $this->input->post('kpi_name'),
				'level2' => $this->input->post('level2'),
				'level3' => $this->input->post('level3'),
				'level4' => $this->input->post('level4')
			);
			$this->session->set_userdata('structure',$data);
			$this->load->view('c_structure', $data);
	}

	public function test(){
		$structure = $this->session->userdata('structure');
		// echo "insert kpi_name = ".$level['level']['kpi_name'];
		// Insert to table tb_kpi_name
		$insert = array(
			'kpi_name' => $structure['kpi_name'],
			'created_by' => 'G1010'
		);
		$this->kpi->set_data('tb_kpi_name',$insert, null);

		for($j = 2;$j <= 4; $j++){
			$lv = "level".$j;
			for($i = 0;$i < $structure[$lv];$i++){
				$kpi_lv = "kpi_lv".$j."_".$i;
				$kpi_weight = "weight_lv".$j."_".$i;
				$insert = array(
					'kpi'      => $this->input->post($kpi_lv),
					'kpi_name' => $structure['kpi_name'],
					'level'    => $j,
					'weight'   => $this->input->post($kpi_weight)
				);
				$this->kpi->set_data('tb_kpi',$insert, null);
			}	
		}

		for($j = 3;$j <= 4; $j++){
			$lv = "level".$j;
			for($i = 0;$i < $structure[$lv];$i++){
				$kpi_lv = "kpi_lv".$j."_".$i;
				$kpi_parent = "parent_lv".$j."_".$i;
				$insert = array(
					'kpi_name'	 => $structure['kpi_name'],
					'kpi'        => $this->input->post($kpi_lv),
					'kpi_parent' => $this->input->post("parent_lv3_$i")
				);
				$this->kpi->set_data('tb_kpi_structure',$insert, null);	
			}	
		}
		
		redirect('welcome','refresh');
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('login');
			$this->load->view('templates/footer');
		} else {
			$data['kpi'] = $this->kpi->get_login($this->input->post('username'),$this->input->post('password'));
			$this->session->set_userdata($data['kpi']['login']);
			redirect('welcome/index','refresh');
		}
	}

	public function dashboard(){
		$this->load->view('templates/header');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}
}
