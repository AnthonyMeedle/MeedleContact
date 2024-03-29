<?php

namespace MeedleContact\Hook;

use MeedleContact\MeedleContact;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Tools\URL;

class MeedleContactHook extends BaseHook {
    public function onMainTopMenuToolsContents(HookRenderBlockEvent $event)
    {
		$event->add(array(
			"id" => "meedleContactTools",
			"class" => '',
			"url" => URL::getInstance()->absoluteUrl('/admin/modules/meedle/contact-accueil'),
			"title" => $this->trans("Contact")
		));		
    } 
	public function onHeadBottomContents(HookRenderEvent $event){
        $clesite = MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-clesite');
		if($clesite){
			$content = '<script src="https://www.google.com/recaptcha/api.js?render='. $clesite .'"></script>';
			$event->add($content);
		}
    }
	public function onContactFormTopContents(HookRenderEvent $event){
		if(MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-contact')){
			$clesite = MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-clesite');
			if($clesite){
				$content = '<input type="hidden" name="recaptcha_response" id="recaptchaResponse">';
				$event->add($content);
			}
		}
    }
	public function onContactAfterJavascriptInclude(HookRenderEvent $event){
		if(MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-contact')){
			$clesite = MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-clesite');
			if($clesite){
				$content = '
		<script>
			grecaptcha.ready(function() {
				grecaptcha.execute(\''. $clesite .'\', {action: \'contact\'}).then(function(token) {
					var recaptchaResponse = document.getElementById(\'recaptchaResponse\');
					recaptchaResponse.value = token;
				});
			});
		</script>';
				$event->add($content);
			}
		}
    }
	public function onRegisterFormTopContents(HookRenderEvent $event){
		if(MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-register')){
			$clesite = MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-clesite');
			if($clesite){
				$content = '<input type="hidden" name="recaptcha_response" id="recaptchaResponse">';
				$event->add($content);
			}
		}
    }
	public function onRegisterAfterJavascriptInclude(HookRenderEvent $event){
		if(MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-register')){
			$clesite = MeedleContact::getConfigValue('module-meedlecontact-captchagooglev3-clesite');
			if($clesite){
				$content = '
		<script>
			grecaptcha.ready(function() {
				grecaptcha.execute(\''. $clesite .'\', {action: \'register\'}).then(function(token) {
					var recaptchaResponse = document.getElementById(\'recaptchaResponse\');
					recaptchaResponse.value = token;
				});
			});
		</script>';
				$event->add($content);
			}
		}
	}
}
?>