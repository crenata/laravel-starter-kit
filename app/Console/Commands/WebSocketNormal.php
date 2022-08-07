<?php

namespace App\Console\Commands;

use App\Http\Controllers\WebSockets\WebSocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketNormal extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "websocket:normal";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Run WebSocket without SSL";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            env("WEBSOCKET_PORT", 8090)
        );
        $server->run();
    }
}
