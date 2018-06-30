<?php
/**
 * Content Stats plugin for Craft CMS 3.x
 *
 * ...
 *
 * @link      http://sadfsdf.com
 * @copyright Copyright (c) 2018 dsafadsfqsd
 */

namespace wbrowar\contentstats\variables;

use wbrowar\contentstats\ContentStats;

use Craft;

/**
 * Content Stats Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.contentStats }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Will Browar
 * @package   ContentStats
 * @since     2.1.0
 */
class ContentStatsVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.contentStats.formattedFileSize }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.contentStats.formattedFileSize(1024) }}
     *
     * @param null $bytes
     * @return integer
     */
    public function formattedFileSize($bytes = 0)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 1) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 1) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 1) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
