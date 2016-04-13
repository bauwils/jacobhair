<?php 
use Jofry\Fields\PageFields;
class Cms56e51c506dee0_4010731327Class extends \Cms\Classes\LayoutCode
{

public function onStart()
{
    PageFields::instance()->addValuesToPage($this);
   	//$this['tiles'] = with(new App\TileMaker($this))->all();
}

}
