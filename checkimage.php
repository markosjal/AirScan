<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$refresh=2; // the frequency at which we will check and re-check
$file='222222';
// some lines of code to determine $statusmessagetxt

echo "retry: 1\ndata: {$file}\n\n";

?>
