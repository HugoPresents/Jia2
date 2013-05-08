<header class="subhead">
    <div class="container">
        <p class="lead">分享校园生活！感动你我！</p>
    </div>
</header>
<div class="container mainBody">
    <div class="main">
        <h4 class="title_01 title_02 title_03"><span>管理</span><?=$crumb ?></h4>
        <div  class="main_02">
            <div  class="search_result flow_result">
                <h4>我的粉丝 <span><?=$followers_num?>个</span> <a href="<?=site_url('personal/manage/following') ?>" class="fr">我的关注</a></h4>
                <ul id="user-result">
                    <? if(isset($followers)):?>
                        <? foreach($followers as $row):?>
                            <li>
                                <?=anchor('personal/profile/' . $row['id'], '<img class="img_block" src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
                                <div class="li_mbox">
                                    <?=anchor('personal/profile/' . $row['id'], $row['name'])?> （ <?=$row['gender'] == 1 ? '男' : '女'?> ）
                                    <p><?=$row['province'][0]['name'] ?><? if(!empty($row['school'][0]['name'])): ?><span class="vline">|</span><? endif ?><?=$row['school'][0]['name'] ?></p>
                                </div>
                                <div class="fr">
                                    <?=form_button('remove_follower', '移除粉丝', 'class="btn cancelBtn" user_id="'.$row['id'].'"') ?>
                                </div>
                            </li>
                        <? endforeach?>
                        <div class="pagination">
                            <?=$pagination ?>
                        </div>
                    <? endif?>
                </ul>
            </div>
        </div>
    </div>
    <? $this->load->view('includes/slider_bar_view') ?>
</div>

