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
class UserCount extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $display = 'simple';

    /**
     * @var boolean
     */
    public $showAdmin = false;

    /**
     * @var mixed
     */
    public $showGroup = [];

    /**
     * @var string
     */
    public $status = 'active';

    /**
     * @var string
     */
    public $widgetTitle = 'User Count';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('content-stats', 'User Count');
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
                ['widgetTitle', 'default', 'value' => 'User Count'],
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
            'content-stats/_components/widgets/UserCount_settings',
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
            'content-stats/_components/widgets/UserCount_body',
            [
                'display' => $this->display,
                'showAdmin' => $this->showAdmin,
                'showGroup' => $this->showGroup,
                'status' => $this->status === 'all' ? null : $this->status,
                'widgetTitle' => $this->widgetTitle,
                'widget' => $this,
            ]
        );
    }
}
