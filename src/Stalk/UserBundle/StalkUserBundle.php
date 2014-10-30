<?php

namespace Stalk\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StalkUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
