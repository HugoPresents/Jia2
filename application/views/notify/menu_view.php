<div class="mainContainer">
    <div class="container whiteBg">
        <div class="notify">
            <div id="notify_menu" class="search_item">
                <ul class="nav nav-tabs">
                    <li id="notify_letter" <?=$notify == 'letter' ? ' class="active"' :''?>>
                        <a href="<?= site_url('notify?type=letter') ?>">站内信</a>
                    </li>
                    <li id="notify_request" <?=$notify == 'request' ? ' class="active"' :''?>>
                        <a href="<?= site_url('notify?type=request') ?>">请求</a>
                    </li>
                    <li id="notify_message" <?=$notify == 'message' ? ' class="active"' :''?>>
                        <a href="<?= site_url('notify?type=message') ?>">消息</a>
                    </li>
                </ul>
            </div>
