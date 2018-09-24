<?php
namespace OCA\MattermostWebhook;
use OCP\Files\IRootFolder;
use OCP\Files\Node;
use OCP\ILogger;
use OC\Files\Filesystem;
use OCP\IConfig;


class FilesHooks {
	protected $rootFolder;

	/** @var ILogger */
	protected $logger;
	/** @var CurrentUser */
	protected $currentUser;

	protected $config;

	/*
	 * Constructor
	 *
	 * @param IRootFolder $rootFolder
	 * @param ILogger $logger
	 * @param CurrentUser $currentUser
	 */
	public	function __construct( IRootFolder $rootFolder, ILogger $logger, IConfig $config ) {
		$this->rootFolder = $rootFolder;
		$this->logger = $logger;
		$this->currentUser = $currentUser;
		$this->config = $config;
	}

	public	function fileUpdate( $path ) {
		
		$view = Filesystem::getView();
		$root = $this->rootFolder;
		$config = $this->config;
		$owner = $view->getOwner( $path );
		$node = $root->getUserFolder($owner)->get($path);
		
		$preconfiguser = $config->getAppValue( "mattermostwebhook", "userID");

		if ( $owner == $preconfiguser ) {
			$mattermostwebhook = $config->getUserValue( $owner, "mattermostwebhook", "webhookurl");
			$dataarray=array('text' =>'Datei ' .$node->getName(). ' hat sich geändert.'); 
			
			$data = array( 'payload' => json_encode($dataarray) );
			$post = http_build_query( $data );
			// use key 'http' even if you send the request to https://...
			$options = array(
				'http' => array(
					'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
					'method' => 'POST',
					'content' =>$post
				)
			);
			$context = stream_context_create( $options );
			$result = file_get_contents( $mattermostwebhook, false, $context );
			
			
		}
		
	}
}
?>