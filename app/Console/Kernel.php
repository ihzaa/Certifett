<?php

namespace App\Console;

use App\Mail\EmailVerification;
use App\Models\event;
use App\Models\participant_event_certificate;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
          set_time_limit(false);
            $data = participant_event_certificate::where("release_date", "=", Carbon::today())->where('is_send', 0)->get();
            $event = event::pluck('name', 'id');
            $arr_id = array();
            foreach ($data as $d) {
                $data = [
                    'name' => $d->name,
                    'type' => 'sertif',
                    'idpeserta' => $d->id,
                    'event' => $event[$d->event_id],
                    'congrat_word' => $d->congrat_word
                ];
                Mail::to($d->email)->send(new EmailVerification($data));
                array_push($arr_id, $d->id);
            }
            participant_event_certificate::whereIn('id', $arr_id)->update([
                "is_send" => 1
            ]);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
