<?php
/**
 * Content Stats plugin for Craft CMS 3.x
 *
 * This is a generic Craft CMS plugin
 *
 * @link      https://wbrowar.com
 * @copyright Copyright (c) 2018 Will Browar
 */

namespace wbrowar\contentstats\widgets;

use wbrowar\contentstats\assetbundles\contentstats\ContentStatsAsset;

use Craft;
use craft\base\Widget;

/**
 * Content Stats Widget
 *
 * @author    Will Browar
 * @package   ContentStats
 * @since     2.1.0
 */
class AssetCount extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var mixed
     */
    public $display = 'simple';

    /**
     * @var mixed
     */
    public $showVolume = [];

    /**
     * @var mixed
     */
    public $status = 'live';

    /**
     * @var string
     */
    public $widgetTitle = 'Asset Count';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('content-stats', 'Asset Count');
    }

    /**
     * @inheritdoc
     */
    public static function icon()
    {
        return Craft::getAlias("@wbrowar/contentstats/assetbundles/contentstats/dist/icon/icon-mask.svg");
    }

    /**
     * @inheritdoc
     */
    public static function maxColspan()
    {
        return null;
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge(
            $rules,
            [
                [['display','widgetTitle'], 'string'],
                ['display', 'default', 'value' => 'simple'],
                ['widgetTitle', 'default', 'value' => 'Asset Count'],
            ]
        );
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'content-stats/_components/widgets/AssetCount_settings',
            [
                'settings' => $this->settings,
                'widget' => $this
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getBodyHtml()
    {
        Craft::$app->getView()->registerAssetBundle(ContentStatsAsset::class);

        return Craft::$app->getView()->renderTemplate(
            'content-stats/_components/widgets/AssetCount_body',
            [
                'display' => $this->display,
                'showVolume' => $this->showVolume,
                'widgetTitle' => $this->widgetTitle,
                'widget' => $this,
            ]
        );
    }
}
