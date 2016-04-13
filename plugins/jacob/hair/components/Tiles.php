<?php namespace Jacob\Hair\Components;

use App\TileMaker;
use Cms\Classes\ComponentBase;

class Tiles extends ComponentBase
{
    public $tiles;

    public function componentDetails()
    {
        return [
            'name'        => 'Tiles',
            'description' => 'Render Tiles'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {
        $this->tiles = with(new TileMaker())->allChunked();
    }

    public function onShowPopup()
    {
        $tiles = with(new TileMaker())->all();
        $popupTile = null;

        foreach ($tiles as $key => $tile) {
            if (post('id') === $key) {
                $popupTile = $tile;
                break;
            }
        }

        return [
            'result' => $this->renderPartial('@_popup_tile', ['tile' => $popupTile])
        ];
    }

}