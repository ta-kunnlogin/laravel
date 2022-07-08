<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Practice;
use App\Condition;
use App\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index()
    {

        // $practice = new Practice;
        // $practice_with_category = $practice->with('category')->get();
        $practices = Auth::user()->practice()->get();
        // $condition = new Condition;
        // $condition_with_category = $condition->get();
        $conditions = Auth::user()->condition()->get();

            return view('home', [
                // 'practices' => $practice_with_category,
                'practices' => $practices,
                // 'conditions' => $condition_with_category,
                'conditions' => $conditions,
            ]);
    }
    public function practiceDetail(int $practiceId)
    {
        $practices = new Practice;
        $practice=$practices->find($practiceId);

        // echo $practice;
        return view('detail_practice', [
            'practice' => $practice,
        ]);
    }
    public function conditionDetail($conditionId)
    {
        $conditions = new Condition;
        $condition = $conditions->find($conditionId);

        return view('detail_condition', [
            'condition' => $condition,
        ]);
    }
}
