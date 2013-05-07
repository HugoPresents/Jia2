<div class="mainContainer sta_main">
    <div class="container">
        <div id="static">
            <p>
                <?=$message ?>  ╮(╯_╰)╭
                <br>
                <a href="javascript:history.go(-1);">返回上一页</a>
            </p>

            <? if ($url): ?>
                <p><?=anchor($url, '返回') ?></p>
            <? endif ?>
        </div>
    </div>
</div>
