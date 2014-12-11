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

 if (!$h->isAjax()) {
   /* Page setup */
   $page = array();
   $page['title'] = 'Error';
   if ($lm->o_login) $page['login'] = &$lm->o_login;

   $index = new Template("../tpl/index.tpl");
   $head = new Template("../tpl/head.tpl");
   $head->set('page', $page);
   $foot = new Template("../tpl/foot.tpl");
   $foot->set("start_time", $start_time);

   $content = new Template("../tpl/error.tpl");
   $content->set('error', "The page you requested cannot be called as-is...");

   $index->set('head', $head);
   $index->set('content', $content);
   $index->set('foot', $foot);
   echo $index->fetch();
   exit(0);
 }

 if (isset($_GET['w']) && !empty($_GET['w'])) {
   switch($_GET['w']) {
     case 'saveslr':
        if (!isset($_POST['name']) || empty($_POST['name'])) {
         die('Missing argument');
       }
        if (!isset($_POST['mets']) || empty($_POST['mets'])) { 
         die('Missing argument');
       }
       $name = $_POST['name'];
       $mets = $_POST['mets'];
       $slr = new SLR();
       $slr->name = $name;
       if (!$slr->fetchFromField('name')) { 
         die('Name already taken');
       }
       $slr->definition = serialize($mets);
       $slr->insert();
       $ret = array('success');
       header('Content-Type: application/json');
       echo json_encode($ret);
    break;
     case 'lslr':
       $a_s = SLR::getAll(true, array(), array('name'));
       foreach($a_s as $s) $s->getArray();
       header('Content-Type: application/json');
       echo json_encode($a_s);
     break;
     case 'lserver':
       $a_s = Server::getAll(true, array(), array('hostname'));
       header('Content-Type: application/json');
       echo json_encode($a_s);
     break;
     case 'lmet':
       if (!isset($_GET['i']) || empty($_GET['i']) || !is_numeric($_GET['i'])) {
         die('Missing argument');
       }
       $id = $_GET['i'];
       $rrd = new RRD($id);
       if ($rrd->fetchFromId()) {
         die('Wrong argument');
       }
       $val = $rrd->getWhat('all');
       $ret = array();
       $i = 0;
       foreach($val as $k => $v) {
         $ret[$i]['name'] = $k;
         $ret[$i]['value'] = $v;
	 $i++;
       }
       header('Content-Type: application/json');
       echo json_encode($ret);
     break;
     case 'lrrd':
       if (!isset($_GET['i']) || empty($_GET['i']) || !is_numeric($_GET['i'])) {
         die('Missing argument');
       }
       $id = $_GET['i'];
       $a_rrd = RRD::getAll(true, array('fk_server' => 'CST:'.$id), array('type'));
       header('Content-Type: application/json');
       echo json_encode($a_rrd);
     break;
     case 'slr':
       if (!isset($_GET['i']) || empty($_GET['i']) || !is_numeric($_GET['i'])) {
         die('Missing argument');
       }
       $id = $_GET['i'];
       $slr = new SLR($id);
       if ($slr->fetchFromId()) {
         die('SLR not found in DB');
       }
       $slr->getArray();
       header('Content-Type: application/json');
       echo json_encode($slr);
     break;
     case 'server':
       if (!isset($_GET['s']) || empty($_GET['s'])) {
	  die('Missing argument');
       }
       if (!isset($_GET['i']) || empty($_GET['i']) || !is_numeric($_GET['i'])) {
         die('Missing argument');
       }
       $id = $_GET['i'];
       $a_server = Server::getAll(true, array('fk_os' => 'CST:'.$id), array('hostname'));
       header('Content-Type: application/json');
       echo json_encode($a_server);
     break;
     default:
       die('Unknown option or not implemented');
     break;
   }
 }

?>
