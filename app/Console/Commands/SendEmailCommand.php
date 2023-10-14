<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleEmail; // Import kelas email Anda (contoh: ExampleEmail)

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'name' => 'John Doe',
            'message' => 'Ini adalah pesan email.'
        ];

        $subject = 'Contoh Email';

        Mail::to('penerima@example.com')->send(new ExampleEmail($data, $subject));

        $this->info('Email sent successfully!');
    }
}
