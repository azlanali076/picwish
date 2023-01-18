<?php

namespace Azlanali076\Picwish\Facades;

use Azlanali076\Picwish\Models\PicwishScale;
use Azlanali076\Picwish\Models\PicwishScaleAsyncResponse;
use Azlanali076\Picwish\Models\PicwishScaleErrorResponse;
use Azlanali076\Picwish\Models\PicwishScalePollResult;
use Azlanali076\Picwish\Models\PicwishScaleSuccessResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PicwishScaleAsyncResponse|PicwishScaleErrorResponse|PicwishScaleSuccessResponse|string scale(PicwishScale $picwishScale)
 * @method static PicwishScaleErrorResponse|PicwishScalePollResult|PicwishScaleSuccessResponse checkProgress(string $taskId)
 */
class Picwish extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'picwish';
    }

}