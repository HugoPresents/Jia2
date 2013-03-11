<script>
window.onload = function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["t1", "t2", "t3"], ["a1", "a2", "a3"], "sd1", "sd2");
}
</script>

<div class="container gs_con">
	<div class="content_top">
		<div  class="tab" id="guest_tab"> 
			<ul>
				<li class="sd1" id="t1">
					<a href="#">全部</a>
				</li><li>|</li>
				<li class="sd2" id="t2">
					<a href="#">社团</a>
				</li><li>|</li>
				<li class="sd2" id="t3">
					<a href="#">活动</a>
				</li>
			</ul>
		</div>
		<div class="clear"></div>
		<div  class="tab_cont_box content_1">
			<div id="a1">
				<ul>
					<li class="box_1">
						<a><img src="<?=site_url('source/img/user02.jpg') ?>"/></a>
						<h3><a>社么社团的</a></h3>
						<p>。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
					<li class="box_1">
						<a><img  src="<?=site_url('source/img/user02.jpg') ?>"/></a>
						<h3><a>什么活动</a></h3>
						<p>。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
					<li class="box_1">
						<a><img src="<?=site_url('source/img/user02.jpg') ?>"/></a>
						<h3><a>社么社团的</a></h3>
						<p>是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
					<li class="box_1">
						<a><img  src="<?=site_url('source/img/user02.jpg') ?>"/></a>
						<h3><a>什么活动</a></h3>
						<p>是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
				</ul>
			</div>
			<div id="a2"  class="hidden">
				<ul>
					<li class="box_1">
						<a><img /></a>
						<h3><a>什么社团的</a></h3>
						<p>是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
				</ul>
			</div>
			<div id="a3"  class="hidden">
				<ul>
					<li class="box_1">
						<a><img /></a>
						<h3><a>什么活动</a></h3>
						<p>是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
 </div>