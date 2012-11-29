<?php
function getId($file) {
	$arrayFile = array('error', 'success', 'text', 'title', 'mail');
	if(!in_array($file, $arrayFile)):
		return false;
	endif;
	
	$arrayLang = getLang();
	$code      = array();
	foreach($arrayLang as $lang):
		if(file_exists(LANG.'/'.$lang.'/lang.'.$file.'.xml')):
			$xml = @simplexml_load_file(LANG.'/'.$lang.'/lang.'.$file.'.xml');
			foreach($xml->lang as $line):
				if(!in_array((string)$line->attributes()->id, $code)):
					$code[] = (string)$line->attributes()->id;
				endif;
			endforeach;
		endif;
	endforeach;
	
	return $code;
}
?>