<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserQuery
{
    public static function apply(Request $request): Builder
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('email', 'LIKE', '%'.$request->search.'%');
            });
        }

        if ($request->filled('field')) {
            $query->orderBy($request->field, $request->direction);
        } else {
            $query->latest();
        }

        return $query;
    }
}
