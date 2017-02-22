<?php 
	/**
	* 目前是上傳兩個檔案，若要新增至多個請修改 imageFileProcess()以及processInput()的檔案名稱索引
	*
	* http://www.codexworld.com/codeigniter-upload-multiple-files-images/可以應付更多檔案且程式碼更少也會顯示錯誤/成功，但是沒有更改名稱。
	*
	* base_url() = http://[::1]/CodeIgniter-productupload/
	* 圖片部分如果singer跟product的名稱一樣，是有可能發生讀取錯誤檔案的
	*/

	//howard 2/22 adding from git local
<<<<<<< HEAD
	//this is a6432.chang from git local, again
=======

	//this is from github~~
	//this is me checking the changes after the second push
	//the third time checking...
	//a test in the fourth time
>>>>>>> 905fffd93369d21f187eebf7541515e53aaa4323
	class ProductuploadC extends CI_Controller
	{

		private $timeString = '%Y%m%d';
		private $reply_timeString = '%Y-%m-%d %h:%i:%a';
		public $file_name;
		private $file_extension;

		function __construct()
		{
			parent::__construct();
			$this->load->library(array('form_validation', 'upload'));
			$this->load->helper(array('form', 'url')); 
			$this->load->helper('date');
			$this->load->model('Admin_model');
		} 

		public function index()
		{
			$data['pageTitle'] = 'home';
			$this->load->view('_header');
			$this->load->view('_navigation',$data);
			$this->load->view('_adminHome');
		}

		public function do_what($which='') //分配view頁面及傳檔案
		{
			if ($which == 'uploadNew') {
				$data['pageTitle'] = 'uploadBoard';
				$this->load->view('_header');
				$this->load->view('_navigation',$data);
				$this->load->view('_uploadBoard');
			}
			if ($which == 'seeSample') {
				$data['sample'] = $this->Admin_model->get_sample();
				$data['pageTitle'] = 'seeSample';
				$this->load->view('_header');
				$this->load->view('_navigation', $data);
				$this->load->view('_modifyBoard');
			}
			if ($which == 'guestBook') {
				$data['get_message'] = $this->Admin_model->get_message();
				$data['pageTitle'] = 'guestBook';

				$this->load->view('_header');
				$this->load->view('_navigation', $data);
				$this->load->view('_admin_guestbook');
			}
		}

		public function input_validation() //驗證是否每一輸入欄都有填寫
		{
			$this->form_validation->set_rules('singer','','required');
			$this->form_validation->set_rules('category','','required');
			$this->form_validation->set_rules('singersdoc','','required');
			//singerphoto不強制
			$this->form_validation->set_rules('productname','','required');
			$this->form_validation->set_rules('productprice','','required');
			//productimage不強制
			$this->form_validation->set_rules('description','','required');
			$this->form_validation->set_rules('fulldescription','','required');
			$this->form_validation->set_rules('releaseddate','','required');
			$this->form_validation->set_rules('labelcompany','','required');
			$this->form_validation->set_rules('songname','','required');
			$this->form_validation->set_rules('time','','required');
			$this->form_validation->set_rules('ranking','','required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p style="font-size: 8px; color: red; margin: 0">', '</p>');
				$this->do_what( $which = 'uploadNew');
			}
			if ($this->form_validation->run() == TRUE)
			{
				$this->processInput($action = 'insert');
			}
		} 

		private function processInput($action = '') //插入資料庫的檔案處理
		{
			$this->imageFileProcess();
			//插入資料庫前先取得要設定好的圖片名稱並完成上傳至資料夾
			$data = array 
			(
				'singer' => ucwords(strtolower($this->input->post('singer'))),
				'category' => $this->input->post('category'),
				'singersdoc' => $this->input->post('singersdoc'),
				'singerphoto' => $this->input->post('singerphoto'),
				'singerphoto' => $this->file_name[0]['singerphoto'],
				'productname' => ucwords(strtolower($this->input->post('productname'))),
				'productprice' => $this->input->post('productprice'),
				'productimage' => $this->input->post('productimage'),
				'productimage' => $this->file_name[1]['productimage'],
				'description' => $this->input->post('description'),
				'fulldescription' => $this->input->post('fulldescription'),
				'releaseddate' => $this->input->post('releaseddate'),
				'labelcompany' => $this->input->post('labelcompany'),
				'songname' => $this->input->post('songname'),
				'time' => $this->input->post('time'),
				'ranking' => $this->input->post('ranking')
			);
			if ($action == 'insert') {
				$this->Admin_model->insert_product($data); //前往model進行insert
				$this->load->view('uploadsuccess');
				//redirect('/ProductuploadC/do_what/uploadNew');
			}
		}
		
		private function get_filename_extension()
		{
			$arr = array($_FILES['singerphoto'],$_FILES['productimage']);
			for ($i=0; $i < count($arr); $i++) 
			{ 
				$fileNameArray = explode(".", $arr[$i]['name']);
				$hz[] = array_pop($fileNameArray);
			} 
			return $hz; //$hz擷取副檔名
		}

		private function imageFileProcess() //圖片檔案處理
		{
			$this->file_extension = $this->get_filename_extension();
			$singerName_productName = array($this->input->post('singer'),$this->input->post('productname')); // 歌手名/專輯名
			$uploadField = array('singerphoto', 'productimage'); //有多少個上傳地點

            $uploadPath = 'uploads/files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png';//upload的$config設定

   			foreach ($singerName_productName as $key => $value) {
            	$config['file_name'] = mdate($this->timeString).$value.".".$this->file_extension[$key];
            	//從原始檔名改成自訂檔案名稱格式：日期+歌手名/專輯名+副檔名
            	$this->file_name[] = array ($uploadField[$key] => $config['file_name']);
            	$this->upload->initialize($config);
            	$this->upload->do_upload($uploadField[$key]); //上傳確定
            }

            return $this->file_name; 
            //自訂檔案名稱傳給function processInput使用，以當作要插入資料庫的檔案名稱 
		} //end of function imageFileProcess

		public function ajax_update_adminReply()
		{
			$data = array
			(
				'admin_reply' => $this->input->post('reply_message'),
				'reply_time' => mdate($this->reply_timeString)
			);
			$this->Admin_model->update_replyMessage(array('id' => $this->input->post('id')), $data);
			echo json_encode(array('status' => TRUE));
		}
		public function ajax_delete_message($theID='')
		{
			$which = 'delete_message';
			$this->Admin_model->delete($which,$theID);
	    	echo json_encode(array("status" => TRUE));
		}
		public function ajax_editPage($id = '')
	    {
	    	$data = $this->Admin_model->get_by_id($productid = $id);
	        echo json_encode($data);
	    }

	    public function ajax_update_all()
	    {
	    	$this->ajax_validate(); //CI提供的form_validation只能在refresh page狀況下才能使用，因此不能接受動態的ajax檢驗！故導向另一個檢驗方法！
	    	$data = array (
				'singer' => ucwords(strtolower($this->input->post('singer'))),
				'category' => $this->input->post('category'),
				'singersdoc' => $this->input->post('singersdoc'),
				'singerphoto' => $this->input->post('singerphoto'),
				'productname' => ucwords(strtolower($this->input->post('productname'))),
				'productprice' => $this->input->post('productprice'),
				'productimage' => $this->input->post('productimage'),
				'description' => $this->input->post('description'),
				'fulldescription' => $this->input->post('fulldescription'),
				'releaseddate' => $this->input->post('releaseddate'),
				'labelcompany' => $this->input->post('labelcompany'),
				'songname' => $this->input->post('songname'),
				'time' => $this->input->post('time'),
				'ranking' => $this->input->post('ranking'),
			);
			$this->Admin_model->update_product(array('productid' => $this->input->post('productid')), $data);
			echo json_encode(array("status" => TRUE));
	    }

	    public function ajax_update_singerphoto()
		{
			$arr = array($_FILES['singerphoto']);
			$nameSeperate = explode(".", $arr[0]['name']);
			$nameExtension = array_pop($nameSeperate);
			//以下為upload的自訂設定
			$uploadPath = 'uploads/files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';//upload的$config設定	
            $config['file_name'] = mdate($this->timeString).$this->input->post('singer').".".$nameExtension;
           	$this->upload->initialize($config);
            $this->upload->do_upload('singerphoto'); //上傳確定
            //回傳更新後的圖片名稱
            $this->file_name[] = array ('singerphoto' => $config['file_name']);
            $datareturn = $this->file_name;
			echo json_encode($datareturn,JSON_FORCE_OBJECT);
		}
		public function ajax_update_productimage()
		{	
			$arr = array($_FILES['productimage']);
			$nameSeperate = explode(".", $arr[0]['name']);
			$nameExtension = array_pop($nameSeperate);
			//以下upload的自訂設定
			$uploadPath = 'uploads/files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';//upload的$config設定	
            $config['file_name'] = mdate($this->timeString).$this->input->post('productname').".".$nameExtension;
           	$this->upload->initialize($config);
            $this->upload->do_upload('productimage'); //上傳確定
            //回傳更新後的圖片名稱
            $this->file_name[] = array ('productimage' => $config['file_name']);
            $datareturn = $this->file_name;
			echo json_encode($datareturn,JSON_FORCE_OBJECT);
		}

	    public function ajax_delete_product($theID)
	    {
	    	$which = 'delete_product';
	    	$this->Admin_model->delete($which,$theID);
	    	echo json_encode(array("status" => TRUE));
	    }

		private function ajax_validate()
	    {	
	        $data['status'] = TRUE;
	 		//category未放,因為不可能為空
	        if($this->input->post('singer') == '' || $this->input->post('singersdoc') == '' || $this->input->post('singerphoto') == '' || $this->input->post('productname') == '' || $this->input->post('productprice') == '' || $this->input->post('productimage') == '' || $this->input->post('description') == '' || $this->input->post('fulldescription') == '' || $this->input->post('releaseddate') == '' || $this->input->post('labelcompany') == '' || $this->input->post('songname') == '' || $this->input->post('time') == '' || $this->input->post('ranking') == '')
	        {
	            $data['status'] = FALSE;
	        }

	        if($data['status'] === FALSE)
	        {
	            echo json_encode($data);
	            exit();
	        }
	    }

	} //end of class




