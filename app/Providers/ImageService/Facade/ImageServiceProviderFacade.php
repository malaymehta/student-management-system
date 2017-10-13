<?php namespace App\Providers\ImageService\Facade;

use Illuminate\Support\Facades\Facade;

class ImageServiceProviderFacade extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ImageService';
    }
}
