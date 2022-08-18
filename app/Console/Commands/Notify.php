<?php

namespace App\Console\Commands;

use App\Mail\Notiflymail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notfiy:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email nifiy every day';

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
//       $users=User::selsect('email')->get();//get colleation of all emails

        $emails=User::pluck('email')->toArray();
        $data=['title'=>"Programing",'body'=>"php"];
        foreach ($emails as $email){
            //how to send email in laravel
            Mail::To($email)->send(new Notiflymail($data));
    }

    }
}
