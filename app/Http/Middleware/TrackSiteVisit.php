<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            try {
                SiteVisit::create([
                    'visitor_key' => $this->visitorKey($request),
                    'ip_address'  => $request->ip(),
                    'user_agent'  => substr((string) $request->userAgent(), 0, 1000),
                    'path'        => '/' . ltrim($request->path(), '/'),
                    'url'         => substr($request->fullUrl(), 0, 1000),
                    'referer'     => substr((string) $request->headers->get('referer'), 0, 1000),
                    'visited_at'  => now(),
                ]);
            } catch (\Throwable $exception) {
                Log::debug('Site visit tracking failed', ['message' => $exception->getMessage()]);
            }
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || ! $response->isSuccessful()) {
            return false;
        }

        if ($request->is('dashboard*') || $request->is('storage*') || $request->is('build*')) {
            return false;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return false;
        }

        return ! $request->is('*.css', '*.js', '*.png', '*.jpg', '*.jpeg', '*.gif', '*.svg', '*.ico', '*.webp', '*.woff', '*.woff2');
    }

    private function visitorKey(Request $request): string
    {
        return hash('sha256', $request->ip() . '|' . (string) $request->userAgent());
    }
}
