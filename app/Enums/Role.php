<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    /**
     * Check if a role is an admin.
     */
    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
}
