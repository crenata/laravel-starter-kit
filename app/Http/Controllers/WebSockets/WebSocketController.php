<?php

namespace App\Http\Controllers\WebSockets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

class WebSocketController extends Controller implements MessageComponentInterface {
    protected $connections, $console;

    public function __construct() {
        $this->connections = new \SplObjectStorage();
        $this->console = new ConsoleOutput();
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn) {
        $query = [];
        parse_str($conn->httpRequest->getUri()->getQuery(), $query);

        $token = $query["token"];

        if (empty($token)) {
            $conn->close();
        } else {
            $tokenData = PersonalAccessToken::findToken($token);

            if (empty($tokenData)) {
                $conn->close();
            } else {
                $user = $tokenData->tokenable()->first();

                if (empty($user->id)) {
                    $conn->close();
                } else {
                    $this->connections->attach($conn);
                    $this->console->writeln("Connection {$conn->resourceId} with User ID {$user->id} has Connected");
                }
            }
        }
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn) {
        $this->connections->detach($conn);
        $this->console->writeln("Connection {$conn->resourceId} has Disconnected");
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception          $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
        $this->console->writeln("An error occurred with Connection {$conn->resourceId}");
        $this->console->writeln($e->getMessage());
    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string                       $msg  The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->connections as $connection) {
            if ($connection->resourceId !== $from->resourceId) {
                $connection->send($msg);

                /**
                 * If wanna send to specific user, filter connection
                 * and if the connection is disconnected
                 * send push subscription notification using web push here.
                 */
                //auth()->user()->notify(new PushSubscription());
            }
        }
    }
}
