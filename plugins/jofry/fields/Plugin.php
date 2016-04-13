<?php namespace Jofry\Fields;

use App;
use Backend;
use BackendAuth;
use Carbon\Carbon;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Event;
use October\Rain\Auth\AuthException;
use October\Rain\Exception\ApplicationException;
use System\Classes\PluginBase;

/**
 * Food Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Shortcue to this namespace
     *
     * @var string
     */
    protected $namespace = '\\Jofry\\Fields\\';

    protected $pageFields = null;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Custom Page Fields',
            'description' => 'Customisations and enhancements to CMS Fields',
            'author'      => 'True Agency',
            'icon'        => 'icon-user'
        ];
    }

    /**
     * Register permissions provided by plugin
     * 
     * @return array
     */
    public function registerPermissions()
    {
        return [
        ];
    }

    /**
     * Additional backend navigation
     * @see  http://octobercms.com/docs/plugin/registration
     *     
     * @return array
     */
    public function registerNavigation()
    {
        return [
            
        ];
    }

    /**
     * Register additional components
     * @see http://octobercms.com/docs/plugin/components
     * 
     * @return array
     */
    public function registerComponents()
    {
        return [
        ];
    }

    /**
     * Register report widgets.
     * @see http://octobercms.com/docs/backend/widgets
     *
     * @return array
     */
    public function registerReportWidgets()
    {
        return [];

    }

    public function registerFormWidgets()
    {
        return [
        ];
    }

    /**
     * Register additional twig markups
     * 
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
        ];
    }

    /**
     * Return additional settings provided by this plugin
     * 
     * @return array
     */
    public function registerSettings()
    {
        return [
        ];
    }

    //Disabled for now, could cause problems with stuff being stored in the db
    public function registerMailTemplates()
    {

        return [
        ];
    }

    public function registerSchedule($schedule)
    {
    }

    /**
     * Register services
     *
     * @return void
     */
    public function register() 
    {
        //Add custom fields to pages
        Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->model instanceof \Cms\Classes\Page) return;
  
            $this->pageFields->loadFields($widget);
            return $widget;
        });

        //Save custom fields to the template
        $justSaved = '';
        Event::listen('cms.template.save', function($controller, $template, $type) use ($justSaved)
        {   
            //Page only
            if($type != 'page') return;

            //No infinite loops here thank you sir!
            if($justSaved == $template->filename) return;

            $justSaved = $template->filename;
            
            $this->pageFields->saveValues($template);

        });

        Event::listen('cms.page.beforeDisplay', function($controller, $url, $page)
        {
            $this->pageFields->addValuesToPage($page);
        });
    }

    /**
     * Additional registration when this plugin is booted
     *
     * @return void
     */
    public function boot()
    {
        $this->pageFields = PageFields::instance();
        
    }

}
