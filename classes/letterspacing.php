<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Widget definition
 *
 * @package     accessibility_letterspacing
 * @copyright   2025 Ponlawat Weerapanpisit <ponlawat_w@outlook.co.th>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace accessibility_letterspacing;

use local_accessibility\widgets\rangewidget;

/**
 * Letter spacing accessibility widget definition
 */
class letterspacing extends rangewidget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            get_string('pluginname', 'accessibility_letterspacing'),
            'letterspacing',
            -0.1,
            0.5,
            0.1,
            0
        );
    }

    /**
     * Widget initialisation
     *
     * @return void
     */
    public function init() {
        global $PAGE;

        $userconfig = $this->getuserconfig();
        if ($userconfig) {
            // We set the userconfig variable because we perhaps need it for the amd script too.
            $userconfig = clean_param($userconfig, PARAM_FLOAT);
            $this->addbodyclass('accessibility-letterspacing-' . round($userconfig * 100));
        }

        /** @var \moodle_page $PAGE */
        $PAGE->requires->js_call_amd('accessibility_letterspacing/script', 'init', [$userconfig]);
    }
}
