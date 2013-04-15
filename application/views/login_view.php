<!-- <div class="login_bg">
	<div id="login_logo"></div>
		<div class="login">
		<div class="title">
		</div>
		<?=form_open('index/do_login', 'id="login_form"') ?>
			<div class="field">
				<label for="email">邮&nbsp; 箱：</label>
				<input type="text" name="email" placeholder="demo" id="email" maxlength="32" tabindex="1" />
				<span class="prompt" id="email_prompt"></span>
			</div>
			<div class="field">
				<label>密&nbsp; 码：</label>
				<span>
					<input type="password" name="pass" placeholder="demo" id="pass" maxlength="20" tabindex="2" />
				</span>
				<span class="prompt" id="pass_prompt"></span>
			</div>
			
			<div class="field_below remmber">
				<input type="checkbox" name="remember" value="1" checked="checked"><span>记住我</span>
			</div>
			<div class="field_below">
				<?=form_submit('submit', '登录', 'class="button"') ?>
				<span>|</span><span><?=anchor(site_url('index/regist'), '用户注册') ?> </span>
				<span>|</span><span><?=anchor(site_url(), '游客登录') ?> </span>
			</div>
		<?=form_close() ?>
	</div>
</div> -->
<div class="login_bd">
    <div class="topbar"></div>
    <div class="mainBody">
        <div class="container">
            <?=form_open('index/do_login','class="form_signin"', 'id="login_form"') ?>
                <h2 class="signin_heading">加加-校园社团网</h2>
                <input type="text" class="input-block-level" name="email"  id="email" placeholder="Email address">
                <input type="password" class="input-block-level" name="pass" id="pass" placeholder="Password">
                <label class="checkbox">
                    <input type="checkbox" name="remember" checked="checked" value="remember-me"> 记住我
                </label>
                <button class="btn btn-large btn-primary" type="submit">登录</button>
            <?=form_close() ?>
        </div>
    </div>
</div>