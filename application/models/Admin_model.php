<?php  

	/**
	* 
	*/
	class Admin_model extends CI_Model
	{
		private $product_tbl = 'product';
		private $guestbook_tbl = 'guestbook';

		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function insert_product($productContent)
		{
			$this->db->insert($this->product_tbl, $productContent);
		} //end of function insert_product

		public function get_sample()
		{
			$this->db->select('productid, productname, productimage, singer, productprice');
			$query = $this->db->get('product');

			return $query->result_array();
		}
		public function get_by_id($productid = '') 
 		{
			$this->db->from($this->product_tbl);
	        $this->db->where('productid',$productid);
	        $query = $this->db->get();
 
        	return $query->result_array();
 		}
 		public function update_product($where, $data)
 		{
 			$this->db->update($this->product_tbl, $data, $where);
 			return $this->db->affected_rows();
 		}
		public function delete($which='',$theID='')
		{
			if ($which == 'delete_product') {
				$this->db->delete($this->product_tbl, array('productid' => $theID));
				return;
			}
			if ($which == 'delete_message') {
				$this->db->delete($this->guestbook_tbl, array('id' => $theID));
				return;
			}
		}
		public function get_message()
		{
			$query = $this->db->get($this->guestbook_tbl);

			return $query->result_array();
		}
		public function update_replyMessage($where,$replyData)
		{
			/*
			var_dump($where);
			array (size=1)
  				'id' => string '9' (length=1)
			var_dump($replyData);
			array (size=1)
  				'admin_reply' => string 'ooooppp' (length=7)
			*/
			$this->db->update($this->guestbook_tbl, $replyData, $where);
			return;
		}
	} //end of class
