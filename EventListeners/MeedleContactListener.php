<?php
namespace MeedleContact\EventListeners;
use MeedleContact\Model\Meedlecontact;
use MeedleContact\MeedleContact as Objcontact;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\Customer\CustomerCreateOrUpdateEvent;
use Thelia\Core\Event\Newsletter\NewsletterEvent;
use Thelia\Core\Event\TheliaEvents;

class MeedleContactListener extends BaseAction implements EventSubscriberInterface
{
    public function __construct()
    {
    }
    public function newsletterSubscribe(NewsletterEvent $newsletterEvent){
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
			$infoCaptcha='';
			$sendEmail = false;
			// Build POST request:
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			$recaptcha_secret = Objcontact::getConfigValue('module-meedlecontact-captchagooglev3-clesecrete');
			$recaptcha_response = $_POST['recaptcha_response'];

			// Make and decode POST request:
			$libre2=$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
			$recaptcha = json_decode($recaptcha);

			foreach($recaptcha as $index => $info){ $infoCaptcha .= "<br>\n" . $index . ' - ' . $info;
			   if(is_array($info))foreach($info as $index2 => $info2){ $infoCaptcha .= "<br>\n &nbsp;&nbsp;&nbsp;&nbsp;" . $index2 . ' - ' . $info2;}
			  }
			// Take action based on the score returned:
			if ($recaptcha->score >= 0.5) {
				$sendEmail = true;
			} else {
                
                $ch = "error-codes";
                if(isset($recaptcha->$ch)){
                    $error=$recaptcha->$ch;
                //	echo $error[0];
                    if($error[0] == 'missing-input-response'){
                        $sendEmail=false;
                        $newsletterEvent->stopPropagation();
				        exit('captcha erreur - Veuillez contacter l\'administrateur du site.');
                    }
                    if($error[0] == 'timeout-or-duplicate'){
                        $sendEmail=true;
                    }
                }
			}
		}
	}
    public function customerCreate(CustomerCreateOrUpdateEvent $customerCreateEvent){
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
			$infoCaptcha='';
			$sendEmail = false;
			// Build POST request:
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			$recaptcha_secret = Objcontact::getConfigValue('module-meedlecontact-captchagooglev3-clesecrete');
			$recaptcha_response = $_POST['recaptcha_response'];

			// Make and decode POST request:
			$libre2=$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
			$recaptcha = json_decode($recaptcha);

			foreach($recaptcha as $index => $info){ $infoCaptcha .= "<br>\n" . $index . ' - ' . $info;
			   if(is_array($info))foreach($info as $index2 => $info2){ $infoCaptcha .= "<br>\n &nbsp;&nbsp;&nbsp;&nbsp;" . $index2 . ' - ' . $info2;}
			  }
			// Take action based on the score returned:
			if ($recaptcha->score >= 0.5) {
				$sendEmail = true;
			} else {
                
                $ch = "error-codes";
                if(isset($recaptcha->$ch)){
                    $error=$recaptcha->$ch;
                //	echo $error[0];
                    if($error[0] == 'missing-input-response'){
                        $sendEmail=false;
                        $customerCreateEvent->stopPropagation();
				        exit('captcha erreur - Veuillez contacter l\'administrateur du site.');
                    }
                    if($error[0] == 'timeout-or-duplicate'){
                        $sendEmail=true;
                    }
                }
                
                
				
			}
		}
	}
    public static function getSubscribedEvents()
    {
        return array(
            TheliaEvents::CUSTOMER_CREATEACCOUNT => array('customerCreate', 129),
            TheliaEvents::NEWSLETTER_SUBSCRIBE => array('newsletterSubscribe', 129)
        );
    }	
}