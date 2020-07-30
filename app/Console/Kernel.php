<?php

namespace App\Console;

use App\Mail\EmailVerification;
use App\Models\event;
use App\Models\participant_event_certificate;
use Carbon\Carbon;
use Exception;
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
            $data = participant_event_certificate::where("is_absent_send", 0)->take(150)->get();
            $type = 'register';
            $arr_id = array();
            foreach ($data as $d) {
                $id = $data[0]->event_id;
                try {
                    app('App\Http\Controllers\EmailController')->RegisterSuccess($d->name, $d->email, $type, $id, $d->id);
                    array_push($arr_id, $d->id);
                } catch (Exception $e) {
                    continue;
                }
            }
            participant_event_certificate::whereIn('id', $arr_id)->update([
                "is_absent_send" => 1
            ]);
            if (count($data) < 150) {
                $limit = 150 - count($data);
                $data = participant_event_certificate::where("release_date", "<=", Carbon::today())->where('is_send', 0)->where('is_absent', 1)->take($limit)->get();
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
            }
        })->everyMinute();
        // $schedule->call(function () {
        //     set_time_limit(false);
        //     $data = participant_event_certificate::where("id", ">=", "0060147")->get();
        //     $id = $data[0]->event_id;
        //     $type = 'register';
        //     foreach ($data as $d) {
        //         app('App\Http\Controllers\EmailController')->RegisterSuccess($d->name, $d->email, $type, $id, $d->id);
        //     }
        // })->everyMinute();
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
