<div class="siderbar">
  <div class="user_head_box sidebar_nav">
  	<?=anchor('personal/profile/' . $info['id'], '<img src="'. avatar_url($info['avatar'], 'personal', 'big') .'" >','class="user_head"') ?>
    <a href="<?=site_url('personal/profile/' . $post['user'][0]['id']) ?>" class="user_name"><?=$info['name'] ?></a>
  </div>
  <div class="sidebar_nav">
    <a class="a_sty_01" href="<?=site_url('blog/post')?>"><i class="ico ico_dairy"></i>写日志</a>
    <a class="a_sty_01" href="<?=site_url('album/index')?>"><i class="ico ico_photo"></i>传照片</a>
    <a class="a_sty_01" href="<?=site_url('corporation/request_add')?>"><i class="ico ico_asso"></i>创建社团</a>
  </div>
  <? $this->load->view('includes/slider_bar_corporations_view') ?>
</div>