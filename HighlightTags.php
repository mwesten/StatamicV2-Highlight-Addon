<?php

namespace Statamic\Addons\Highlight;

use Statamic\API\Path;
use Statamic\Extend\Tags;


class HighlightTags extends Tags
{
    /**
     * The {{ highlight }} tag
     *
     * Enables the Highlight.js script to color-code codeblocks.
     * parameter: style (defaults to 'default') contains the name of the optional style (css filename without the '.css')     
     * can be called with the style parameter like this: {{ highlight style="sunburst" }} to override the default or configured stylesheet
     *
     * @return string containing the css and js includes to be placed in the <HEAD> tags
     */
    public function index()
    {
        $baseCodeStyle = $this->getConfig('codestyle', 'default');
        $name = $this->getParam('style', $baseCodeStyle); // Style name defaults to 'default'
        $baseLibVer = $this->getConfig('library_version', 'small');
        
        $style = $this->css->tag($name);
        $js1 = $this->js->tag('highlight.pack.'.$baseLibVer);
        $js = '
        <script type="text/javascript">
          hljs.initHighlightingOnLoad();
        </script>';

        return $style . $js1 . $js;
    }

}
