<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;

class AuditLogMiddleware
{
    public function handle($request, Closure $next)
    {
        DB::table('audit_logs')->insert([
            'ip' => $request->ip(),
            'endpoint' => $request->url(),
            'method' => $request->method(),
            'payload' => json_encode($request->all()),
            'header' => json_encode($request->header()),
            'created_at' => Carbon::now()
        ]);
        $response = $next($request);
        return $response;
    }
}
