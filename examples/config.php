<?PHP

$shell['title1'] = "jQuery Message Queuing";
$shell['link1']  = "http://benalman.com/projects/jquery-message-queuing-plugin/";

ob_start();
?>
  <a href="http://benalman.com/projects/jquery-message-queuing-plugin/">Project Home</a>,
  <a href="http://benalman.com/code/projects/jquery-message-queuing/docs/">Documentation</a>,
  <a href="http://github.com/cowboy/jquery-message-queuing/">Source</a>
<?
$shell['h3'] = ob_get_contents();
ob_end_clean();

$shell['jquery'] = 'jquery-1.3.2.js';

$shell['shBrush'] = array( 'JScript' );

?>
