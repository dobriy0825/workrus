<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyWorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMyWorker()
    {
        $user = Auth::user();
        if ($user->isWorker()) {
            $worker = $user->worker()->first();
            //dd($worker->categories,$worker->categories()->first()->subCategories);
            $categoriesCollection = $worker->categories()->get();
            $subCategoriesCollection = $worker->subCategories()->get();
            $categories = [];
            $subCategories = [];

            foreach ($categoriesCollection as $item) {
                $categories[] = ['id' => $item->id, 'name' => $item->name, 'categories' => ''];
            }
            foreach ($subCategoriesCollection as $item) {
                $subCategories[] = ['id' => $item->id, 'name' => $item->name, 'category_id' => $item->category_id];
            }

        }
        return view('cabinet.my_worker.my_worker', compact('user','worker', 'categories', 'subCategories'));
    }
}
