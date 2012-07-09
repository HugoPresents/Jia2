<?php
	class Photo_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->library('upload');
			$this->load->library('image_lib');
		}
		
		function upload($param = array()) {
			$config = array(
			  		'allowed_types' => 'jpeg|jpg|png|gif|bmp',
			  		'upload_path' => $param['upload_path'],
			  		'max_size' => '2048',
			  		'overwrite' => TRUE,
			  		'file_name'	=> $param['filename']
			 );
			switch ($param['mode']) {
				case 'avatar':
					$this->upload->initialize($config);
					if($this->upload->do_upload()) {
						$image_data = $this->upload->data();
						$thumb_tiny = array(
							'source_image' => $image_data['full_path'],
							'create_thumb' => TRUE,
							'maintain_ratio' => TRUE,
							'thumb_marker' => '',
							'new_image' => $param['upload_path'] . 'tiny/',
							'width' => 50,
							'height' => 50
						);
						$thumb_big = array(
							'source_image' => $image_data['full_path'],
							'create_thumb' => TRUE,
							'maintain_ratio' => TRUE,
							'thumb_marker' => '',
							'new_image' => $param['upload_path'] . 'big/',
							'width' => 180,
							'height' => 180
						);
						$this->image_lib->initialize($thumb_tiny); 
						$this->image_lib->resize();
						$this->image_lib->initialize($thumb_big);
						$this->image_lib->resize();
						// 删除原始图像
						if(file_exists($image_data['full_path']))
							unlink($image_data['full_path']);
						return TRUE;
						} else {
							//错误提示
							// echo $this->upload->display_errors('<p>', '</p>');
							return FALSE;
						}
					break;
				case 'request':
					if(is_array($param['field'])) {
						$filename = array();
						foreach ($param['field'] as $field) {
							$config['file_name'] = $field . '_' . $this->session->userdata('id');
							$this->upload->initialize($config);
							if($this->upload->do_upload($field)) {
								$data = $this->upload->data();
								$filename[$field] = $data['file_name'];
							} else {
								return FALSE;
							}
						}
					} else {
						$config['file_name'] = $param['filename'];
						$this->upload->initialize($config);
						if($this->upload->do_upload($param['field'])) {
							$data = $this->upload->data();
							$filename = $data['file_name'];
						} else {
							return FALSE;
						}
					}
					return $filename;
					break;
				case 'blog':
					$this->upload->initialize($config);
					if($this->upload->do_upload('upfile')) {
						$image_data = $this->upload->data();
						if($image_data['image_width'] > 700) {
							$thumb = array(
								'source_image' => $image_data['full_path'],
								'maintain_ratio' => TRUE,
								'master_dim' => 'width',
								'thumb_marker' => '',
								'width' => 700,
								'height' => 700
							);
							$this->image_lib->initialize($thumb); 
							$this->image_lib->resize();
						}
						return TRUE;
					} else {
						return FALSE;
					}
					break;
				case 'album':
					$config['overwrite'] == FALSE;
					$this->upload->initialize($config);
					if($this->upload->do_upload('userfile')) {
						$image_data = $this->upload->data();
						$filename = array(
							'original' => $param['upload_path'] . $image_data['orig_name'],
							'thumb' => $param['upload_path'] . $image_data['orig_name']
						);
						if($image_data['image_width'] > 150) {
							$thumb = array(
								'source_image' => $image_data['full_path'],
								'maintain_ratio' => TRUE,
								'thumb_maker' => '_thumb',
								'master_dim' => 'width',
								'create_thumb' => TRUE,
								'width' => 150,
								'height' => 150
							);
							$this->image_lib->initialize($thumb); 
							if($this->image_lib->resize()) {
								$filename['thumb'] = $param['upload_path'] . $image_data['raw_name'] . $thumb['thumb_maker'] . $image_data['file_ext'];
							} else {
								unlink($image_data['full_path']);
								return FALSE;
							}
						}
						if($image_data['image_width'] > 700) {
							
							$original = array(
								'source_image' => $image_data['full_path'],
								'maintain_ratio' => TRUE,
								'master_dim' => 'width',
								'thumb_marker' => '',
								'width' => 700,
								'height' => 700
							);
							$this->image_lib->initialize($original);
							if(!$this->image_lib->resize()) {
								unlink($image_data['full_path']);
								unlink($filename['thumb']);
								return FALSE;
							}
						}
						return $filename;
					}
					echo $this->upload->display_errors();
					break;
				}
		}
		
		function set_avatar($mode = 'personal', $filename) {
			$param = array(
				'upload_path' => $this->config->item($mode . '_avatar_path'),
				'mode' => 'avatar',
				'filename' => $filename . '.jpg',
			);
			if($this->upload($param)) {
				return $param['filename'];
			} else {
				return FALSE;
			}
		}
		// 上传证件照方法
		function save_request_cap($mode = 'corporation') {
			$param = array(
				'upload_path' => $this->config->item($mode . '_request'),
				'mode' => 'request',
				'filename' => $this->input->post('field') . '_'.$this->input->post('user') . '.jpg',
				'field' => $this->input->post('field')
			);
			if($this->upload($param)) {
				$this->session->set_userdata('type', 'register');
				$this->session->set_userdata('filename', $param['filename']);
				  $file_id = md5($_FILES[$param['field']]["tmp_name"] + rand()*100000);
				  echo "FILEID:" . $file_id; 
			}
		}
		// 上传日志图片方法
		function save_blog_img($path) {
			$param = array(
				'upload_path' => $path,
				'mode' => 'blog',
				'filename' => rand(1,10000).time().strrchr($_FILES['upfile']['name'],'.')
			);
			if($this->upload($param)) {
				return $param['filename'];
			} else {
				return FALSE;
			}
		}
		
		function save_album_photo($path) {
			$param = array (
				'upload_path' => $path,
				'mode' => 'album',
				'filename' => rand(1,10000).time().strrchr($_FILES['userfile']['name'],'.')
			);
			return $this->upload($param);
		}
		
		// UEditor 在线图片管理方法
		function getfiles($path, &$files = array()){
			if (!is_dir($path)) return;
		
			$handle = opendir($path);
			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..') {
					$path2 = $path . '/' . $file;
					if (is_dir($path2)) {
						$this->getfiles($path2, $files);
					} else {
						if (preg_match("/\.(gif|jpeg|jpg|png|bmp)$/i", $file)) {
							$files[] = $path2;
						}
					}
		
				}
			}
			return $files;
		}
	}
