<?php
	class crumb {
		private $_separator;
		private $_content;
		private $CI;
		public function __construct($params = array()) {
			if(array_key_exists('separator', $params))
				$this->_separator = $params['separator'];
			else 
				$this->_separator = ' > ';
			$this->CI = &get_instance();
			$this->append('首页', '/');
		}
		
		public function append($name, $url = '') {
			
			if($url == '')
				$url = $this->CI->uri->uri_string();
			$this->_content[] = array(
				'name' => $name,
				'url' => $url
			);
		}
		
		public function output() {
			$str = '';
			foreach ($this->_content as $row) {
				if($this->CI->uri->uri_string() == $row['url']) {
					$str .= $row['name'];
				} else {
					$str .= '<a href="'.site_url($row['url']).'">'.$row['name'].'</a>'.$this->_separator;
				}
			}
			$this->revert();
			return $str;
		}
		
		public function set_separator($separator) {
			$this->_separator = $separator;
		}
		
		public function revert() {
			$this->_content = array();
			$this->append('首页', site_url());
		}
	}