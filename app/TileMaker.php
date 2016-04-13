<?php 
namespace App;

class TileMaker
{

    protected $haircutTiles = [];
    protected $productTiles = [];

    protected $mixedTiles = [];

    public function __construct($cmsPage = null)
    {
        if (!$cmsPage) {
            // Retrieve page instance from controller
            $cmsPage = \Cms\Classes\Controller::getController()->getPage();
        }
        $this->haircutTiles = $cmsPage->settings['haircut_tiles'];
        $this->productTiles = $cmsPage->settings['product_tiles'];
    }

    public function all()
    {
        if ($this->isEmpty())
            return [];

        if (count($this->mixedTiles) <= 0)
            $this->mixedTiles = $this->makeMixedTiles();

        return $this->mixedTiles;
    }

    public function allChunked()
    {
        return array_chunk($this->all(), 2, true);
    }

    public function isEmpty()
    {
        return (count($this->haircutTiles) + count($this->productTiles)) <= 0;
    }

    protected function makeMixedTiles()
    {
        $tilesOne = $this->haircutTiles;
        $tilesTwo  = $this->productTiles;
        $result = [];

        $idx = 1;

        while ((count($tilesOne) + count($tilesTwo)) > 0) {

            $result['tile_one_' . $idx] = count($tilesOne) > 0
                ? array_shift($tilesOne)
                : $this->makeEmptyTile();

            $result['tile_two_' . $idx] = count($tilesTwo) > 0
                ? array_shift($tilesTwo)
                : $this->makeEmptyTile();

            $idx++;
        }

        return $result;
    }

    protected function makeEmptyTile()
    {
        return [
            'photo' => 'empty',
            'title' => 'empty',
            'description' => 'empty',
        ];
    }
}