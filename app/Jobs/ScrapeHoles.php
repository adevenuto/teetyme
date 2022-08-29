<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class ScrapeHoles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $course;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $course_data = array(
            'name' => null,
            'teeboxes' => array(  
            ),
            'teeboxes-meta' => array(  
            ),
            'holes' => array(  
            )
        );
        
        $crawler = \Goutte::request('GET', $this->course->url);
        $crawler->filter('.vertical-scorecard')->each(function ($node) use (&$course_data) {
            // Target html
            $html = $node->html();
            
            // Course Name
            $course_data['name'] = $this->course->name;

            // Teeboxes
            preg_match_all("'<div class=\"affixed-icon\">(.*?)<i class=\"collapse-icon fa fa-compress\"></i>'si", $html, $teebox);
            foreach($teebox[1] as $key => $teebox) {
                $course_data['teeboxes'][$key] = trim($teebox);
            }

            // Teexbox Meta
            preg_match_all("'<tr style=\"border-color:(.*?)</tr>'si", $html, $meta);
            foreach($meta[1] as $meta) {
                preg_match_all("'<td>(.*?)</td>'si", $meta, $slope_rating);
                $slope = null;
                $rating = null;
                foreach ($slope_rating[1] as $key => $value) {
                    if ($key === 2) $slope  = trim($value);
                    if ($key === 3) $rating = trim($value);
                }
                // \Log::info($slope.','.$rating);
                array_push($course_data['teeboxes-meta'], $slope.','.$rating);
            }

            // Hole Data
            preg_match_all("'<tr>\s*<td>Hole(.*?)</td>\s*</tr>'si", $html, $holes);
            foreach($holes[1] as $hole) {
                // Match all nums not preceded by "
                preg_match_all("'(?<!\")(\d+)'", $hole, $hole_data);
                // $hole_data_count = count($hole_data[1]);
                // \Log::info($hole_data_count);
                $hole = array();
                foreach ($hole_data[1] as $key => $match) {
                    if($key === 0) $hole['hole_num']            = $match;
                    if($key === 1) $hole['hole_par']            = $match;
                    if($key === 2) $hole['hole_length_yd']      = $match;
                    if($key === 3) $hole['hole_length_m']       = $match;
                    if($key === 4) $hole['hole_si']             = $match;
                }
                array_push($course_data['holes'], $hole);
                // \Log::info($hole);
            }

            $num_of_teeboxes = count($course_data['teeboxes']);
            $num_of_scorecard_holes = count($course_data['holes']);
            $num_of_holes = $num_of_scorecard_holes / $num_of_teeboxes;

            $num_of_scorecard_holes_chunked = array_chunk($course_data['holes'], $num_of_holes);
            $course_data['holes'] = $num_of_scorecard_holes_chunked;

        });

        foreach ($course_data['holes'] as $key => $hole_group) {

                foreach ($hole_group as $i => $hole) {

                    $course_id          = $this->course->id;
                    $state_id           = $this->course->state_id;
                    $hole_num           = isset($hole['hole_num']) ? $hole['hole_num'] : NULL;
                    $hole_par           = isset($hole['hole_par']) ? $hole['hole_par'] : NULL;
                    $hole_length_yds    = isset($hole['hole_length_yd']) ? $hole['hole_length_yd'] : NULL;
                    $hole_length_m      = isset($hole['hole_length_m']) ? $hole['hole_length_m'] : NULL;
                    $hole_stroke_index  = isset($hole['hole_si']) ? $hole['hole_si'] : NULL;
                    $teebox             = $course_data['teeboxes'][$key] ?? NULL;
                    $teebox_slope       = explode(',', $course_data['teeboxes-meta'][$key])[0] ?? NULL;
                    $teebox_rating      = explode(',', $course_data['teeboxes-meta'][$key])[1] ?? NULL;


                    \Log::info($course_id.' '.$state_id.' '.$hole_num.' '.$hole_par.' '.$hole_length_yds.' '.$hole_length_m.' '.$hole_stroke_index.' '.$teebox.' '.$teebox_slope.' '.$teebox_rating);

                    DB::table('holes')->insert([
                        'course_id'      => $course_id ?? NULL,
                        'state_id'       => $state_id ?? NULL,
                        'number'         => $hole_num ?? NULL,
                        'par'            => $hole_par ?? NULL,
                        'length_yds'     => $hole_length_yds ?? NULL,
                        'length_m'       => $hole_length_m ?? NULL,
                        'stroke_index'   => $hole_stroke_index ?? NULL,
                        'teebox'         => $teebox ?? NULL,
                        'teebox_slope'   => $teebox_slope ?? NULL,
                        'teebox_rating'  => $teebox_rating ?? NULL,
                        "created_at" =>  \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now()
                    ]);
                }
                
        }
    }
}
