<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\CommonUtil;

class JobSmsOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $noHp;
    protected $textSms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($noHp, $textSms)
    {
        $this->noHp = $noHp;
        $this->textSms = $textSms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        CommonUtil::sendSms($this->noHp, $this->textSms);
    }
}
