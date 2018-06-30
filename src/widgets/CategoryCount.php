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
class CategoryCount extends Widget
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
    public $showGroup = [];

    /**
     * @var string
     */
    public $widgetTitle = 'Category Count';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('content-stats', 'Category Count');
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@wbrowar/contentstats/icon-mask.svg");
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
                ['widgetTitle', 'default', 'value' => 'Category Count'],
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
            'content-stats/_components/widgets/CategoryCount_settings',
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
            'content-stats/_components/widgets/CategoryCount_body',
            [
                'display' => $this->display,
                'showGroup' => $this->showGroup,
                'widgetTitle' => $this->widgetTitle,
                'widget' => $this,
            ]
        );
    }
}
