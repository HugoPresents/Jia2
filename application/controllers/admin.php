<?php
	class Admin extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			if($this->session->userdata('type') != 'admin') {
				static_view('抱歉，你没有该权限', '权限不足');
			}
			$this->load->model('User_model');
			$jiadb = new Jiadb();
		}
		
		function co_request($request_id = '') {
			if(is_numeric($request_id)) {
				// 处理请求
				$this->jiadb->_table = 'corporation_request';
				$join = array(
					'user' => array('user_id', 'id'),
					'user.school' => array('school_id', 'id')
				);
				$request =  $this->jiadb->fetchJoin(array('id' => $request_id, 'status' => 0), $join);
				if($request) {
					$pass = $this->input->get('pass');
					$co_name = $request[0]['co_name'];
					if($pass == 'yes') {
						$this->db->where('id', $request_id);
						$this->db->update('corporation_request', array('status' => 1));
						$notify = array(
							'user_id' => 1,
							'content' => "你申请创建 $co_name 社团成功," . anchor('corporation/add_from_request/' . $request_id, '点此完成创建'),
							'receiver_id' => $request[0]['user_id'],
							'type' => 'message',
							'time' => time()
						);
						$this->Notify_model->insert($notify);
						redirect('admin/admin/co_request');
					} elseif($pass == 'no') {
						$this->db->where('id', $request_id);
						$this->db->delete('corporation_request');
						$notify = array(
							'user_id' => 1,
							'content' => "你申请创建 $co_name 社团失败,",
							'receiver_id' => $request[0]['user_id'],
							'type' => 'message',
							'time' => time()
						);
						$this->Notify_model->insert($notify);
						redirect('admin/co_request');
					} else {
						$data['title'] = '管理请求';
						$data['requests'] = $request;
						$data['js'] = 'admin/co_request.js';
						$data['main_content'] = 'admin/co_request_view';
						$this->load->view('includes/template_view', $data);
					}
				} else {
					static_view('申请不存在');
				}
			} else {
				$this->jiadb->_table = 'corporation_request';
				$join = array(
					'user' => array('user_id', 'id'),
					'user.school' => array('school_id', 'id')
				);
				$requests = $this->jiadb->fetchJoin(array('status' => '0'), $join);
				$data['title'] = '管理请求';
				$data['requests'] = $requests;
				$data['js'] = 'admin/co_request.js';
				$data['main_content'] = 'admin/co_request_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		function list_all_user($page = 1) {
			$this->load->library('pagination');
			$limit = $this->config->item('page_size');
			$this->jiadb->_table = 'user';
			$data['user_count'] = count_rows('user');
			$pg_config = array(
				'base_url' => site_url('admin/list_all_user'),
				'total_rows' => $data['user_count'],
				'per_page' => $limit,
				'uri_segment' => 3,
				'use_page_numbers' => TRUE
			);
			$this->pagination->initialize($pg_config);
			$offset = ($page-1) * $limit;
			$join = array(
				'school' => array('school_id', 'id'),
				'province' => array('province_id', 'id')
			);
			$data['pagination'] = $this->pagination->create_links();
			$data['users'] = $this->jiadb->fetchJoin('', $join, array('regist_time' => 'DESC'), array($limit, $offset));
			$data['title'] = '所有用户';
			$data['main_content'] = 'admin/user_list_view';
			$this->load->view('includes/template_view', $data);
		}
	}