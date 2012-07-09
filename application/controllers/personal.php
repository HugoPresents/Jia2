<?php
	class Personal extends MY_Controller {
		public $user_id;
		private $join;
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Post_model');
			$this->load->model('Photo_model');
			$this->load->model('Notify_model');
			$this->user_id = $this->session->userdata('id');
			$this->join = array(
				'school' => array('school_id', 'id'),
				'province' => array('province_id', 'id')
			);
		}
		
		function index() {
			redirect('personal/profile');
		}
		
		function profile($id = '') {
			if($id == '') {
				$this->_require_login();
			}
			$id = $id ? $id : $this->session->userdata('id');
			$this->_auth('view', 'post', $id);
			$data['info'] = $this->User_model->get_info((int)$id, $this->join);
			$followers = $this->User_model->get_followers($id);
			$following = $this->User_model->get_following($id);
			$data['followers'] = $followers;
			$data['followers_num'] = $followers ? count($followers) : 0;
			$data['following_num'] = $following ? count($following) : 0;
			$data['title'] = '个人主页-' . $data['info']['name'];
			$post_id = $this->input->get('post_id');
			if(!empty($post_id)) {
				$post = array('personal' => $this->Post_model->fetch(array('owner_id' => $id, 'id' => $post_id)));
				if($post['personal']) {
					$data['posts'] = $post;
				} else {
					static_view('抱歉该页面不存在');
				}
			} else {
				$data['posts'] = array('personal' => $this->Post_model->fetch(array('owner_id' => $id)));
			}
			$data['js'] = array('post.js', 'personal/profile_view.js', 'tab.js');
			$data['main_content'] = 'personal/profile_view';
			$data['slider_bar_view'] = 'includes/slider_bar_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function setting() {
			$this->_require_login();
			$post_auth = Auth_factory::get_auth('post', $this->session->userdata('id'));
			$comment_auth = Auth_factory::get_auth('comment', $this->session->userdata('id'));
			$identity_array = array(
				'guest', 'register', 'follower'
			);
			$privacy = array(
				'post' => '',
				'comment' => ''
			);
			for($i=0; $i<3; $i++) {
				$post_auth->get_access('view', $identity_array[$i]);
				if ($post_auth->access == 1) {
					$privacy['post'] = $identity_array[$i];
					break;
				}
			}
			for ($i=0; $i<3; $i++) {
				$comment_auth->get_access('add', $identity_array[$i]);
				if ($comment_auth->access == 1) {
					$privacy['comment'] = $identity_array[$i];
					break;
				}
			}
			$privacy['post'] = $privacy['post'] ? $privacy['post'] : 'self';
			$privacy['comment'] = $privacy['comment'] ? $privacy['comment'] : 'self';
			$data['info'] = $this->User_model->get_info((int)$this->session->userdata('id'));
			$data['title'] = '账户设置';
			$data['privacy'] = $privacy;
			$schools = array();
			$this->jiadb->_table = 'school';
			$school_result = $this->jiadb->fetchAll();
			foreach ($school_result as $key => $row) {
				$schools[$row['id']] = $row['name'];
			}
			$provinces = array();
			$this->jiadb->_table = 'province';
			$provinces_result = $this->jiadb->fetchAll();
			foreach ($provinces_result as $key => $row) {
				$provinces[$row['id']] = $row['name'];
			}
			$data['schools'] = $schools;
			$data['provinces'] = $provinces;
			$data['info'] = $this->User_model->get_info((int)$this->session->userdata('id'), $this->join);
			$data['main_content'] = 'personal/setting_view';
			$data['slider_bar_view'] = 'includes/slider_bar_view';
			$data['css'] = array('corporation/jquery-ui-1.7.custom.css');
			$data['js'] = array('personal/setting.js','tab.js', 'corporation/jquery-ui-1.7.custom.min.js');
			$this->load->view('includes/template_view', $data);
		}
		
		function do_setting() {
			$this->_require_login();
			$setting = $this->input->post('setting');
			switch ($setting) {
				case 'avatar':
					// 头像设置
					$result = $this->Photo_model->set_avatar('personal', $this->user_id);
					if($result) {
						$this->User_model->update(array('id' => $this->user_id), array('avatar' => $result));
						redirect('personal/setting');
					} else {
						static_view('不好意思亲~ 上传失败了, 要不然' . anchor('personal/setting', '再试一次?'));
					}
					break;
				case 'info':
				// 资料设置
					$name = $this->input->post('name');
					$gender = $this->input->post('gender');
					$birthday = $this->input->post('birthday');
					$description = $this->input->post('description');
					$school_id = $this->input->post('school');
					$province_id = $this->input->post('province');
					if($name && $gender && $school_id && $province_id) {
						$info = array(
							'name' => $name,
							'gender' => $gender,
							'school_id' => $school_id,
							'province_id' => $province_id,
							'birthday' => strtotime($birthday),
							'description' => $description
						);
						$this->db->where('id', $this->session->userdata('id'));
						$this->db->update('user', $info);
						redirect('personal/setting');
					}
				case 'privacy':
					// 隐私设置
					$post = $this->input->post('post');
					$comment = $this->input->post('comment');
					$post_access = Access_factory::get_access('post');
					$comment_access = Access_factory::get_access('comment');
					// post 权限设置
					$post_access_array = array();
					$comment_access_array = array();
					switch ($post) {
						case 'guest':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 1),
								array('identity' => 'register', 'operation' => 'view', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'register':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'follower':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'self':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 0)
							);
							break;
						default:
							static_view('表单数据不正确' . anchor('personal/setting#privacy', '重新设置'));
					}
					// 评论权限设置
					switch ($comment) {
						case 'register':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'follower':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'self':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 0)
							);
							break;
						default:
							static_view('亲, 请不要恶意篡改表单好嘛~, 给你个机会, ' . anchor('personal/setting#privacy', '重新设置'));
					}
					$post_access->set_access($this->user_id, $post_access_array);
					$comment_access->set_access($this->user_id, $comment_access_array, 'personal');
					break;
					
				case 'pass':
					// 密码设置
					$this->_require_ajax();
					$old_pass = $this->input->post('old_pass');
					$pass = $this->input->post('pass');
					$pass_check = $this->input->post('pass_check');
					$json_array = array(
						'verify' => 0,
						'old_pass' => '',
						'pass' => '',
						'pass_check' => ''
					);
					if(!$old_pass) {
						$json_array['old_pass'] = '请输入原密码';
						echo json_encode($json_array);
						return;
					}
					if(!$pass) {
						$json_array['pass'] = '请输入新密码';
						echo json_encode($json_array);
						return;
					}
					if($pass != $pass_check) {
						$json_array['pass_check'] = '密码不一致';
						echo json_encode($json_array);
						return;
					}
					$info = $this->User_model->get_info((int)$this->user_id);
					if($info['pass'] != md5($old_pass)) {
						$json_array['old_pass'] = '原密码不正确';
						echo json_encode($json_array);
						return;
					}
					$this->db->where('id', $this->user_id);
					$this->db->update('user', array('pass' => md5($pass)));
					$json_array['verify'] = 1;
					echo json_encode($json_array);
					return;
				break;
			}
			redirect('personal/setting');
		}
		
		// 关注某人
		function follow() {
			$this->_require_login();
			$this->_require_ajax();
			$following_id = $this->input->post('user_id');
			if($this->User_model->follow($this->user_id, $following_id)) {
				// 发条通知
				$notify = array(
					'user_id' => $this->user_id,
					'receiver_id' => $following_id,
					'content' => '关注了你',
					'time' => time(),
					'type' => 'message'
				);
				$this->Notify_model->insert($notify);
				echo 1;
			} else {
				echo 0;
			}
		}
		// 取消关注某人，ajax function
		function unfollow() {
			$this->_require_login();
			$this->_require_ajax();
			$following_id = $this->input->post('user_id');
			if($this->User_model->follow($this->user_id, $following_id, TRUE)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 请求关注
		function request_follow() {
			$this->_require_login();
			$this->_require_ajax();
			$follower_id = $this->input->post('user_id');
			// 发一条请求关注的通知
			$notify = array(
				
			);
		}
		// 移除粉丝
		function remove_follower() {
			$this->_require_login();
			$this->_require_ajax();
			$follower_id = $this->input->post('user_id');
			// 相当于粉丝取消关注当前用户
			if($this->User_model->follow($follower_id, $this->user_id, TRUE)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		// 屏蔽某人
		function block() {
			$this->_require_login();
			$this->_require_ajax();
			$blocker_id = $this->input->post('user_id');
			if($this->User_model->add_blocker($this->user_id, $blocker_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 个人管理（关注，被关注）
		function manage($opereation, $page = 1) {
			$this->_require_login();
			$user_id = $this->session->userdata('id');
			$limit = $this->config->item('page_size');
			$this->load->library('pagination');
			$offset = ($page-1) * $limit;
			$pg_config = array(
				'base_url' => site_url('personal/manage/' . $opereation),
				'per_page' => $limit,
				'uri_segment' => 4,
				'use_page_numbers' => TRUE
			);
			$data['js'] = 'personal/manage.js';
			switch ($opereation) {
				case 'follower':
					$this->jiadb->_table = 'user';
					$followers = $this->User_model->get_followers($user_id);
					$data['followers_num'] = count($followers);
					$pg_config['total_rows'] = $data['followers_num'];
					$this->pagination->initialize($pg_config);
					$data['pagination'] = $this->pagination->create_links();
					if($data['followers_num'] != 0) {
						$followers_now = array_slice($followers, $offset, $limit);
						$data['followers'] = $this->jiadb->fetchJoin(array('id' => $followers_now), $this->join);
					}
					$data['title'] = '粉丝管理';
					$data['main_content'] = 'personal/follower_view';
					$this->load->view('includes/template_view', $data);
					break;
				case 'following':
					$this->jiadb->_table = 'user';
					$following = $this->User_model->get_following($user_id);
					$data['following_num'] = count($following);
					$pg_config['total_rows'] = $data['following_num'];
					$this->pagination->initialize($pg_config);
					$data['pagination'] = $this->pagination->create_links();
					if($data['following_num'] != 0) {
						$following_now = array_slice($following, $offset, $limit);
						$data['following'] = $this->jiadb->fetchJoin(array('id' => $following_now), $this->join);
					}
					$data['title'] = '关注管理';
					$data['main_content'] = 'personal/following_view';
					$this->load->view('includes/template_view', $data);
					break;
				default:
					static_view('抱歉，你访问的页面不存在');
					break;
			}
		}
		
		// 驳回请求
		function reject_request() {
			$this->_require_login();
			$this->_require_ajax();
			$request_id = $this->input->post('request_id');
			$request = $this->Notify_model->get_info($request_id);
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			// 判断数据是否存在，是否是请求，接受者是否为当前用户
			if($request && $request['type_id'] == $this->config->item('entity_type_request') && $request['receiver_id'] == $this->session->userdata('id')) {
				$this->db->where('id', $request['id']);
				$this->db->delete('notify');
				$json_array['success'] = 1;
				$json_array['message'] = '成功';
			} else {
				$json_array['message'] = '失败';
			}
			echo json_encode($json_array);
		}
	}
