<?php
namespace local_autoconfirm;

defined('MOODLE_INTERNAL') || die();

class observer {

    /**
     * Event observer for \\core\\event\\user_created
     *
     * @param \core\event\user_created $event
     * @return void
     */
    public static function user_created(\core\event\user_created $event) {
        global $DB;

        // Get the user snapshot from the event
        $user = $event->get_record_snapshot('user', $event->objectid);

        // Only target users created by the email self-registration plugin
        if (!empty($user) && isset($user->auth) && $user->auth === 'email' && empty($user->confirmed)) {
            $DB->set_field('user', 'confirmed', 1, ['id' => $user->id]);
        }
    }
}
