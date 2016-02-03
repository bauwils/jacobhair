<?php 
namespace Jofry\Fields;
use Yaml;
use Request;
use Log;
/**
 * Page Fields
 */
class PageFields
{
    use \October\Rain\Support\Traits\Singleton;

    protected $widget = null;
    protected $controller = null;

    protected $isLoaded = false;

    /**
     * Excluding loading custom fields on these
     *
     * @var array
     */
    protected $repeatingHandlers = [
        'onAddItem'
    ];


    /**
     * Load fields for Pages in the CMS section of the site
     *
     * @param  [Widget Object] $widget Called in Plugins.php ->register()
     *
     */
    public function loadFields($widget)
    {
        if ($this->isLoaded) {
            return;
        }

        $this->widget = $widget;
        $this->controller = $widget->getController();

        if ($this->isExcludedHandler($this->controller)) {
            trace_log('excluded');
            // return;
        }

        $pageFilename = $this->getTemplateFilename($widget->model->filename);

        $fields = $this->getFields($pageFilename);

        if(count($fields) > 0) {
            //Primary = normal tabs
            //Secondary = the code editor
            //outside = Top banner

            //Check if there are any tabs
            if(isset($fields['tabs'])) {
                $widget->addTabFields($fields['tabs'],'primary');
            }

            //Check if there are any standalone fields
            if(isset($fields['fields'])) {
                $storedData = $this->getValues($pageFilename);

                //Load all of our data into the widget thingy
                foreach($storedData as $name => $value) {
                    // tracelog($name);
                    // tracelog($value);
                    
                    $widget->data[$name] = $value;
                }

                $widget->addFields($fields['fields'], 'primary');
            }

            //Breaks layouts
            // $widget->removeField('markup');
            // $widget->removeField('code');
        }

        $this->isLoaded = true;
    }

    /**
     * Get the full path to the PageFields dir
     *
     * @return [string] Path
     */
    private function getDir()
    {
        return plugins_path('jofry/fields/fields/');
    }


    /**
     * [getFields description]
     *
     * @param  [string] $filename The template name
     *
     * @return [type]           [description]
     */
    private function getFields($filename) 
    {
        $fields = [];

        $fullPath = $this->getDir() . 'forms/' . $filename . '.yaml';

        if(file_exists($fullPath)) {
            $fields = \Yaml::parseFile($fullPath);
        }

        $defaultFieldsPath = $this->getDir() . 'forms/_default.yaml';
        if (file_exists($defaultFieldsPath)) {
            $defaultFields = \Yaml::parseFile();

            foreach($defaultFields['fields'] as $name => $field) {
                $fields['fields'][$name] = $field;
            }
        }

        return $fields;
    }

    protected function isExcludedHandler($controller)
    {
        tracelog($controller->getAjaxHandler());

        if (!($handler = $controller->getAjaxHandler())) {
            return true;
        }

        if (strpos($handler, '::')) {
            $handlerName = explode('::', $handler)[1];
        } else {
            $handlerName = $handler;
        }

        if (in_array($handlerName, $this->repeatingHandlers)) {
            return true;
        }

        return false;
    }

    public function getTemplateFilename($filename)
    {

        $path = pathinfo($filename);

        $url = $path['filename'];

        //Remove ./
        $url = str_replace('./', '', $url);

        if(isset($path['dirname']) && $path['dirname'] != '') {

            if(trim($path['dirname']) != '.') {
                $url = $path['dirname'] . '/' . $url;
            }
        }

        return $url;
    }

    /**
     * [saveFieldValues description]
     *
     * @param  [type] $model [description]
     *
     */
    public function saveValues($model) 
    {

        $templateFilename = $this->getTemplateFilename($model->filename);

        $fields = $this->getFields($templateFilename);

        if (!isset($fields['fields'])) {
            return;
        }

        $fieldNames = array_keys($fields['fields']);

        $templateData = [];
        foreach ($fieldNames as $name) {
            if (array_key_exists($name, $_POST)) {
                $templateData[$name] = \Request::input($name);
            }
        }

        //Save the values to the data folder\
        $dirPath = $this->getDir() . 'data/' . strtolower(env('APP_ENV')) . '/';
        //Make sure the folder exists first
        if (!is_dir($dirPath)) {
            mkdir($dirPath);
        }

        //Store the contents into the file
        $path = $dirPath . $templateFilename . '.yaml';
        $yamlString = Yaml::render($templateData);
        file_put_contents($path, $yamlString);
    }

    /**
     * Gets the saved Values from the Cache
     *
     * @param  [string] $pageFilename The Page filename
     *
     * @return [array] Returns an Array of field_name => values
     */
    public function getValues($pageFilename)
    {
        $filePath = $this->getDir() . 'data/' . strtolower(env('APP_ENV')) . '/' . $pageFilename . '.yaml';

        if(file_exists($filePath)) {
            try {
                return Yaml::parseFile($filePath);
            } catch (Exception $e) {
                //Something wrong with the file, unfortunately your data is now lost
                return [];
            }
        } else {
            return [];
        }
    }

    /**
     * Add the values to the this.page array for the templates to use
     *
     * @param [object] $app Lord only knows what this thing is, its $this on a page
     */
    public function addValuesToPage($app)
    {
        $filename = $this->getTemplateFilename($app->page->filename);
        $values = $this->getValues($filename);

//        echo '<pre>';
//         var_dump($values);
//         echo '</pre>';
//         die;

        
        foreach($values as $name => $value) {
            $app->page->settings[$name] = $value;
        }
    }
}