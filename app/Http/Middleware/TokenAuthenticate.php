<?php

namespace App\Http\Middleware;

use App\Models\User;
use Appkr\Infra\TokenException;
use Appkr\Infra\TokenExtractor;
use Appkr\Infra\TokenParser;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenAuthenticate
{
    private $tokenParser;

    public function __construct(TokenParser $tokenParser)
    {
        $this->tokenParser = $tokenParser;
    }

    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $this->tokenParser->parse(TokenExtractor::extract($request));
        } catch (TokenException $e) {
            return new JsonResponse(['message' => $e->getMessage(),], $e->getStatusCode());
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Unknown exception',], 400);
        }

        $request->setUserResolver(function () use ($token) {
            $user = new User();
            $user->name = $token->getUserName();
            return $user;
        });

        return $next($request);
    }
}
