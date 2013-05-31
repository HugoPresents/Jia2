<?php
	class Corporation_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('corporation');
		}
		
		function get_info($id, $join = array()) {
			$reslut = $this->jiadb->fetchJoin(array('id' => $id), $join);
			if($reslut) {
				return $reslut[0];
			} else {
				return FALSE;
			}
		}
		
		function update($where = array(), $row = array()) {
			$this->db->where($where);
			$this->db->update('corporation', $row);
		}
		
		function get_trends($corporation_id, $limit = array(10, 0)) {
			$this->jiadb->_table = 'post';
			$join_co = array(
				'corporation' => array('owner_id', 'id'),
				'post_meta' => array('id', 'post_id'),
				'comment' => array('id', 'post_id', 5),
				'comment.user' => array('user_id', 'id')
			);
			return $this->jiadb->fetchJoin(array('owner_id' =>$corporation_id, 'type_id' => $this->config->item('entity_type_activity')), $join_co, array('time' => 'desc'), $limit);
		}
		
		function get_activities($corporation_id, $limit = array(10, 0)) {
			$this->jiadb->_table = 'activity';
			$join = array(
				'corporation' => array('corporation_id', 'id'),
				'comment' => array('id', 'post_id', 5),
				'comment.user' => array('user_id', 'id')
			);
			return $this->jiadb->fetchJoin(array('corporation_id' => $corporation_id), $join, array('time' => 'DESC'), $limit);
		}
		
		function get_followers($corporation_id) {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_table' => 'corporation',
				'meta_value' => $corporation_id,
				'meta_key' => 'follower'
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function get_members($corporation_id, $order = null, $limit = null) {
			$this->jiadb->_table = 'corporation';
			$return = 'meta_value';
			$where = array(
				'meta_table' => 'user',
				'meta_key' => 'member',
				'corporation_id' => $corporation_id
			);
			return $this->jiadb->fetchMeta($return, $where, $order, $limit);
		}
		
		function get_admin($corporation_id) {
			$this->jiadb->_table = 'corporation';
			$return  = 'meta_value';
			$where = array(
				'meta_table' => 'user',
				'meta_key' => 'admin',
				'corporation_id' => $corporation_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function get_blockers($corporation_id) {
			$this->jiadb->_table = 'corporation';
			$return = 'meta_value';
			$where = array(
				'meta_table' => 'user',
				'corporation_id' => $corporation_id,
				'meta_key' => 'blocker'
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function insert($corporation) {
			if($this->db->insert('corporation', $corporation)) {
				$corporation_id = $this->db->insert_id();
				//初始化社团
				$this->_initialize($corporation_id);
				return $corporation_id;
			} else {
				return FALSE;
			}
		}

		function _initialize($corporation_id) {
			// 初始化社团相关权限
			$corporation_access = Access_factory::get_access('corporation');
			$activity_access = Access_factory::get_access('activity');
			$comment_access = Access_factory::get_access('comment');
			$comment_access->init($corporation_id, 'activity');
			$corporation_access->init($corporation_id);
			$activity_access->init($corporation_id);
			
			//初始化社团相册
			$this->load->model('Album_model');
			$album = array(
				'owner_id' => $corporation_id,
				'type' => 'corporation',
				'name' => '社团默认相册',
				'comment' => '社团默认相册',
			);
			$this->Album_model->insert($album);
		}
		
		/**
		 * @param int follower_id
		 * @param int following_id
		 * @param boolean follow or unfollow
		 */
		function follow($user_id, $corporation_id, $unfollow = FALSE) {
			$user_meta = array(
				'user_id' => $user_id,
				'meta_table' => 'corporation',
				'meta_key' => 'follower',
				'meta_value' => $corporation_id,
			);
			// 取消关注
			if($unfollow) {
				$this->db->where($user_meta);
				$this->db->delete('user_meta', $user_meta);
				return TRUE;
			} else {
				$blocker = $this->get_blockers($corporation_id);
				if(in_array($user_id, $blocker)) {
					return FALSE;
				} else {
					$this->jiadb->_table = 'user_meta';
					$exists = $this->jiadb->fetchAll($user_meta);
					if($exists) {
						return TRUE;
					} else {
					    $user_meta['add_time'] = time();
						$this->db->insert('user_meta', $user_meta);
						return TRUE;
					}
				}
			}
		}
		
		function block($corporation_id, $blocker_id, $unblock = FALSE) {
			$meta_array = array(
				'corporation_id' => $corporation_id,
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'meta_value' => $blocker_id
			);
			if($unblock) {
				$this->db->where($meta_array);
				$this->db->delete('corporation_meta', $meta_array);
			} else {
				// 移除粉丝
				$delete_follower = array(
					'user_id' => $blocker_id,
					'meta_key' => 'follower',
					'meta_table' => 'corporation',
					'meta_value' => $corporation_id
				);
				$this->delete_meta('user_meta', $delete_follower);
				$this->insert_meta($meta_array);
			}
		}
		
		function join_member($corporation_id, $member_id, $unjoin = FALSE) {
			$corporation = $this->get_info($corporation_id);
            $time = time();
			$meta_array = array(
				'meta_key' => 'member',
				'meta_table' => 'user',
				'meta_value' => $member_id,
				'corporation_id' => $corporation_id,
			);
			if($unjoin) {
				$this->db->delete('corporation_meta', $meta_array);
				return TRUE;
			} else {
				$blockers = $this->get_blockers($corporation_id);
				$members = $this->get_members($corporation_id);
				if(!empty($blockers) && in_array($member_id, $blockers)) {
					return 1;
				} elseif(!in_array($member_id, $members)) {
				    $meta_array['add_time'] = $time;
					$this->db->insert('corporation_meta', $meta_array);
					// 加入社团会自动关注这个社团
					$this->follow($member_id, $corporation_id);
					$message = array(
						'content' => '添加了你为' . anchor('corporation/profile/' . $corporation['id'], $corporation['name']) . '社团的成员',
						'type' => 'message',
						'user_id' => $this->session->userdata('id'),
						'receiver_id' => $member_id,
						'time' => $time
					);
					$this->Notify_model->insert($message);
					return 3;
				} else {
					return 2;
				}
			}
		}
		
		function join_admin($corporation_id, $admin_id, $unjoin = FALSE) {
			$meta_array = array(
				'meta_key' => 'admin',
				'meta_table' => 'user',
				'meta_value' => $admin_id,
				'corporation_id' => $corporation_id,
			);
			if($unjoin) {
				$this->db->where($meta_array);
				$this->db->delete('corporation_meta', $meta_array);
			} else {
				$members = $this->get_members($corporation_id);
				$admin = $this->get_members($corporation_id);
				if(!in_array($admin_id, $admin) && in_array($admin_id, $members)) {
				    $meta_array['add_time'] = time();
					$this->db->insert('corporation_meta', $meta_array);
				} else {
					return FALSE;
				}
			}
		}
		
		function get_tags() {
			$sql = 'SELECT * FROM corporation_meta WHERE meta_key="tag" group by meta_value LIMIT 10';
			$result = $this->db->query($sql)->result_array();
			return $result;
		}
	}
