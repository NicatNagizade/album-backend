<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

class DailyLogMiddleware
{
    protected $max_size = 1024 * 1024 * 10; // 10MB
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($this->checkSize()) {
            $data = $this->call($request, $response);
            $log = Log::channel('daily');
            $log->info($data);
        }
        return $response;
    }

    protected function getFileDirectory()
    {
        return storage_path('logs/daily/d-' . Carbon::now()->format('Y-m-d') . '.log');
    }

    protected function checkSize(): bool
    {
        $file_dir = $this->getFileDirectory();
        if (file_exists($file_dir)) {
            $file_size = filesize($file_dir);
            if ($file_size >= $this->max_size) {
                return false;
            }
        }
        return true;
    }

    protected function call($request, $response): array
    {
        return [
            'ip' => $request->ip(),
            'endpoint' => $request->path(),
            'method' => $request->method(),
            'status' => $response->getStatusCode(),
            'payload' => json_encode($request->all()),
            'header' => json_encode($request->header()),
            'response_time' => (microtime(true) - LUMEN_START),
            'response' => $response->getContent(),
        ];
    }
}
