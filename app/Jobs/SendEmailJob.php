<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $to;
    public $subject;
    public $view;
    public $data;

    public function __construct($to, $subject, $view, $data)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->view = $view;
        $this->data = $data;
    }
    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Mail::send($this->view, $this->data, function ($message) {
                $message->to($this->to)->subject($this->subject);
            });
        } catch (\Exception $e) {
            info($e);
        }
    }
}
