<?php
namespace OCA\MattermostWebhook\AppInfo;

use OCP\AppFramework\App;

use OCA\MattermostWebhook\Controller\SettingsController;
use \OCA\MattermostWebhook\Hooks\UserHooks;


class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('mattermostwebhook', $urlParams);

        $container = $this->getContainer();

        /**
         * Controllers
         */
        $container->registerService('SettingsController', function($c) {
            return new SettingsController(
                $c->query('AppName'),
                $c->query('Request'),
				$c->query('Logger'),
				$c->query('Config'),
				$c->query('UserID')
            );
        });
		
		 $container->registerService('Logger', function($c) {
            return $c->query('ServerContainer')->getLogger();
        });
		
		 $container->registerService('Config', function($c) {
            return $c->query('ServerContainer')->getConfig();
        });
		 $container->registerService('UserID', function($c) {
            return $c->query('UserSession')->getUser()->getUID();
        });
		
		$container->registerService('UserHooks', function($c) {
            return new UserHooks(
                $c->query('ServerContainer')->getRootFolder(),
				$c->query('UserSession')->getUser()->getUID()
            );
        });
		
		$container->registerService('FilesHooks', function($c) {
            return new FilesHooks(
                $c->query('ServerContainer')->getRootFolder(),
				$c->query('ServerContainer')->getLogger(),
				$c->query('ServerContainer')->getConfig()
            );
        });
    }
}

