      <div class="row">
        <div class="span12">
          <div class="hero-unit">
            <h1>Welcome to Espix Operations</h1>
            <p>You can manage different flavours of UNIX operating systems using this portal, simply browse through the menu or check the documentation to see how to get more benefit of this portal.</p>
  	    <p>
  	      <a class="btn btn-primary btn-large" href="http://spxops.espix.net/docs">Documentation</a>
	    </p>
          </div>
          <div class="row">
	    <div class="span4">
	      <h2>DB Statistics</h2>
	      <ul>
		<li>Servers: <?php echo $stats['nbsrv']; ?> registered</li>
		<li>Clusters: <?php echo $stats['nbcl']; ?> registered</li>
		<li>Chassis: <?php echo $stats['nbpsrv']; ?> registered</li>
		<li>Disks: <?php echo $stats['nbdisk']; ?> detected</li>
		<li>HW Model: <?php echo $stats['nbmodel']; ?> detected</li>
		<li>Network Switches: <?php echo $stats['nbswitch']; ?> detected</li>
		<li>Portal Users: <?php echo $stats['nblogin']; ?> registered</li>
		<li>SSH Users: <?php echo $stats['nbsuser']; ?> registered</li>
	      </ul>
	    </div>
            <div class="span4">
              <h2>Last Checks</h2>
              <ul>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
              </ul>
	      <a class="btn" href="#">More..</a>
            </div>
            <div class="span4">
              <h2>Last Checks</h2>
              <ul>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
                <li>This is a test check result message</li>
              </ul>
              <a class="btn" href="#">More..</a>
            </div>
  	  </div>
	  <div class="row">
 	    <div class="span6">
              <h2>Last Jobs</h2>
              <ul>
<?php foreach($a_job as $job) { ?>
                <li><?php echo $job; ?></li>
<?php } ?>
              </ul>
	      <a class="btn" href="/list/w/jobs">More..</a>
            </div>
	    <div class="span6">
              <h2>User Activities</h2>
              <ul>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
                <li>User a0p60721 launched RCE "ps -eaf" on 2 servers (<a href="#">details</a>)</li>
              </ul>
	      <a class="btn" href="#">More..</a>
            </div>
	  </div>
        </div>
      </div>