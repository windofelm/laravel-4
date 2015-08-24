<?php

class ForumController extends BaseCOntroller{

    public function index(){

        $groups = ForumGroup::all();
        $categories = ForumCategory::all();

        return View::make('forum.home')->with('groups',$groups)->with('categories',$categories);
    }

    public function category($id){

        $category = ForumCategory::find($id);
        if($category == null){

            return Redirect::route('forum-home')->with('fail', 'That category doesen\'t exist');
        }

        $threads = $category->threads()->get();


         return View::make('forum.category')->with('category', $category)->with('threads', $threads);
    }


        public function thread($id){

            $thread = ForumThread::find($id);

            if($thread == null){

                return Redirect::route('forum-home')->with('fail', 'That thread doesn\!t exist');
            }

            $author = $thread->author()->first()->username;

            return View::make('forum.thread')->with('thread', $thread)->with('author', $author);
        }


    public function storeGroup(){

        $validator = Validator::make(Input::all(),array(
            'group_name' => 'required|unique:forum_groups,title'
        ));

        if($validator->fails()){

            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal','#group_form');
        }else{

            $group = new ForumGroup();

            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;

            if($group->save()){

                return Redirect::route('forum-home')->with('success','The group was created.');
            }else{
                return Redirect::route('forum-home')->with('fail','An error occured while saving the new group !');
            }
        }

    }


    public function deleteGroup($id){

        $group = ForumGroup::find($id);

        if($group == null){

            return Redirect::route('forum-home')->with('fail','That group doesen\'t exist.');
        }

            //$categories = ForumCategory::where('group_id', $id);
            //$threads = ForumThread::where('group_id', $id);
            //$comments = ForumComment::where('group_id', $id);

            $categories = $group->categories();
            $threads = $group->threads();
            $comments = $group->comments();


            $delCa = true;
            $delTh = true;
            $delCo = true;

            if($categories->count() > 0){

                $delCa = $categories->delete();
            }
            if($threads->count() > 0){

                $delTh = $threads->delete();
            }
            if($comments->count() > 0){

                $delCo = $comments->delete();
            }

        if($delCa && $delTh && $delCo && $group->delete()){

            return Redirect::route('forum-home')->with('success','The group was deleted.');
        }else{

            return Redirect::route('forum-home')->with('fail','An error occured while deleting the group.');
        }

    }


    public function deleteCategory($id){


        $category = ForumCategory::find($id);

        if($category == null){

            return Redirect::route('forum-home')->with('fail','That group doesn\'t exist.');
        }

        //$categories = ForumCategory::where('group_id', $id);
        //$threads = ForumThread::where('group_id', $id);
        //$comments = ForumComment::where('group_id', $id);

        $threads = $category->threads();
        $comments = $category->comments();


        $delTh = true;
        $delCo = true;


        if($threads->count() > 0){

            $delTh = $threads->delete();
        }
        if($comments->count() > 0){

            $delCo = $comments->delete();
        }

        if($delTh && $delCo && $category->delete()){

            return Redirect::route('forum-home')->with('success','The category was deleted.');
        }else{

            return Redirect::route('forum-home')->with('fail','An error occured while deleting the category.');
        }
    }


    public function storeCategory($id){

        $validator = Validator::make(Input::all(),array(
            'category_name' => 'required|unique:forum_categories,title'
        ));

        if($validator->fails()){

            // Hata döndüğünde formun action alanını doldurmak için; ->with('new-form-action','forum/category/'.$id.'/new')
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal','#category_modal')->with('new-form-action','forum/category/'.$id.'/new');
        }else{


            $group = ForumGroup::find($id);
            if($group == null){

                return Redirect::route('forum-home')->with('fail', 'That group doesn\'t exist.');
            }


            $category = new ForumCategory();

            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->group_id = $id;

            if($category->save()){

                return Redirect::route('forum-home')->with('success','The category was created.');
            }else{
                return Redirect::route('forum-home')->with('fail','An error occured while saving the new category !');
            }
        }
    }


    public function newThread($id){

        return View::make('forum.newthread')->with('category_id', $id);
    }




    public function storeThread($id){

        $category = ForumCategory::find($id);

        if($category == null){

            return Redirect::route('forum-get-new-thread')->with('fail', 'You posted to an invalid category.');
        }

        $validator = Validator::make(Input::all(), array(

            'title' => 'required|min:3|max:255',
            'body' => 'required|min:10|max:65000'
        ));

        if($validator->fails()){

            return Redirect::route('forum-get-new-thread')->withInput()->withErrors($validator)->with('fail', 'Your input doesn\'t match the requirements.');
        }else{

            $thread = new ForumThread();

            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->group_id = $category->group_id;
            $thread->author_id = Auth::user()->id;


            if($thread->save()){

                return Redirect::route('forum-thread', $thread->id)->with('success', 'Your thread has been saved.');
            }else{

                return Redirect::route('forum-get-new-thread', $id)->with('fail', 'An error occured while saving your thread.')->withInput();
            }
        }
    }

}