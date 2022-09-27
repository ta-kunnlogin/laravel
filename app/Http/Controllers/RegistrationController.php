<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice;
use App\Condition;
use App\Category;
use App\Alert;
use App\Menu;
use App\User;
use App\group;
use App\Team;
use App\Schedule;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateCondition;
use App\Http\Requests\CreateAlert;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\CreateTeam;
use App\Http\Requests\Feedback;
use App\Http\Requests\CreateSchedule;

use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    //practice

    public function createPracticeForm()
    {
        $user=Auth::user();
        $id = $user['id'];
        $categories = Category::
        where('user_id', $id)
        ->get();

        if ($categories->isEmpty()) {
            return redirect('/create_category');
        }

        return view('practice_form', [
            'categories' => $categories
        ]);
    }

    public function createPractice(CreateData $request)
    {
        $practice = new Practice;

        $practice->date = $request->date;
        $practice->morning = $request->morning;
        $practice->type_id_1 = $request->type_id_1;
        $practice->afternoon = $request->afternoon;
        $practice->type_id_2 = $request->type_id_2;
        $practice->image = $request->image;
        $practice->comment = $request->comment;

        Auth::user()->practice()->save($practice);
        return redirect('/');
    }

    public function editPracticeForm(int $id)
    {
        $practices = new Practice;
        $practice = $practices->find($id);

        $user = Auth::user();
        $id = $user['id'];
        $categories = Category::where('user_id', $id)->get();



        return view('edit_practice_form', [
            // 'id' => $id,
            'practice' => $practice,
            'categories' => $categories,
        ]);
    }

    public function editPractice(int $id, CreateData $request)
    {

        $instance = new Practice;
        $record = $instance->find($id);
        $columns = ['date', 'morning', 'type_id_1', 'afternoon', 'type_id_2', 'image', 'comment'];

        foreach ($columns as $column) {
            $record->$column = $request->$column;
        }

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

    public function feedbackPracticeForm()
    {
        return view('feedback_practice_form');
    }
    public function feedbackPractice(int $id, Feedback $request)
    {
        $instance = new Practice;
        $record = $instance->find($id);

        $record->feedback = $request->feedback;
        $record->save();

        return redirect('/');
    }




    // condition
    public function createConditionForm()
    {
        return view('condition_form');
    }

    public function createMenuForm()
    {
        return view('Menu_form');
    }

    public function createCondition(CreateCondition $request)
    {
        $condition = new Condition;

        $condition->date = $request->date;
        $condition->condition = $request->condition;
        $condition->comment = $request->comment;

        Auth::user()->condition()->save($condition);
        return redirect('/');
    }

    public function editConditionForm(int $id)
    {
        $conditions = new Condition;
        $condition = $conditions->find($id);

        return view('edit_condition_form', [
            'id' => $id,
            'condition' => $condition,
        ]);
    }

    public function editCondition(int $id, CreateCondition $request)
    {
        $instance = new Condition;
        $record = $instance->find($id);

        $columns = ['date', 'condition', 'comment'];

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

    public function feedbackConditionForm()
    {
        return view('feedback_condition_form');
    }

    public function feedbackCondition(int $id, Feedback $request)
    {
        $instance = new Condition;
        $record = $instance->find($id);

        $record->feedback = $request->feedback;
        $record->save();

        return redirect('/');
    }

    //
    // category
    //
    public function createCategoryForm()
    {
        $category = new Category;

        return view('category_form', [
            'categories' => $category,
        ]);
    }
    public function createCategory(CreateCategory $request)
    {
        // echo $request;
        $category = new Category;

        $category->training = $request->training;

        Auth::user()->category()->save($category);
        return redirect('/');
    }



    // Alert
    public function createAlert(CreateAlert $request)
    {
        $alert = new Alert;

        $alert->date = $request->date;
        $alert->comment = $request->comment;

        $alert->save();
        return redirect('/');
    }

    public function createAlertForm()
    {
        return view('alert_form');
    }

    public function editAlertForm($id)
    {
        $alerts = new Alert;
        $alert = $alerts->find($id);

        return view('edit_alert_form', [
            // 'id' => $id,
            'alert' => $alert,
        ]);
    }

    public function editAlert(int $id, CreateAlert $request)
    {
        $instance = new Alert;
        $record = $instance->find($id);

        $record->date = $request->date;
        $record->comment = $request->comment;

        $record->save();
        return redirect('/');
    }
    public function editDeleteAlert(int $id)
    {
        $alerts = new Alert;
        $alert = $alerts->find($id);
        $alert->forceDelete();

        return redirect('/');
    }





    public function createScheduleForm()
    {
        return view('schedule_form');
    }
    public function createSchedule(Request $request)
    {
        // $schedule = new Schedule;
        $date = $request->date;
        // $schedule->schedule = $request->schedule;
        // 画像フォームでリクエストした画像を取得

        $img = $request->file('schedule');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img', 'public');

        $user = Auth::user();
        echo $user['id'];
        if ($path) {
            // DBに登録する処理
            Schedule::create([
                'schedule' => $path,
                'date' => $date,
                'user_id' => $user['id'],
            ]);
        }
        return redirect('/');
    }

    public function schedule()
    {
        $id = Auth::user();
        $my_id = $id['id'];

        // echo $my_id;

        $user_team = Auth::user()
            ->join('teams', 'users.id', 'teams.user_id')
            ->where('id', $my_id)
            ->get()
            ->toArray();

        $team = $user_team[0]['team_num'];

        $schedules = Schedule::join('users', 'schedules.user_id', 'users.id')
            ->join('teams', 'schedules.user_id', 'teams.user_id')
            ->where('team_num', $team)
            ->get()
            ->toArray();

        // $scheduleMonth = Schedule::get();

        return view('schedule', [
            'schedules' => $schedules,
            // 'schedules' => $scheduleMonth,
        ]);
    }

    public function scheduleDetail(int $scheduleId)
    {
        // var_dump($scheduleId);
        $schedules = new Schedule;
        $schedule = $schedules
            ->where('data_id', $scheduleId)
            ->get()
            ->toArray();

        $menu = 'storage/' . $schedule[0]['schedule'];
        // var_dump($schedule);

        return view('schedule_detail', [
            'schedule' => $schedule,
            'menu' => $menu,
        ]);
    }

    public function editScheduleForm(int $id)
    {
        $schedules = new Schedule;
        $schedule = $schedules->find($id);

        return view('edit_schedule_form', [
            'id' => $id,
            'schedule' => $schedule,
        ]);
    }

    public function editSchedule(int $id, Request $request)
    {
        $schedule = new Schedule;
        $date = $request->date;
        // $schedule->schedule = $request->schedule;
        // 画像フォームでリクエストした画像を取得
        $img = $request->file('schedule');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img', 'public');

        if ($path) {
            // DBに登録する処理
            Schedule::create([
                'schedule' => $path,
                'date' => $date,
            ]);
        }
        return redirect('/');
    }

    public function editDeleteSchedule(int $id)
    {
        $schedules = new Schedule;
        $schedule = $schedules
        ->where('data_id', $id);
        $schedule->forceDelete();

        return redirect('/');
    }




    public function Month($nowMonth)
    {
        //共通

        $alerts = new Alert;
        $alert = $alerts->limit(5)->get();

        // player専用
        $practices = Auth::user()->practice()
            ->where('date', 'LIKE', '%' . $nowMonth . '%')
            ->get();

        $conditions = Auth::user()->condition()
            ->where('date', 'LIKE', '%' . $nowMonth . '%')
            ->get();

        // coach専用
        $practice = new Practice;
        $condition = new Condition;

        // team_num取得
        $id = Auth::user();
        $my_id = $id['id'];

        $user_team = Auth::user()
            ->join('teams', 'users.id', 'teams.user_id')
            ->where('id', $my_id)
            ->get()
            ->toArray();

        $my = Auth::user()
            ->join('teams', 'users.id', 'teams.user_id')
            ->join('groups', 'team_num', 'groups.group_id')
            ->where('id', $my_id)
            ->get()
            ->toArray();

        $my_group = $my[0]['team_num'];
        $team = $my[0]['group_name'];


        $groups_practice = $practice
            ->join('users', 'practices.user_id', 'users.id')
            ->join('teams', 'practices.user_id', 'teams.user_id')
            ->with('category1')
            ->with('category2')
            ->where('date', 'LIKE', '%' . $nowMonth . '%')
            ->where('team_num', $my_group)
            ->get()
            ->toArray();

        $group_condition = $condition
            ->join('users', 'conditions.user_id', 'users.id')
            ->join('teams', 'conditions.user_id', 'teams.user_id')
            ->where('date', 'LIKE', '%' . $nowMonth . '%')
            ->where('team_num', $my_group)
            ->get()
            ->toArray();

        $user = new User;
        $users = $user
            ->join('teams', 'users.id', 'teams.user_id')
            ->join('groups', 'team_num', 'groups.group_id')
            ->where('team_num', '1')
            ->get()
            ->toArray();

        // echo $result;
        $year = substr($nowMonth, 0, 4);
        $month = substr($nowMonth, 5, 2);
        $a = substr($nowMonth, 4, 1);

        if ($month == '01' || $month == '02' || $month == '03' || $month == '04' || $month == '05' || $month == '06' || $month == '07' || $month == '08' || $month == '09' || $month == '10' || $month == '11' || $month == '12') {
        } else {
            abort(404);
        }
        if ($year == '0000') {
            abort(404);
        }
        if ($a == '-') {
        } else {
            abort(404);
        }
        $str = strlen($nowMonth);
        // echo $str;
        if ($str == 7) {
        } else {
            abort(404);
        }

        $noTeam = $user_team[0]['team_num'];

        return view('home', [

            'users' => $users,
            'alerts' => $alert,
            'nowMonth' => $nowMonth,
            'team' => $team,
            'noTeam' => $noTeam,

            'groups' => $groups_practice,
            'practices' => $practices,
            'conditions' => $conditions,

            'practices_coach' => $groups_practice,
            'conditions_coach' => $group_condition,
        ]);
    }
    public function createTeamForm()
    {
        return view('team_form');
    }

    public function createTeam(CreateTeam $request)
    {
        $group = new group;
        $group->group_name = $request->group_name;

        $group->save();
        return redirect('/');
    }

    public function addTeamFrom(int $id)
    {
        $group = new group;
        $groups = $group->get();

        $users = new User;
        $user = $users
            ->join('teams', 'users.id', 'teams.user_id')
            ->find($id);


        return view('add_team_form', [
            'id' => $id,
            'groups' => $groups,
            // 'team' => $team,
            'user' => $user,
        ]);
    }
    public function addTeam(int $id, Request $request)
    {
        $users = new Team;
        $user = $users
            // ->join('teams', 'users.id', 'teams.user_id')
            ->find($id);

        $user->team_num = $request->team_num;
        $user->save();
        return redirect('/');
    }
}
