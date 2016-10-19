<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-frontend
 * @author: n3vrax
 * Date: 7/18/2016
 * Time: 9:55 PM
 */

namespace Dot\Frontend\User\Entity;

/**
 * Class UserEntityHydrator
 * @package Dot\Frontend\User\Entity
 */
class UserEntityHydrator extends \Dot\User\Entity\UserEntityHydrator
{
    /**
     * UserEntityHydrator constructor.
     * @param bool $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = false)
    {
        parent::__construct($underscoreSeparatedKeys);
        $this->addStrategy('details', new UserDetailsHydratorStrategy(new UserDetailsHydrator()));
    }
}