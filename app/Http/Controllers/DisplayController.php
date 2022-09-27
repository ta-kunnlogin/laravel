<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Practice;
use App\Condition;
use App\Category;
use App\Alert;
use App\Team;
use App\User;
use App\group;
use Carbon\Carbon;
use Google\Service\CloudScheduler\RetryConfig;
use SheetDB\SheetDB;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use PDO;

class DisplayController extends Controller
{
    public function index()
    {
        //共通
        $nowMonth = date('Y-m');

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

        // var_dump($user_team);

        if (empty($user_team)) {
            Team::insert([
                'user_id' => $my_id,
                'team_num' => 1,
            ]);
        }



        $my = Auth::user()
            ->join('teams', 'users.id', 'teams.user_id')
            ->join('groups', 'team_num', 'groups.group_id')
            ->where('id', $my_id)
            ->get()
            ->toArray();

        // var_dump($my);

        $my_group = $my[0]['team_num'];
        // var_dump($my_group);
        $team = $my[0]['group_name'];
        // var_dump($team);

        // echo $team;


        $groups_practice = $practice
            ->join('users', 'practices.user_id', 'users.id')
            ->join('teams', 'practices.user_id', 'teams.user_id')
            ->with('category1')
            ->with('category2')
            ->where('date', 'LIKE', '%' . $nowMonth . '%')
            ->where('team_num', $my_group)
            ->get()
            ->toArray();

            // var_dump($groups_practice);

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


        // var_dump($user_team[0]);

        $noTeam = $user_team[0]['team_num'];

        $all_user = $user
            ->join('teams', 'users.id', 'teams.user_id')
            ->join('groups', 'team_num', 'groups.group_id')
            ->where('permissions_id', '1')
            ->orWhere('permissions_id', '2')
            ->get()
            ->toArray();



        return view('home', [
            'users' => $users,
            'alerts' => $alert,

            'noTeam' => $noTeam,
            'user' => $user_team[0],

            'nowMonth' => $nowMonth,

            'team' => $team,

            'groups' => $groups_practice,
            'practices' => $practices,
            'conditions' => $conditions,

            'practices_coach' => $groups_practice,
            'conditions_coach' => $group_condition,

            'all_user' =>$all_user,
        ]);
    }



    public function practiceDetail($id)
    {
        $practices = new Practice;
        // $practice = $practices->find($id);
        $practice = $practices
        ->with('category1')
        ->with('category2')
        ->where('practice_id',$id)
        ->get()->toArray();

        if (is_null($practice)) {
            abort(404);
        }
        // var_dump($practice);
        return view('detail_practice', [
            'practice' => $practice[0],
        ]);
    }
    public function conditionDetail($conditionId)
    {
        $conditions = new Condition;
        $condition = $conditions->find($conditionId);

        if (is_null($condition)) {
            abort(404);
        }

        return view('detail_condition', [
            'condition' => $condition,
        ]);
    }

    public function get()
    {
        $sheetDB = new SheetDB('f0u12a9vaxa5o');
        $response = $sheetDB->get();
        // dd($response);
        // var_dump($response);
        foreach ($response as $val) {
            var_dump($val);
            echo '</br>';
        }
    }
    public function createEventForm()
    {
        return view('event_form');
    }



    public function event()
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = env('GOOGLE_CALENDAR_ID');

        $event = new Google_Service_Calendar_Event(array(
            //タイトル
            'summary' => 'テスト',
            'start' => array(
                // 開始日時
                'dateTime' => '2020-08-23T11:00:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ),
            'end' => array(
                // 終了日時
                'dateTime' => '2020-08-23T12:00:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ),
        ));

        // $event = $service->events->insert($calendarId, $event);
        // var_dump($event);
        // echo "イベントを追加しました";

        // $calendar = $service->calendars->get('primary');

        // echo $calendar->getSummary();
    }

    private function getClient()
    {
        $client = new Google_Client();

        //アプリケーション名
        $client->setApplicationName('GoogleCalendarAPIのテスト');
        //権限の指定
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        //JSONファイルの指定
        $client->setAuthConfig(storage_path('app/api-key/fit-galaxy-357813-7330c0d542bd.json'));

        return $client;
    }

    public function getUsersBySearchName(Request $request)
    {
        $name = $request->all();
        $search = $name['name'];

        // $users = User::
        // where('name', 'like', "%$search%")
        // ->get()->toArray(); //出品数もほしいため、withCountでitemテーブルのレコード数も取得
        // return response()->json($users);

        $users = new Practice;
        $user = $users
            ->join('users', 'practices.user_id', 'users.id')
            ->where('name',  $search)
            ->get()->toArray(); //出品数もほしいため、withCountでitemテーブルのレコード数も取得
        return response()->json($user);
    }
}
