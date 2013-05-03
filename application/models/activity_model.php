<?php
	class Activity_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Post_model');
			$this->jiadb = new Jiadb('activity');
		}
		
		// 获取活动信息
		function get_info($id, $join = array()) {
			$this->jiadb->_table = 'activity';
			$result = $this->jiadb->fetchJoin(array('id' => $id), $join);
			if($result) {
				return $result[0];
			} else {
				return FALSE;
			}
		}
		
		//创建活动
		function insert($activity) {
			if($this->db->insert('activity', $activity)) {
				$activity_id = $this->db->insert_id();
				// 同时发一条post
				$post = array(
					'owner_id' => $activity['corporation_id'],
					'type' => 'activity',
					'content' => '发起了一个活动',
					'time' => time()
				);
				$post_meta = array(
					'meta_key' => 'activity',
					'meta_value' => $activity_id,
					'meta_table' => 'activity',
				);
				$post_meta['post_id'] = $this->Post_model->insert($post);
				$this->db->insert('post_meta', $post_meta);
				return $activity_id;
			} else {
				return FALSE;
			}
		}
		
		//更新活动
		function update() {
			
		}
		
		// 获取活动参与者
		function get_participants($activity_id) {
			$this->jiadb->_table = 'activity';
			$return = 'meta_value';
			$meta_array = array(
				'meta_key' => 'participant',
				'meta_table' => 'user',
				'activity_id' => $activity_id
			);
			return $this->jiadb->fetchMeta($return, $meta_array);
		}
		
		// 参加活动
		function join($user_id, $activity_id, $unjoin = FALSE) {
			$meta_array = array (
				'meta_value' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'participant',
				'activity_id' => $activity_id
			);
			if($unjoin) {
				$this->db->where($meta_array);
				$this->db->delete('activity', $meta_array);
			} else {
				$activity = $this->get_info($activity_id);
				$blockers = $this->Corporation_model->get_blockers($activity['corporation_id']);
				$participants = $this->get_participants($activity_id);
				if(!empty($blockers) && in_array($user_id, $blockers)) {
					return FALSE;
				} elseif(!in_array($user_id, $participants)) {
					$this->db->insert('activity_meta', $meta_array);
				}
			}
		}
	}
