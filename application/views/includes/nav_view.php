<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="/">加加社团</a>
          <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav">
              <li><a href="/">首页</a></li>
              <li><?=anchor('personal', '个人主页', '') ?></li>
              <li><?=anchor('corporation', '社团之家', '')?></li>
            </ul>
            <form name="search" class="navbar-search pull-left" action="/search" id="searchform">
                <input type="text" class="search-query span2" id="nav_search_content" placeholder="用户/社团/活动" name="keywords">
                <?=form_hidden('target', 'user') ?>
                <?=form_submit('', 'Search', 'class="btn" id="nav_search_submit"') ?>
            </form>
            
            <ul class="nav pull-right">
			<? if($this->session->userdata('type') != 'guest'): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">通知 <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=site_url('notify?type=letter') ?>" id="letter_notify">站内信</a></li>
                  <li><a href="<?=site_url('notify?type=request') ?>" id="request_notify">请求</a></li>
                  <li><a href="<?=site_url('notify?type=message') ?>" id="message_notify">消息</a></li>
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
                <?=anchor('index/login', '登录', 'class="btnDefault"', 'id="lgoginBtn"') ?>
				<?=anchor('index/regist', '注册','class="btnDefault btnBlue"',' id="registBtn"') ?>
                </div>
             <? endif ?>
            </ul>
          </div><!-- /.nav-collapse -->
        </div>
      </div>
    </div>