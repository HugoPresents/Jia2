<?php
	class Index extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Post_model');
		}
		
		function index() {
            if($this->session->userdata('type') == 'guest') {
                $this->_guest();
            } else {
                $data['title'] = '首页';
                $data['posts'] = $this->Post_model->post_string($this->session->userdata('id'));
                $join = array(
                    'school' => array('school_id', 'id'),
                    'province' => array('province_id', 'id')
                );
                $data['info'] = $this->User_model->get_info($this->session->userdata('id'), $join);
                $followers = $this->User_model->get_followers($this->session->userdata('id'));
                $following = $this->User_model->get_following($this->session->userdata('id'));
                $data['followers_num'] = $followers ? count($followers) : 0;
                $data['following_num'] = $following ? count($following) : 0;
                $data['js'] = array('post.js');
                $data['main_content'] = 'index_view';
                $this->load->view('includes/template_view', $data);
            }
        }
		
		function ajax_trends() {
			$this->_require_ajax();
			$type = $this->input->post('type');
			$page = $this->input->post('page');
			$posts = $this->Post_model->post_string($this->session->userdata('id'), $type, $page);
			if(empty($posts)) {
				echo 0;exit;
			}
			switch ($type) {
				case 'personal':
					$this->load->view('post/user_posts_view', array(
						'posts' => array(
							'personal' => $posts
						)
					));
					break;
				case 'activity':
					$this->load->view('post/co_posts_view', array(
						'posts' => array(
							'activity' => $posts
						)
					));
					break;
				default:
					echo 0;
					break;
			}
		}
		
		function _guest() {
			$data['title'] = '游客页面';
			$data['css'] = array('home.css','guest.css');
			//$data['js'] = array('tab.js');
			$this->jiadb->_table = 'corporation';
			$limit = array($this->config->item('page_size'), 0);
			$data['corporations'] = $this->jiadb->fetchAll('', '', $limit);
			$this->load->model('Corporation_model');
			$data['tags'] = $this->Corporation_model->get_tags();
			$data['main_content'] = 'corporation/list_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function login() {
			$this->_require_login(FALSE);
			$data['title'] = '登录';
			// $data['css'] = array('login_regist.css');
			$data['js'] = array('login_view.js');
			$data['main_content'] = 'login_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_login($cookie = FALSE) {
			$this->_require_login(FALSE);
			if($cookie) {
				$id = get_cookie('id');
				$pass = get_cookie('pass');
				$result = $this->User_model->login((int)$id, $pass);
				switch ($result) {
					case 1:
					case 2:
						delete_cookie('id');
						delete_cookie('pass');
						break;
					default:
						$session = array(
							'id' => $result['id'],
							'email' => $result['email'],
							'type' => $result['entity_type'][0]['name'],
							'name' => $result['name'],
							'avatar' => $result['avatar'],
						);
						$this->session->set_userdata($session);
						break;
				}
			} else {
				$this->_require_ajax();
				$email = $this->input->post('email');
				$pass = md5($this->input->post('pass'));
				$remember = $this->input->post('remember');
				$result = $this->User_model->login((string)$email, $pass);
				$json_array = array('verify' => 0, 'email' => '', 'pass' => '');
				switch ($result) {
					case 1:
						$json_array['email'] = '账户不存在';
						echo json_encode($json_array);
						break;
					case 2:
						$json_array['pass'] = '密码不正确';
						echo json_encode($json_array);
						break;
					default:
						$session = array(
							'id' => $result['id'],
							'type' => $result['entity_type'][0]['name'],
							'email' => $result['email'],
							'name' => $result['name'],
							'avatar' => $result['avatar'],
						);
						$this->session->set_userdata($session);
						$json_array['verify'] = 1;
						echo json_encode($json_array);
						if($remember) {
							set_cookie('id', $result['id'], '86500');
							set_cookie('pass', $result['pass'], '86500');
						}
				}
			}
		}
		
		function regist() {
			$this->_require_login(FALSE);
			$data['title'] = '注册加加';
			// $data['css'] = array('home.css','login_regist.css');
			$data['js'] = array('regist_view.js');
			$data['main_content'] = 'regist_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_regist() {	
			$this->_require_login(FALSE);
			$this->_require_ajax();
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$pass = $this->input->post('pass');
			$result = $this->User_model->insert($email, $name, $pass);
			$json_array = array('verify' => 0, 'email' => '');
			switch ($result) {
				case 1:
					$json_array['email'] = '邮箱已被注册';
					echo json_encode($json_array);
					break;
				default:
					$json_array['verify'] = 1;
					echo json_encode($json_array);
					$session = array(
						'id' => $result['id'],
						'type' => $result['entity_type'][0]['name']
					);
					$this->session->set_userdata($session);
			}
		}
		
		function logout() {
			$this->_require_login();
			$this->session->sess_destroy();
			delete_cookie('id');
			delete_cookie('pass');
			redirect('index/login');
		}
		
		// 更新数据库
		function update_db() {
			$entity_result = $this->db->get('entity_type')->result_array();
			foreach ($entity_result as $row) {
				$entity[$row['name']] = $row['id'];
			}
			$entity_table = array(
				'user',
				'post',
				'notify',
			);
			foreach ($entity_table as $table) {
				$type = $table . '_type';
				$sql = 'select ' . $table . '.id as pid, ' . $type . '.name as typename from ' . $table . ', ' . $type . ' where ' . $table . '.type_id = ' . $type . '.id';
				$cur = $this->db->query($sql)->result_array();
				foreach ($cur as $row) {
					$sql = 'update ' . $table .' set type_id=' . $entity[$row['typename']] . ' where id=' . $row['pid'];
					$this->db->query($sql);
				}
			}
		}
		
		//个人权限修正
		function auth_revert() {
			$this->_require_login();
			$post_access = Access_factory::get_access('post');
			$post_access->init($this->session->userdata('id'));
			$comment_auth = Access_factory::get_access('comment');
			$comment_auth->init($this->session->userdata('id'), 'personal');
		}
	}