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
 * Piwik Analytics
 *
 * This module provides extensive analytics, without the privacy concerns
 * of using Google Analytics, see install_piwik.txt for installing Piwik
 *
 * @package    local_analytics
 * @copyright  2013 David Bezemer, www.davidbezemer.nl
 * @author     David Bezemer
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
function analytics_trackurl() {
    global $DB, $PAGE, $COURSE;
    $pageinfo = get_context_info_array($PAGE->context->id);
    $trackurl = "'";

    if ($COURSE->id == 1) {
        return 'document.title';
    }

    // Adds course category name.
    if (isset($pageinfo[1]->category)) {
        if ($category = $DB->get_record('course_categories', array('id'=>$pageinfo[1]->category))) {
			$cats=explode("/",$category->path);
			foreach ($cats as $cat) {
				if ($categorydepth = $DB->get_record("course_categories", array("id" => $cat))) {;
					$trackurl .= $categorydepth->name.'/';
				}
			}
        }
    }

    // Adds course full name.
    if (isset($pageinfo[1]->fullname)) {
		if (isset($pageinfo[2]->name)) {
			$trackurl .= $pageinfo[1]->fullname.'/';
		} else if ($PAGE->user_is_editing()) {
			$trackurl .= $pageinfo[1]->fullname.'/'.get_string('edit', 'local_analytics');
		} else {
			$trackurl .= $pageinfo[1]->fullname.'/'.get_string('view', 'local_analytics');
		}
    }

    // Adds activity name.
    if (isset($pageinfo[2]->name)) {
        $trackurl .= $pageinfo[2]->modname.'/'.$pageinfo[2]->name;
    }
	
	$trackurl .= "'";
	return $trackurl;
}
 
function insert_analytics_tracking() {
    global $CFG;
    $enabled = get_config('local_analytics', 'enabled');
    $imagetrack = get_config('local_analytics', 'imagetrack');
    $siteurl = get_config('local_analytics', 'siteurl');
    $siteid = get_config('local_analytics', 'siteid');
    $trackadmin = get_config('local_analytics', 'trackadmin');
}

insert_analytics_tracking();