<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ScrapeCities;
use App\Jobs\ScrapeCourses;
use App\Jobs\ScrapeHoles;
use Sunra\PhpSimple\HtmlDomParser;
use DB;

class ScrappingController extends Controller
{   
    public function scrapeStates()
    {   
        return "Scrape States";
        // $crawler = \Goutte::request('GET', 'https://courses.swingu.com/statelist/United%20States%20of%20America');
        // $crawler->filter('.m-b-1')->each(function ($node) {
        //     $state = $node->text();
        //     if ($state !== 'Dist. of Columbia' && $state !== 'empty' && $state !== 'AP (Military Base)' && $state !== 'AZ' && $state !== 'FL') {
        //         DB::table('states')->insert([
        //             'name' => $state
        //         ]);
        //     }
        // });
    }

    public function scrapeCities()
    {   
        return "Scrape Cities";
        // $states = DB::table('states')->get();
        // foreach ($states as $state) {
        //     ScrapeCities::dispatch($state);
        // }
        // return true;
    }

    public function scrapeCourses()
    {   
        return "Scrape Courses";
        // $cities = DB::table('cities')->get();
        // foreach ($cities as $key => $city) {
        //     $state = DB::table('states')->where('id', $city->state_id)->first();
        //     ScrapeCourses::dispatch($city, $state);
        // }
        // return true;
    }

    public function scrapeCourseHoles()
    {   
        return "Scrape Holes";
        // $courses = DB::table('courses')
        //     ->where([['state_id', 14]])
        //     ->offset(0)
        //     ->limit(10)
        //     ->get();
        // foreach ($courses as $key => $course) {
        //     ScrapeHoles::dispatch($course);
        // }
        // return true;
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

