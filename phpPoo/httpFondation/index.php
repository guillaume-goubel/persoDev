<?php

    require __DIR__.'/vendor/autoload.php';
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    $request = Request::createFromGlobals();
    $response = new Response('<h1>Hello</h1>');
    $response->headers->set('Content-Type', 'text/html');
    $response->send();
    
    // dump('Hello World!!');



