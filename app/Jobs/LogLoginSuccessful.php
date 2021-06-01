<?php

namespace App\Jobs;

use App\Helpers\RestApiAuthHelper;
use Illuminate\Auth\Events\Login;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LogLoginSuccessful implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @param $event
     * @return void
     */
    public function handle()
    {
        DB::table('auth_logs')->insert([
            'user_id' => $this->event->user->id,
            'action_name' => 'Login',
            'ip_address' => RestApiAuthHelper::getIp(),
            'created_at' => now()
        ]);
    }
}
