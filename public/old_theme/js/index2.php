<?php
// fetch JavaScript files to compress
$jsfiles = array_keys($_GET);

$path = $_SERVER['DOCUMENT_ROOT']  .'/old_theme/js';

$jsfiles = [
    //'slick.js',
    //$path.'/scripts/a_common/common.js',
    'scripts.js',
];

$js = '';		// code to compress
$jscomp = '';	// compressed JS
$err = '';		// error string
$reduced = -1;	// compression saving

// fetch JavaScript files
for ($i = 0, $j = count($jsfiles); $i < $j; $i++) {

	$fn = $jsfiles[$i];
	$jscode = file_get_contents($fn);
	if ($jscode !== false) {
		$js .= $jscode . "\n";
	}
	else {
		$err .= $fn . '; ';
	}
}
header("Cache-control: public");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*24) . " GMT");
	header("Content-type: text/javascript");

	function compress($buffer) {

		//$buffer = preg_replace("/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/", "", $buffer);
		//$buffer = str_replace(array("\r\n", "\r", "\n", "\t", "  ", "    ", "    "), "", $buffer);

		return $buffer;

	}

	ob_start("compress");

	echo $js;

	ob_end_flush();
