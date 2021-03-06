<?php

namespace App\Http\Middleware;

use App\Models\User;
use Appkr\Infra\TokenException;
use Appkr\Infra\TokenExtractor;
use Appkr\Infra\TokenParser;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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
            $jwtString = TokenExtractor::extract($request);
            if (!$jwtString) {
                throw TokenException::tokenNotProvided();
            }
            $token = $this->tokenParser->parse($jwtString);
        } catch (TokenException $e) {
            return new JsonResponse(['message' => $e->getMessage(),], $e->getStatusCode());
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Unknown exception',], 400);
        }

        $request->setUserResolver(function () use ($token) {
            $user = new User();
            $user->name = ($token->getUserName() instanceof Uuid) ? $token->getUserName() : Uuid::fromString(Uuid::NIL);
            return $user;
        });

        return $next($request);
    }
}
