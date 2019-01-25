<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kpi');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if($this->input->post('month')){
			$data['month'] = $this->input->post('month');
			$data['ikpi'] = $this->kpi->get_ikpi($this->input->post('month'),$this->input->post('kpi'));
			$data['ikpi_all'] = $this->kpi->get_ikpi_all($this->input->post('month'),$this->input->post('kpi'));
			$data['score_kpi'] = $this->kpi->get_score_kpi_name($this->input->post('month'),$this->input->post('kpi'));
		}else{
			$data['ikpi'] = array();
			$data['ikpi_all'] = array();
		}
		$data['kpi_name'] = $this->kpi->get_table('tb_kpi_name');

		$this->load->view('kpi/score',$data);
		// echo intval(date('m'));
	}

	public function insert(){
		$kpi = $this->input->post('kpi');
		$kpi_name = $this->input->post('kpi_name');
		$month = $this->input->post('month');
		$skor = $this->input->post('skor');
		$this->kpi->insert_score($kpi, $kpi_name, $month, $skor);
		$data['parent'] = $this->kpi->get_score_parent($kpi_name, $month);
		foreach ($data['parent'] as $row) {
			$this->kpi->insert_score($row->kpi_parent, $kpi_name, $month, $row->total);
		}
		redirect('Dashboard');
		
	}

	function json_kpi($id){
		$this->db->where('kpi_id',$id);
		$data = $this->db->get('tb_kpi');
		echo json_encode($data->row_array());
	}

}

/* End of file Kpi.php */
/* Location: ./application/controllers/Kpi.php */