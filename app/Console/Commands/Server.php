<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Server extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Hoa Websocket Server.';

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
            $data = $bucket->getData();
            echo 'message: ', $data['message'], "\n";
            $bucket->getSource()->broadcast($data['message']);
            return;
        });
//Execute the server
        $server->run();
    }
}
