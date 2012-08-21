<?php
/**
 * 面包屑导航类
 * @param $_separator string html输出分隔符
 * @param $_content array  存导航内容的数组
 * @param $CI obj 引用CI超类
 */
	class crumb {
		private $_separator;
		private $_content;
		private $CI;
		
		// 为了适应CI加载类库的方式，故使用这种方法传递参数 分隔符默认为 ' < '
		public function __construct($params = array()) {
			if(array_key_exists('separator', $params))
				$this->_separator = $params['separator'];
			else 
				$this->_separator = ' > ';
			$this->CI = &get_instance();
			// 构造时加入首页导航
			$this->append('首页', '/');
		}
		
		/**
		 * @param string 导航名
		 * @param string 导航 uri string
		 * 若uri为空则指定为当前uri
		 */
		public function append($name, $uri = '') {
			if($uri == '')
				$uri = $this->CI->uri->uri_string();
			$this->_content[] = array(
				'name' => $name,
				'url' => $uri
			);
		}
		
		/**
		 * 输出导航将uri补全为完整路径，输出后清空对象的导航内容
		 * @return string
		 */
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
		
		/**
		 * @param $separator string 设置分隔符
		 */
		public function set_separator($separator) {
			$this->_separator = $separator;
		}
		
		/**
		 * 还原方法 恢复对象至刚构造时状态
		 */
		public function revert() {
			$this->_content = array();
			$this->append('首页', site_url());
		}
	}