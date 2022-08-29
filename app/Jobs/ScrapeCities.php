<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class ScrapeCities implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $state;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($state)
    {
        $this->state = $state;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $url = "https://courses.swingu.com/citylist/United%20States%20of%20America/{$this->state->name}";
        $crawler = \Goutte::request('GET', $url);

        $crawler->filter('.m-b-1')->each(function ($node) {
            $city = $node->text();
            DB::table('cities')->insert([
                'state_id' => $this->state->id,
                'name' => $city,
            ]);
        });
    }
}
