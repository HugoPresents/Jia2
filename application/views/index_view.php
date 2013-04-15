<!-- <script>
	window.onload =posttab;
</script> -->

<!-- <div id="main">
<div class="post_top">
	<form id="pub">
		<div id="pub_text">
			<table class="Textarea">
			<tbody>
				<tr>
					<td id="Textarea-tl"></td>
					<td id="Textarea-tm"></td>
					<td id="Textarea-tr"></td>
				</tr>
				<tr>
					<td id="Textarea-ml"></td>
					<td id="Textarea-mm" class="">
						<div>
							<?=form_textarea(array('name' => 'post_content', 'id' => "post_content")) ?>
						</div>
					</td>
					<td id="Textarea-mr"></td>
				</tr>
				<tr>
					<td id="Textarea-bl"></td>
					<td id="Textarea-bm"></td>
					<td id="Textarea-br"></td>
				</tr>
			</tbody>
		</table>
		</div>
		<?=form_button('post', '发布', 'class="pub_button pub_btn" disabled="disabled"') ?>
	</form>
</div>
<div class="post_main">
				<div class="search_item"><ul>
					<li class="sd01" id="po1">
						<a href="#" id="active">好友动态</a>
					</li>
					<li class="sd02" id="po2">
						<a href="#">社团动态</a>
					</li>
				</ul></div>
	</div>
	<div id="feeds_container" class="feeds">
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
	</div>
</div> -->
    <header class="subhead">
      <div class="container">
      <!--<h1>加加社团网</h1>-->
      <p class="lead">分享校园生活！感动你我！</p>
    </div>
    </header>
    <div class="container mainBody">
        <div class="main">
          <div class="main_top"></div>

          <div class="input_wrap">
            <textarea rows="3" class="C_input" id="pup_textarea"></textarea>
            <div class="word_num">1 / 140</div>
            <div class="toolbar clearfix">
                <a href="javascript:;" class="emot_btn"><i class="ico ico_emot"></i>表情</a>
                <button name="post" type="button" class="pub_btn fr" id="pup_post">发布</button>
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
              <a title="全部" href="javascript:void(0);" id="filter_all" class="first selected">全部</a>
              <a title="社团动态" href="javascript:void(0);" id="filter_asso" class="">社团动态</a>
              <a title="好友动态" href="javascript:void(0);" id="filter_friend" class="last">好友动态</a>
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