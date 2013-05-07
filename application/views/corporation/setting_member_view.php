<div id="set_member" class="active">
    <h4 class="set_title">管理协会成员</h4>
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