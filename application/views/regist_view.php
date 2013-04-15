<!-- <div class="login_bg re_bg">
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
    </div> -->
<div class="login_bd">  
    <div class="topbar"></div>
    <div class="mainBody">
        <div class="container">
            <?=form_open('index/do_regist','class="form_signin"', 'id = "reg"') ?>
                <h2 class="signin_heading">加加-校园社团网</h2>
                <input type="text" class="input-block-level" placeholder="邮箱地址">
                <input type="text" class="input-block-level" placeholder="昵称">
                <input type="password" class="input-block-level" placeholder="密码">
                <button class="btn btn-large btn-primary" type="submit">注册</button>
            </form>
        </div>
    </div>
</div>