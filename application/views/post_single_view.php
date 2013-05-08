<script type="text/javascript">
    $(function () {
        $('.CommetBtn').trigger('click');
    });
</script>


<header class="subhead">
    <div class="container">
        <p class="lead">分享校园生活！感动你我！</p>
    </div>
</header>
<div class="container mainBody">
    <div class="main">
        <? if(!empty($posts['activity'])): ?>
        <h4 class="title_01 title_02 title_03">
            <span>动态</span><?=anchor('corporation/profile/' . $posts['activity'][0]['corporation'][0]['id'], $posts['activity'][0]['corporation'][0]['name'] . '的动态') ?>
        </h4>

        <div id="main">
            <div class="post_main">
                <? $this->load->view('post/co_posts_view') ?>
                <? else: ?>
                <h4 class="title_01 title_02 title_03">
                    <span>动态</span><?=anchor('personal/profile/' . $posts['personal'][0]['user'][0]['id'], $posts['personal'][0]['user'][0]['name'] . '的动态') ?>
                </h4>

                <div id="main">
                    <div class="post_main">
                        <? $this->load->view('post/user_posts_view') ?>
                        <? endif ?>
                    </div>
                </div>
            </div>

            <? $this->load->view('includes/slider_bar_view') ?>

        </div>