<?php
//
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	protected $response = [];

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ( !$this->hasLogin() ) {
			redirect('welcome/login');
		}

		$data['log_user'] = $this->session->userdata('hr-apps')->log_user;
		$data['emp'] = $this->sitemodel->view('tab_emp', '*');

		$this->load->view('welcome_message', $data);
	}

	public function login()
	{
		if ( $this->hasLogin() ) { redirect(); }
		$this->load->view('login_page');
	}

	public function signin()
	{
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$user_name = trim($this->input->post('user_name'));
		$user_pass = md5($this->input->post('user_pass'));

		if ( empty($user_name) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid username";echo json_encode($this->response);exit;}
		if ( empty($user_pass) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid password";echo json_encode($this->response);exit;}

		$res = $this->sitemodel->view('tab_user', '*', ['user_name'=>$user_name]);

		if ($res) {
			$pwd = '';
			$data_sess = array();

			foreach ($res as $row) {
				$data_sess['log_id'] = $row->user_id;
				$data_sess['log_user'] = $row->user_name;
				$pwd = $row->user_pass;
			}

			if ($user_pass !== $pwd) {
				$this->response['type'] = "Failed";
				$this->response['msg'] = "Wrong Password";
				echo json_encode($this->response);
				exit;
			}

			$this->session->set_userdata(SESS, (object)$data_sess);
			
			$this->response['type'] = 'done';
			$this->response['msg'] = "Successfully login.";
			echo json_encode($this->response);

		}else{
			$this->response['type'] = "Failed";
			$this->response['msg'] = "No Data Found";
			echo json_encode($this->response);
			exit;
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function find_data()
	{
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Required Area ***/
		$emp_id  = 0;
		$emp_name = '';
		$emp_nip = $this->input->post('emp_nip');
		$user_id = $this->input->post('user_id');
		/*** Validate Area ***/
		if ( empty($emp_nip) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid nip";echo json_encode($this->response);exit;}

		$q1 = $this->sitemodel->view('tab_emp', '*', ['emp_nip'=>$emp_nip]);
		if ( empty($q1) ) {
			$this->response['type'] = "Failed";
			$this->response['msg'] = "Data tidak ditemukan";
			echo json_encode($this->response);
			exit;
		}
		
		// $check = $this->sitemodel->view('vw_tr', '*', ['emp_nip'=>$emp_nip]);
		$check = $this->sitemodel->view('vw_tr_plus', '*', ['emp_nip'=>$emp_nip]);
		if ( $check ) {
			foreach ($check as $row) {
				$this->response['type'] = "Failed";
				$this->response['msg'] = $row->emp_name . " telah melakukan vaksinasi pada " . date('d F Y H:i:s', strtotime($row->created_date));
				echo json_encode($this->response);
				exit;
			}
		}

		$get_emp = $this->sitemodel->view('tab_emp', 'emp_id, emp_name', ['emp_nip'=>$emp_nip]);
		if ($get_emp) {
			foreach ($get_emp as $emp) {
				$emp_id = $emp->emp_id;
				$emp_name = $emp->emp_name;
			}
		}

		$data_tr = [
			'emp_id' 		=> $emp_id,
			'user_id'		=> $user_id,
			'created_date' 	=> date('Y-m-d H:i:s')
		];
		// $result_tr = $this->sitemodel->insert('tr_exchange', $data_tr);
		$result_tr = $this->sitemodel->insert('tr_exchange_plus', $data_tr);

		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $emp_nip . ' - ' . $emp_name . '<br> Terima Kasih' ;
		$this->response['data'] = $this->sitemodel->view('vw_tr', '*', ['emp_nip'=>$emp_nip]);;
		echo json_encode($this->response);
		exit;
	}

	public function find_data2()
	{
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Required Area ***/
		$emp_name = '';
		$emp_nip = '';
		$emp_id = $this->input->post('emp_id');
		$user_id = $this->input->post('user_id');
		/*** Validate Area ***/
		if ( empty($emp_id) ) {$this->response['type'] = "Failed";$this->response['msg'] = "Please input a valid name";echo json_encode($this->response);exit;}

		$q1 = $this->sitemodel->view('tab_emp', '*', ['emp_id'=>$emp_id]);
		if ( empty($q1) ) {
			$this->response['type'] = "Failed";
			$this->response['msg'] = "Data tidak ditemukan";
			echo json_encode($this->response);
			exit;
		}
		
		
		// $check = $this->sitemodel->view('vw_tr', '*', ['emp_id'=>$emp_id]);
		$check = $this->sitemodel->view('vw_tr_plus', '*', ['emp_id'=>$emp_id]);
		if ( $check ) {
			foreach ($check as $row) {
				$this->response['type'] = "Failed";
				$this->response['msg'] = $row->emp_name . " telah melakukan vaksinasi pada " . date('d F Y H:i:s', strtotime($row->created_date));
				echo json_encode($this->response);
				exit;
			}
		}

		$get_emp = $this->sitemodel->view('tab_emp', 'emp_nip, emp_name', ['emp_id'=>$emp_id]);
		if ($get_emp) {
			foreach ($get_emp as $emp) {
				$emp_nip = $emp->emp_nip;
				$emp_name = $emp->emp_name;
			}
		}

		$data_tr = [
			'emp_id' 		=> $emp_id,
			'user_id'		=> $user_id,
			'created_date' 	=> date('Y-m-d H:i:s')
		];
		// $result_tr = $this->sitemodel->insert('tr_exchange', $data_tr);
		$result_tr = $this->sitemodel->insert('tr_exchange_plus', $data_tr);

		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $emp_nip . ' - ' . $emp_name . '<br> Terima Kasih' ;
		$this->response['data'] = $this->sitemodel->view('tab_emp', '*', ['emp_id'=>$emp_id]);;
		echo json_encode($this->response);
		exit;
	}

	public function view_history()
	{
		$a = 1;
		$data = array();
		$res = $this->sitemodel->get_applicant();
		$temp = $this->db->last_query();
		$place = '';
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
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->sitemodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->sitemodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}
}
