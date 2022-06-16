<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Frozenmodel extends CI_Model{
/*
		$table = String
		$join = Array
		$select = String
		$where = Array
		$order_by = String
*/
		function view($table, $select, $where=false, $join=false, $order_by=false, $limit=false, $start=false, $ex_select = true, $group_by=false){
			$this->db->select($select, $ex_select);
			$this->db->from($table);
			if ( $where )
				$this->db->where($where);
			
			if ( $order_by )
				$this->db->order_by($order_by);
			
			if ( $join ){
				foreach($join as $key => $value){
					$exp = explode(',', $value);
					$this->db->join($key, $exp[0], $exp[1]);
				}
			}
			
			if ( $limit ){
				if ( $start != 0) {
					$this->db->limit($limit, $start);
				}else{	
					$this->db->limit($limit);
				}
			}
			
			if ( $group_by )
				$this->db->group_by($group_by);
			
			$q = $this->db->get();
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function custom_query($sql, $where=false){
			if ( $where )
				$q = $this->db->query($sql, $where);
			else
				$q = $this->db->query($sql);
			
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function insert($table, $data){
			$this->db->insert($table, $data);
			$ret = $this->db->insert_id();
			return $ret;
		}
		
		function insertid($table, $data){
			$this->db->insert($table, $data);
			$id = $this->db->insert_id();
			return $id;
		}
		
		function update($table, $data, $where){
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->update($table, $data);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}
		
		function delete($table, $where){
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->delete($table);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}

		/*** DATATABLE SERVER SIDE FOR HISTORY TABLE ***/
		function _get_applicant_query(){
			$__order 			= array('tr_id' => 'DESC');
			$__column_search 	= array('tr_id', 'emp_nip', 'emp_name', 'emp_dir', 'emp_div', 'emp_dept', 'emp_post', 'user_id', 'created_date');
			$__column_order     = array('tr_id', 'emp_nip', 'emp_name', 'emp_dir', 'emp_div', 'emp_dept', 'emp_post', 'user_id', 'created_date');


			$this->db->select('*');
			// $this->db->from('vw_tr');
			$this->db->from('vw_tr');

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

    function get_applicant(){
    	$this->_get_applicant_query();
    	if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_applicant_count_filtered(){
    	$this->_get_applicant_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_applicant_count_all(){
    	$this->_get_applicant_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }


}