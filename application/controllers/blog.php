<?php
	class Blog extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Blog_model');
		}
		
		// 默认加载当前用户 blog
		function index($id='', $entity_type = 'personal') {
			if($entity_type != 'personal' && $entity_type != 'corporation')
				static_view();
			$owner_id = $id ? $id : $this->session->userdata('id');
			$where = array(
				'owner_id' => $owner_id,
				'draft' => 0,
				'status' => $this->config->item('status_public')
			);
			if($entity_type == 'corporation') {
				$where['type_id'] = $this->config->item('entity_type_corporation');
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($owner_id);
				$data['back_a'] = anchor('corporation/profile/' . $owner_id, $data['info']['name'] . '的主页');
				$data['post_a'] = anchor('blog/post/'.$owner_id.'/corporation', '写社团日志','class="oprate_w"');
			} else {
				$where['type_id'] = $this->config->item('entity_type_personal');
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($owner_id);
				$data['back_a'] = anchor('personal/profile/' . $owner_id, $data['info']['name'] . '的个人主页');
				$data['post_a'] = anchor('blog/post', '写日志','class="oprate_w"');
			}
			$data['main_content'] = 'blog/list_view';
			$data['title'] = $data['info']['name'] . '的日志';
			$data['css'] = array('dairy.css');
			$data['blogs'] = $this->Blog_model->fetch($where, $entity_type);
			$this->load->view('includes/template_view', $data);
		}
		
		//发表日志
		function post($id = '', $entity_type = 'personal') {
			$this->_require_login();
			if($entity_type != 'personal' && $entity_type != 'corporation')
				static_view();
			$owner_id = $id ? $id : $this->session->userdata('id');
			$data['img_manager'] = site_url('blog/img_manager');
			$data['img_up'] = site_url('blog/img_up');
			if($entity_type == 'corporation') {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($owner_id);
				// 默认只有社长能发布社团日志，后期加入日志权限
				if($data['info'] && $data['info']['user_id'] == $this->session->userdata('id')) {
					$data['img_up'] .= '?entity=corporation' . '&id=' . $owner_id;
					$data['img_manager'] .= '?entity=corporation' . '&id=' . $owner_id;
					$data['img_path'] = '/' . $this->config->item('corporation_blog_path') . $owner_id;
					$data['back_a'] = anchor('blog/' . $owner_id . '/corporation', $data['info']['name'] . '的日志');
				} else {
					static_view('你没有该权限', '权限不足');
				}
			} else {
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($owner_id);
				$data['img_up'] .= '?id=' . $owner_id;
				$data['img_manager'] .= '?id=' . $owner_id;
				$data['img_path'] = $this->config->item('personal_blog_path') . $owner_id;
				$data['back_a'] = anchor('blog/' . $owner_id, $data['info']['name'] . '的日志');
			}
			
			// 提交表单
			if($this->input->post('submit') || $this->input->post('draft')) {
				$order = $this->input->post('order');
				$title = trim($this->input->post('title'));
				$draft = ($this->input->post('draft') ? 1 : 0);
				$privacy = $this->input->post('privacy');
				$status = ($privacy == 'privary' ? $this->config->item('status_privary') : $this->config->item('status_public')); 
				$content = $this->input->post('myContent');
				$tags = trim($this->input->post('tags'));
				if($title && $content != '') {
					if($tags) {
						$tags_array = explode(' ', $tags);
						$tags_array = array_filter($tags_array, "tags_filter");
						$tags = implode(' ', $tags_array);
					}
					$time = time();
					$blog = array(
						'owner_id' => $owner_id,
						'title' => $title,
						'content' =>$content,
						'tags' => $tags,
						'status' => $status,
						'draft' => $draft,
						'add_time' => $time,
						'update_time' => $time,
						'type' => $entity_type,
						'order' => $this->input->post('order') ? 1 : 0
					);
					$blog_id = $this->Blog_model->insert($blog);
					if($blog_id) {
						$str = '发布日志成功！ ' . anchor('blog/view/' . $blog_id, '查看');
						static_view($str, '发布成功');
					}
				} else {
					static_view('发表失败');
				}
			} else {
				// 加载编辑视图
				$data['title'] = '发布日志';
				$data['main_content'] = '/'.'blog/post_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		// 编辑日志
		function edit($blog_id = '') {
			$this->_require_login();
			if(!$blog_id || !is_numeric($blog_id))
				static_view();
			$blog = $this->Blog_model->get_info($blog_id);
			// 个人日志
			$data['img_manager'] = site_url('blog/img_manager');
			$data['img_up'] = site_url('blog/img_up');
			if($blog['type_id'] = $this->config->item('entity_type_personal') && $blog['owner_id'] == $this->session->userdata('id')) {
				$data['img_up'] .= '?id=' . $blog['owner_id'];
				$data['img_manager'] .= '?id=' . $blog['owner_id'];
				$data['img_path'] = $this->config->item('personal_blog_path') . $blog['owner_id'];
			} else {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($blog['owner_id']);
				if($data['info']['user_id'] != $this->session->userdata('id'))
					static_view('貌似你没有该权限哦', '权限不足');
				$data['img_up'] .= '?entity=corporation' . '&id=' . $blog['owner_id'];
				$data['img_manager'] .= '?entity=corporation' . '&id=' . $blog['owner_id'];
				$data['img_path'] = '/' . $this->config->item('corporation_blog_path') . $blog['owner_id'];
			}
			if($this->input->post('submit') || $this->input->post('draft')) {
				$title = trim($this->input->post('title'));
				$draft = ($this->input->post('draft') ? 1 : 0);
				$privacy = $this->input->post('privacy');
				$status = ($privacy == 'privary' ? $this->config->item('status_privary') : $this->config->item('status_public')); 
				$content = $this->input->post('myContent');
				$tags = trim($this->input->post('tags'));
				if($title && $content != '') {
					if($tags) {
						$tags_array = explode(' ', $tags);
						$tags_array = array_filter($tags_array, "tags_filter");
						$tags = implode(' ', $tags_array);
					}
					$time = time();
					$blog = array(
						'title' => $title,
						'content' =>$content,
						'tags' => $tags,
						'status' => $status,
						'draft' => $draft,
						'update_time' => $time,
					);
					if($this->Blog_model->update($blog_id, $blog)) {
						$str = '编辑日志日志成功！ ' . anchor('blog/view/' . $blog_id, '查看');
						static_view($str, '发布成功');
					}
				} else {
					static_view('编辑失败');
				}
			} else {
				$data['blog'] = $blog;
				$data['main_content'] = 'blog/edit_view';
				$data['title'] = '编辑日志';
				$this->load->view('includes/template_view', $data);
			}
		}

		
		// 查看单篇日志
		function view($blog_id = '') {
			if(!$blog_id || !is_numeric($blog_id))
				static_view();
			$data['blog'] = $this->Blog_model->get_info($blog_id);
			if($data['blog']['type_id'] == $this->config->item('entity_type_personal')) {
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($data['blog']['owner_id']);
				$data['back_a'] = anchor('blog/' . $data['info']['id'], $data['info']['name'] . '的日志');
			} elseif($data['blog']['type_id'] == $this->config->item('entity_type_corporation')) {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($data['blog']['owner_id']);
				$data['back_a'] = anchor('blog/' . $data['info']['id'] . '/corporation', $data['info']['name'] . '的日志');
			} else {
				static_view();
			}
			$data['css'] = array('dairy.css');
			$data['main_content'] = 'blog/single_view';
			$data['title'] = $data['blog']['title'] . '-' . $data['info']['name'] . '的日志';
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出某个用户或者社团的日志
		/*           暂时不需要 用index方法代替
		function lists($entity_type, $owner_id = 0, $page = 1) {
			if($entity_type != 'personal' && $entity_type != 'corporation')
				static_view('你访问的页面不存在');
			if($owner_id == 0 || !is_numeric($owner_id)) {
				static_view('你访问的页面不存在');
			}
			$where = array(
				'owner_id' => $owner_id,
				'type_id' => $this->config->item('entity_type_' . $entity_type),
				'draft' => 0,
				'status' => $this->config->item('status_public'),
			);
			$blogs = $this->Blog_model->fetch($where, $entity_type);
			// 加载视图
		}
		
		 * 
		 */
		//日志图片上传
		function img_up() {
			$state = "上传失败";
			$this->load->model('Photo_model');
			//原始文件名，表单名固定，不可配置
		    $oriName = htmlspecialchars($_POST['fileName'], ENT_QUOTES);
		    //上传图片框中的描述表单名称，
		    $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
			$id = $this->input->get('id');
			$entity = $this->input->get('entity');
			if($entity == 'corporation') {
				$path = $this->config->item('corporation_blog_path') . $id .'/';
			} else {
				$path = $this->config->item('personal_blog_path') . $id . '/'; 
			}
			if(!file_exists($path)) {
				mkdir($path);
			}
			$fileName = $this->Photo_model->save_blog_img($path);
			if($fileName) {
				$fileName = $path . $fileName;
				$state = 'SUCCESS';
			}
			echo "{'url':'".$fileName."','title':'".$title."','original':'".$oriName."','state':'".$state."'}";
		}
		
		function img_manager() {
			$id = $this->input->get('id');
			$entity = $this->input->get('entity');
			if($entity == 'corporation') {
				$path = $this->config->item('corporation_blog_path') . $id;
			} else {
				$path = $this->config->item('personal_blog_path') . $id; 
			}
			$action = htmlspecialchars($_POST["action"]);
			if($action=="get"){
				$this->load->model('Photo_model');
			    $files = $this->Photo_model->getfiles($path);
			    if(!$files)return;
			    $str = "";
			    foreach ($files as $file) {
			    	$str .= $file."ue_separate_ue";
			    }
			    echo $str;
			}
		}
		
		//UEditor获取视频
		function get_movie() {
			$key =htmlspecialchars($_POST["searchKey"]);
			$type = htmlspecialchars($_POST["videoType"]);
			$html = file_get_contents('http://api.tudou.com/v3/gw?method=item.search&appKey=myKey&format=json&kw='.$key.'&pageNo=1&pageSize=20&channelId='.$type.'&inDays=7&media=v&sort=s');
			echo $html;
		}
	}