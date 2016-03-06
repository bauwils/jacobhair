<?php 
use Jofry\Fields\PageFields;
class Cms56dc11380ef03_4001174909Class extends \Cms\Classes\LayoutCode
{

public function onStart()
{
    PageFields::instance()->addValuesToPage($this);
}

}
