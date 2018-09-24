<?php
namespace OCA\MattermostWebhook;
class FilesHooksStatic {

	/**
	 * @return FilesHooks
	 */
	static protected function getHooks() {
		return \OC::$server->query(FilesHooks::class);
	}
	public static function fileUpdate($params) {
		self::getHooks()->fileUpdate($params['path']);
	}
}
?>