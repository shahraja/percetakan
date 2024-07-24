<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class MidtransSignatureKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('midtrans.server_key'));
        if ($key == $request->signature_key) {
            return $next($request);
        }
        return response([
            "status" => 401,
            "message" => "Unauthorized"
        ])->header('Content-Type', 'application/json')
            ->setStatusCode(401);
    }
}