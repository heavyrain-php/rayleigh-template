<?php declare(strict_types=1);

/**
 * @license MIT
 */

namespace R\Http\Handlers\Index\Get;

return static function(IndexGetInput $input): IndexGetOutput {
    return new IndexGetOutput(true);
};
