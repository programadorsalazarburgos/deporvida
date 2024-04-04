	<?php
	error_reporting(0); // Set E_ALL for debuging
	require './autoload.php';
	elFinder::$netDrivers['ftp'] = 'FTP';
	function access($attr, $path, $data, $volume, $isDir, $relpath) 
	{
		$basename = basename($path);
		return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
				 && strlen($relpath) !== 1           // but with out volume root
			? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
			:  null;                                 // else elFinder decide it itself
	}
	$ds=DIRECTORY_SEPARATOR;
	$opts = array(
		// 'debug' => true,
		'roots' => array(
			// Items volume
			array(
				'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
				'path'          => '..'.$ds.'..'.$ds.'documentos'.$ds.'' . $_GET['user'].$ds,// path to files (REQUIRED)
				'URL'           => dirname($_SERVER['PHP_SELF']) . '..'.$ds.'..'.$ds.'..'.$ds.'documentos'.$ds .$_GET['user'].$ds, // URL to files (REQUIRED)
				'trashHash'     => 't1_Lw',                     // elFinder's hash of trash folder
				'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
				'uploadDeny'    => array(),                // All Mimetypes not allowed to upload
				'uploadAllow'   => array(),// Mimetype `image` and `text/plain` allowed to upload
				'uploadOrder'   => array(),      // allowed Mimetype `image` and `text/plain` only
				'accessControl' => 'access'                     // disable and hide dot starting files (OPTIONAL)
			),
			// Trash volume
			array(
				'id'            => '1',
				'driver'        => 'Trash',
				'path'          => '..'.$ds.'files'.$ds.'.trash'.$ds.'',
				'tmbURL'        => dirname($_SERVER['PHP_SELF']) . ''.$ds.'..'.$ds.'files'.$ds.'.trash'.$ds.'.tmb'.$ds.'',
				'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
				'uploadDeny'    => array(),                // Recomend the same settings as the original volume that uses the trash
				'uploadAllow'   => array(),// Same as above
				'uploadOrder'   => array(),      // Same as above
				'accessControl' => 'access',                    // Same as above
			)
		)
	);
	$connector = new elFinderConnector(new elFinder($opts));
	$connector->run();