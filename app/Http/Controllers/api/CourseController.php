<?php

namespace App\Http\Controllers\api;

use DB;
use App\Models\Course;
use App\Models\Hole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $term = $request->term;
        return Course::where([['name','like','%'.$term.'%']])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $course = DB::table('courses as c')
                        ->select('c.name', 'c.id')
                        ->where('c.id', $id)
                        ->first();
            $holes_collection = collect(DB::table('holes as h')
                        ->where('h.course_id', $id)
                        ->orderBy('h.teebox', 'ASC')
                        ->orderBy('h.number', 'ASC')
                        ->get());
            $course_teeboxes = $holes_collection->unique('teebox')->pluck('teebox');
            $teeboxes = [];
            foreach ($course_teeboxes as $teebox) {
                $teeboxes[$teebox] = $holes_collection->where('teebox', $teebox);
            }
            return response()->json(['course' => $course, 'teeboxes' => $teeboxes], 200);
        } catch (\exception $e) {
            return response()->json(['error' => 'something went wrong'], 400);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
