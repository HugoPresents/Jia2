<?php
	class Corporation extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Corporation_model');
			$this->load->model('User_model');
			$this->jiadb = new Jiadb();
		}
		// 社团之家
		function index() {
			$data['title'] = '社团之家';
			$data['main_content'] = 'corporation/index_view';
			$where = array();
			$limit = '';
			$this->jiadb->_table = 'corporation';
			$data['j_num'] = 0;
			$data['f_num'] = 0;
            $join = array(
                'user' => array('user_id', 'id'),
                'school' => array('school_id', 'id')
            );
			if($this->session->userdata('id')) {
				$following_cos = $this->User_model->get_following_co($this->session->userdata('id'));
				$join_cos = $this->User_model->get_join_co($this->session->userdata('id'));
				//$data['j_num'] = count($join_cos);
				//$data['f_num'] = count($following_cos);
                $data['m_corporations'] = $this->User_model->get_master_co($this->session->userdata('id'));
				if(count($following_cos) > 0) {
					$data['f_corporations'] = $this->jiadb->fetchJoin(array('id' => $following_cos), $join);
				}
				if(count($join_cos) > 0) {
					$data['j_corporations'] = $this->jiadb->fetchJoin(array('id' => $join_cos), $join);
				}
                $user_info = $this->User_model->get_info($this->session->userdata('id'), array('school' => array('school_id', 'id')));
                if(!$user_info['school_id']) {
                    $data['message'] = '你需要先完善自己的学校信息' . anchor('personal/setting#info', '点此设置');
                } else {
                    $this->jiadb->_table = 'corporation';
                    $data['school_corporations'] = $this->jiadb->fetchJoin(array('school_id' => $user_info['school'][0]['id']), $join);
                }
			} else {
			    redirect('/');
			}
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出全站社团
		function list_all($id = '', $page = '') {
			$this->jiadb->_table = 'corporation';
			if(!empty($id) && is_numeric($id)) {
				$corporation = $this->Corporation_model->get_info($id);
				if($corporation) {
					$data['corporations'][0] = $corporation;
				} else {
					static_view();
				}
			} elseif(empty($id)) {
				if(is_numeric($page)) {
					$limit = array($this->config->item('page_size'), $this->config->item('page_size') * ($page-1));
				} else {
					$limit = array($this->config->item('page_size'), );
				}
				$limit = array($this->config->item('page_size'), 0);
				$data['title'] = '所有社团';
				$data['corporations'] = $this->jiadb->fetchAll('', '', $limit);
				$data['main_content'] = 'corporation/list_view';
				$this->load->view('includes/template_view', $data);
			} else {
				static_view();
			}
		}
        
		// 列出全校社团
		function list_by_school() {
			$this->_require_login();
			$limit = array($this->config->item('page_size'), 0);
			$user_info = $this->User_model->get_info($this->session->userdata('id'), array('school' => array('school_id', 'id')));
			if(!$user_info['school_id'])
				static_view('你需要先完善自己的学校信息' . anchor('personal/setting#info', '点此设置'), '申请创建社团');
			$data['title'] = $user_info['school'][0]['name'] . '的社团';
			$this->jiadb->_table = 'corporation';
			$data['corporations'] = $this->jiadb->fetchAll(array('school_id' => $user_info['school'][0]['id']), '', $limit);
			$data['main_content'] = 'corporation/list_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function list_by_tag() {
			$this->_require_ajax();
			$tag = $this->input->post('tag');
			$limit = array($this->config->item('page_size'), 0);
			$this->jiadb->_table = 'corporation';
			$join = array(
				'school' => array('school_id', 'id')
			);
			$result = $this->db->query('SELECT corporation_id FROM corporation_meta WHERE meta_key="tag" AND meta_value="'.$tag.'"');
			$result = $result->result_array();
			$corporation_ids = array();
			foreach($result as $tag) {
				$corporation_ids[] = $tag['corporation_id'];
			}
			$where = array('id' => $corporation_ids);
			$corporations = $this->jiadb->fetchJoin($where, $join);
			$data['corporations'] = $corporations;
			$this->load->view('corporation/ajax_list_view', $data);
		}
		
		function list_by_meta() {
			$this->_require_ajax();
			$meta = $this->input->post('meta');
			$corporation_ids = array();
			$join = array(
				'user' => array('user_id', 'id')
			);
			switch ($meta) {
				case 'master':
					$this->jiadb->_table = 'corporation';
					$where = array('user_id');
					$this->jiadb->fetchJoin();
					break;
				case 'member':
					
					break;
				default:
					
					break;
			}
		}
		
		function profile($corporation_id = '') {
			if($corporation_id) {
				$join = array(
					'school' => array('school_id', 'id'),
					'user' => array('user_id', 'id'),
					'school.province' => array('province_id', 'id')
				);
				$corporation_info = $this->Corporation_model->get_info(array('id' => $corporation_id), $join);
				if($corporation_info) {
					$this->load->model('Post_model');
					$data['info'] = $corporation_info;
					$data['main_content'] = 'corporation/profile_view';
					$data['title'] = $data['info']['name'];
					$data['js'] = array('corporation/profile_view.js', 'post.js');
					$data['css'] = 'corporation/jquery-ui-1.7.custom.css';
                    $data['followers_ids'] = $this->Corporation_model->get_followers($corporation_id, array('add_time' => 'DESC'));
                    if($data['followers_ids']) {
                        $data['followers'] = $this->db
                                             ->where_in('id', $data['followers_ids'])
                                             ->get('user')
                                             ->result_array();
                    }
                    $data['members_ids'] = $this->Corporation_model->get_members($corporation_id, array('add_time' => 'DESC'));
                    if($data['members_ids']) {
                        $data['members'] = $this->db
                                           ->where_in('id', $data['members_ids'])
                                           ->get('user')
                                           ->result_array();
                    }
					$data['posts']['activity'] = $this->Post_model->fetch(array('owner_id' => $corporation_id, 'type_id' => $this->config->item('entity_type_activity')), 'activity');
					$activities = $this->Corporation_model->get_activities($corporation_id);
					$data['activities'] =  $activities ? $activities : array();
					$this->load->view('includes/template_view', $data);
				} else {
					static_view();
				}
			} else {
				static_view();
			}
		}
		
		function add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			$this->jiadb->_table = 'school';
			$schools = array();
			$school_result = $this->jiadb->fetchAll();
			foreach ($school_result as $key => $row) {
				$schools[$row['id']] = $row['name'];
			}
			$data['schools'] = $schools;
			$data['title'] = '添加社团';
			$data['main_content'] = 'corporation/add_view';
			$this->load->view('includes/template_view', $data);
		}
		/**
		 * @param $request_id 申请id
		 */
		function add_from_request($request_id) {
			$this->_require_login();
			if(!is_numeric($request_id))
				static_view();
			$this->jiadb->_table = 'corporation_request';
			$join = array(
				'user' => array('user_id', 'id'),
				'user.school' => array('school_id', 'id')
			);
			$request = $this->jiadb->fetchJoin(array('id' => $request_id, 'status' => 1), $join);
			// 该请求存在，以及被通过了
			if($request) {
				$request = $request[0];
				if($request['user'][0]['id'] != $this->session->userdata('id'))
					static_view('抱歉, 你没有该权限', '权限不足');
				$co_name = $request['co_name'];
				$submit = $this->input->post('submit');
				if($submit) {
					$comment = $this->input->post('comment');
					$name = $request['co_name'];
					$school_id = $request['user'][0]['school'][0]['id'];
					$corporation = array(
						'name' => $name,
						'school_id' => $school_id,
						'user_id' => $request['user'][0]['id'],
						'comment' => $comment
					);
					if($corporation_id = $this->Corporation_model->insert($corporation)) {
						// 删除该条请求
						$this->db->where('id', $request_id);
						$this->db->delete('corporation_request');
						static_view('创建社团成功' . anchor('corporation/profile/' . $corporation_id, '社团主页'), '创建社团成功');
					} else {
						static_view('貌似没有创建成功~， 要不然' . anchor(current_url(), '再试一次？'), '创建社团失败');
					}
				} else {
					$data['co_name'] = $request['co_name'];
					$data['master'] = $request['user'][0]['name'];
					$data['school'] = $request['user'][0]['school'][0]['name'];
					$data['title'] = '创建社团';
					$data['request_id'] = $request['id'];
					$data['main_content'] = 'corporation/add_from_request_view';
					$this->load->view('includes/template_view', $data);
				}
			} else {
				static_view();
			}
		}
		
		function do_add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			$name = $this->input->post('name');
			$school_id = $this->input->post('school');
			$user_id = $this->input->post('master');
			$comment = $this->input->post('comment');
			if($name && $comment && $school_id && $user_id) {
				$corporation = array(
					'name' => $name,
					'school_id' => $school_id,
					'user_id' => $user_id,
					'comment' => $comment
				);
				if($corporation_id = $this->Corporation_model->insert($corporation)) {
					redirect('corporation/profile/' . $corporation_id);
				} else {
					static_view('貌似没有创建成功~， 要不然' . anchor('corporation/add', '再试一次？'), '创建社团失败');
				}
			} else {
				static_view('请将表单填写完整', '创建社团失败', site_url('corporation/add'));
			}
		}
		
		// 请求创建社团
		function request_add() {
			$this->_require_login();
			$this->jiadb->_table = 'corporation_request';
			$requests = $this->jiadb->fetchAll(array('user_id' => $this->session->userdata('id')));
			$user_info = $this->User_model->get_info($this->session->userdata('id'));
			if(!$user_info['school_id'])
			 static_view('你需要先完善自己的学校信息' . anchor('personal/setting#info', '点此设置'), '申请创建社团');
			if(!$user_info['province_id'])
				static_view('你需要完善自己的省份信息' . anchor('personal/setting#info', '点此设置'), '申请创建社团');
			if($requests)
				static_view('你已经申请过创建社团了，请勿重复申请');
			// 当get参数为上传图片时
			$submit = $this->input->post('submit');
			if(!empty($submit)) {
				$this->load->model('Photo_model');
				// 判断证件照
				//$caps = $this->Photo_model->save_request_cap();
				$id_card_cap = $this->input->post('st_card_cap');
				$st_card_cap = $this->input->post('id_card_cap');
				$caps = array(
					'st_card_cap' . '_' .$this->session->userdata('id') . '.jpg',
					'id_card_cap' . '_' .$this->session->userdata('id') . '.jpg'
				);
				foreach ($caps as $value) {
					//echo $this->config->item('corporation_request') . $value;exit;
					if(!file_exists($this->config->item('corporation_request') . $value)) {
						static_view('你需要先上传证件照');
					}
				}
				$id_card_number = $this->input->post('id_card_number');
				$st_card_number = $this->input->post('st_card_number');
				$co_name = $this->input->post('co_name');
				$comment = $this->input->post('comment');
				$request = array(
					'user_id' => $this->session->userdata('id'),
					'id_card_number' => $id_card_number,
					'st_card_number' => $st_card_number,
					'id_card_cap' => $caps[1],
					'st_card_cap' => $caps[0],
					'comment' => $comment,
					'co_name' => $co_name,
					'time' => time()
				);
				$this->db->insert('corporation_request', $request);
				$request_id = $this->db->insert_id();
				// 增加一条提醒
				$this->load->model('Notify_model');
				$notify = array(
					'user_id' => $this->session->userdata('id'),
					'receiver_id' => 1,
					'time' => time(),
					'content' => '申请创建社团 ' . anchor('admin/admin/co_request/' . $request_id, '审核'),
					'type' => 'message'
				);
				$this->Notify_model->insert($notify);
				jump_view('提交申请成功，页面将跳转到' . anchor('corporation', '社团之家'), site_url('corporation'), '提交申请成功');
			} else {
				$data['title'] = '申请创建社团';
				$data['js'] = array('jquery.validate.min.js', 'corporation/add.js');
				$data['main_content'] = 'corporation/request_add_view';
				$this->load->view('includes/template_view', $data);
			}
		}

		function upload_cap() {
			if(isset($_POST["PHPSESSID"])) {
				session_id($_POST["PHPSESSID"]);
				$this->session->set_userdata('id', $this->input->post('user'));
				$this->session->set_userdata('file_name', $this->input->post('field') . '_' .$this->input->post('user'));
				$this->load->model('Photo_model');
				$this->Photo_model->save_request_cap();
			} else {
				 header("Content-type: image/jpeg") ;
				 readfile($this->config->item('corporation_request') . $this->session->userdata('filename'));
			}
		}
		
		function setting($id = '') {
			$this->_require_login();
			if($id == '' || !is_numeric($id)) {
				static_view('抱歉，您访问的页面不存在');
			} else {
				$join = array(
					'school' => array('school_id', 'id'),
					'user' => array('user_id', 'id')
				);
				$corporation_info = $this->Corporation_model->get_info($id, $join);
				if($corporation_info) {
					$this->_auth('edit', 'corporation', $id);
					$this->jiadb->_table = 'user';
					$members = $this->Corporation_model->get_members($id);
					if($members) {
						$data['members'] = $this->jiadb->fetchJoin(array('id' => $members));
						$data['members_num'] = count($members);
					} else {
						$data['members_num'] = 0;
					}
					$admins = $this->Corporation_model->get_admin($id);
					if($admins) {
						$data['admins'] = $this->jiadb->fetchJoin(array('id' => $admins));
						$data['admins_num'] = count($admins);
					} else {
						$data['admins_num'] = 0;
					}
                    $this->jiadb->_table = 'corporation';
                    $data['tags'] = $this->jiadb->fetchMeta('meta_value', array('corporation_id'=>$corporation_info['id'], 'meta_key' => 'tag'));
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						$setting = $this->input->post('setting');
						switch ($setting) {
							case 'avatar':
								$this->load->model('Photo_model');
								$result = $this->Photo_model->set_avatar('corporation', $corporation_info['id']);
								if($result) {
									$this->Corporation_model->update(array('id' => $corporation_info['id']), array('avatar' => $result));
									redirect('corporation/setting/' . $corporation_info['id'].'?target=?avatar');
								} else {
									static_view('不好意思亲~ 上传失败了, 要不然' . anchor('personal/setting', '再试一次?'));
								}
								break;
							case 'info':
							    $this->Corporation_model->update(array('id' => $corporation_info['id']), array('comment' => trim($this->input->post('comment'))));
								$tags = $this->input->post('tags');
                                foreach($tags as $tag) {
                                   $meta_array = array(
                                        'corporation_id' => $corporation_info['id'],
                                        'meta_key' => 'tag',
                                        'meta_value' => $tag
                                   );
                                   print_vars($meta_array);
                                   $meta_exists = $this->db->where($meta_array)->get('corporation_meta')->result_array();
                                   if(!$meta_exists) {
                                       $meta_array['add_time'] = time();
                                       $this->db->insert('corporation_meta', $meta_array);
                                   }
                                }
								redirect('corporation/setting/' . $corporation_info['id'].'?target=info');
								break;
							case 'member':
								
								break;
							default:
								static_view('页面未找到');
								break;
						}
					} else {
						$data['title'] = '社团设置';
						$data['js'] = 'corporation/setting.js';
						$data['info'] = $corporation_info;
						$data['main_content'] = 'corporation/setting_view';
						$this->load->view('includes/template_view', $data);
					}
				} else {
					static_view('社团不存在');
				}
			}
		}
		/*
		function management($corporation_id) {
			$this->_require_login();
			$corporation = $this->Corporation_model->get_info($corporation_id);
			if($corporation) {
				$this->_auth('edit', 'corporation', $corporation_id);
				$type = $this->input->get('type');
				switch ($type) {
					case 'member':
						static_view('改功能暂未实现', '成员管理');
						break;
					case 'admin':
						static_view('改功能暂未实现' ,'管理员管理');
						break;
					case 'blocker':
						static_view('改功能暂未实现' ,'黑名单管理');
						break;
					case 'follower':
						static_view('改功能暂未实现' ,'粉丝管理');
						break;
					default:
						static_view();
						break;
				}
			} else {
				static_view();
			}
		}
		*/
		function follow() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('id');
			$user_id = $this->session->userdata('id');
			if($this->Corporation_model->follow($user_id, $corporation_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		function unfollow() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('id');
			$user_id = $this->session->userdata('id');
			if($this->Corporation_model->follow($user_id, $corporation_id, TRUE)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 请求加入社团
		function request_join() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('co_id');
			$corporation = $this->Corporation_model->get_info($corporation_id);
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			if($corporation) {
				$blockers = $this->Corporation_model->get_blockers($corporation_id);
				if($blockers && in_array($this->session->userdata('id'), $blockers)) {
					$json_array['message'] = '对不起，由于该社团的隐私设置你不能加入该社团';
				} else {
					$this->load->model('Notify_model');
					$request = array(
						'user_id' => $this->session->userdata('id'),
						'content' => '请求加入 '. anchor('corporation/profile/' . $corporation_id, $corporation['name']) .' 社团' . '|||' . site_url('corporation/add_member/' . $corporation_id . '/' . $this->session->userdata('id')),
						'receiver_id' => $corporation['user_id'],
						'type' => 'request',
						'time' => time()
					);
					$this->Notify_model->insert($request);
					$json_array['success'] = 1;
					$json_array['message'] = '发送请求成功！';
				}
			} else {
				$json_array['message'] = '该社团不存在！';
			}
			echo json_encode($json_array);
		}

		// 退出社团
		function leave() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('co_id');
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			$corporation = $this->Corporation_model->get_info($corporation_id);
			if(!$corporation) {
				$json_array['message'] = '社团不存在';
			} else {
				$this->db->delete('corporation_meta', array(
						'corporation_id' => $corporation_id,  
						'meta_table' => 'user',
						'meta_key' => 'member',
						'meta_value' => $this->session->userdata('id')
					));
				$json_array['success'] = 1;
			}
			echo json_encode($json_array);
		}

		
		function add_member($corporation_id, $user_id) {
			$this->_require_login();
			$request_id = $this->input->get('request_id');
			if(empty($request_id))
				static_view('');
			if(is_numeric($corporation_id) && is_numeric($user_id)) {
			    $this->load->model('Notify_model');
				$request = $this->Notify_model->get_info($request_id);
				if($request['type_id'] != $this->config->item('entity_type_request') || $request['user_id'] != $user_id)
					static_view();
				$this->_auth('edit', 'corporation', $corporation_id);
				$corporation = $this->Corporation_model->get_info($corporation_id);
				if(!$corporation)
					static_view();
				$this->_auth('edit', 'corporation', $corporation_id);
				$code = $this->Corporation_model->join_member($corporation_id, $user_id);
				if($code == 1) {
					static_view('添加会员失败，该用户在社团黑名单内 ' . anchor('corporation/setting/' . $corporation_id . '?target=blocker', '管理社团黑名单'));
				} elseif($code == 2) {
					$this->db->where('id', $request_id);
					$this->db->delete('notify');
					static_view('该会员已是社团成员 ' . anchor('corporation/setting/' . $corporation_id . '?target=member', '管理社团成员'));
				} elseif($code == 3) {
					$this->Notify_model->delete($request_id);
					$this->db->where('id', $request_id);
					$this->db->delete('notify');
					static_view('添加会员成功！你可以' . anchor('personal/notify?target=request', '查看请求') . '或者' . anchor('corporation/setting/' . $corporation_id . '?type=member', '管理社团成员'));
				}
			} else {
				static_view();
			}
		}
		
		function delete_member() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('co_id');
			$corporation_info = $this->Corporation_model->get_info($corporation_id);
			if($corporation_info) {
				$this->_auth('edit', 'corporation', $corporation_id);
				$member_id = $this->input->post('member_id');
				if($this->Corporation_model->join_member($corporation_id, $member_id, TRUE)) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 0;
			}
		}
	}