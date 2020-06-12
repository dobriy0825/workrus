<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkerRequest;
use App\Models\Address\City;
use App\Models\Address\Region;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    public function showCreate()
    {
        // Добавить проверку , на существование анкеты
        if (session()->has('popup')){
            session()->forget('popup');
        }
        $user = Auth::user();
        // перенести в модель
        $dt = Carbon::parse($user->birth_day);
        $categories = Category::with('subCategories')->get() ;
        return view('worker.create', compact('user', 'dt', 'categories'));
    }

    public function getRegions()
    {
        $regions = Region::with('city')->get();
        return $regions;
    }

    public function getCitiesOfRegion(Request $request)
    {
        $city = Region::find($request->id)->city;
        return $city;
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



    public function storeDraft(CreateWorkerRequest $request)
    {

        $a = [];
        foreach ($request->subCategory as $item){
            $a[] = SubCategory::find($item)->category_id;
        }
        $user = Auth::user();
        $data = [
            'name' => $user->name,
            'surname' => $user->surname,
            'age' => $user->age,
            'sex' => $user->sex,
            'city' => $request->city,
            'about_me' => $request->about_me,
            'user_id' => $user->id,
            'tasks_completed' => 0,
            'rating' => 0,
            'draft' => false
        ];
        $worker = $user->worker()->create($data);
        $worker->categories()->attach(array_unique($a));
        $worker->subCategories()->attach($request->input('subCategory'));

        return redirect()->route('worker.check');
    }
    //-----------------------------------------------------------------




    public function showCheck()
    {
        $user = Auth::user();
        $myWorker = $user->worker;
        $categoriesCollection = $myWorker->categories()->get();
        $subCategoriesCollection = $myWorker->subCategories()->get();
        $categories = [];
        $subCategories = [];
        foreach ($categoriesCollection as $item){
            $categories[] = ['id' => $item->id, 'name' => $item->name, 'categories' => ''];
        }
        foreach ($subCategoriesCollection as $item){
            $subCategories[] = ['id' => $item->id, 'name' => $item->name, 'category_id' => $item->category_id];
        }
        return view('worker.check_filling', compact('user', 'categories', 'subCategories'));
    }

    public function createAfterCheck()
    {
        $user = Auth::user();
        $user->worker->update(
            ['draft' => false]
        );
        // отправить уведомление на почту
        return view('worker.successful_creation');
    }



    public function showEdit()
    {
        $user = Auth::user();
        $date = Carbon::parse($user->birth_day);
        $myWorker = $user->worker;
        $categories = Category::with('subCategories')->get();
        $subCategoriesWorker = $myWorker->subCategories->all();
        $idSubCategories = [];
        foreach ($subCategoriesWorker as $item){
            $idSubCategories[] = $item->id;
        }
        return view('worker.edit', compact('user','myWorker', 'categories','idSubCategories', 'date'));
    }



    public function editAtCreation(CreateWorkerRequest $request)
    {
        $user = Auth::user();
        $worker = $user->worker;
        $idCategories = [];
        foreach ($request->subCategory as $subcategory){
            if (!in_array(SubCategory::find($subcategory)->category_id, $idCategories))
                $idCategories[] = SubCategory::find($subcategory)->category_id;
        }
        $idCategories2 = [];
        foreach ($worker->categories as $category){
            $idCategories2[] = $category->id;
        }
        $addIdCategories = array_diff($idCategories, $idCategories2);
        $removeIdCategories = array_diff($idCategories2, $idCategories);
        //dd($worker->parentCategories, $idParentCategories2, $idParentCategories, $resultIdParentCategories);
        $idSubCategories = [];
        foreach ($worker->subCategories as $subCategory){
            $idSubCategories[] = $subCategory->id;
        }
        $addIdSubCategories = array_diff($request->subCategory, $idSubCategories);
        $removeIdSubCategories = array_diff($idCategories, $request->subCategory);
        //dd($request->category, $idCategories,$addIdCategories, $delIdCategories);
        $fields = [
            'about_me',
            'city'
            ];
        $data = $worker->only($fields);
        $data2 = $request->except('_method', '_token', 'subCategory');
        //dd($data,$data2);

        $result = array_diff($data2, $data);
        $worker->update($result);
        $worker->categories()->detach($removeIdCategories);
        $worker->categories()->attach($addIdCategories);
        $worker->subCategories()->detach($removeIdSubCategories);
        $worker->subCategories()->attach($addIdSubCategories);

        return redirect()->route('worker.check');
    }


    public function show($id)
    {
        $worker = Worker::find($id);
        //dd($worker->categories);
        $user = $worker->user->first();
        //dd($worker->categories($id)->get());
        $categoriesCollection = $worker->categories()->get();
        $subCategoriesCollection = $worker->subCategories()->get();
        $categories = [];
        $subCategories = [];
        foreach ($categoriesCollection as $item){
            $categories[] = ['id' => $item->id, 'name' => $item->name, 'categories' => ''];
        }
        foreach ($subCategoriesCollection as $item){
            $subCategories[] = ['id' => $item->id, 'name' => $item->name, 'category_id' => $item->category_id];
        }
        $worker->addView($worker);
        return view('worker.item', compact('user','worker', 'categories', 'subCategories'));
    }

    public function index()
    {
        $workers = Worker::all();
        return view('worker.index', compact('workers'));
    }

    public function getOpenJobs()
    {
        $user = Auth::user();
        $jobs = $user->jobs()->statusOpen()->get();
        return $jobs;
    }

    public function getProposedJobs()
    {
        return 4;
    }

    public function proposedJob(Request $request)
    {
        $worker = Worker::find($request->worker_id);
        $worker->proposedJobs()->attach($request->job_id);
        return 1;
    }


}
