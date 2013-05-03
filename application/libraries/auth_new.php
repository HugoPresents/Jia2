<?php
require_once APPPATH . 'libraries/jiadb.php';
	abstract class Auth_new_factory {
		static function create_auth($mode) {
			switch ($mode) {
				// 个人权限
				case 'personal':
					
					break;
				// 社团权限
				case 'corporation':
					
					break;
				// 日志权限
				case 'blog':
					
					break;
				// 活动权限
				case 'activity':
					
					break;
				// 新鲜事权限
				case 'post':
					
					break;
				// 评论权限
				case 'comment':
					
					break;
			}
		}
	}
	
	
	abstract class Auth_new {
		/**
		 * @param $request 请求的用户
		 * @param $owner 被请求的用户
		 */
		public $request;
		public $access = 0;
		public $owner;
		public $CI;
		public $jiadb;
		public $table;
		public $identity_array;
		public $operation_array;
		function __construct($request = 0, $owner = 0) {
			$this->CI =& get_instance();
			$this->request = ($request ? $request : $this->CI->session->userdata('id'));
			$this->owner = $owner ? $owner : $this->request;
			$this->jiadb = new Jiadb();
			$identity_result = $this->CI->db->get('identity')->result_array();
			$operation_result = $this->CI->db->get('operation')->result_array();
			foreach ($identity_result as $row) {
				$this->identity_array[$row['name']] = $row['id'];
			}
			foreach ($operation_result as $row) {
				$this->operation_array[$row['name']] = $row['id'];
			}
			$this->CI->load->model('User_model');
		}
		
		/**
		 * @param $operation 请求的操作
		 * @param $identity 请求的身份
		 * @param $entity_type 个人用户或者社团（社团和个人用户的权限放在同一张表，由实体类型区分）
		 */
		function get_access($operation, $identity, $entity_type = 1){
			$where = array(
				'identity_id' => $this->identity_array[$identity],
				'operation_id' => $this->operation_array[$operation],
				'type_id' => $entity_type
			);
			$result = $this->jiadb->fetchAll($where);
			if($result) {
				$this->access = $result[0]['access'];
			} 
		}
	}

	class Personal_auth extends Auth_new {
		function __construct() {
			parent:__construct();
		}
	}
