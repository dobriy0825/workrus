<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Requests\CreateJobRequest;
use App\Models\Address\City;
use App\Models\Address\Region;
use App\Models\Category;
use App\Models\Job;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JobController extends Controller
{
    private $jobId;

    public function create()
    {
        $time = $this->timed();
        $user = Auth::user();
        $categories = Category::all(['name']);
        return view('job.create', compact('user', 'categories', 'time'));
    }

    public function store(CreateJobRequest $request)
    {
        $user = Auth::user();
        $job = $user->jobs()->create([
            'title' => $request->title,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'address' => $request->city,
            'need_people' => $request->need_people,
            'start' => $request->date_start . ' ' . $request->time_start,
            'finish' => $request->date_finish . ' ' . $request->time_finish,
            'price' => $request->price,
            'description' => $request->description,
            'draft' => true,
            'status' => Job::STATUS_OPEN
        ]);
        return redirect()->route('job.check', $job->id);
    }

    public function edit($id)
    {
        $time = $this->timed();
        $job = Job::where('id', $id)->first();
        $categories = Category::with('subCategories')->get();
        $category = $categories->where('name', $job->category)->first();
        $subCategories = $category->subCategories;
        return view('job.edit', compact('job', 'categories', 'subCategories', 'time'));
    }

    public function update(CreateJobRequest $request, $id)
    {
        //$job = Job::where('id', $id)->get();
        $user = Auth::user();
        $job = $user->jobs()->where('id', $id)->first();
        $fields = ['title', 'category', 'sub_category','need_people', 'address', 'start', 'finish', 'price', 'description'];

        $jobF = $job->only($fields);
        $query = [
            'title' => $request->title,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'need_people' => $request->need_people,
            'start' => $request->date_start . ' ' . $request->time_start,
            'finish' => $request->date_finish . ' ' . $request->time_finish,
            'price' => $request->price,
            'description' => $request->description
        ];
        if ($request->city != null){
            $query = Arr::add($query, 'address', $request->city);
        };
        $job->update($query);
        return view('job.check_filling', compact('job'));
    }

    public function check($id)
    {
        $user = Auth::user();
        $job = Job::where('id', $id)->with('user')->first();
        return view('job.check_filling', compact('job'));
    }

    public function confirm($id)
    {
        $user = Auth::user();
        $job = $user->jobs()->where('id', $id);
        $job->update(['draft' => false]);
        return view('job.successful_creation');
    }

    public function show($id)
    {
        $userAuth = User::where('id', Auth::id())->with('jobs', 'worker')->first();
        $job = Job::where('id',$id)->with('offerWorkers')->first();
        $job->addView();
        return view('job.item', compact('job', 'userAuth'));
    }

    public function index()
    {
        $jobs = Job::statusOpen()->orderBy('created_at', 'desc')->get();
        return view('job.index', compact('jobs'));
    }


    public function timed()
    {
        $hour = 0;
        $minute = 0;
        $array = [];
        $r = 4;
        $h = 24;
        for($i = 0; $h > $i; $i++ ){
            //$array[$i] = $i;
            for($j = 0; $r > $j; $j++){
                if ($minute == 60){
                    $minute = 0;
                }
                if (strlen($minute) < 2){
                    $minute = '0' . $minute;
                }
                if (strlen($i) < 2){
                    $i = '0' . $i;
                }

                $array[] = $i . ':' . $minute;
                $minute = $minute + 15;
            }
        }
        return $array;
    }


    public function getRegions()
    {
        $parentCategories = Region::with('city')->get();
        return $parentCategories;
    }

    public function getCitiesOfRegion(Request $request)
    {
        $cities = Region::find($request->id)->city;
        return $cities;
    }

    public function getRelevantCities(Request $request)
    {
        $val = $this->letterSearch($request->value);
        $cities = City::all(['name', 'region_id']);
        $result = [];
        $length = mb_strlen($val);
        foreach($cities as $city){
            $part = mb_substr($city->name, 0, $length);
            if ($val == $part){
                if (!$part){
                    return $result = [];
                }
                $result[] = $city->name/*."". ' '.$city->region->name*/;
            }
            if (count($result) == 20){
                break;
            }
        }
        return $result;
    }

    public function letterSearch($str)
    {
        $start = mb_strtoupper(mb_substr($str, 0, 1));
        $finish = mb_substr($str, 1);
        return $start . $finish;
    }

    public function getCategories()
    {
        $categories = Category::with('subCategories')->get();
        return $categories;
    }

    public function getSubCategoriesOfCategory(Request $request)
    {
        $category = Category::where('name', $request->id)->first();
        //dd($category);
        //$s = SubCategory::where('category_id',$category->id)->get();
        $s = $category->subCategories;
        return $s;
    }














    public function offerWorker($id)
    {
        $user = Auth::user();
        $job = Job::find($id);
        if ($user->worker) {
            if (!$job->isProposedWorker($user->worker, $job->offerWorkers)) {
                $worker = $user->worker()->first();
                $job->offerWorkers()->attach($worker->id);
                event(new TestEvent($job->user, $worker));
            }
        }else{
            session(['popup' => 'yes']);
        }
        return back();
    }

    public function cancel($id)
    {
        if (session()->has('popup')) {
            session()->forget('popup');
        }
        return redirect()->route('job.show', $id);
    }

    public function deleteProposedWorker($id)
    {
        $user = Auth::user();
        $job = Job::find($id);
        $job->offerWorkers()->detach($user->worker()->first()->id);
        return back();
    }

    public function hiredWorker($job_id, $worker_id)
    {
        $job = Job::find($job_id);
        $job->update(['status' => Job::STATUS_IN_GEAR]);
        $job->hiredWorkers()->attach($worker_id);
        return back();
    }

    public function notPerformed($id, Request $request)
    {
        $job = Job::find($id);
        $worker = $job->hiredWorkers->first();
        $data = [
            'from' => $id,
            'whom' => $worker->id,
            'text' => $request->text,
        ];
        $job->update(['status' => Job::STATUS_OPEN ]);
        $job->hiredWorkers()->detach($worker->id);
        Review::create($data);
        return back();
    }

    public function performed($id, Request $request)
    {
        $job = Job::find($id);
        $worker = $job->hiredWorkers->first();
        $data = [
            'from' => $id,
            'whom' => $worker->id,
            'text' => $request->text,
            'assessment' => $request->assessment
        ];
        $job->update(['status' => Job::STATUS_PERFORMED]);
        Review::create($data);
        $sumAssessment = 0;
        $reviews = $worker->reviews;
        foreach ($reviews as $review){
            if ($review != null) {
                $sumAssessment += $review->assessment;
            }
        };
        $rating = $sumAssessment / $reviews->count();
        $worker->completedJobs()->attach($job->id);
        $worker->update([
            'rating' => $rating,
            'tasks_completed' => $worker->completedJobs->count()
            ]);
        return back();
    }
}
