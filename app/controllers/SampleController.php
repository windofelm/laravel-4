<?php



class SampleController extends BaseController{

    public function sampleFunction(){

        $records = DB::table('forum_categories')
            ->join('forum_threads', 'forum_categories.id', '=', 'forum_threads.category_id')
            ->select('forum_categories.title as c_title', 'forum_threads.title as t_title')
            ->get();

        foreach ($records as $item)
        {
            echo $item->c_title." - ";
            echo $item->t_title;

            echo "<br />";
        }
    }
}