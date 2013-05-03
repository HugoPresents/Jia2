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
    <div class="topbar"></div>
    <div class="mainBody">
        <div class="container">
            <?=form_open('index/do_regist','class="form_signin"', 'id = "reg"') ?>
                <h2 class="signin_heading">加加-校园社团网</h2>
                <input type="text" class="input-block-level" name="email" id="email" placeholder="邮箱地址">
                <div class="alert" id="email_prompt"></div>
                <input type="text" class="input-block-level" name="name" id="name" placeholder="昵称">
                <div class="alert" id="name_prompt"></div>
                <input type="password" class="input-block-level" name="pass" id="pass" placeholder="密码">
                <div class="alert" id="pass_prompt"></div>
                <button class="btn btn-large btn-primary btn-relax" type="submit">注册</button>
                <?=anchor(site_url('index/regist'), '注册','class="btn btn-relax mt10"') ?> </span>
            </form>
        </div>
    </div>
</div>