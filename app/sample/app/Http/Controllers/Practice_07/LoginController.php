<?php
namespace App\Http\Controllers\Practice_07;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practice_07\LoginRequest;
use App\Models\User;
use App\Models\DayWorkInformation;
use Carbon\Carbon;

// ログ出力用
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('Practice_07.login');
    }

    public function login(LoginRequest $request)
    {
        //リクエスト情報取得
        $employeeCode = $request->input('employeeCode');
        $password = $request->input('password');

        //usersテーブルを検索
        $user = User::getUserByUserIdAndPassword($employeeCode, $password);

        $message = '';
        //検索結果の判定
        if (is_null($user) || empty($user)) {
            $errorMessage = '入力された社員コードまたはパスワードが違います。';
            return back() //1つ前の入力画面に戻す
                ->withInput() //入力値を保持する
                ->withErrors(['errorMessage' => $errorMessage]);
        } else {
            $message = 'ようこそ！' . $user->name . 'さん！';
        }

        $workInfo = DayWorkInformation::getMonthWorkInfo($employeeCode)
                ->withPath('/Practice_07/work/get');


        $responseData = [
            'message' => $message, 'employeeCode' => $employeeCode, 'workInfo' => $workInfo, 'workMonth' => date('Y-m')
        ];
        log::info($responseData);

        $request->session()->put(['code' => $employeeCode]);

        log::info($request->session()->all());

        return view('Practice_07.home', ['responseData' => $responseData]);
    }
}
