<?php

// 错误提示视图方法
if ( ! function_exists('static_view')) {
	function static_view($message = '抱歉，您访问的页面不存在', $title = '页面未找到', $url = '') {
		$CI =& get_instance();
		$data['main_content'] = 'static_view';
		$data['message'] = $message;
		$data['title'] = $title;
		$data['url'] = $url;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

// 自动跳转视图方法
if( ! function_exists('jump_view')) {
	function jump_view($message, $url = '', $title = 'forward') {
		$CI =& get_instance();
		$data['main_content'] = 'jump_view';
		$data['message'] = $message;
		$data['url'] = $url ? $url : site_url();
		$data['title'] = $title;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

// 生成头像链接方法
if( ! function_exists('avatar_url')) {
	/**
	 * @param string from db
	 * @param string ting or big
	 */
	function avatar_url($avatar = 'default.jpg', $obj = 'personal', $mode = 'tiny') {
		$CI =& get_instance();
		return base_url($CI->config->item($obj . '_avatar_path') . $mode . '/' . $avatar);
	}
}

if( ! function_exists('card_cap')) {
	/**
	 * @param string from db
	 * @param string ting or big
	 */
	function card_cap($filename, $obj = 'corporation') {
		$CI =& get_instance();
		return base_url($CI->config->item($obj . '_request') . $filename);
	}
}

// 统计满足条件的表记录总数
if(! function_exists('count_rows')) {
	function count_rows($table, $where = array()) {
		$CI = &get_instance();
		if ($where) {
			foreach ($where as $key => $value) {
				if (is_array($value)) {
					$CI->db->where_in($key, $value);
				} else {
					$CI->db->where($key, $value);
				}
			}
			return $CI->db->get($table)->num_rows;
		} else {
			//若无限制条件则返回表的总行数
			return $CI->db->count_all($table);
		}
	}
}

// 将时间戳转换为中国时间方法
if(! function_exists('jdate')) {
	function jdate($time, $with_hour = TRUE) {
		if(is_numeric($time) && $with_hour)
			return date('Y年m月d日 H:i:s', $time);
		elseif(is_numeric($time) && !$with_hour)
			return date('Y年m月d日', $time);
		else
			return '';
	}
}

//将数组转换为json格式，兼容中文
/*********************** jia_json start************************/

if(! function_exists('jia_json')) {
	function jia_json($array) {
	    arrayRecursive($array, 'urlencode', true);
	    $json = json_encode($array);
	    return urldecode($json);
	}
}

function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
}
/***************** jia_json end ***************************/
if(! function_exists('cover_url')) {
	function cover_url($cover_id) {
		if(!$cover_id || !is_numeric($cover_id))
			return base_url('data/album/cover.png');
		$CI = &get_instance();
		$cover = $CI->db->get_where('photo', array('id' => $cover_id))->result_array();
		if($cover) {
			return base_url($cover[0]['thumb']);
		}
		return base_url('data/album/cover.png');
	}
}

if(! function_exists('tags_filter')) {
	function tags_filter($item) {
		if(!$item || trim($item) == '') 
			return false; 
		else 
			return true;
	}
}

// 打印变量辅助函数
if(! function_exists('print_vars')) {
	function print_vars() {
		$vars = func_get_args();
		echo '<pre>';
		foreach ($vars as $var) {
			var_dump($var);
		}
		echo '</pre>';
	}
}

if(! function_exists('mkdirs')) {
	function mkdirs($dir) {
		if(!is_dir($dir)) {
			if(!mkdirs(dirname($dir))){
				return false;
			}
			if(!mkdir($dir,0755)) {
				return false;
			}
		}
		return true;
	}
}

if(! function_exists('convert_emoji')) {
	function convert_emoji($str) {
		$CI =& get_instance();
		$CI->config->load('emoji');
		foreach($CI->config->item('emoji') as $word => $img) {
			$pattern = '/(\['.$word.'\])/';
			$replacement = '<img src="'.$CI->config->item('emoji_path').$img.'" alt="'.$word.'" title="'.$word.'">';
			$str = preg_replace($pattern, $replacement, $str);
		}
		return $str;
	}
}

if(! function_exists('time2duration')) {
    function time2duration($time_stamp) {
        $time = time();
        $duration = $time - $time_stamp;
        if(($duration < 0))
            return '时间穿越了 -.-';
        if( $duration < 30)
            return $duration . ' 秒前';
        if( $duration < 60)
            return '半分钟前';
        if( $duration < 3600)
            return intval($duration/60) . ' 分钟前';
        if( $duration < 24*3600)
            return intval($duration/3600) . ' 小时前';
        if( $duration < 365*24*3600)
            return intval($duration/(24*3600)) . ' 天前';
        return date('Y-m-d H:i:s', $time_stamp);
    }
}
