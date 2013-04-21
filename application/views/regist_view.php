<div class="login_bg re_bg">
	<div id="regist_logo"></div>
	<div class="login register">
    <div class="title"></div>
    <?=form_open('index/do_regist', 'id = "reg"') ?>
    	<div class="field">
            <label >邮&nbsp; 箱：</label>
            <input type="text" name="email" id="email" value="" maxlength="32" tabindex="1" />
            <span class="prompt" id="email_prompt"></span>
        </div>
        <div class="field">
            <label>姓&nbsp; 名：</label>
            <span >
             <input type="text" name="name" id="name" maxlength="20" tabindex="2" />
            </span>
            <span class="prompt" id="name_prompt"></span>            
         </div>
         <div class="field">
            <label >密&nbsp; 码：</label>
            <span >
             <input type="password" name="pass" id="pass" maxlength="20" tabindex="2" />
            </span>
            <span class="prompt" id="pass_prompt"></span>       
         </div>
         <div class="field_below">
         	<?=anchor('/index/agreement', '同意以下协议并') ?>
            <?=form_submit('submit', '注册', 'class="button"') ?><br>
            已有账号？<?=anchor('/index/login', '登录') ?>
         </div>  
    	<?=form_close() ?>
	</div>
    </div>
