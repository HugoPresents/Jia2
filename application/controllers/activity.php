<?php
	class Activity extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Corporation_model');
			$this->load->model('Activity_model');
		}
		
		function index() {
			static_view('活动集中地');
		}
		
		function view($activity_id = '') {
			if($activity_id) {
				$join = array(
					'user' => array('user_id', 'id')
				);
				$activity_info = $this->Activity_model->get_info($activity_id, $join);
				if($activity_info) {
				    $join = array(
                        'school' => array('school_id', 'id'),
                        'user' => array('user_id', 'id'),
                        'school.province' => array('province_id', 'id')
                    );
                    $corporation_info = $this->Corporation_model->get_info(array('id' => $activity_info['corporation_id']), $join);
                    $data['corporation'] = $corporation_info;
                    $data['followers_ids'] = $this->Corporation_model->get_followers($corporation_info['id'], array('add_time' => 'DESC'));
                    if($data['followers_ids']) {
                        $data['followers'] = $this->db
                                             ->where_in('id', $data['followers_ids'])
                                             ->get('user')
                                             ->result_array();
                    }
                    $data['members_ids'] = $this->Corporation_model->get_members($corporation_info['id'], array('add_time' => 'DESC'));
                    if($data['members_ids']) {
                        $data['members'] = $this->db
                                           ->where_in('id', $data['members_ids'])
                                           ->get('user')
                                           ->result_array();
                    }
					$data['info'] = $activity_info;
					$data['title'] = '查看活动-' . $activity_info['name'];
					$data['main_content'] = 'activity/details_view';
					$data['css'] = array();
					$data['js'] = array('corporation/profile_view.js', 'post.js');
					$this->load->view('includes/template_view', $data);
				} else {
					static_view('你要查看的活动不存在');
				}
			} else {
				static_view('你要查看的活动不存在');
			}
		}
		
		function add($corporation_id = '') {
			$this->_require_login();
			if($corporation_id) {
				$corporation_info = $this->Corporation_model->get_info($corporation_id);
				if($corporation_info) {
					$this->_auth('add', 'activity', $corporation_id);
					$data['title'] = '创建活动';
					$data['main_content'] = 'activity/add_view';
					$data['css'] = array('corporation/jquery-ui-1.7.custom.css');
					$data['js'] = array('corporation/jquery-ui-1.7.custom.min.js');
					$data['corporation'] = $corporation_info;
					$this->load->view('includes/template_view', $data);
				} else {
					static_view('社团不存在');
				}
			} else {
				static_view('社团不存在');
			}
		}
		
		function do_add($corporation_id = '') {
			$this->_require_login();
			if($corporation_id) {
				$corporation_info = $this->Corporation_model->get_info($corporation_id);
				if($corporation_info) {
					$this->_auth('add', 'activity', $corporation_id);
					// 开始创建活动
					$name = $this->input->post('name');
					$address = $this->input->post('address');
					$start_time = $this->input->post('start_time');
					$deadline = $this->input->post('deadline');
					$comment = $this->input->post('detail');
					if($name && $address && $start_time && $deadline && $comment) {
						$activity = array(
							'user_id' => $this->session->userdata('id'),
							'corporation_id' => $corporation_info['id'],
							'name' => $name,
							'time' => time(),
							'start_time' => strtotime($start_time),
							'deadline' => strtotime($deadline),
							'address' => $address,
							'detail' => $comment
						);
						$activity_id = $this->Activity_model->insert($activity);
						if($activity_id) {
							static_view('创建活动成功！' . anchor('activity/view/' . $activity_id, '查看该活动') . '或者' . anchor('activity/add', '继续创建'), '创建活动成功');
						} else {
							static_view('创建活动失败，请联系管理员～', '创建活动失败');
						}
					} else {
						static_view('请输入完整信息', '创建活动失败');
					}
				} else {
					static_view('社团不存在');
				}
			} else {
				static_view('社团不存在', '创建活动失败');
			}
		}
		
		function edit($activity_id = '') {
			$this->_require_login();
			if($activity_id) {
				$this->jiadb->_table = 'activity';
				$join = array('corporation' => array('corporation_id', 'id'));
				$activity_info = $this->Activity_model->get_info($activity_id, $join);
				if($activity_id) {
					$corporation_id = $activity_info['corporation'][0]['id'];
					$this->_auth('edit', 'activity', $corporation_id);
					static_view('亲，你有权限编辑这个活动哦！', '编辑活动');
				} else {
					static_view('你要编辑的活动不存在', '编辑活动');
				}
				
			} else {
				static_view('你要编辑的活动不存在', '编辑活动');
			}
		}
		
		function do_edit() {
			$this->_require_login();
		}
		
		function delete() {
			$this->_require_login();
		}
		
	}
