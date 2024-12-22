<?php

namespace App\Helpers;

use App\Models\User;

class DashboardHelper
{
    /**
     * Get user summary data.
     *
     * @return array
     */
    public static function getUserSummary(): array
    {
        return [
            'totalUsers' => User::count(),
            'totalMembers' => User::whereHas('roles', fn($q) => $q->where('name', 'member'))->count(),
            'usersThisWeek' => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'usersThisMonth' => User::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
        ];
    }

    /**
     * Get another type of data (e.g., sales statistics, etc.).
     *
     * @return array
     */
    public static function getSalesSummary(): array
    {
        // Example logic for fetching sales data
        return [
            'totalSales' => 120,
            'salesThisWeek' => 30,
            'salesThisMonth' => 100,
        ];
    }

    /**
     * Add other reusable methods here for dynamic components.
     */
}
