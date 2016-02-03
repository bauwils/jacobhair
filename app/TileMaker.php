<?php 
namespace App;

class TileMaker
{

    protected $haircutTiles = [];
    protected $productTiles = [];

    protected $mixedTiles = [];

    public function __construct($cmsPage)
    {
        $this->haircutTiles = $cmsPage->page->settings['haircut_tiles'];
        $this->productTiles = $cmsPage->page->settings['product_tiles'];

    }

    public function all()
    {
        if ($this->isEmpty())
            return [];

        if (count($this->mixedTiles) <= 0)
            $this->mixedTiles = $this->makeMixedTiles();

        return $this->mixedTiles;
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

        while ((count($tilesOne) + count($tilesTwo)) > 0) {

            $result[] = count($tilesOne) > 0
                ? array_shift($tilesOne)
                : $this->makeEmptyTile();

            $result[] = count($tilesTwo) > 0
                ? array_shift($tilesTwo)
                : $this->makeEmptyTile();
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