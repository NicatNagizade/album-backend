<?php

use App\Http\Middleware\AuditLogMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuditLogMiddlewareTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    public function test_audit_log_middleware()
    {
        $middleware = new AuditLogMiddleware;
        $request = Request::create('api/album', 'GET');
        $response = new Response('content', 200);
        $mid_response = $middleware->handle($request, function ($req) use ($response) {
            return $response;
        });
        $this->assertEquals(200, $mid_response->getStatusCode());
        $data = DB::table('audit_logs')->first();
        $this->assertNotNull($data);
        $this->assertEquals('api/album', $data->endpoint);
        $this->assertEquals('GET', $data->method);
        $this->assertEquals('200', $data->status);
    }
}
