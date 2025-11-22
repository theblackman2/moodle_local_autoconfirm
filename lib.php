<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Hook to inject custom JavaScript on signup confirmation page
 * This callback is called before HTML head is rendered
 */
function local_autoconfirm_before_standard_html_head()
{
  global $SESSION;

  // Check if we just auto-confirmed a user (flag set by observer)
  if (!empty($SESSION->local_autoconfirm_just_confirmed)) {
    // Clear the flag so it doesn't trigger again
    unset($SESSION->local_autoconfirm_just_confirmed);

    $loginurl = new moodle_url('/login/index.php');

    // Inject JavaScript to redirect immediately
    $js = "
        <script type='text/javascript'>
            window.location.href = '" . $loginurl->out(false) . "';
        </script>
        ";

    return $js;
  }

  return '';
}
