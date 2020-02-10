#!/usr/local/bin/php
<?php
error_reporting( -1 );
ini_set( 'display_errors', 1 );
// directory to watch
$dirWatch = '/var/www';

// Open an inotify instance
$inoInst = inotify_init();

// this is needed so inotify_read while operate in non blocking mode
stream_set_blocking($inoInst, 0);

// watch if a file is created or deleted in our directory to watch
$watch_id = inotify_add_watch($inoInst, $dirWatch, IN_CREATE | IN_DELETE);

// not the best way but sufficient for this example :-)
while(true){

  // read events (
  // which is non blocking because of our use of stream_set_blocking
  $events = inotify_read($inoInst);

  // output data
  print_r($events);
}

// stop watching our directory
inotify_rm_watch($inoInst, $watch_id);

// close our inotify instance
fclose($inoInst);
?>
