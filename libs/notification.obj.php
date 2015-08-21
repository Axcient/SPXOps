<?php
/**
 * Notification object
 *
 * @author Gouverneur Thomas <tgo@espix.net>
 * @copyright Copyright (c) 2015, Gouverneur Thomas
 * @version 1.0
 * @package objects
 * @category classes
 * @subpackage backend
 * @filesource
 * @license https://raw.githubusercontent.com/tgouverneur/SPXOps/master/LICENSE.md Revised BSD License
 */
class Notification
{
  public static function jobSendNotification(&$job, $s_arg) {
  }

  public static function sendResult(Server &$s, Result $cr, Result $oldcr = null)
  {
      $a_login = array();

      if ($cr->rc == 0 && !$oldcr) { // First check result and it's OK, don't send anything.
          return;
      }

      Logger::log('Notification request...'.$cr.' / '.$oldcr, null, LLOG_DEBUG);

      if (!$cr->o_server && $cr->fk_server > 0) {
          $cr->fetchFK('fk_server');
      }
      if (!$cr->o_check && $cr->fk_check > 0) {
          $cr->fetchFK('fk_check');
      }

    /* fetch Server groups */
    $cr->o_server->fetchJT('a_sgroup');

    /* fetch Server Groups link to User Groups */
    foreach ($cr->o_server->a_sgroup as $sg) {
        $sg->fetchJT('a_ugroup');
      /* for each user group, add each login where notifications are enabled */
      foreach ($sg->a_ugroup as $ug) {
          $ug->fetchJT('a_login');
          foreach ($ug->a_login as $ugl) {
              if (!isset($a_login[$ugl->id]) && !$ugl->f_noalerts) {
                  $a_login[$ugl->id] = $ugl;
              }
          }
      }
    }

      $mfrom = Setting::get('general', 'mailfrom')->value;
      $domain = explode('@', $mfrom);
      $domain = $domain[0];
      $subject = $s.'/'.$cr->o_check.': '.Result::colorRC($cr->rc);
      $headers = 'From: '.$mfrom."\r\n";
      $headers .= 'X-Mailer: SPXOps'."\r\n";
      $headers .= 'Reply-To: no-reply@'.$domain."\r\n";
      $headers .= 'References: <'.Result::getHash($cr, $oldcr).'>'."\r\n";
      $msg = 'Device: '.$s."\r\n";
      $msg .= 'Check: '.$cr->o_check."\r\n";
      if ($oldcr && $cr->rc != $oldcr->rc) {
          $msg .= 'Result: '.Result::colorRC($cr->rc).' (old: '.Result::colorRC($oldcr->rc).')'."\r\n";
      } else {
          $msg .= 'Result: '.Result::colorRC($cr->rc)."\r\n";
      }
      $msg .= 'Message: '.$cr->message."\r\n";
      $msg .= 'When: '.date('d-m-Y H:m:s', $cr->t_upd)."\r\n";
      $msg .= 'Details: '.$cr->details."\r\n";
      if ($oldcr && strcmp($cr->details, $oldcr->details)) {
          $msg .= 'Old Details: '.$oldcr->details;
      }

      foreach ($a_login as $l) {
          Logger::log('Going to send notification for check '.$cr->o_check.' to '.$l, null, LLOG_DEBUG);
          mail($l->email, $subject, $msg, $headers);
      }
  }

    public static function sendMail($to, $short, $msg)
    {
        Logger::log('Mail message to: '.$to, null, LLOG_DEBUG);

        $mfrom = Setting::get('general', 'mailfrom')->value;
        $domain = explode('@', $mfrom);
        $domain = $domain[0];
        $subject = '[SPXOps] '.$short;
        $headers = 'From: '.$mfrom."\r\n";
        $headers .= 'X-Mailer: SPXOps'."\r\n";
        $headers .= 'Reply-To: no-reply@'.$domain."\r\n";
        mail($to, $subject, $msg, $headers);
    }

    public static function sendAlert(AlertType $at, $short, $msg)
    {
        $a_login = array();

        Logger::log('Notification request...'.$at, LLOG_DEBUG);

    /* fetch Server groups */
    $at->fetchJT('a_ugroup');

    /* for each user group, add each login where notifications are enabled */
    foreach ($at->a_ugroup as $ug) {
        $ug->fetchJT('a_login');
        foreach ($ug->a_login as $ugl) {
            if (!isset($a_login[$ugl->id]) && !$ugl->f_noalerts) {
                $a_login[$ugl->id] = $ugl;
            }
        }
    }

        $mfrom = Setting::get('general', 'mailfrom')->value;
        $domain = explode('@', $mfrom);
        $domain = $domain[0];
        $subject = '['.$at.'] '.$short;
        $headers = 'From: '.$mfrom."\r\n";
        $headers .= 'X-Mailer: SPXOps'."\r\n";
        $headers .= 'Reply-To: no-reply@'.$domain."\r\n";
        $msg .= 'When: '.date('d-m-Y H:m:s', $cr->t_upd)."\r\n";
        $msg .= 'Message: '.$msg."\r\n";

        foreach ($a_login as $l) {
            Logger::log('Going to send notification for check '.$cr->o_check.' to '.$l, LLOG_DEBUG);
            mail($l->email, $subject, $msg, $headers);
        }
    }

    public function fetchAll($all = 1)
    {
    }

  /**
   * ctor
   */
  public function __construct()
  {
  }
}
