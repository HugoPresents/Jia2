<?php
	// 每页显示的信息数量
	$config['page_size'] = 10;
	// 个人头像上传相对路径
	$config['personal_avatar_path'] = 'data/avatar/personal/';
	// 个人照片上传路径
	$config['personal_album_path'] = 'data/album/personal/';
	// 社团头像上传路劲
	$config['corporation_avatar_path'] = 'data/avatar/corporation/';
	// 申请创建社团证件影印
	$config['corporation_request'] = 'data/request/corporation/';
	// 社团照片上传路径
	$config['corporation_album_path'] = 'data/avatar/corporation/';
	// 个人日志图片上传路劲
	$config['personal_blog_path'] = 'data/blog/personal/';
	// 社团日志图片上传路劲
	$config['corporation_blog_path'] = 'data/blog/corporation/';
	// 部署模式
	$config['deploy_mode'] = TRUE;
	// 相册个数限制
	$config['album_limit'] = 5;
	// 状态码
	// 和谐
	$config['status_block'] = 0;
	// 保密
	$config['status_privary'] = 1;
	//公开
	$config['status_public'] = 2;
	// 更多配置项在MY_Controller中设置