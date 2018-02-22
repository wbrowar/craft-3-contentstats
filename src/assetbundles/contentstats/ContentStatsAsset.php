<?php
/**
 * Content Stats plugin for Craft CMS 3.x
 *
 * Display info about your site's entries.
 *
 * @link      http://wbrowar.com
 * @copyright Copyright (c) 2018 Will Browar
 */

namespace wbrowar\contentstats\assetbundles\contentstats;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Will Browar
 * @package   ContentStats
 * @since     2.0.0
 */
class ContentStatsAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@wbrowar/contentstats/assetbundles/contentstats/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/contentstats.js',
        ];

        $this->css = [
            'css/contentstats.css',
        ];

        parent::init();
    }
}
