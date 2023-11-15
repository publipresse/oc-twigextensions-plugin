<?php namespace Publipresse\TwigExtensions;

use System\Classes\PluginBase;

use Dusterio\LinkPreview\Client as LinkPreview;

class Plugin extends PluginBase
{
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'linkpreview' => [$this, 'linkPreview'],
                'imagewidth' => [$this, 'imageWidth'],
                'imageweight' => [$this, 'imageHeight'],
                'imagedimensions' => [$this, 'imageDimensions'],
            ],
        ];
    }

    public function linkPreview($url, $parser = null) {
        $client = new LinkPreview($url);
        if(!$parser) {
            $preview = $client->getPreviews();
        } else {
            $preview = $client->getPreview($parser)->toArray();
        }
        return $preview;
    }

    public function imageWidth($url) {
        $data = getimagesize($url);
        return $data[0];
    }

    public function imageHeight($url) {
        $data = getimagesize($url);
        return $data[1];
    }

    public function imageDimensions($url) {
        $data = getimagesize($url);
        return $data[3];
    }
}
