<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;
 ///Users/sodaryoutarou/Desktop/develop/mi_ryo_system/www/contents/chat/ratchet/vendor/autoload.php
    
    // var_dump(__DIR__);

    require_once '/var/www/html/contents/chat/ratchet/vendor/autoload.php';
    
 
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080
    );
 
    $server->run();