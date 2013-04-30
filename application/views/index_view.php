<!-- <script>
	window.onload =posttab;
</script> -->
<header class="subhead">
      <div class="container">
      <p class="lead">分享校园生活！感动你我！</p>
    </div>
    </header>
    <div class="container mainBody">
        <div class="main">
          <div class="main_top"></div>

          <div class="input_wrap">
<!--            <textarea rows="3" class="C_input" id="pup_textarea"></textarea>-->
            <?=form_textarea(array('rows' => '3','name' => 'post_content','class' => "C_input", 'id' => "post_content")) ?>
            <div class="word_num">1 / 140</div>
            <div class="toolbar clearfix">
                <a href="javascript:;" class="emot_btn"><i class="ico ico_emot"></i>表情</a>
<!--                <button name="post" type="button" class="pub_btn fr" id="pup_post">发布</button>-->
                <?=form_button('post', '发布', 'class="pub_btn fr" disabled="disabled"') ?>
            </div>
            <div class="emotion_wrap hide">
              <div class="emotion_bd">
              </div>
              <span class="arr">
                <span class="arr_out"></span>
                <span class="arr_in"></span>
              </span>
            </div>
          </div>

          <!-- feed_switcher begin-->
          <div class="mt20 clearfix feed_switcher">
              <a title="好友动态" href="javascript:void(0);" id="filter_friend" class="last">好友动态</a>
              <a title="社团动态" href="javascript:void(0);" id="filter_asso" class="">社团动态</a>
          </div><!-- feed_switcher end-->

          <!-- feeds begin -->
          <div class="feeds">
            <div class="loading">
                <img src="img/loading.gif"/><span>正在加载，请稍候...</span>
            </div>
            <ul id="feed_1">
				<?=$this->load->view('post/user_posts_view') ?>
				<div class="loading"><img src="<?=base_url('resource/img/loading.gif') ?>"></img></div>
				<?=form_button('request_more', '加载更多', 'page="1" po_type="personal" class="pub_button"') ?>
			</ul>
				
			<ul id="feed_2" class="hidden">
				<?=$this->load->view('post/co_posts_view') ?>
				<div class="loading"><img src="<?=base_url('resource/img/loading.gif') ?>"></img></div>
				<?=form_button('request_more', '加载更多', 'page="1" po_type="activity" class="pub_button"') ?>
			</ul>


            
            
          </div><!-- feeds end -->
        </div>
        
        <? $this->load->view('includes/slider_bar_view') ?>
        
     </div>