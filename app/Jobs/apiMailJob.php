<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\apiMailable;
use App\models\api\request as requestModel;
use App\models\api\response;
use App\models\api\billing;

class apiMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mailRequest;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailRequest)
    {
        $this->mailRequest = $mailRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->mailRequest->to)
            ->cc($this->mailRequest->cc)
            ->bcc($this->mailRequest->bcc)
            ->send(new apiMailable($this->mailRequest));
        requestModel::where('id', $this->mailRequest->id)->update(['status_id' => 2]);
        response::where('request_id', $this->mailRequest->id)->update(['status_id' => 2]);
        billing::saveData($this->mailRequest->user->id, $this->mailRequest->id);

    }
}
