<?php namespace Publipresse\TwigExtensions;

use System\Classes\PluginBase;

use Dusterio\LinkPreview\Client as LinkPreview;

class Plugin extends PluginBase
{
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'linkpreview' => [$this, 'linkPreview']
            ],
        ];
    }

    public function linkPreview($text, $parser = null) {
        $client = new LinkPreview($text);
        if(!$parser) {
            $preview = $client->getPreviews();
        } else {
            $preview = $client->getPreview($parser)->toArray();
        }
        return $preview;
    }
}
