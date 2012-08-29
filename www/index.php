<?php
 require_once("../libs/autoload.lib.php");
 require_once("../libs/config.inc.php");

 $m = mysqlCM::getInstance();
 if ($m->connect()) {
   HTTP::getInstance()->errMysql();
 }
 $lm = loginCM::getInstance();
 $lm->startSession();
 $h = HTTP::getInstance();
 $h->parseUrl();

 /* Page setup */
 $page = array();
 $page['title'] = 'Home';

 $stats = array();
 $stats['nblogin'] = $m->count('list_login');
 $stats['nbswitch'] = $m->count('list_switch');
 $stats['nbos'] = $m->count('list_os');
 $stats['nbmodel'] = $m->count('list_model');
 $stats['nbsrv'] = $m->count('list_server');
 $stats['nbpsrv'] = $m->count('list_pserver');
 $stats['nbdisk'] = $m->count('list_disk');
 $stats['nbcl'] = 0;


 $index = new Template("../tpl/index.tpl");
 $head = new Template("../tpl/head.tpl");
 $head->set('page', $page);

 $foot = new Template("../tpl/foot.tpl");
 $foot->set("start_time", $start_time);
 $content = new Template("../tpl/home.tpl");
 $content->set('stats', $stats);

 $index->set('head', $head);
 $index->set('content', $content);
 $index->set('foot', $foot);

 echo $index->fetch();

?>
