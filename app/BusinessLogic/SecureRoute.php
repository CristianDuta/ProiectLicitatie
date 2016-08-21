<?php

namespace BusinessLogic;

use Silex\Route;

class SecureRoute extends Route
{
    use Route\SecurityTrait;
}