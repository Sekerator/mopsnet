<?php

namespace api\modules\kanban\models;

use common\models\kanban\KanbanUser;

class User extends KanbanUser
{
    public function fields() {
        return [
            'username',
            'email',
            'auth_token',
            'created_at'
        ];
    }
}