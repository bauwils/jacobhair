<?php namespace Jacob\Hair;

use Backend;
use Jacob\Hair\Components\EnquiryForm;
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

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            EnquiryForm::class => 'enquiry',
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

}
