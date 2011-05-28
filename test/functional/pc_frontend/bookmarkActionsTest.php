<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));

include dirname(__FILE__).'/../../bootstrap/database.php';

$browser->login('sns@example.com', 'password');
$browser->setCulture('en');

#my bookmark
$browser->get('/bookmark/list')->isStatusCode(200);

#friend's bookmark
$browser->get('/bookmark/list/2')->isStatusCode(200);

#bookmark of other member who blocks me

#add my bookmark
$title = 'TEST SITE';
$url = 'http://www.77-web.com';
$browser->get('/bookmark/add?title='.urlencode($title).'&url='.urlencode($url))
  ->isStatusCode(200)
  ->with('request')->begin()
    ->isParameter('module', 'bookmark')
    ->isParameter('action', 'add')
    ->isParameter('title', $title)
    ->isParameter('url', $url)
  ->end()
  
  ->click('Send')
    ->isStatusCode(302)
    ->with('request')->begin()
      ->isParameter('module', 'bookmark')
      ->isParameter('action', 'add')
    ->end();

#delete my bookmark
$browser->get('/bookmark/delete/1')
  ->isStatusCode(200)
  
  ->click('Delete')
  ->isStatusCode(302)
  ->with('request')->begin()
    ->isParameter('module', 'bookmark')
    ->isParameter('action', 'delete')
  ->end()
  
  ->click('Back')
  ->isStatusCode(200)
  ->with('request')->begin()
    ->isParameter('module', 'bookmark')
    ->isParameter('action', 'list')
  ->end();


#try to delete other member's bookmark, and fail in status 404
$browser->get('/bookmark/delete/2')->isStatusCode(404);