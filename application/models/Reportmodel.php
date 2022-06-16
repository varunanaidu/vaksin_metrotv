<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Reportmodel extends CI_Model{

	/*** DATATABLE SERVER SIDE FOR HISTORY TABLE ***/
	function _get_applicant_query($fDate="", $fPlace=""){
		$__order 			= array('tr_id' => 'DESC');
		$__column_search 	= array('tr_id', 'emp_nip', 'emp_name', 'emp_dir', 'emp_div', 'emp_dept', 'emp_post', 'user_id', 'created_date');
		$__column_order     = array('tr_id', 'emp_nip', 'emp_name', 'emp_dir', 'emp_div', 'emp_dept', 'emp_post', 'user_id', 'created_date');

		$this->db->select('*');
        // $this->db->from('vw_tr');
        $this->db->from('vw_tr_plus');

        if ( empty($fDate) == FALSE ) {
            $this->db->like('created_date', $fDate);
        }

        if ( empty($fPlace) == FALSE ) {
            if ($fPlace == 'ABN Nasdem') {
                $this->db->where_in('user_id', [4,5,6]);
            }else{
                $this->db->where_in('user_id', [1,2,3]);
            }
        }

		$i = 0;
		$search_value = $this->input->post('search')['value'];
		foreach ($__column_search as $item){
			if ($search_value){
                if ($i === 0){ // looping awal
                	$this->db->group_start(); 
                	$this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                	$this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

        /* order by */
        if ($this->input->post('order') != null){
        	$this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
        	$order = $__order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_applicant($fDate="", $fPlace=""){
    	$this->_get_applicant_query($fDate, $fPlace);
    	if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_applicant_count_filtered($fDate="", $fPlace=""){
    	$this->_get_applicant_query($fDate, $fPlace);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_applicant_count_all(){
    	$this->_get_applicant_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }


}