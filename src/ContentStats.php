<?php
/**
 * Content Stats plugin for Craft CMS 3.x
 *
 * Display info about your site's entries.
 *
 * @link      http://wbrowar.com
 * @copyright Copyright (c) 2018 Will Browar
 */

namespace wbrowar\contentstats;

use wbrowar\contentstats\variables\ContentStatsVariable;
use wbrowar\contentstats\widgets\AssetCount;
use wbrowar\contentstats\widgets\CategoryCount;
use wbrowar\contentstats\widgets\EntryCount;
use wbrowar\contentstats\widgets\UserCount;

use Craft;
use craft\base\Plugin;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class ContentStats
 *
 * @author    Will Browar
 * @package   ContentStats
 * @since     2.0.0
 *
 */
class ContentStats extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ContentStats
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '2.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('contentStats', ContentStatsVariable::class);
            }
        );

        // Add our widgets
        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = AssetCount::class;
                $event->types[] = CategoryCount::class;
                $event->types[] = EntryCount::class;
                $event->types[] = UserCount::class;
            }
        );

        // Log that the plugin has been loaded
        Craft::info(
            Craft::t(
                'content-stats',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
