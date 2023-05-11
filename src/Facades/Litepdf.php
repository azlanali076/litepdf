<?php

namespace Azlanali076\Litepdf\Facades;

use Azlanali076\Litepdf\Models\LitepdfConversion;
use Azlanali076\Litepdf\Models\LitepdfConversionAsyncResponse;
use Azlanali076\Litepdf\Models\LitepdfConversionErrorResponse;
use Azlanali076\Litepdf\Models\LitepdfConversionResult;
use Azlanali076\Litepdf\Models\LitepdfConversionSuccessResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LitepdfConversionAsyncResponse|LitepdfConversionErrorResponse|LitepdfConversionSuccessResponse|string convert(LitepdfConversion $litepdfConversion)
 * @method static LitepdfConversionErrorResponse|LitepdfConversionResult|LitepdfConversionSuccessResponse checkProgress(string $taskId)
 */
class Litepdf extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'litepdf';
    }

}