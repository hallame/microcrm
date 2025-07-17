<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

trait HasFilters {
    /**
     * Применяет фильтры к запросу ( статус и период).
     */
    public function applyFilters(Request $request, Builder $query, array $statusMapping = [], string $statusColumn = 'status'): Builder {
        $status = $request->filled('status') ? $request->input('status') : 'all';
        $period = $request->has('period') ? $request->input('period') : 'recently_added';

        $now = Carbon::now();
        // Фильтр по статусу
        if ($status !== 'all') {
            $query->where($statusColumn, $status);
        }

        // Фильтр по времени создания
        switch ($period) {
            case 'recently_added':
                $query->orderBy('created_at', 'desc');
                break;
            case 'last_month':
                $query->where('created_at', '>=', $now->copy()->subMonth());
                break;
            case 'last_7_days':
                $query->where('created_at', '>=', $now->copy()->subDays(7));
                break;
        }
        return $query;
    }
}
