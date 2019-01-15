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
		$data['kpi'] = $this->kpi->get_kpi();
		// $this->load->view('templates/header');
		$this->load->view('dashboard', $data);
		// $this->load->view('templates/footer');
	}

	public function show(){
		$data['kpi'] = $this->db->where('level',2)->get('tb_kpi')->result_array();
		$data['row'] = $this->db->where('level',2)->get('tb_kpi')->num_rows();
		$data['kpi2'] = $this->db->where('level',3)->get('tb_kpi')->result_array();
		$data['row2'] = $this->db->where('level',3)->get('tb_kpi')->num_rows();
		$this->load->view('show_structure', $data, FALSE);
	}

	public function create(){
		$this->load->view('create_kpi');
	}

	public function create_structure(){
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
						'weight' => $this->input->post("weight_lv2_$i")
					)
				);
			}
			//Input array level 3
			for($i = 0;$i < $data['get_level']['level']['level3'];$i++){
				$data['structure']['level3'] += array(
					$i => array(
						'name' => $this->input->post("kpi_lv3_$i"),
						'weight' => $this->input->post("weight_lv3_$i")
					)
				);
			}
			//Input array Level 4
			for($i = 0;$i < $data['get_level']['level']['level4'];$i++){
				$data['structure']['level4'] += array(
					$i => array(
						'name' => $this->input->post("kpi_lv4_$i"),
						'weight' => $this->input->post("weight_lv4_$i")
					)
				);
			}
			$data['select']['level2'] = array();
			$data['select']['level3'] = array();

			for($i = 0; $i < $data['get_level']['level']['level2'];$i++){
				$data['select']['level2'][$i] = "<option>".$data['structure']['level2'][$i]['name']."</option>";
			}

			for($i = 0; $i < $data['get_level']['level']['level3'];$i++){
				$data['select']['level3'][$i] = "<option>".$data['structure']['level3'][$i]['name']."</option>";
			}

			$this->session->set_userdata('structure',$data['structure']);
			$this->load->view('m_structure', $data);
		}else{
			$data['level'] = array(
				'kpi_name' => $this->input->post('kpi_name'),
				'level2' => $this->input->post('level2'),
				'level3' => $this->input->post('level3'),
				'level4' => $this->input->post('level4')
			);
			$this->session->set_userdata('structure_level',$data);
			$this->load->view('c_structure', $data);
		}
	}

	public function test(){
		$this->load->view('m_structure');
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
