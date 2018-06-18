<?php

namespace DI\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DIUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
