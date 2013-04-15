<!-- <div id="header">
	<div id="head">
		<div class="left" id="head_nav">
			
			<?=anchor('', '<img width="57" height="57" src="'.base_url('resource/img/plusplus_03.png').'">', 'id="logo_img"') ?>
			<?=anchor('', '首页', '') ?><?=anchor('personal', '个人主页', '') . anchor('corporation', '社团之家', '')?>
		</div>
		<span class="search left">
				<?=form_open('search','id="searchform"') ?>
				<?=form_hidden('offset', 0) ?>
				<?=form_hidden('user', 1) ?>
				<?=form_hidden('corporation', 1) ?>
				<?=form_hidden('activity', 1) ?>
				<?=form_input(array('id' => 'nav_search_content', 'maxlength' => 50, 'class' => 'keywords', 'name' => 'keywords', 'placeholder' => '社团/个人/活动')) ?>
				<?=form_submit('submit', '', 'class="button" id="nav_search_submit"') ?>
	            <?=form_close() ?>
			</span>
		<div class="right right_nav">
			<? if($this->session->userdata('type') != 'guest'): ?>
			<div class="setting">
				<?=anchor('notify?type=message', '通知', '') ?>
				<ul class="drop_box" >
					<li><a id="letter_notify" href="<?=site_url('notify?type=letter') ?>">站内信</a></li>
					<li><a id="request_notify" href="<?=site_url('notify?type=request') ?>">请求</a></li>
					<li><a id="message_notify" href="<?=site_url('notify?type=message') ?>">消息</a></li>
				</ul>
			</div>
			<div class="setting">
				<?=anchor('personal/setting', '设置', '') ?>
				<ul class="drop_box drop_box2" >
					<li><a href="<?=site_url('personal/setting#info') ?>" >资料修改</a></li>
					<li><a href="<?=site_url('personal/setting#avatar') ?>" >头像修改</a></li>
					<li><a href="<?=site_url('personal/setting#account') ?>" >账户设置</a></li>
					<li><a href="<?=site_url('personal/setting#privacy') ?>" >隐私设置</a></li>
				</ul>
			</div>
				<?=anchor('index/logout', '退出') ?>
			<? else: ?>
				<?=anchor('index/login', '登录') ?>
				<?=anchor('index/regist', '注册') ?>
			<? endif ?>
		</div>			
	</div>
</div> -->
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="/">加加社团</a>
          <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li class="active"><a href="#">首页</a></li>
                      <li><?=anchor('personal', '个人主页', '') ?></li>
                      <li><a href="found.html">社团之家</a></li>
                      <li><a href="#">活动之家</a></li>
                    </ul>
                    <form class="navbar-search pull-left" action="">
                      <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                    
                    <ul class="nav pull-right">
                    							<? if($this->session->userdata('type') != 'guest'): ?>
                      <li class="dropdown">
                        <a href="http://127.0.0.1:8888/#" class="dropdown-toggle" data-toggle="dropdown">通知 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?=site_url('notify?type=letter') ?>">站内信</a></li>
                          <li><a href="<?=site_url('notify?type=request') ?>">请求</a></li>
                          <li><a href="<?=site_url('notify?type=message') ?>">消息</a></li>
                        </ul>
                      </li>
                      <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a href="###" class="dropdown-toggle" data-toggle="dropdown">帐户 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?=site_url('personal/setting#account') ?>">帐户设置</a></li>
                          <li class="divider"></li>
                          <li><?=anchor('index/logout', '退出') ?></li>
                        </ul>
                      </li>
                      <? else: ?>
                      <div class="vm">
                            <!-- <a type="button" class="btnDefault" id="lgoginBtn" href="logIn.html">登陆</a>
                            <a type="button" class="btnDefault btnBlue" id="registBtn" href="signin.html">注册</a> -->
                            <?=anchor('index/login', '登录', 'class="btnDefault"', 'id="lgoginBtn"') ?>
							<?=anchor('index/regist', '注册','class="btnDefault btnBlue"',' id="registBtn"') ?>
                        </div>
                     <? endif ?>
                    </ul>
                  </div><!-- /.nav-collapse -->
        </div>
      </div>
    </div>