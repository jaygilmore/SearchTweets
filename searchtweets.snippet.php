<?php
/*
 *  Snippet: SearchTweets
 *  Grabs Tweets based on comma delimited list of keywords.
 *  
 *  @version 1.0 
 *  @author Jay Gilmore (me@jaygilmore.ca)
 *  @description
 *  Enables you to display Twitter search results and 
 *  and control the output.
 * 
 *  @example [[!SearchTweets? &terms=`chrisbrogan` &tpl=`tweetItems`]]
 *
 */

$properties =& $scriptProperties;
$properties['namespace'] = !empty($namespace) ? $namespace : 'stream';

// Location of the snippet files.
$assetPath = 'assets/snippets/searchtweets/searchtweets.inc.php';
// Cache Key
$ckey = "{$properties['namespace']}.{$modx->resource->id}.SearchTweets";

// How long before cache file expires (in seconds)
$ttl = '30';

// Retrieves the Cache File
$o = $modx->cacheManager->get($ckey);

// If it returns no value or its expired run the script
if(!$o) {

    //Set your path to the snippet.
    $f = MODX_BASE_PATH.$assetPath;
    $o = include $f;
    $modx->cacheManager->set($ckey, $o, $ttl);
}
return $o;
?>