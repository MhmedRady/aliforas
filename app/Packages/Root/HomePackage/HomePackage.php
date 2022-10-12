<?php

namespace App\Packages\Root\HomePackage;


use Heshamfouda\PackagesManager\PackageLoader;
use Illuminate\Support\Facades\Route;

class HomePackage extends PackageLoader
{
    protected array $viewLocations = [
        [
            'root.index' => __DIR__ . DIRECTORY_SEPARATOR . 'Views'
        ]
    ];

    /**
     * Get Package's Long name
     * @return string
     */
    public function longName()
    {
        return __('sms_template.longName');
    }

    /**
     * Get Package's Short name
     * @return string
     */
    public function shortName()
    {
        return __('sms_template.shortName');
    }

    /**
     * Get package's Description
     * @return string
     */
    public function description()
    {
        return __('sms_template.description');
    }

    /**
     * Get package's Slug
     * @return string
     */
    public function slug()
    {
        return 'sms_template';
    }

    /**
     * Get routes's Slug name
     * @return string
     */
    public function routeName()
    {
        return 'sms_template';
    }

    /**
     * Get routes's Slug name
     * @return string
     */
    public function routePrefix()
    {
        return 'sms-template';
    }

    /**
     * Get routes's Slug name
     * @return array
     */
    public function routeMiddleware()
    {
        return ['auth'];
    }

    /**
     * Define The package routes.
     * @return void
     */
    public function registerRouters()
    {

    }
}
