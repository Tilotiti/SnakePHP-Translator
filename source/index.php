<?php
$template->assign('title', 'EdenPHP Translator');

// Available languages
$alright = true;
$dir = opendir(LANG);
$languages = array();
$langFiles = array("error", "success", "text", "title", "mail");

while ($file = readdir($dir)):
    if(is_dir(LANG.'/'.$file) && $file != '.' && $file != '..'):
    	$lang = array();
    	$lang['code'] = $file;

    	$lang['writable'] = is_writable(LANG.'/'.$file);
    	
    	// Complete
    	$lang['complete'] = true;
    	foreach($langFiles as $lf):
    		if(!file_exists(LANG.'/'.$file.'/lang.'.$lf.'.xml') && !is_dir(LANG.'/'.$file.'/'.$lf)):
    			$lang['complete'] = false;
    			break;
    		endif;
    		
    		if(!is_writable(LANG.'/'.$file.'/lang.'.$lf.'.xml') && !is_writable(LANG.'/'.$file.'/'.$lf)):
    			$lang['writable'] = false;
    		endif;
    	endforeach;
    	
    	$languages[] = $lang;
    endif;
endwhile;
closedir($dir);
$template->assign('languages', $languages);

// Translation progress
$xml = array();
$arrayFile = array();
foreach($langFiles as $file):
	if($file == "mail"):
		continue;
	endif;
	
	$arrayFile[$file]['code'] = $file;
	$arrayFile[$file]['max']  = count(getId($file));
	
	foreach($languages as $lang):
		$arrayFile[$file]['lang'][$lang['code']]['error'] = false;
		
		$xml = @simplexml_load_file(LANG.'/'.$lang['code'].'/lang.'.$file.'.xml');

		if(!$xml):
			$arrayFile[$file]['lang'][$lang['code']]['progress'] = 0;
			$arrayFile[$file]['lang'][$lang['code']]['error']    = true;
			continue;
		endif;
		
		$arrayFile[$file]['lang'][$lang['code']]['progress'] = 0;
		foreach($xml->lang as $line):
			if('['.$line->attributes()->id.']' != $line):
				$arrayFile[$file]['lang'][$lang['code']]['progress']++;
			endif;
		endforeach;
		
	endforeach;
endforeach;
$template->assign('arrayFile', $arrayFile);
?>