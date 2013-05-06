<?php
	class Jiadb {
		/**
		 * @var string table's name
		 * @access pulic
		 */
		public $_table;
		/**
		 * @var object
		 * @access public
		 */
		public $CI;
		/**
		 * @param string table's name
		 */
		function __construct($_table = '') {
			$this->CI =& get_instance();
			$this->_table = $_table;
		}
		
		/**
		 * @param array index is table's field value is field's value 
		 * @param array 
		 * @param array
		 * @return array
		 */ 
		function fetchAll($where = array(), $order = array(), $limit = array()) {
			if($where) {
				foreach ($where as $key => $value) {
					if(is_array($value)) {
						$this->CI->db->where_in($key, $value);
					} else {
						$this->CI->db->where($key, $value);
					}
				}
			}
			if($order) {
				foreach ($order as $key => $value) {
					$this->CI->db->order_by($key, $value);
				}
			}
			if($limit) {
				if(is_array($limit)) {
					$this->CI->db->limit($limit[0], $limit[1]);
				} else {
					$this->CI->db->limit($limit);
				}
			}
			$result = $this->CI->db->get($this->_table)->result_array();
			$rows = count($result);
			if ($rows > 0) {
				return $result;
			} else {
				return FALSE;
			}
		}
		
		/**
		 * @param array
		 * @param array like following:
		 * $join = array(
		 * 		'joined_table1' => array('current_table_field', 'joined_table1_field', 'limit', 'order'),
		 * 		'joined_table2' => array('current_table_field', 'joined_table2_field', 'limit', 'order')
		 * )
		 * @param array
		 * @param array
		 */ 
		
		function fetchJoin($where = array(), $join = array(), $order = array(), $limit = array()) {
			$result = $this->fetchAll($where, $order, $limit);
			// 因为此方法内部会改变对象的_table值，需要做一个备份，后面再恢复
			$original_table = $this->_table;
			if($result && $join) {
				foreach ($join as $table => $field) {
					$limit = empty($field[2]) ? '' : $field[2];
					$order = empty($field[3]) ? '' : $field[3];
					$table = explode('.', $table);
					foreach ($result as $key => $row) {
						if(!empty($table[1]) && !empty($row[$table[0]])) {
							$this->_table = $table[1];
							foreach ($row[$table[0]] as $sub_key => $sub_row) {
								$tmp = $this->fetchAll(array($field[1] => $sub_row[$field[0]]), $order, $limit);
								if($tmp)
									$result[$key][$table[0]][$sub_key][$table[1]] = $tmp;
							}
						} elseif(!array_key_exists(1, $table)) {
							$this->_table = $table[0];
							$tmp = $this->fetchAll(array($field[1] => $row[$field[0]]), $order, $limit);
							if($tmp) {
								$result[$key][$table[0]] = $tmp;
							}
						}
					}
				}
			}
			$this->_table = $original_table;
			unset($original_table);
			return $result;	
		}
		
		
		/**
		 * @param string meta_key or meta_value and so on
		 * @param array where array
		 * @param array
		 * @param array
		 */  
		 
		 function fetchMeta($return, $where = array(), $order = array(), $limit = array()) {
		 	$meta = array();
			$original_table = $this->_table;
			$this->_table .= '_meta';
			$result = $this->fetchAll($where, $order, $limit);
			if($result) {
				foreach ($result as $row) {
					$meta[] = $row[$return];
				}
			}
			$this->_table = $original_table;
			unset($original_table);
			return $meta;
		 }
	}
