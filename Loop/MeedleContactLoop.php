<?php
namespace MeedleContact\Loop;
use MeedleContact\Model\MeedlecontactQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Element\SearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Type\BooleanOrBothType;
class MeedleContactLoop extends BaseLoop implements PropelSearchLoopInterface{
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument('id')
        );
    }
    /**
     * this method returns a Propel ModelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildModelCriteria()
    {
        $search = MeedlecontactQuery::create();
        $id = $this->getId();
        if ($id) {
            $search->filterById($id, Criteria::IN);
        }
		$search->orderByCreatedAt(Criteria::DESC);
		return $search;
    }
    /**
     * @param LoopResult $loopResult
     *
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult)
    {
        foreach ($loopResult->getResultDataCollection() as $contact) {
            $loopResultRow = new LoopResultRow($contact);
            $info = json_decode($contact->getInfosCaptcha());
            $infoScore='';
            if($info){
                $coderror='error-codes';
                $infoScore=$info->$coderror[0];
            }
            $score = $contact->getScore();
            if(!$score)$score=$infoScore;
            $loopResultRow
                ->set('ID', $contact->getId())
                ->set('CIVILITE', $contact->getCivilite())
                ->set('NOM', $contact->getNom())
                ->set('PRENOM', $contact->getPrenom())
                ->set('PHONE', $contact->getTelephone())
                ->set('EMAIL', $contact->getEmail())
                ->set('SUJET', $contact->getConnuecomment())
                ->set('DESCRIPTION', $contact->getCommentaires())
                ->set('SCORE', $score)
                ->set('INFONAV', $contact->getInfosNavig())
                ->set('INFOCAPTCHA', $contact->getInfosCaptcha())
//                ->set('NEWSLETTER', $contact->getAccepteNewsletter())
                ->set('CREATEDAT', $contact->getCreatedAt());

		/*	if($contact->getAutre()){
				$autre = json_decode($contact->getAutre());
				foreach($autre as $nomInfo => $info){
					$loopResultRow->set(strtoupper($nomInfo), $info);
				}
			}*/
			
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}