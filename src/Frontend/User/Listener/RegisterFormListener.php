<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-frontend
 * @author: n3vrax
 * Date: 7/18/2016
 * Time: 9:55 PM
 */

namespace Dot\Frontend\User\Listener;

use Dot\Frontend\User\Form\InputFilter\UserDetailsInputFilter;
use Dot\Frontend\User\Form\UserDetailsFieldset;
use Zend\EventManager\Event;
use Zend\Form\Form;

/**
 * Class RegisterFormListener
 * @package Dot\Frontend\User\Listener
 */
class RegisterFormListener
{
    /**
     * Listens for RegisterForm init event to add more elements to the original form
     *
     * @param Event $e
     */
    public function __invoke(Event $e)
    {
        /** @var Form $form */
        $form = $e->getTarget();

        $detailsFieldset = new UserDetailsFieldset();
        $detailsFieldset->init();
        $detailsFieldset->setName('details');

        $detailsFilter = new UserDetailsInputFilter();
        $detailsFilter->init();
        //TODO: remove some elements from the fieldset that you don't want in the register form
        //this is not the case right now, as this fieldset contains only lastName and firstName

        $form->add($detailsFieldset);
        $form->getInputFilter()->add($detailsFilter, 'details');
    }
}