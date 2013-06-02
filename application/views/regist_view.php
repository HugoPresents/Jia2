<?
/*
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
         	<?=anchor('', '同意以下协议并') ?>
            <?=form_submit('submit', '注册', 'class="button"') ?>
         </div>  
    	<?=form_close() ?>
	</div>
    </div>
*/
?>
<div class="login_bd">
    <div class="mainBody">
        <div class="container">
            <?=form_open('index/do_regist','class="form_signin"', 'id = "reg"') ?>
                <h2 class="signin_heading">加加-校园社团网</h2>
                <div class="controls">
                <input type="text" class="input-block-level" name="email" id="email" placeholder="邮箱地址">
                <span class="alert" id="email_prompt"></span>
                </div>
                 <div class="controls">
                <input type="text" class="input-block-level" name="name" id="name" placeholder="用户名">
                <span class="alert" id="name_prompt"></span>
                </div>
                 <div class="controls">
                <input type="password" class="input-block-level" name="pass" id="pass" placeholder="密码">
                <span class="alert" id="pass_prompt"></span>
                </div>
                <?=anchor(site_url('index/regist'), '注册','class="btn btn-primary" id="regist"') ?> </span>
                <span class="vline">|</span><span><?=anchor(site_url('index/login'), '登录') ?> </span>
                <span class="vline">|</span><span><?=anchor(site_url(), '游客登录') ?> </span>
            </form>
        </div>
    </div>
</div>