<?php

namespace Reservation\Hook\Admin;

use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Tools\URL;

class ReservationTools extends BaseHook {
    public function onMainTopMenuToolsContents(HookRenderBlockEvent $event)
    {
		$event->add(array(
			"id" => "reservationTools",
			"class" => '',
			"url" => URL::getInstance()->absoluteUrl('/admin/modules/reservation/accueil'),
			"title" => $this->trans("Réservation")
		));		
    }
	
	public function onReservationStyleSheet(HookRenderEvent $event){
        $event->add($this->addCSS("/assets/css/bootstrap-datetimepicker.css"));
    }

    public function onReservationJs(HookRenderEvent $event){
		$event->add($this->addJS("/assets/js/bootstrap-datetimepicker.js"));
    }

	
}
?>