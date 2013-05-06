<?php
	class User_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			$this->jiadb = new Jiadb('user');
			parent::__construct();
		}
		
		function login($param, $pass) {
			$join = array(
				'entity_type' => array('type_id', 'id')
			);
			$info = $this->get_info($param, $join);
			if(!$info) {
				return 1;
			}
			if($info['pass'] != $pass) {
				return 2;
			}
			return $info;
		}
		
		function insert($email, $name, $pass) {
			$info = $this->get_info((string)$email);
			if($info) {
				return 1;
			}
			$user = array(
				'email' => $email,
				'name' => $name,
				'pass' => md5($pass),
				'regist_time' => time(),
				'type_id' => $this->config->item('entity_type_register')
				
			);
			$this->db->insert('user', $user);
			$user_id = $this->db->insert_id();
			$this->_initialize($user_id);
			$join = array(
				'entity_type' => array('type_id', 'id')
			);
			$info = $this->get_info($user_id, $join);
			return $info;
		}
		
		//初始化用户数据
		function _initialize($user_id) {
			// 权限初始化
			$post_access = Access_factory::get_access('post');
			$post_access->init($user_id);
			$comment_auth = Access_factory::get_access('comment');
			$comment_auth->init($user_id, 'personal');
			// 相册初始化
			$this->load->model('Album_model');
			$album = array(
				'owner_id' => $user_id,
				'type' => 'personal',
				'name' => '默认相册',
				'comment' => '默认相册'
			);
			$this->Album_model->insert($album);
		}
		
		function update($where = array(), $row = array()) {
			$this->db->where($where);
			$this->db->update('user', $row);
		}
		
		/**
		 * @param string or int(email address or user_id)
		 * @param array like following:
		 * $join = array(
		 * 		'joined_table1' => array('current_table_field', 'joined_table1_field'),
		 * 		'joined_table2' => array('current_table_field', 'joined_table2_field')
		 * )
		 * 
		 * such as $join = array(
		 * 		'user_type' => array('type_id', 'id')
		 * )
		 */ 
		function get_info($param, $join = array()) {
			$result = '';
			$this->jiadb->_table = 'user';
			$field = 'id';
			if(is_array($param)) {
				if(is_int($param[0])) {
					$field = 'id';
				} elseif(is_string($param[0])) {
					$field = 'email';
				}
			} else {
				if(is_numeric($param)) {
					$field = 'id';
				} elseif(is_string($param)) {
					$field = 'email';
				}
			}
			$user = $this->jiadb->fetchJoin(array($field => $param), $join);
			if($user) {
				$user = $user[0];
			}
			return $user;
		}
		
		/*
		// 获取用户变化值 
		function get_meta($meta_key, $meta_table = '') {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_value' => $user_id
			);
			if($meta_table) {
				$where['meta_table'] = $meta_table;
			}
			return $this->jiadb->fetchMeta($return, $where);
		}
		 */
		
		// 获取粉丝
		function get_followers($user_id, $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => 'user',
				'meta_value' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where, $order);
		}
		
		// 获取关注
		/**
		 * @param int 
		 * @param string user or corporation or activity
		 */
		function get_following($user_id, $meta_table = 'user', $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'meta_value';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => $meta_table,
				'user_id' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		// 获取关注的社团
		function get_following_co($user_id, $meta_table = 'corporation', $order = array()) {
			$this->jiadb->_table = 'user';
			$return = 'meta_value';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => $meta_table,
				'user_id' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function get_join_co($user_id, $meta_table = 'user', $order = array()) {
			$this->jiadb->_table = 'corporation';
			$return = 'corporation_id';
			$where = array(
				'meta_key' => 'member',
				'meta_table' => $meta_table,
				'meta_value' => $user_id
			);
			$corporations =  $this->jiadb->fetchMeta($return, $where);
			// with master corporation ?
			/*
			$ma_co = $this->jiadb->fetchAll(array('user_id' => $user_id));
			if($ma_co) {
				$corporations[] = $ma_co[0]['id'];
			}
			*/
			return $corporations;
		}
		
		function get_master_co($user_id) {
			$this->jiadb->_table = 'corporation';
            $join = array(
                'user' => array('user_id', 'id'),
                'school' => array('school_id', 'id')
            );
			$corporations = $this->jiadb->fetchJoin(array('user_id' => $user_id), $join);
			return $corporations;
		}
		
		function get_blockers($user_id, $order = array()) {
			$this->jiadb->_table = 'user';
			$reutrn = 'meta_value';
			$where = array(
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'user_id' => $user_id
			);
		}
		
		/**
		 * @param int follower_id
		 * @param int following_id
		 */
		function follow($user_id, $following_id, $unfollow = FALSE) {
		    $time = time();
			$meta_array = array(
				'user_id' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'follower',
				'meta_value' => $following_id,
			);
			if($unfollow) {
				$this->db->where($meta_array);
				$this->db->delete('user_meta', $meta_array);
				return TRUE;
			} else {
				// 被关注者的黑名单
				$following_blockers = $this->get_blockers($following_id);
				// 关注者的黑名单
				$follower_blockers = $this->get_blockers($user_id);
				// 需要满足 关注者不在被关注者的黑名单内同时 被关注者也不在关注者的黑名单内
				if($following_blockers && (in_array($user_id, $following_blockers) || in_array($following_id, $follower_blockers))) {
					return FALSE;
				} else {
				    $meta_array['add_time'] = $time;
					$this->insert_meta($meta_array);
                    // 发条通知
                    $this->load->model('Notify_model');
                    $notify = array(
                        'user_id' => $this->user_id,
                        'receiver_id' => $following_id,
                        'content' => '关注了你',
                        'time' => $time,
                        'type' => 'message'
                    );
                    $this->Notify_model->insert($notify);
					return TRUE;
				}
			}
			
		}
		
		/**
		 * @param int master_id
		 * @param int blocker_id
		 */
		function block($user_id, $blocker_id, $unblock = FALSE) {
			$meta_array = array(
				'user_id' => $user_id,
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'meta_value' => $blocker_id,
			);
			if($unblock) {
				$this->db->where($meta_array);
				$this->db->delete('user_meta', $meta_array);
			} else {
				// 移除关注
				$delete_following = array(
					'user_id' => $user_id,
					'meta_key' => 'follower',
					'meta_table' => 'user',
					'meta_value' => $blocker_id
				);
				
				// 移除粉丝
				$delete_follower = array(
					'user_id' => $blocker_id,
					'meta_key' => 'follower',
					'meta_table' => 'user',
					'meta_value' => $user_id
				);
				$this->delete_meta('user_meta', $delete_follower);
				$this->delete_meta('user_meta', $delete_following);
                $meta_array['add_time'] = time();
				$this->insert_meta('usermeta', $meta_array);
			}
		}
		
		function insert_meta(array $meta_array) {
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($meta_array)) {
				return;
			} else {
				$this->db->insert('user_meta', $meta_array);
				return;
			}
		}
		
		function delete_meta(array $meta_array) {
			$this->db->where($meta_array);
			$this->db->delete('user_meta');
		}
	}
