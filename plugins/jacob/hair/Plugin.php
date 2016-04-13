<?php namespace Jacob\Hair;

use Backend;
use Jacob\Hair\Components\EnquiryForm;
use Jacob\Hair\Components\Tiles;
use System\Classes\PluginBase;

/**
 * Hair Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Hair',
            'description' => 'No description provided yet...',
            'author'      => 'Jacob',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'thumb' => [$this, 'thumb']
            ]
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            EnquiryForm::class => 'enquiry',
            Tiles::class => 'tiles',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
        ];
    }

    /**
     * Register mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'jacob.hair::mail.enquiry'    => 'Enquiry email',
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'enquiries' => [
                'label'       => 'Enquiries',
                'url'         => Backend::url('jacob/hair/enquiries'),
                'icon'        => 'icon-envelope',
                'permissions' => ['jacob.hair.*'],
                'order'       => 500,
            ],
        ];
    }

    public function thumb($img, $width, $height)
    {
        return Classes\Thumb::make($img, $width, $height);
    }

}
