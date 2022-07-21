<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\MailOtp;

class JobOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail, $data)
    {
        $this->send_mail = $send_mail;
        $this->data = $data;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->send_mail)->send(new MailOtp($this->data));
    }
}
