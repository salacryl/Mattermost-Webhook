<?php
namespace OCA\MattermostWebhook\Hooks;
use \OC\Files\Node\LazyRoot;
use OCA\MattermostWebhook\FilesHooksStatic;
use OCP\Util;

class UserHooks {

    private $userfolder;

    public function __construct(\OC\Files\Node\LazyRoot  $userfolder,  $UserId){
        $this->userfolder = $userfolder;
		$this->userID =  $UserId;
    }
	
	public function registerHooks(){
		Util::connectHook('OC_Filesystem', 'post_update',  'OCA\MattermostWebhook\FilesHooksStatic', 'fileUpdate');
	}

    

}