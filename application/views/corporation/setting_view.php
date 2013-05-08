<div class="mainContainer">
    <div class="container whiteBg">
    <h4 class="title_01 title_02"><span>设置</span><?=anchor('corporation/profile/' . $info['id'], '返回' . $info['name'] . '首页') ?></h4>
        <div class="border clearfix">
            <div class="tab-content main" id="set_con">
                <?php
                    $target = $this->input->get('target');
                    switch ($target) {
                        case 'member':
                            $this->load->view('corporation/setting_member_view');
                            break;
                        case 'avatar':
                            $this->load->view('corporation/setting_avatar_view');
                            break;
                        default:
                            $target = 'info';
                            $this->load->view('corporation/setting_info_view');
                    }
                ?>
            </div>
            <ul class="siderbar" id="myTab">
                <li<?=$target=='info' ? ' class="active"':''?>>
                    <a href="/corporation/setting/<?=$info['id']?>?target=info">设置社团资料</a>
                </li>
                <li<?=$target=='member' ? ' class="active"':''?>>
                    <a href="/corporation/setting/<?=$info['id']?>?target=member">管理协会成员</a>
                </li>
                <li<?=$target=='avatar' ? ' class="active"':''?>>
                    <a href="/corporation/setting/<?=$info['id']?>?target=avatar">设置协会头像</a>
                </li>
            </ul>
        </div>
    </div>
</div>