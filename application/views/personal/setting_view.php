<div class="mainContainer">
<div class="container whiteBg">
<h4 class="title_01 title_02"><span>设置</span><a class="oprate_w" href="/">回到首页</a></h4>
<div class="border clearfix">
<div class="main" id="set_con">
    <?
    $target = $this->input->get('target');
    switch ($target) {
        case 'avatar':
            $this->load->view('personal/setting_avatar_view');
            break;
        case 'pass':
            $this->load->view('personal/setting_pass_view');
            break;
        case 'privacy':
            $this->load->view('personal/setting_privacy_view');
            break;
        default:
            $target = 'info';
            $this->load->view('personal/setting_info_view');
            break;
    }
    ?>
</div>

<ul class="siderbar" id="myTab">
    <li<?=$target=='info' ? ' class="active"':''?>>
        <a href="/personal/setting?target=info">资料设置</a>
    </li>
    <li<?=$target=='avatar' ? ' class="active"':''?>>
        <a href="/personal/setting?target=avatar">头像设置</a>
    </li>
    <li<?=$target=='pass' ? ' class="active"':''?>>
        <a href="/personal/setting?target=pass">密码设置</a>
    </li>
    <li<?=$target=='privacy' ? ' class="active"':''?>>
        <a href="/personal/setting?target=privacy">隐私设置</a>
    </li>
</ul>
</div>
</div>
</div>

<script>
    $(function () {
        $(".modify").live("click", function () {
            $(this).closest(".tab-pane").find("#user_info").hide().end().find("#user_info_form").show();
            return false;
        });
    })
</script>
