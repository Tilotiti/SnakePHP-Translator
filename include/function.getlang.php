<?php
function getLang($type = false) {
	$lang = array();
	$dir = @opendir(LANG);
	while ($file = @readdir($dir)):
	    if(is_dir(LANG.'/'.$file) && $file != '.' && $file != '..'):
	    	if(!$type):
		    	$lang[] = $file;
		    else:
		    	if(file_exists(LANG.'/'.$file.'/lang.'.$type.'.xml')):
			    	$lang[] = $file;
		    	endif;
	    	endif;
	    endif;
	endwhile;
	@closedir($dir);
	
	return $lang;
}
?>