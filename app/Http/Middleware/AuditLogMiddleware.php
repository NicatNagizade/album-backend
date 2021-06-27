<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuditLogMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        try {
            DB::table('audit_logs')->insert($this->call($request, $response));
        } catch (\Exception $ex) {
            Log::error('[audit_logs]: '.$ex->getMessage());
        }
        return $response;
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
            'created_at' => Carbon::now()
        ];
    }
}
