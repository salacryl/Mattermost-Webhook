<?php
namespace OCA\MattermostWebhook\AppInfo;

use OCA\MattermostWebhook;

$app = new Application();
$app->getContainer()->query('UserHooks')->registerHooks();