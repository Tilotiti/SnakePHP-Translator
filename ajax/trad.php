<?php
session_start();
include '../config.php';

if(PASSWORD && (!isset($_SESSION['password']) || PASSWORD != $_SESSION['password'])):
	exit("Password required");
endif;

if(!isset($_POST['id']) || empty($_POST['id'])):
	exit("Something went wrong with the ID");
endif;

if(!isset($_POST['type']) || empty($_POST['type'])):
	exit("Something went wrong with the file type");
endif;

if(count($_POST['data']) == 0 || !is_array($_POST['data'])):
	exit("Something went wrong with the translations");
endif;

foreach($_POST['data'] as $country => $trad):
	if(!file_exists(LANG.'/'.$country.'/lang.'.$_POST['type'].'.xml')):
		continue;
	endif;
	
	$lang = array();
	$var  = array();
	$xml = simplexml_load_file(LANG.'/'.$country.'/lang.'.$_POST['type'].'.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
    foreach($xml->lang as $line):
        $id = (string) $line['id'];
        $var[$id]  = (string) $line['var'];
        $lang[$id] = (string) $line;
    endforeach;
    $lang[$_POST['id']] = $trad;
    
    $xml  = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><language charset="UTF-8" code="'.$country.'"></language>');
        
    foreach($lang as $id => $content):
    	    $content = str_replace('&', '&amp;', $content);
	    $node = $xml->addChild('lang', $content);
	    $node->addAttribute('id', $id);
	    $node->addAttribute('var', $var[$id]);
    endforeach;
    
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save(LANG.'/'.$country.'/lang.'.$_POST['type'].'.xml');
endforeach;
?>
