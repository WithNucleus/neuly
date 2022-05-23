<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Laravel\Passport\Client;

class OauthClient extends Client
{
    use CrudTrait;
}
