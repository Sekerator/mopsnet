<?php

namespace api\modules\magwelt\models;

use common\models\magwelt\MagweltUser;

class User extends MagweltUser
{
    public function fields()
    {
        return [
            'username',
            'phone',
            'created_at',
        ];
    }
}