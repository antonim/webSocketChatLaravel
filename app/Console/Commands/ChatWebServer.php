<?php

namespace App\Console\Commands;

use App\Message;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Auth;

class ChatWebServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runChatServer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    static protected $userNodes = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $server = new \Hoa\Websocket\Server(
            new \Hoa\Socket\Server('tcp://192.168.0.51:8889')
        );

//Manages the message event to get send data for each client using the broadcast method
        $server->on('message', function ( \Hoa\Core\Event\Bucket $bucket ) {

            try {

                $data = $bucket->getData();

                $inputMessage = json_decode($data['message'], true);

                $currentNodeId = $bucket->getSource()->getConnection()->getCurrentNode()->getId();

                if (!empty($inputMessage['user'])) {
                    self::$userNodes[$inputMessage['user']] = $currentNodeId;
                    return;
                }


                $nodesUsers = array_flip(self::$userNodes);

                $message = Message::create([
                    'message' => $inputMessage['message'],
                    'user_from' => $nodesUsers[$currentNodeId],
                    'user_to' => $inputMessage['to'],
                ]);


//                $nodes = $bucket->getSource()->getConnection()->getNodes();
//
//                foreach ($nodes as $node) {
//
//                    $userId = $nodesUsers[$node->getId()];
//                    if (in_array($userId, [$message->user_from, $message->user_to])) {
//
//                    }
//                }


                $bucket->getSource()->broadcastIf(function($node) use($nodesUsers, $message) {
                    $userId = $nodesUsers[$node->getId()];
                    return in_array($userId, [$message->user_from, $message->user_to]);

                }, $message);

            } catch (\Exception $e) {
                echo $e->getMessage() . "\n" . $e->getTraceAsString();
            }

            return;
        });
//Execute the server
        $server->run();
    }
}
