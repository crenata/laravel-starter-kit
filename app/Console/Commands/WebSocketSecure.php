<?php

namespace App\Console\Commands;

use App\Http\Controllers\WebSockets\WebSocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;
use React\Socket\SecureServer;
use React\Socket\SocketServer;

class WebSocketSecure extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "websocket:secure";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Run WebSocket with SSL";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $loop = Loop::get();
        $webSocket = new SecureServer(
            new SocketServer("0.0.0.0:" . env("WEBSOCKET_PORT", 8090), [], $loop),
            $loop,
            [
                "local_cert" => env("SERVER_CRT", "/mnt/c/Xampp/apache/conf/ssl.crt/server.crt"),
                "local_pk" => env("SERVER_KEY", "/mnt/c/Xampp/apache/conf/ssl.key/server.key"),
                "allow_self_signed" => true,
                "verify_peer" => false
            ]
        );
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            $webSocket
        );
        $loop->run();
    }
}
