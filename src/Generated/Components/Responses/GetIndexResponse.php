<?php declare(strict_types=1);

/**
 * @license MIT
 */

namespace R\Generated\Components\Responses;

final readonly class GetIndexResponse implements \JsonSerializable
{
    public function __construct(
        public bool $ok,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'ok' => $this->ok,
        ];
    }
}
