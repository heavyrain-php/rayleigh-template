<?php declare(strict_types=1);

/**
 * @license MIT
 */

namespace R\Http\Handlers\Index\Get;

use R\Generated\Components\Responses\GetIndexResponse;

return static function(): GetIndexResponse {
    return new GetIndexResponse(ok: true);
};
