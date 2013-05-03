<script>
	window.onload = copro_m_tab;
	CO_ID = <?=$info['id'] ?>
</script>
<h4 class="title_01 title_02"><?=anchor('corporation/profile/' . $info['id'], '返回' . $info['name'] . '首页') ?></h2>
	<div id="main">
		<div class="search_item">
		<ul>
			<li class="sd01" id="coo-01">
				<a href="#" id="active">设置协会信息&nbsp;</a>
			</li>
			<li class="sd02" id="coo-02">
				<a href="#">管理协会成员&nbsp;(<?=$members_num ?>)</a>
			</li>
			<li class="sd02" id="coo-03">
				<a href="#">设置协会头像&nbsp;</a>
			</li>
		</ul>
		</div>
		<div id="feeds_container" class="feeds"></div>
			<div id="coo_01">
				<form class="form">
				<span><label>协会名称：</label>
					<?=$info['name'] ?>
				</span>
				<span><label>所在学校：</label><?=$info['school'][0]['name'] ?></span>
				<span ><label>协会简介：</label>
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
									<?=form_textarea(array('name' => 'comment', 'value' => $info['comment'])) ?>
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
				</span>
				<p class="li_c">
					<?=form_hidden('setting', 'info') ?>
					<?=form_submit('submit', '保存','class="pub_button btn_11"') ?></p>
				</form>
			</div>
			<div id="coo_02" class="hidden">
				<ul id="manage">
					<li>
						<?=anchor('personal/profile/' . $info['user'][0]['id'], '<img src="'. avatar_url($info['user'][0]['avatar']) .'" >','class="a-img"') ?>
						<p id="manager_01">	
							<span>社长</span><br />
							<?=anchor('personal/profile/' . $info['user'][0]['id'], $info['user'][0]['name'],'class="head_pic"') ?>
						</p>
					</li>
					<? if($admins_num > 0): ?>
						<? foreach($admins as $admin): ?>
						<li>
							<?=anchor('personal/profile/' . $admin['id'], '<img src="'. avatar_url($admin['avatar']) .'" >','class="a-img"') ?>
							<p id="manager_01">	
								<span>管理员</span><br />
								<?=anchor('personal/profile/' . $admin['id'], $admin['name'],'class="head_pic"') ?>
							</p>
						</li>
						<? endforeach ?>
					<? endif ?>
				</ul>
				<ul id="member">
					<? if($members_num > 0): ?>
						<? foreach($members as $member): ?>
							<li>
								<?=anchor('personal/profile/' . $member['id'], '<img src="'. avatar_url($member['avatar']) .'" >','class="a-img"') ?>
								<div class="operate">
								<p><?=anchor('personal/profile/' . $member['id'], $member['name'],'class="head_pic"') ?></p>	
								<p>	
									<span>
									<?=form_button('remove_member', '移除', 'member_id="'.$member['id'].'"') ?>
									</span>
								</p>	
								</div>
							</li>
						<? endforeach ?>
					<? endif ?>
				</ul>
			</div>
			
			<div id="coo_03" class="hidden">
				<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
				<?=form_open_multipart('corporation/setting/' . $info['id']) ?>
				
				<span href="" class="btn-blue">
					浏览
					<?=form_upload('userfile') ?>
				</span>
				<?=form_hidden('setting', 'avatar') ?>
				<?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
				<?=form_close() ?>
				
				<h4 class="set_title">当前头像</h4>
				<img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" />
			</div>
		</div>