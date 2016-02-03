<?php 
use Jofry\Fields\PageFields;
class Cms56b1e95c8d597_245981144Class extends \Cms\Classes\LayoutCode
{

public function onStart()
{
    PageFields::instance()->addValuesToPage($this);
}

}
