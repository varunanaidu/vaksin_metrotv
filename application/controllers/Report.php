<?php
//
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('reportmodel');
	}

	public function index()
	{
		if ( !$this->hasLogin() ) {
			redirect('welcome/login');
		}

		$data['log_user'] = $this->session->userdata('hr-apps')->log_user;
		$this->load->view('report_page', $data);
	}

	public function view_report()
	{
		$fDate = $this->input->post('fDate');
		$fPlace = $this->input->post('fPlace');
		// echo json_encode($this->input->post());die;

		$a = 1;
		$place = '';
		$data = array();
		$res = $this->reportmodel->get_applicant($fDate, $fPlace);
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			switch ($row->user_id) {
				case '1':
				$place = 'Kedoya';
				break;
				case '2':
				$place = 'Kedoya';
				break;
				case '3':
				$place = 'Kedoya';
				break;
				case '4':
				$place = 'ABN Nasdem';
				break;
				case '5':
				$place = 'ABN Nasdem';
				break;
				case '6':
				$place = 'ABN Nasdem';
				break;
				case '7':
				$place = 'Reported by Admin';
				break;
			}
			$col = array();
			$col[] = $row->tr_id;
			$col[] = $row->emp_nip;
			$col[] = $row->emp_name;
			$col[] = $row->emp_dir;
			$col[] = $row->emp_div;
			$col[] = $row->emp_dept;
			$col[] = $row->emp_post;
			$col[] = $place;
			$col[] = date('d F Y H:i:s', strtotime($row->created_date));
			if ( $this->session->userdata('hr-apps')->log_id == 7 ) {
				$col[] = '<button type="buton" class="btn btn-sm btn-danger btn-delete" data-id="'.$row->tr_id.'"><i class="fas fa-trash"></i></button>';
			}else{
				$col[] = '';
			}
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->reportmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->reportmodel->get_applicant_count_filtered($fDate, $fPlace),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

	public function delete(){
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->sitemodel->view("vw_tr_plus", "*", ['tr_id'=>$key]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$this->sitemodel->delete("tr_exchange_plus", ["tr_id"=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully remove data.";
		echo json_encode($this->response);
		exit;
	}
}
