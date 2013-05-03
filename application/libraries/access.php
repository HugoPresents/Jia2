<?php
/**
 * 权限设置类，三种类型的权限，包括对权限的初始化等功能
 */
	class Access_factory {
		static function get_access($type) {
			switch ($type) {
				case 'post':
					return new Post_access('post_auth');
					break;
				case 'activity':
					return new Activity_access('activity_auth');
					break;
				case 'corporation':
					return new Corporation_access('corporation_auth');
					break;
				case 'comment':
					return new Comment_access('comment_auth');
					break;
			}
		} 
	}
	class Access {
		public $jiadb;
		public $table;
		public $CI;
		public $identity_array;
		public $operation_array;
		function __construct() {
			$this->jiadb = new Jiadb($this->table);
			$this->CI =& get_instance();
			$identity_result = $this->CI->db->get('identity')->result_array();
			$operation_result = $this->CI->db->get('operation')->result_array();
			foreach ($identity_result as $row) {
				$this->identity_array[$row['name']] = $row['id'];
			}
			foreach ($operation_result as $row) {
				$this->operation_array[$row['name']] = $row['id'];
			}
		}
		// 初始化权限
		/**
		 * @param int user_id or corporation_id
		 * @param string personal or activity
		 * @param array such as 
		 * array(
		 * 	'identity' => 'operation'
		 * ) 
		 * @param array such as
		 * array(
		 * 'type_id' => 'value'
		 * )
		 */
		function init($id, $array, $extend = array()) {
			foreach ($array as $identity => $auth_array) {
				$identity_id = $this->identity_array[$identity];
				foreach ($auth_array as $operation) {
					$operation_id = $this->operation_array[$operation];
					$row = array(
						'owner_id' => $id,
						'identity_id' =>$identity_id,
						'operation_id' => $operation_id
					);
					if($extend) {
						$row = array_merge($row, $extend);
					}
					$rows = $this->CI->db->get_where($this->table, $row)->num_rows;
					if($rows == 0) {
						$this->CI->db->insert($this->table, $row);
					} else if($rows > 1) {
						$this->CI->db->delete($this->table, $row, $row-1);
					}
					
				}
			}
		}
		/**
		 * 
		 * @param int user_id or corporation_id
		 * @param array like
		 * array(
		 *   array('identity' => 'register', 'opetarion' => 'add', 'access' => 0),
			 array('identity' => 'follower', 'opetarion' => 'add', 'access' => 1)
		 * )
		 */
		function set_access($id, array $access, $extend = array()) {
			foreach ($access as $row) {
				$where_array = array(
					'owner_id' => $id,
					'identity_id' => $this->identity_array[$row['identity']],
					'operation_id' => $this->operation_array[$row['operation']]
				);
				if($extend) {
					$where_array = array_merge($where_array, $extend);
				}
				$rows = $this->CI->db->get_where($this->table, $where_array)->num_rows;
				if($rows == 1) {
					$this->CI->db->where($where_array)->update($this->table, array('access' => $row['access']));
				} else if($rows > 1) {
					$this->CI->db->where($where_array)->delete($this->table);
					$this->CI->db->insert($this->table, array_merge($where_array, array('access' => $row['access'])));
				} else {
					$this->CI->db->insert($this->table, array_merge($where_array, array('access' => $row['access'])));
				}
				
			}
		}
	}
	
	class Post_access extends Access {
		function __construct() {
			$this->table = 'post_auth';
			parent::__construct();
		}
		
		function init($user_id) {
			$init_array = array(
				'guest' => array('view'),
				'register' => array('view'),
				'follower' => array('view'),
				'self' => array('view', 'add', 'delete')
			);
			
			parent::init($user_id, $init_array);
		}
	}
	
	class Comment_access extends  Access {
		function __construct() {
			$this->table = 'comment_auth';
			parent::__construct();
		}
		
		/**
		 * @param int user_id or corporation_id
		 * @param string personal or activity
		 */
		function init($owner_id, $type) {
			$array = array(
				'guest' => array('view'),
				'register' => array('view', 'add'),
				'self' => array('view', 'add', 'delete')
			);
			if($type == 'activity') {
				$array['co_member'] = array('view', 'add');
				$array['co_admin'] = array('view', 'add', 'delete');
				$array['participant'] = array('view', 'add');
			} elseif($type == 'personal') {
				$array['follower'] = array('view', 'add');
				$array['po_master'] = array('view', 'add', 'delete');
			} else {
				return FALSE;
			}
			$this->jiadb->_table = 'entity_type';
			$post_type_result = $this->jiadb->fetchAll(array('name' => $type));
			$type_id = $post_type_result[0]['id'];
			$extend = array('type_id' => $type_id);
			parent::init($owner_id, $array, $extend);
		}
		
		function set_access($id, $access = array(), $post_type) {
			$this->jiadb->_table = 'entity_type';
			$result = $this->jiadb->fetchAll(array('name' => $post_type));
			$extend = array(
				'type_id' => $result[0]['id']
			);
			parent::set_access($id, $access, $extend);
		}
	}
	
	class Activity_access extends  Access {
		function __construct() {
			$this->table = 'activity_auth';
			parent::__construct();
		}
		
		function init($corporation_id) {
			$init_array = array(
				'guest' => array('view'),
				'register' => array('view'),
				'participant' => array('view'),
				'co_member' => array('view'),
				'co_admin' => array('view', 'add', 'edit', 'delete'),
				'co_master' => array('view', 'add','edit', 'delete')
			);
			parent::init($corporation_id, $init_array);
		}
	}
	
	class Corporation_access extends Access {
		function __construct() {
			$this->table = 'corporation_auth';
			parent::__construct();
		}
		
		// 社团权限初始化
		function init($corporation_id) {
			$init_array = array(
				'guest' => array('view'),
				'register' => array('view'),
				'co_member' => array('view'),
				'co_admin' => array('view'),
				'co_master' => array('view', 'edit')
			);
			parent::init($corporation_id, $init_array);
		}
	}