<?php
	class Album_model extends CI_Model {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('album');
		}
		
		function get_info($album_id, $join = array()) {
			$this->jiadb->_table = 'album';
			$album = $this->jiadb->fetchJoin(array('id' => $album_id), $join);
			if($album) {
				return $album[0];
			} else {
				return false;
			}
		}
		
		function get_photo_info($photo_id, $join = array()) {
			$this->jiadb->_table = 'photo';
			$photo = $this->jiadb->fetchJoin(array('id' => $photo_id), $join);
			if($photo) {
				return $photo[0];
			} else {
				return FALSE;
			}
		}
		
		function insert($album) {
			if($album && is_array($album)) {
				$album['type_id'] = ($album['type'] == 'corporation' ? $this->config->item('entity_type_corporation') : $this->config->item('entity_type_personal'));
				unset($album['type']);
				$result = $this->db->get_where('album', array('owner_id' => $album['owner_id'], 'name' => $album['name'], 'type_id' => $album['type_id']));
				if($result->num_rows > 0) {
					return '相册名已存在';
				} else {
					$album['add_time'] = time();
					$this->db->insert('album', $album);
					return $this->db->insert_id();
				}
			} else {
				return '创建相册失败';
			}
		}
		
		function update($album_id, $album) {
			$this->db->where('id', $album_id);
			$this->db->update('album', $album);
			return TRUE;
		}
		
		function fetch_album($where = array(), $join = array(), $order = '', $limit = '') {
			$this->jiadb->_table = 'album';
			if($where) {
				return $this->jiadb->fetchAll($where, $order, $limit);
			} else {
				return FALSE;
			}
		}
		
		function fetch_photo($album_id) {
			$this->jiadb->_table = 'photo';
			return $this->jiadb->fetchAll(array('album_id' => $album_id));
		}
		
		function delete_album() {
			
		}
		
		function delete_photo() {
			
		}
	}
