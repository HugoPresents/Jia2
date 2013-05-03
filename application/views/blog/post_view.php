<script>
$(function(){
	$(".Checked").toggle(function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		},function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		})
	$(".Checkbox").toggle(function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		},function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		})
})
</script> 
<div class="mainContainer">
    <div class="container whiteBg">
<h4 class="title_01 title_02"><span>发布日志</span><?=$crumb ?></h4>
<div class="main_02">
	<div id="post_blog">
		<p><?=form_open() ?> </p>
	    <div id="blog_write" class="form-horizontal">
	    	<div class="control-group">
			    <label class="control-label">标&nbsp;题：</label>
			    <div class="controls">
			      <?=form_input('title') ?>
			    </div>
			  </div>
			<div class="control-group">
			    <label class="control-label">标&nbsp;签：</label>
			    <div class="controls">
			      <?=form_input('tags') ?>
			      <span class="info_notice">多个标签请用空格隔开</span>
			    </div>
			  </div>			  		
		</div>
		<?=$this->load->view('blog/editor') ?>
		<p class="li_d p_buttons">
			<?=anchor('blog', '取消', 'class="btn fl"') ?>
			<?=form_submit('submit', '直接发布','class="btn btn-primary fr"') ?>
			<?=form_submit('draft', '保存到草稿','class="btn btn-info mr10 fr"') ?>
		</p>
	</div>
</div>
<div class="right_handler">
	<h4 class="set_title">日志选项</h4>
	<p class="clearfix">
		<span class="CheckboxWrapper Checkbox">
			<input type="checkbox" name="order" value="1" class="chbox"/>
		</span>
		<span class="Checkitem">置顶</span>
	</p>
	<h4 class="set_title">可见性</h4>
	<p><label><?=form_radio(array('name' => 'status', 'value' => 'privary')) ?> 保密 (仅自己可见)</label></p>
	<p><label><?=form_radio(array('name' => 'status', 'value' => 'public', 'checked' => TRUE)) ?> 公开</label></p>
	<?=form_close() ?>
</div>
</div></div>