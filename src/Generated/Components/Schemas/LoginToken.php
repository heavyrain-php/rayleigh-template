<?php declare(strict_types=1);

/**
 * @license MIT
 */

namespace R\Generated\Components\Schemas;

final readonly class LoginToken
{
    public function __construct(
        private string $token,
    ) {
    }

    public function getRawToken(): string
    {
        return $this->token;
    }
}
