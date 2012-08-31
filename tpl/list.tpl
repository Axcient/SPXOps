<?php 
  $cols = call_user_func($oc.'::printCols');
  if (!$a_list) $a_list = array();
?>
      <div class="row">
        <div class="row">
  	  <h1 class="span8">List of <?php echo $what; ?></h1>
        </div>
        <div class="row">
          <div class="span12">
  	   <table class="table table-striped table-bordered table-hover table-condensed">
  	    <thead>
	     <tr>
<?php foreach($cols as $e => $k) { ?>
               <th><?php echo $e; ?></th>
<?php } ?>
<?php if (isset($canMod)) { ?>
               <th></th>
<?php } ?>
<?php if (isset($canDel)) { ?>
               <th></th>
<?php } ?>
<?php if (isset($canView)) { ?>
               <th></th>
<?php } ?>
	     </tr>
	    </thead>
	    <tbody>
<?php foreach($a_list as $e) { $a = $e->toArray(); ?>
             <tr>
   <?php foreach($cols as $v) { 
	   if (preg_match('/^f_/', $v)) {
	     if ($a[$v]) {
	       $fl = '<i class="icon-ok-sign"></i>';
	     } else {
	       $fl = '<i class="icon-remove-sign"></i>';
	     }
    ?>
               <td><?php echo $fl; ?></td>
    <?php
	   } else {
    ?>
               <td><?php echo $a[$v]; ?></td>
    <?php  } ?>
   <?php } ?>
<?php if (isset($canMod)) { ?>
               <td><a href="/edit/w/<?php echo strtolower($oc); ?>/i/<?php echo $e->id; ?>">Edit</a></td>
<?php } ?>
<?php if (isset($canDel)) { ?>
               <td><a href="/del/w/<?php echo strtolower($oc); ?>/i/<?php echo $e->id; ?>">Del</a></td>
<?php } ?>
<?php if (isset($canView)) { ?>
               <td><a href="/view/w/<?php echo strtolower($oc); ?>/i/<?php echo $e->id; ?>">View</a></td>
<?php } ?>
             </tr>
<?php } ?>
	    </tbody>
	   </table>
         </div>
	</div>
<?php if (isset($actions)) { ?>
        <div class="row">
          <div class="span4">
           <h3>Actions</h3>
            <ul class="nav nav-tabs nav-stacked">
<?php foreach($actions as $name => $link) { ?>
              <li><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
<?php } ?>
            </ul>
          </div>
	</div>
<?php } ?>
      </div>