<?php

class ForumController extends BaseCOntroller{

    public function index(){

        $groups = ForumGroup::all();
        $categories = ForumCategory::all();

        return View::make('forum.home')->with('groups',$groups)->with('categories',$categories);
    }

    public function category($id){

    }

    public function thread($id){

    }
}