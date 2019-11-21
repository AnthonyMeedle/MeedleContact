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
                ->setHtmlLayoutFileName('meedle-email-layout.tpl')
                ->setLocale('en_US')
                ->setTitle('Module - Meedle Contact - Admin')
                ->setSubject('Mail form contact {config key="store_name"}')
                ->setTextMessage('Bonjour, 

Vous avez un nouveau message de {$nom} {$prenom},

{$sujet}

{$description}


{if $phone}téléphone : {$phone}{/if}
email : {$email}')->setHtmlMessage('<p>Bonjour, 
<br>
Vous avez un nouveau message de {$nom} {$prenom},</p>
<p>
{$sujet}
</p>
<p>
{$description}
</p>
<p>
{if $phone}téléphone : {$phone}<br>{/if}
email : {$email}

</p>')
                ->setLocale('fr_FR')
                ->setTitle('Module - Meedle Contact - Message pour l\'admin.')
                ->setSubject('Message du formulaire de contact {config key="store_name"}')
                ->setTextMessage('Bonjour, 

Vous avez un nouveau message de {$nom} {$prenom},

{$sujet}

{$description}


{if $phone}téléphone : {$phone}{/if}
email : {$email}')->setHtmlMessage('<p>Bonjour, 
<br>
Vous avez un nouveau message de {$nom} {$prenom},</p>
<p>
{$sujet}
</p>
<p>
{$description}
</p>
<p>
{if $phone}téléphone : {$phone}<br>{/if}
email : {$email}

</p>')
                ->save()
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