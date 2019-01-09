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
		$this->load->view('templates/header');
		$this->load->view('main', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		$this->form_validation->set_rules('kpi_name', 'Nama KPI', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('create_kpi');
			$this->load->view('templates/footer');
		} else {
			# code...
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('login');
		} else {
			$data['kpi'] = $this->kpi->get_login($this->input->post('username'),$this->input->post('password'));
			$this->session->set_userdata($data['kpi']['login']);
			redirect('welcome/index','refresh');
		}
	}
}
