<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use AppBundle\Entity\Carro;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

    
class CarroVoter extends Voter
{
    
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';


    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Carro objects inside this voter
        if (!$subject instanceof Carro) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {

        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // ROLE_ADMIN can do anything
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
           return true;
       }
        // you know $subject is a Carro object, thanks to supports
        /** @var Post $post */
        $carro = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($carro, $user);
            case self::EDIT:
                return $this->canEdit($carro, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Carro $carro, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($carro, $user)) {
            return true;
        }

//        // the Carro object could have, for example, a method isPrivate()
//        // that checks a boolean $private property
        return !$carro->isPrivate(); //-> implementar na entity para o voter
    }

    private function canEdit(Carro $carro, User $user)
    {
 
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
       return $user === $carro->getUser();

    }
    
}       