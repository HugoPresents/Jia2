<div class="login_bg">
				<div class="login">
				<div class="title">
					Jia2网logo_<span>登录</span>
				</div>
				<?=form_open('index/do_login') ?>
					<div class="field">
						<label for="email">邮&nbsp; 箱：</label>
						<input type="text" name="email" id="email" maxlength="32" tabindex="1" />
						<span class="prompt" id="email_prompt"></span>
					</div>
					<div class="field">
						<label>密&nbsp; 码：</label>
						<span>
							<input type="password" name="pass" id="pass" maxlength="20" tabindex="2" />
						</span>
						<span class="prompt" id="pass_prompt"></span>
					</div>
					
					<div class="field_below remmber">
						<input type="checkbox" name="remember" value="1"><span>记住我</span>
					</div>
					<div class="field_below">
						<?=form_submit('submit', '登录', 'class="button"') ?>
						<span>|</span><span><?=anchor(site_url('index/regist'), '用户注册') ?> </span>
						<span>|</span><span><?=anchor(site_url(), '游客登录') ?> </span>
					</div>
				<?=form_close() ?>
			</div>
	</div>