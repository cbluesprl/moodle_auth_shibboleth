<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contains a helper class for the Shibboleth authentication plugin.
 *
 * @package    auth_shibboleth
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_shibboleth;

defined('MOODLE_INTERNAL') || die();

/**
 * The helper class for the Shibboleth authentication plugin.
 *
 * @package    auth_shibboleth
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {

    /**
     * @param string $spsessionid SP-provided Shibboleth Session ID
     * @throws \dml_exception
     */
    public static function logout_session($spsessionid) {
        global $DB;

        if ($DB->record_exists('shibboleth_session', ['shibboleth_id' => $spsessionid])) {
            $shibboleth_session = $DB->get_record('shibboleth_session', ['shibboleth_id' => $spsessionid]);
            \core\session\manager::kill_session($shibboleth_session->session_id);
            $DB->delete_records('shibboleth_session', ['shibboleth_id' => $spsessionid]);
        }
    }
}
