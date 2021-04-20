<?php
namespace MeedleContact\Controller;

use MeedleContact\Model\Meedlecontact;
use MeedleContact\MeedleContact as Objcontact;
use Thelia\Model\ConfigQuery;
use Thelia\Log\Tlog;
use Thelia\Core\Event\ActionEvent;
use Thelia\Controller\Front\BaseFrontController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class MeedleContactController extends BaseFrontController{
    public function __construct(){}
	public function noAction(){}
	public function sendForm(){
		
		$autre = array();
		
		$contact = new Meedlecontact();
		
		$score='';
		$verified = false;
		if(!isset($_REQUEST['recaptcha_response'])){
			$verified = true;
		}
		$infoCaptcha='<br> Le captcha n\'a pas été remplie. Donc ce n\'est surement pas un humain.';
		if (isset($_REQUEST['recaptcha_response']) && $_REQUEST['recaptcha_response']) {
			$infoCaptcha='';
			// Build POST request:
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			$recaptcha_secret = Objcontact::getConfigValue('module-meedlecontact-captchagooglev3-clesecrete');
			$recaptcha_response = $_REQUEST['recaptcha_response'];

			// Make and decode POST request:
			$infoCaptcha = $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
			$recaptcha = json_decode($recaptcha);

			if(isset($recaptcha->score)){
				$infoCaptcha='';
				foreach($recaptcha as $index => $info){ $infoCaptcha .= "<br>\n" . $index . ' - ' . $info;
				   if(is_array($info))foreach($info as $index2 => $info2){ $infoCaptcha .= "<br>\n &nbsp;&nbsp;&nbsp;&nbsp;" . $index2 . ' - ' . $info2;}
				}

				$score=$recaptcha->score;
				// Take action based on the score returned:
				if ($recaptcha->score >= 0.5) {
					$verified = true;
				} else {
					$verified = false;
				}
			}
		}
		
		
		if(isset($_REQUEST['thelia_contact']['name']) && !isset($_REQUEST['nom'])) $_REQUEST['nom'] = $_REQUEST['thelia_contact']['name'];
		if(isset($_REQUEST['thelia_contact']['email']) && !isset($_REQUEST['email'])) $_REQUEST['email'] = $_REQUEST['thelia_contact']['email'];
		if(isset($_REQUEST['thelia_contact']['subject']) && !isset($_REQUEST['sujet'])) $_REQUEST['sujet'] = $_REQUEST['thelia_contact']['subject'];
		if(isset($_REQUEST['thelia_contact']['message']) && !isset($_REQUEST['description'])) $_REQUEST['description'] = $_REQUEST['thelia_contact']['message'];
		if(empty($_REQUEST['prenom']))$_REQUEST['prenom']='';
		
		$contact->setScore($score);
		if(isset($_REQUEST['civilite'])) $contact->setCivilite($_REQUEST['civilite']);
		if(isset($_REQUEST['nom'])) $contact->setNom($_REQUEST['nom']);
		if(isset($_REQUEST['prenom'])) $contact->setPrenom($_REQUEST['prenom']);
		if(isset($_REQUEST['phone'])) $contact->setPhone($_REQUEST['phone']);
		if(isset($_REQUEST['email'])) $contact->setEmail($_REQUEST['email']);
		if(isset($_REQUEST['sujet'])) $contact->setSujet($_REQUEST['sujet']);
		if(isset($_REQUEST['description'])) $contact->setDescription($_REQUEST['description']);
		$contact->setInfosCaptcha($infoCaptcha);
		$contact->setInfosNavig($this->getInfos());
		$contact->save();
		
		$destinataire[ConfigQuery::getStoreEmail()] = ConfigQuery::getStoreName();
		if(isset($_REQUEST['contactemail']))$destinataire[$_REQUEST['contactemail']] = $_REQUEST['contactname'];
		
		if($verified){
		$this->getMailer()->sendEmailMessage('module-meedle-contact', 
											 [ ConfigQuery::getStoreEmail() => $_REQUEST['nom'] . ' ' . $_REQUEST['prenom'] ], 
											 $destinataire, 
											 $_REQUEST, null, [], [], [ $_REQUEST['email'] => $_REQUEST['nom'] . ' ' . $_REQUEST['prenom']]);
			/*
			$this->getMailer()->sendSimpleEmailMessage(
				[ ConfigQuery::getStoreEmail() => $_REQUEST['nom'] . ' ' . $_REQUEST['prenom'] ],
				[ ConfigQuery::getStoreEmail() => ConfigQuery::getStoreName() ],
				$_REQUEST['sujet'],
				'',
				$_REQUEST['description'],
				[],
				[],
				[ $_REQUEST['email'] => $_REQUEST['nom'] . ' ' . $_REQUEST['prenom'] ]
			);*/
		}
		return $this->generateRedirectFromRoute('contact.success');
	}
	
	public function getOS( $ua = '' ){ 
		if( ! $ua ) $ua = $_SERVER['HTTP_USER_AGENT']; 
		$os = 'Système d&#39;exploitation inconnu'; 
		$os_arr = Array( 'Windows NT 6.1' => 'Windows 7', 'Windows NT 6.0' => 'Windows Vista', 'Windows NT 5.2' => 'Windows Server 2003', 'Windows NT 5.1' => 'Windows XP', 'Windows NT 5.0' => 'Windows 2000', 'Windows 2000' => 'Windows 2000', 'Windows CE' => 'Windows Mobile', 'Win 9x 4.90' => 'Windows Me.', 'Windows 98' => 'Windows 98', 'Win98' => 'Windows 98', 'Windows 95' => 'Windows 95', 'Win95' => 'Windows 95', 'Windows NT' => 'Windows NT', 'Ubuntu' => 'Linux Ubuntu', 'Fedora' => 'Linux Fedora', 'Linux' => 'Linux', 'Macintosh' => 'Mac', 'Mac OS X' => 'Mac OS X', 'Mac_PowerPC' => 'Mac OS X PowerPC', 'FreeBSD' => 'FreeBSD', 'Unix' => 'Unix', 'Playstation portable' => 'PSP', 'OpenSolaris' => 'SunOS', 'SunOS' => 'SunOS', 'Nintendo Wii' => 'Nintendo Wii', 'Mac' => 'Mac', ); 
		$ua = strtolower( $ua ); 
		foreach( $os_arr as $k => $v ) { 
			if( strtolower( $k ) ) { 
				$os = $v; 
				break; 
			} 
		} 
		return $os; 
	} 

	public function getInfos(){ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'Linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'Mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'Windows';
		}

		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		}

		$i = count($matches['browser']);
		if ($i != 1) {
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}

		if ($version==null || $version=="") {$version="?";}
		
		$form_quand  = date("Y-m-d H:i:s");
		$form_page   = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 
		$form_qui    = (getenv("HTTP_X_FORWARDED_FOR") ? getenv("HTTP_X_FORWARDED_FOR") : getenv("REMOTE_ADDR"));  
		$form_lang   = $_SERVER["HTTP_ACCEPT_LANGUAGE"]; 
		
		$ua = array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
		$os=$this->getOS();
		$yourbrowser= "<b>Navigateur : </b>" . $ua['name'] . " " . $ua['version'] . "<br /><b>OS : </b>" .$ua['platform'] . "<br /> <b>Plus : </b>". $os . $ua['userAgent'];
		$yourbrowser.= "<br /><b>Quand : </b>" . $form_quand . "<br /><b>Qui : </b>" . $form_qui . "<br /><b>Language : </b>" . $form_lang . "<br /><b>Où : </b>" . $form_page ;
		
		return $yourbrowser;
	}
		   
}