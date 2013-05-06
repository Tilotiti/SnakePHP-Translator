<?php
$template->assign('title', 'Translate lang.'.get(2).'.xml');

$listId = getId(get(2));

if(!$listId):
	header('location: /');
	exit();
endif;

$lang    = array();
$listVar = array();
foreach(getLang(get(2)) as $file):
	$lang[$file] = array();
	
	foreach($listId as $id):
		$lang[$file][$id] = false;
	endforeach;
	
	$xml = simplexml_load_file(LANG.'/'.$file.'/lang.'.get(2).'.xml');
	foreach($xml->lang as $line):
		if('['.$line->attributes()->id.']' != (string)$line):
			$lang[$file][(string)$line->attributes()->id] = str_replace('"', "&quot;", (string)$line);
		endif;

		if(!empty($line->attributes()->var)):
			if(isset($listVar[(string)$line->attributes()->id])):
				$newVars = explode('|', $line->attributes()->var);
				$exVars  = explode('|', $listVar[(string)$line->attributes()->id]);
				
				foreach($newVars as $newVar):
					if(!in_array($newVar, $exVars)):
						$exVars[] = $newVar;
					endif;
				endforeach;
				
				$listVar[(string)$line->attributes()->id] = implode('|', $exVars);
			else:
				$listVar[(string)$line->attributes()->id] = $line->attributes()->var;
			endif;
		endif;
	endforeach;
endforeach;

$template->assign('listId', $listId);
$template->assign('listLang', $lang);
$template->assign('listVar', $listVar);
?>