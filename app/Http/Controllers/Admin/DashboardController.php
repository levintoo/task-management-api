<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $trend = Trend::model(User::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perWeek()
            ->count();

        return response()->json([
            'stats' => ['users' => User::query()->count(),
                'admins' => User::query()->where('role', Role::ADMIN)->count(),
                'verified_users' => User::query()->whereNotNull('email_verified_at')->count(),
                'unverified_users' => User::query()->whereNull('email_verified_at')->count(),
            ], 'trend' => $trend,
        ]);
    }
}
