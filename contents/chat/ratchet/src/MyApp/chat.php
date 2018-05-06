<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PDO;
use DateTime;
use DateTimeZone;
 
class Chat implements MessageComponentInterface {
    protected $clients;
 
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
 
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
 
        echo "New connection! ({$conn->resourceId})\n";
    }
 
    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $info = explode('?', $msg);
        $except = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
            $stmt = $pdo -> prepare("INSERT INTO message_info (room_id, sender, message, time) VALUES (:room_id, :sender, :message, :currentTime)");
            $stmt->bindParam(':room_id', $info[1], PDO::PARAM_INT);
            $stmt->bindParam(':sender', $info[2], PDO::PARAM_STR);
            $stmt->bindParam(':message', $info[0], PDO::PARAM_STR);
            $created_at = new DateTime("now",new DateTimeZone('Asia/Tokyo'));
            $currentTime = $created_at->format('Y-m-d H:i:s');
            $stmt->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            exit('データベース接続失敗。'.$e->getMessage());
        }

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }
 
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
 
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
 
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
 
        $conn->close();
    }
}