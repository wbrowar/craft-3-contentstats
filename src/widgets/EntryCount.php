<?php
/**
 * Content Stats plugin for Craft CMS 3.x
 *
 * Display info about your site's entries.
 *
 * @link      http://wbrowar.com
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
 * @since     2.0.0
 */
class EntryCount extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $display = 'simple';

    /**
     * @var mixed
     */
    public $showSection = [];

    /**
     * @var string
     */
    public $status = 'live';

    /**
     * @var string
     */
    public $widgetTitle = 'Entry Count';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('content-stats', 'Entry Count');
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
                ['widgetTitle', 'default', 'value' => 'Entry Count'],
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
            'content-stats/_components/widgets/EntryCount_settings',
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

        //Craft::dd($this->showSection);

        return Craft::$app->getView()->renderTemplate(
            'content-stats/_components/widgets/EntryCount_body',
            [
                'display' => $this->display,
                'showSection' => $this->showSection,
                'status' => $this->status === 'all' ? null : $this->status,
                'widgetTitle' => $this->widgetTitle,
                'widget' => $this,
            ]
        );
    }
}
