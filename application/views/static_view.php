<div class="mainContainer">
    <div class="container whiteBg">
        <div id="static">
            <p><?=$message ?></p>
            <? if ($url): ?>
                <p><?=anchor($url, '返回') ?></p>
            <? endif ?>
        </div>
    </div>
</div>
