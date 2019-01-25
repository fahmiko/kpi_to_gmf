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
		$this->kpi->delete('tb_kpi_rating','kpi_name',$kpi);
		redirect('welcome');
	}

	public function create(){
		$this->load->view('create_kpi');
	}

	public function create_structure(){
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
					'weight'   => ($this->input->post($kpi_weight)/100)
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
					$this->kpi->set_data('tb_kpi_rating',$insert, null);
				}	
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
}
