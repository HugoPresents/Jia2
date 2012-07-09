<?php
	class Album extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Album_model');
		}
		
		function index($id = '', $entity_type = 'personal') {
			$owner_id = $id ? $id : $this->session->userdata('id');
			$where = array(
				'owner_id' => $owner_id,
			);
			if($entity_type == 'personal') {
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($owner_id);
				if(!$data['info'])
					static_view();
				$data['upload_url'] = site_url('album/upload');
				$data['create_url'] = site_url('album/create');
				$data['back_a'] = $owner_id == $this->session->userdata('id') ? anchor('personal/profile/', '返回我的主页') : anchor('personal/profile/' .$owner_id, '返回' . $data['info']['name'] . '的主页');
				$where['type_id'] = $this->config->item('entity_type_personal');
			} elseif($entity_type == 'corporation') {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($owner_id);
				if(!$data['info'])
					static_view();
				$data['upload_url'] = site_url('album/upload/' . $data['info']['id'] . '/corporation');
				$data['create_url'] = site_url('album/create/' . $data['info']['id'] . '/corporation');
				$data['back_a'] = anchor('corporation/profile/' . $owner_id, '返回'.$data['info']['name'].'首页');
				$where['type_id'] = $this->config->item('entity_type_corporation');
			} else {
				static_view();
			}
			$data['albums'] = $this->Album_model->fetch_album($where);
			$data['main_content'] = 'album/index_view';
			$data['title'] = '我的相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出相册的照片
		function lists($album_id = '') {
			if(!$album_id || !is_numeric($album_id))
				static_view();
			$data['main_content'] = 'album/list_photo_view';
			$data['info'] = $this->Album_model->get_info($album_id);
			if($data['info']['type_id'] == $this->config->item('entity_type_corporation')) {
				$this->load->model('Corporation_model');
				$owner_info = $this->Corporation_model->get_info($data['info']['owner_id']);
				$data['access_user'] = $owner_info['user_id'];
				$data['profile_a'] = anchor('corporation/profile/' . $owner_info['id'], $owner_info['name']);
				$data['back_a'] = anchor('album/' . $owner_info['id'] . '/corporation', $owner_info['name'] . '的相册');
			} else {
				$this->load->model('User_model');
				$owner_info = $this->User_model->get_info($data['info']['owner_id']);
				$data['access_user'] = $owner_info['id'];
				$data['profile_a'] = anchor('personal/profile/' . $owner_info['id'], $owner_info['name']);
				$data['back_a'] = anchor('album/' . $owner_info['id'], $owner_info['name'] . '的相册');
			}
			$data['photos'] = $this->Album_model->fetch_photo($album_id);
			$data['title'] = $data['info']['name'];
			$data['js'] = array('lightbox.js');
			$data['css'] = array('gallery.css','lightbox.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function create($id = '', $entity_type = 'personal') {
			$this->_require_login();
			$owner_id = $id ? $id : $this->session->userdata('id');
			if($entity_type == 'personal') {
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($owner_id);
				if($data['info']['id'] != $this->session->userdata('id'))
					static_view('权限不足');
				$data['back_a'] = anchor('album', '返回我的相册');
			} elseif($entity_type == 'corporation') {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($owner_id);
				if($data['info']['user_id'] != $this->session->userdata('id'))
					static_view('权限不足');
				$data['back_a'] = anchor('album/'.$data['info'].'/corporation', '返回' . $data['info']['name']);
			} else {
				static_view();
			}
			if($this->input->post('submit')) {
				$name = $this->input->post('name');
				$tags = $this->input->post('tags');
				$tags_array = explode(' ', $tags);
				$tags_array = array_filter($tags_array, "tags_filter");
				$tags = implode(' ', $tags_array);
				$type = $entity_type == 'corporation' ? 'corporation' : 'personal';
				$status = $this->input->post('status') == 'public' ? $this->config->item('status_public') : $this->config->item('status_privary');
				$album = array(
					'name' => trim($name),
					'owner_id' => $owner_id,
					'comment' => trim($this->input->post('comment')),
					'type' => $type,
					'status' => $status,
					'tags' => trim($tags)
				);
				$album_id = $this->Album_model->insert($album);
				if(is_numeric($album_id)) {
					static_view('创建相册成功' . anchor('album/lists/'.$album_id, '查看相册') . '|' .anchor('album/upload', '上传图片'), '创建相册成功');
				} else {
					static_view($album_id, '创建失败');
				}
			}
			$data['main_content'] = 'album/create_view';
			$data['title'] = '创建相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function upload($id = '', $entity_type = 'personal') {
			$this->_require_login();
			if($entity_type != 'personal' && $entity_type != 'corporation')
				static_view();
			$this->load->model('Photo_model');
			$owner_id = $id ? $id : $this->session->userdata('id');
			$albums = $this->Album_model->fetch_album(array('owner_id' => $owner_id, 'type_id' => $this->config->item('entity_type_' . $entity_type)));
			if($entity_type == 'corporation') {
				$this->load->model('Corporation_model');
				$owner_info = $this->Corporation_model->get_info($owner_id);
				if($owner_info['user_id'] != $this->session->userdata('id'))
					static_view('你没有该权限', '权限不足');
				$create_url = 'album/create/' . $owner_id . '/corporation';
				$data['profile_a'] = anchor('corporation/profile/' . $owner_info['id'], $owner_info['name']);
				$data['back_a'] = anchor('album/' . $owner_info['id'] . '/corporation', $owner_info['name'] . '的相册');
			} else {
				$this->load->model('User_model');
				$owner_info = $this->User_model->get_info($owner_id);
				$create_url = 'album/create'; 
				$data['profile_a'] = anchor('personal/profile/' . $owner_info['id'], $owner_info['name']);
				$data['back_a'] = anchor('album/' . $owner_info['id'], $owner_info['name'] . '的相册');
			}
			if(!$albums)
				static_view('你需要先' . anchor($create_url, '创建一个相册'), '上传图片');
			foreach ($albums as $value) {
				$data['albums_id'][$value['id']] = $value['name'];
			}
			// 提交表单
			if($this->input->post('submit')) {
				$album_id = $this->input->post('album');
				if(!array_key_exists($album_id, $data['albums_id']))
					static_view('上传失败', '相册不存在');
				$path = $this->config->item('personal_album_path');
				$filename = $this->Photo_model->save_album_photo($path);
				if($filename) {
					$photo = array(
						'album_id' => $album_id,
						'name' => '图片'
					);
					$photo = array_merge($photo, $filename);
					$this->db->insert('photo', $photo);
					static_view('上传成功' . $data['back_a'], '上传成功');
				} else {
					static_view('上传失败');
				}
			}
			$data['albums'] = $albums;
			$data['main_content'] = 'album/upload_view';
			$data['title'] = '上传照片';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function delete_album() {
			
		}
		
		function edit_album() {
			
		}
		
		function edit_photo() {
			$this->_require_login();
			$this->_require_ajax();
			$action = $this->input->post('action');
			$photo_id = $this->input->post('id');
			$join = array(
				'album' => array('album_id', 'id')
			);
			$photo = $this->Photo_model->get_photo_info($photo_id, $join);
			switch ($action) {
				// 讲照片设置为相册封面
				case 'cover':
					$album_id = $photo['album'][0]['id'];
					$this->db->where('id', $album_id);
					$album = array(
						'cover_id' => $photo_id
					);
					$this->db->update('album', $album);
					break;
				case 'info':
					
					break;
				case 'delete':
					
					break;
			}
		}
	}
