<?php
namespace MeedleContact;

use Thelia\Module\BaseModule;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;
use Thelia\Model\Message;
use Thelia\Model\MessageQuery;

class MeedleContact extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'meedlecontact';
	
	public function postActivation(ConnectionInterface $con = null){
        $database = new Database($con->getWrappedConnection());
        $database->insertSql(null, array(__DIR__ . '/Config/thelia.sql'));
		
        if (null === MessageQuery::create()->findOneByName('module-meedle-contact')) {
            $message = new Message();
            $message
                ->setName('module-meedle-contact')
                ->setHtmlLayoutFileName('default-html-layout.tpl')
                ->setLocale('en_US')
                ->setTitle('Questionnaire confirmation')
                ->setSubject('Questionnaire bien remplie {config key="store_name"}')
                ->setTextMessage('Bonjour, 

Vous avez un nouveau message de {$nom} {$prenom},

{$sujet}

{$description}

email : {$email}')->setHtmlMessage('{block name="email-content"}<p>Bonjour, 
<br>
Vous avez un nouveau message de {$nom} {$prenom},</p>
<p>
{$sujet}
</p>
<p>
{$description}
</p>
<p>
email : {$email}

</p>{/block}')
                ->setLocale('fr_FR')
                ->setTitle('Questionnaire confirmation')
                ->setSubject('Questionnaire bien remplie {config key="store_name"}')
                ->setTextMessage('Bonjour, 

Vous avez un nouveau message de {$nom} {$prenom},

{$sujet}

{$description}

email : {$email}')->setHtmlMessage('{block name="email-content"}<p>Bonjour, 
<br>
Vous avez un nouveau message de {$nom} {$prenom},</p>
<p>
{$sujet}
</p>
<p>
{$description}
</p>
<p>
email : {$email}

</p>{/block}')->save()
            ;
        }
    }
    /*
     * You may now override BaseModuleInterface methods, such as:
     * install, destroy, preActivation, postActivation, preDeactivation, postDeactivation
     *
     * Have fun !
     */
}