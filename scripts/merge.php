<?php


function scan($dir){
    $result = [];
    $handle = opendir($dir);
    if ( $handle ){
        while ( ( $file = readdir ( $handle ) ) !== false ){
            if ( $file != '.' && $file != '..' && $file != '.DS_Store'){
                $absPath = $dir . DIRECTORY_SEPARATOR . $file;
                if ( is_dir ( $absPath ) ){
                    $result = array_merge($result,scan($absPath));
                }
                else{
                    $result[] = $absPath;
                }
            }
        }
        closedir($handle);
    }
    
    return $result;
}

$drafts = scan('../_drafts');
$posts = scan('../_posts');

$num = 0;
foreach ($drafts as $key => $draftPath) {
	$draftContent = file_get_contents($draftPath);
	//$keyword = substr($draftContent, 50,65);
	$keyword = substr($draftContent, 47,57);

	foreach ($posts as $key => $postPath) {
		$postContent = file_get_contents($postPath);
		if(strpos($postContent, $keyword)
			&& !strpos($keyword, 'image')
			&& !strpos($keyword, 'github')
			&& !strpos($keyword, 'woojean')){
			echo $draftPath;
			echo " -> ";
			echo $postPath;
			echo ' -> ';
			echo $keyword;
			echo "\n\n";

			$num += 1;
			
			unlink($draftPath);
			break;
		}
	}
}

var_dump($num);

