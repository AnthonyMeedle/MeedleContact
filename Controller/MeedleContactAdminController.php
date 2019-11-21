<?php
namespace MeedleContact\Controller;

use MeedleContact\Model\Meedlecontact;
use MeedleContact\MeedleContact as Objmc;
use Thelia\Model\ConfigQuery;
use Thelia\Log\Tlog;
use Thelia\Core\Event\ActionEvent;
use Thelia\Controller\Admin\BaseAdminController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\HttpFoundation\Response;
use Thelia\Core\Template\TemplateDefinition;

class MeedleContactAdminController extends BaseAdminController{
    public function __construct(){}
	public function noAction(){}
	public function form(){

		Objmc::setConfigValue('module-meedlecontact-captchagooglev3-clesite', $_REQUEST['ksite']);
		Objmc::setConfigValue('module-meedlecontact-captchagooglev3-clesecrete', $_REQUEST['ksecrete']);
		Objmc::setConfigValue('module-meedlecontact-captchagooglev3-score', $_REQUEST['score']);
		if(isset($_REQUEST['module-meedlecontact-captchagooglev3-contact']) && $_REQUEST['module-meedlecontact-captchagooglev3-contact'])
			Objmc::setConfigValue('module-meedlecontact-captchagooglev3-contact', 1);
		else
			Objmc::setConfigValue('module-meedlecontact-captchagooglev3-contact', 0);
		if(isset($_REQUEST['module-meedlecontact-captchagooglev3-register']) && $_REQUEST['module-meedlecontact-captchagooglev3-register'])
			Objmc::setConfigValue('module-meedlecontact-captchagooglev3-register', 1);
		else
			Objmc::setConfigValue('module-meedlecontact-captchagooglev3-register', 0);
		
		if(!empty($_REQUEST["stop"])) exit;
		if(!empty($_REQUEST["success_url"])) return $response = $this->generateRedirect($_REQUEST["success_url"]);
	}
	
}