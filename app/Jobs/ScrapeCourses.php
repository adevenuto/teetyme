<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class ScrapeCourses implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $city;
    public $state;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($city, $state)
    {
        $this->city = $city;
        $this->state = $state;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $url = "https://courses.swingu.com/courselist/United%20States%20of%20America/{$this->state->name}/{$this->city->name}";
        
        $crawler = \Goutte::request('GET', $url);
        $crawler->filter('.course-list .col-sm-4')->each(function ($node) {
            $content = json_encode($node->children()->each(function ($item) {
                return $item->html();
            }));
            $html = json_decode($content, true)[0];
            $course = self::getStringBetween($html, '<h4 class="m-b-0">', '</h4>');
            $cityName = explode(',', explode('<br>', $html)[1])[0];
            $courseUri = self::getStringBetween($html, '<a href="', '">');
            $courseUrl = "http://courses.swingu.com/{$courseUri}";

            // \Log::info($cityName.' --- '.$this->city->name);
            // \Log::info($html);
            
            // ** Courses are duplicated due to the relationship with surrounding cities
            // Only save course if it belongs to the current city.
            if($cityName === $this->city->name) {
                DB::table('courses')->insert([
                    'state_id' => $this->state->id,
                    'city_id' => $this->city->id,
                    'name' => $course,
                    'url' => $courseUrl,
                ]);
            }
        });
    }
    public function getStringBetween($string, $start, $end)
    {   
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
