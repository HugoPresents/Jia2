<?php
	class Notify_model extends CI_Model {
		public $jiadb;
		public $notify_type;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('notify');
			$this->notify_type = array(
				'message' => $this->config->item('entity_type_message'),
				'letter' => $this->config->item('entity_type_letter'),
				'request' => $this->config->item('entity_type_request')
			);
		}
		
		function get_info($notify_id) {
			$this->jiadb->_table = 'notify';
			$notify = $this->jiadb->fetchAll(array('id' => $notify_id));
			if($notify) {
				return $notify[0];
			} else {
				return FALSE;
			}
		}
		
		function fetch(array $where, array $limit = array(10, 0)) {
			$where['type_id'] = $this->notify_type[$where['type']];
			$type = $where['type'];
			unset($where['type']);
			$join = array(
				'user' => array('user_id', 'id')
			);
			if($type == 'letter' && empty($where['receiver_id'])) {
				$join['user'] = array(
					'receiver_id', 'id'
				);
			}
			return $this->jiadb->fetchJoin($where, $join, array('time' => 'DESC'), $limit);
		}
		
		function insert(array $notify) {
			$notify['type_id'] = $this->notify_type[$notify['type']];
			unset($notify['type']);
			$this->db->insert('notify', $notify);
		}
		
		// 将消息标记已读
		function mark_as_read($notify_id) {
			if(is_array($notify_id)) {
				$this->db->where_in('id', $notify_id);
				$this->db->update('notify', array('status' => 0));
			} else {
				$this->db->where('id', $notify_id);
				$this->db->update('notify', array('status' => 0));
			}
		}
		
		function delete($notify_id) {
			// do nothing here
			$this->db->where('id', $notify_id);
			$this->db->delete('notify');
		}
	}