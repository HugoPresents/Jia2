<?php
	class Search extends MY_Controller {
		public $jiadb;
		public $limit;
		private $join;
		function __construct() {
			parent::__construct();
			$this->limit = $this->config->item('page_size');
			$this->join = array(
				'school' => array('school_id', 'id'),
				'province' => array('province_id', 'id')
			);
			$this->jiadb = new Jiadb;
		}
		
		function index() {
			$data['main_content'] = 'search_view';
			$data['title'] = '搜索';
			$data['css'] = array("main_content.css");
			$data['js'] = array('search.js','tab.js');
			if($this->input->post('keywords')) {
				if($this->input->post('user')) {
					$data['user_result'] = $this->_user();
					$data['user_rows'] = $data['user_result']['rows'];
					unset($data['user_result']['rows']);
				}
				if($this->input->post('corporation')) {
					$data['corporation_result'] = $this->_corporation();
					$data['corporation_rows'] = $data['corporation_result']['rows'];
					unset($data['corporation_result']['rows']);
				}
				if($this->input->post('activity')) {
					$data['activity_result'] = $this->_activity();
					$data['activity_rows'] = $data['activity_result']['rows'];
					unset($data['activity_result']['rows']);
				}
			}
			$this->load->view('includes/template_view', $data);
		}
		
		function do_search() {
			$this->_require_ajax();
			$object = $this->input->post('object');
			$keywords = trim($this->input->post('keywords'));
			$limit = 10;
			$offset = $this->input->post('offsect') ? $this->input->post('offsect') : 0;
			switch ($object) {
				case 'user':
					$json_array['user_result'] = $this->_user();
					break;
				case 'corporation':
					// 搜索社团
					$json_array['corporation_result'] = $this->_corporation();
					break;
				case 'activity':
					// 搜索社团
					$json_array['activity_result'] = $this->_activity();
					break;
				default:
					// 三个都搜索
					$json_array['user_result'] = $this->_user();
					$json_array['corporation_result'] = $this->_corporation();
					$json_array['activity_result'] = $this->_activity();
			}
		}

		//搜索用户
		function _user() {
			$keywords = trim($this->input->post('keywords'));
			$offset = $this->input->post('offset');
			$this->jiadb->_table = 'user';
			$where = array('name REGEXP' => $keywords);
			$user_result = $this->jiadb->fetchJoin($where, $this->join, '', array($this->limit, $offset));
			if($user_result) {
				$user_result['rows'] = count_rows('user', $where);
			} else {
				$user_result['rows'] = 0;
			}
			return $user_result;
		}
		
		// 搜索社团
		function _corporation() {
			$keywords = trim($this->input->post('keywords'));
			$offset = $this->input->post('offset');
			$this->jiadb->_table = 'corporation';
			$where = array('name REGEXP' => $keywords);
			$corporation_result = $this->jiadb->fetchAll($where, '', array($this->limit, $offset));
			if($corporation_result) {
				$corporation_result['rows'] = count_rows('corporation', $where);
			} else {
				$corporation_result['rows'] = 0;
			}
			return $corporation_result;
		}
		
		// 搜索活动
		function _activity() {
			$keywords = trim($this->input->post('keywords'));
			$offset = $this->input->post('offset');
			$this->jiadb->_table = 'activity';
			$where = array('name REGEXP' => $keywords);
			$join = array(
				'corporation' => array('corporation_id', 'id')
			);
			$activity_result = $this->jiadb->fetchJoin($where, $join, '', array($this->limit, $offset));
			if($activity_result) {
				$activity_result['rows'] = count_rows('activity', $where);
			} else {
				$activity_result['rows'] = 0;
			}
			return $activity_result;
		}
		
		/**
		 * @param $extend string "following" "follower" "blocker" "all"
		 */
		// 返回json格式的数据，用于表单自动完成
		function user_search() {
			$this->_require_ajax();
			$this->_require_login();
			$extend = $this->input->post('extend');
			$this->jiadb->_table = 'user';
			$user_info = array();
			switch ($extent) {
				case 'following':
					$following = $this->User_model->get_following($this->sesssion->userdata('id'));
					$user_info = $this->jiadb->fetchAll(array('id' => $following));
					break;
				case 'follower':
					$follower = $this->User_model->get_following($this->sesssion->userdata('id'));
					$user_info = $this->jiadb->fetchAll(array('id' => $follower));
					break;
				case 'blocker':
					$blocker = $this->User_model->get_following($this->sesssion->userdata('id'));
					$user_info = $this->jiadb->fetchAll(array('id' => $blocker));
					break;
				default :
					$following = $this->User_model->get_following($this->sesssion->userdata('id'));
					$follower = $this->User_model->get_following($this->sesssion->userdata('id'));
					$blocker = $this->User_model->get_following($this->sesssion->userdata('id'));
					$user = array_merge($following, $follower, $blocker);
					$user = array_unique($user);
					$user_info = $this->jiadb->fetchAll(array('id' => $user));
					break;
			}
			$data['users'] = $user_info;
			$this->load->view('search_user_view', $data);
		}
		
		// ajax自动完成表单
		function ajax_aucomplate() {
			$this->_require_ajax();
			// 从哪里获取用户
			$limit = $this->config->item('page_size');
			$obj = $this->input->post('obj');
			$json_array = array(
				0 => array(
					'label' => '没找到',
					'value' => 0
				)
			);
			$key = $this->input->post('key');
			if(trim($key) == '') {
				exit();
			}
			switch ($obj) {
				// 搜索用户
				case 'user':
					$from = $this->input->post('from');
					
					switch ($from) {
						// 从所有用户中搜索
						case 'all':
							$this->db->like('name', $key, 'after');
							$result = $this->db->get('user')->result_array();
							if(count($result) > 0) {
								$json_array = array();
								foreach ($result as $key => $value) {
									$json_array[$key]['label'] = $value['name'];
									$json_array[$key]['value'] = $value['id'];
								}
							}
							break;
						// 从好友以及关注中搜索
						default:
							
							break;
					}
					//var_dump($json_array);exit;
					echo jia_json($json_array);
					break;
				
				default:
					
					break;
			}
			$from = $this->input->post('from');
			switch($from) {
				case 'all':
					//do something here
				break;
			default:
				
			}
		}
		
		/**
		 * @param $relation 'following' 'follower' 'all'
		 */
		function user_relation() {
			$this->_require_ajax();
			$this->_require_login();
			$relation = $this->input->post('relation');
			$page = (int)$this->input->post('page');
			if($page < 1)
				$page = 1;
			$limit = 10;
			$this->load->model('User_model');
			$this->load->library('pagination');
			$offset = ($page-1) * $limit;
			$json_array = array(
				'content' => NULL,
				'pagination' => NULL,
				'success' => 0
			);
			$pg_config = array(
				'base_url' => '#',
				'per_page' => $limit,
				'uri_segment' => 4,
				'use_page_numbers' => TRUE
			);
			switch ($relation) {
				case 'following':
					$following = $this->User_model->get_following($this->session->userdata('id'));
					$following_num = count($following);
					$pg_config['total_rows'] = $following_num;
					$following = array_slice($following, $offset, $limit);
					foreach ($following as $user_id) {
						$user = $this->User_model->get_info($user_id);
						$json_array['content'] .= 
						'<li class="group" user_id="'.$user['id'].'">
							<a href="/personal/profile/'.$user['id'].'">
								<img src="'.avatar_url($user['avatar']).'" alt="'.$user['name'].'" />
								<span>'.$user['name'].'</span>
							</a>
						</li>';
					}
					$json_array['success'] = 1;
					break;
				
				case 'follower':
					$followers = $this->User_model->get_followers($this->session->userdata('id'));
					$followers_num = count($followers);
					$pg_config['total_rows'] = $followers_num;
					$followers = array_slice($followers, $offset, $limit);
					foreach ($followers as $user_id) {
						$user = $this->User_model->get_info($user_id);
						$json_array['content'] .= 
						'<li class="group" user_id="'.$user['id'].'">
							<a href="/personal/profile/'.$user['id'].'">
								<img src="'.avatar_url($user['avatar']).'" alt="'.$user['name'].'" />
								<span>'.$user['name'].'</span>
							</a>
						</li>';
					}
					$json_array['success'] = 1;
					break;
			}
			$this->pagination->initialize($pg_config);
			$this->pagination->cur_page = (int)$page;
			$json_array['pagination'] = $this->pagination->create_links(TRUE);
			echo json_encode($json_array);
		}
		
		function _extra_data($array) {
			$length = $count($array);
			foreach ($array as $key => $value) {
				if($key == 0)
					echo '[';
					
				if($key == $length - 1)
					echo ']';
			}
		}
	}
