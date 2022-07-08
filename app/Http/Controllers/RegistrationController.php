<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice;
use App\Condition;
use App\Category;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function createPracticeForm(){
        $categories = Category::get();

        return view('practice_form',[
            'categories'=>$categories
        ]);
    }
    public function createPractice(Request $request){
        $practice = new Practice;

        $practice->date = $request->date;
        $practice->morning = $request->morning;
        $practice->type_id_1 = $request->type_id_1;
        $practice->afternoon = $request->afternoon;
        $practice->type_id_2= $request->type_id_2;
        $practice->image = $request->image;
        $practice->comment= $request->comment;

        Auth::user()->practice()->save($practice);
        return redirect('/');
    }

    public function createConditionForm()
    {
        return view('condition_form');
    }

    public function createCondition(Request $request)
    {
        $condition = new Condition;

        $condition->date = $request->date;
        $condition->condition = $request->condition;
        $condition->comment = $request->comment;

        Auth::user()->condition()->save($condition);
        return redirect('/');
    }

    public function createCategoryForm()
    {
        $category = new Category;

        return view('category_form', [
            'categories' => $category,
        ]);
    }

    public function createCategory(Request $request)
    {
        // echo $request;
        $category = new Category;

        $category->name = $request->name;

        $category->save();
        return redirect('/');
    }

    public function editPracticeForm(int $id){
        $practices = new Practice;
        $practice = $practices->find($id);

        $category= new Category;
        $categories = $category->get();

        return view('edit_practice_form',[
            'id'=>$id,
            '$practice'=>$practice,
            'categories'=>$categories,
        ]);
    }

    public function editPractice(int $id, Request $request){

        $instance = new Practice;
        $record = $instance->find($id);

        $columns = ['date', 'morning', 'type_id_1', 'afternoon', 'type_id_2', 'image', 'comment'];

        foreach($columns as $column){
            $record->$column = $request->$column;
        }

        // Auth::user()->practice()->save($record);
        $record->save();
        return redirect('/');

    }

    public function editDeletePractice(int $id)
    {
        $practices = new Practice;
        $practice = $practices->find($id);
        $practice->forceDelete();

        return redirect('/');
    }

    public function editConditionForm(int $id)
    {
        $conditions = new Condition;
        $condition = $conditions->find($id);


        return view('edit_condition_form', [
            'id' => $id,
            '$condition' => $condition,
        ]);
    }

    public function editCondition(int $id, Request $request)
    {

        $instance = new Condition;
        $record = $instance->find($id);


        $columns = ['date', 'condition','comment'];

        foreach ($columns as $column) {
            $record->$column = $request->$column;

        }

        // Auth::user()->condition()->save($condition);
        $record->save();

        return redirect('/');
    }

    public function editDeleteCondition(int $id)
    {
        $conditions = new Condition;
        $condition = $conditions->find($id);
        $condition->forceDelete();

        return redirect('/');
    }
    public function point()
    {
        echo 'a';
    }
}
