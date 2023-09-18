<?php declare(strict_types=1);

/**
 * @license MIT
 */

namespace R\Http\Handlers\Index\Get;

final readonly class IndexGetOutput implements \JsonSerializable
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
