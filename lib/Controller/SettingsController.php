<?php
namespace OCA\MattermostWebhook\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\IConfig;
use OCP\ILogger;


class SettingsController extends Controller {
	private $userId;
	 /**
     * config
     *
     * @var OCP\IConfig
     */
	private $config;
	 /**
     * Logger
     *
     * @var OCP\ILogger
     */
	private $logger;
	protected $appName;
	private $userID;

	public function __construct($AppName, IRequest $request, $logger, $config, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->config = $config;
		$this->logger = $logger;
		$this->appName = $Appname;
		$this->userID = $UserId;
		
		
		//throw new \Exception( "\$bla = $bla" );
	}
       
	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function save($webhookurl) {
		$this->config->setUserValue($this->userID, "mattermostwebhook", "webhookurl", $webhookurl);	
		$this->config->setAppValue("mattermostwebhook", "userID", $this->userID);
	    return [
            "webhookurl" => $this->config->getUserValue($this->userId, "mattermostwebhook", "webhookurl")
        ];
	}
	
	public function load($webhookurl) {
	    return [
            "webhookurl" => $this->config->getUserValue($this->userId, "mattermostwebhook", "webhookurl")
        ];
	}

}
