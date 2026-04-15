<?php namespace Publipresse\TwigExtensions;

use System\Classes\PluginBase;

use Hazaveh\LinkPreview\Client as LinkPreview;

class Plugin extends PluginBase
{
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'linkpreview' => [$this, 'linkPreview'],
                'imagewidth' => [$this, 'imageWidth'],
                'imageheight' => [$this, 'imageHeight'],
                'imagedimensions' => [$this, 'imageDimensions'],
            ],
        ];
    }

    public function linkPreview($url, $parser = null) {
        $client = new LinkPreview();
        $preview = $client->parse($url);
        return $preview;
    }

    protected function imageSize($url): array
    {
        if (empty($url)) return [];
        $path = public_path(parse_url($url, PHP_URL_PATH));
        return @getimagesize($path) ?: [];
    }

    public function imageWidth($url) { 
        return $this->imageSize($url)[0] ?? null; 
    }

    public function imageHeight($url) { 
        return $this->imageSize($url)[1] ?? null; 
    }
    
    public function imageDimensions($url) { 
        return $this->imageSize($url)[3] ?? null; 
    }
}
