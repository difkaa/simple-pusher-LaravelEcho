<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;
use App\Notifications\NewLessonNotification;
use App\Thread;
use DB;

class LessonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newLesson()
    {


        $lesson = new Lesson;
        $lesson->user_id = auth()->user()->id;
        $lesson->title = 'Laravel Model';
        $lesson->body = 'This is lesson we learn about model on laravel 5.8';
        $lesson->thread_id = '2';
        $lesson->save();

        $threads = Thread::where('id','=',$lesson->thread_id)->select('user_id')->get();
        $allTable = Lesson::with('thread');

        foreach($threads as $thread){
            $user = User::where('id','=', $thread->user_id)->get();
        }
        // \Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first(), User::where('id','=',auth()->user()->id)->first()));

        \Notification::send($user, new NewLessonNotification($allTable->latest('id')->first()));
        // $user->notify(new NewLessonNotification(DB::table('thread_lesson_user')))->latest('id')->first();



        // if(\Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
        // {
        //     return back();
        // }

    }

    public function notification()
    {
        return auth()->user()->unreadNotifications->take(25);

    }

    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->find($request->not_id)->markAsRead();

    }

    public function readLesson($lesson_id)
    {
        $lesson = Lesson::find([$lesson_id]);
        return view('lesson', compact('lesson'));

    }

    public function allMarkAsread()
    {
        auth()->user()->unreadNotifications->markAsRead();

    }

    public function readAllLesson()
    {
        $lessons = auth()->user()->readNotifications;
        return view('allLesson', compact('lessons'));
    }

}
