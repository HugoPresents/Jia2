<?php
	class Blog_model extends CI_Model {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('blog');
		}
		
		function get_info($blog_id, $join = array()) {
			$blog = $this->jiadb->fetchJoin(array('id' => $blog_id), $join);
			if($blog) {
				return $blog[0];
			} else {
				return FALSE;
			}
		}
		
		function fetch($where = array(), $type = 'personal', $order = '', $limit = '') {
			if ($type == 'personal') {
				$join = array(
					'user' => array('owner_id', 'id')
				);
			} elseif ($type == 'corporation') {
				$join = array(
					'corporation' => array('owner_id', 'id')
				);
			} else {
				return FALSE;
			}
			return $blogs = $this->jiadb->fetchJoin($where, $join, $order, $limit);
		}
		
		function insert($blog) {
			if($blog && is_array($blog)) {
				$blog['type_id'] = ($blog['type'] == 'corporation' ? $this->config->item('entity_type_corporation') : $this->config->item('entity_type_personal'));
				unset($blog['type']);
				$this->db->insert('blog', $blog);
				return $this->db->insert_id();
			} else {
				return FALSE;
			}
		}
		
		function delete($blog_id) {
			$this->db->where('id', $blog_id);
			$this->db->delete('blog');
		}
		
		function update($blog_id, array $blog) {
			if($blog && is_array($blog)) {
				$this->db->where('id', $blog_id);
				$this->db->update('blog', $blog);
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
