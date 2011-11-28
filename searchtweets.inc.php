<?php
	require(dirname(__FILE__).'/classes/twitter.class.inc.php');
	
	$output = '';
	
    
	//Search Terms Comma Separated
	$terms = isset($terms) ? $terms : '';
	
	//Words to Filter from Search
	$filter = isset($filter) ? $filter : '';
	
	// Toggle on and off search highlighting.
	$highlight = isset($highlight) ? $highlight : 1; 
	
	// Limit Results (Max 100)
	$display = isset($display) ? $display : '10';
	
	// A String to appear if there are no results.
	$noResults = isset($noResults) ? $noResults :'<p>There are currently no results or twitter search may be down. Please try again</p>'; 
	
	// Chunk name containing the Template for the output.
	$tpl = isset($tpl) ? $tpl : ''; 
	
    // Create and Format Search Term String
	$t = explode(',',$terms);
	$q = implode(" OR ", $t);
	$findinterm = implode("|", $t);
	
	// Create and Format Filter String
	$f = explode(',',$filter);
	$n = implode(" -", $f);
	$nq = ' -' . $n;
	
	// Set Number of Results to Display
	//$rpp = '&amp;rpp='.$display;

    // Run the Query
	$s = new summize();
	$query = $q.$nq;
	$r = $s->search($query,'',$display);
	if (!empty($r->results)){

	$results = $r->results;	
    $chunk = '';
	foreach($results as $k => $v){
		
		$string = $r->results[$k]->text;
		$find_url = "/(http:\/\/|https:\/\/|ftp:\/\/)[^0-9][A-z0-9_]+([.][A-z0-9_]+)*([\/][A-z0-9_]*)*/";
		$make_link = "<a href=\"$0\" target=\"_blank\">$0</a>";
		$linked_txt = preg_replace($find_url, $make_link, $string);
		
		$find_at = "/(?<![A-z0-9_])[@]([A-z0-9_]+)*/";
		$at_linked ="<a href=\"http://www.twitter.com/$1\">$0</a>";
		$atlink_txt = preg_replace($find_at, $at_linked, $linked_txt);
		
		if($highlight==1){
		    $find_name = "/(?<![A-z0-9_])($findinterm)(?![A-z0-9_])/i";
		    $mk_strong = "<strong>$0</strong>";
		    $text = preg_replace($find_name, $mk_strong, $atlink_txt);
	    }
		else {
		    $text = $atlink_txt;
		}		
		
		$from_user = $r->results[$k]->from_user;
		$profile_image_url = $r->results[$k]->profile_image_url;
		$created_at = $r->results[$k]->created_at;
		$rid = $k;
		
		$modx->setPlaceholder('from_user', $from_user);
        $modx->setPlaceholder( 'profile_image_url',$profile_image_url);
        $modx->setPlaceholder( 'created_at',$created_at);
        $modx->setPlaceholder('tweet', $text);
        $chunk .= $modx->getChunk($tpl);

	}
    $output = $modx->newObject('modChunk')->process($properties,$chunk);
	return $output;
	
    }
    else{  
        $output = $noResults;
        return $output;
	}
    
?> 