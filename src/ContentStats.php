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

use wbrowar\contentstats\services\EntryCount as EntryCountService;
use wbrowar\contentstats\widgets\EntryCount as EntryCountWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class ContentStats
 *
 * @author    Will Browar
 * @package   ContentStats
 * @since     2.0.0
 *
 * @property  EntryCountService $entryCount
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

        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = EntryCountWidget::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'content-stats',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
