<script>
	window.onload =posttab;
</script>
<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
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
		<?=form_button('post', '发布', 'class="pub_button pub_btn"') ?>
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
</div>
