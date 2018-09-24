<?php script("mattermostwebhook", "settings"); ?>
<div id="mattermostwebhook" class="section">
	<h2 class="inlineblock"><?php p($l->t('Webhook')); ?></h2>
        <p class="settings-hint"><?php p($l->t('Theming makes it possible to easily customize the look and feel of your instance and supported clients. This will be visible for all users.')); ?></p>
		<div id="mattermostwebhook_settings_status">
			<div id="mattermostwebhook_settings_loading" class="icon-loading-small" style="display: none;"></div>
			<span id="mattermostwebhook_settings_msg" class="msg success" style="display: none;">Saved</span>
		</div>
		<div>
		<label>
			<span><?php p($l->t('Webhook URL')) ?></span>
			<input style="width: 500px;" id="mattermostwebhookurl" type="text"  size="20" placeholder="<?php p($l->t('https://<mattermost-server>/<hookID>')); ?>" value="<?php p($_['webhookurl']) ?>" maxlength="250" />
			<input type="button" id="webhooksaveurl" value="save">
		</label>
	</div>
	
</div>