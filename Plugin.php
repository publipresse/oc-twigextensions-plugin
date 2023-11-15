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
        return !empty($url)? getimagesize($url)[0] : null;
    }
    
    public function imageHeight($url) {
        return !empty($url)? getimagesize($url)[1] : null;
    }
    
    public function imageDimensions($url) {
        return !empty($url)? getimagesize($url)[3] : null;
    }
}
