<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeFormRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Worker;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;
use Session;

class EmployeeController extends Controller
{
    /**
    * ログイン済みかどうかの判定を行います
    *
    * @return View
    */
    public function loginEmployee(): View
    {
        if (Auth::check()) {
            return view('employee/index');
        }
        else {
            return view('auth/login');
        }
    }

    /**
    * 社員データを登録します
    *
    * @param EmployeeFormRequest $request
    * @return RedirectResponse
    */
    public function createEmployee(EmployeeFormRequest $request): RedirectResponse
    {
        try {
            $param = [
                'password' => bcrypt($request->password),
                'worker_name' => $request->worker_name,
                'sex' => $request->sex,
                'age' => $request->age,
                'address' => $request->address,
                'department' => $request->department,
                'division' => $request->division,
                'hire_date' => $request->hire_date,
            ];
            DB::beginTransaction();
            DB::table('workers')->insert($param);
            DB::commit();
            return redirect('/employee/create')->with('message', '登録が完了しました。トップ画面に戻ります。');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect('/employee/create')->with('message', '登録に失敗しました。トップ画面に戻ります。');
        }
    }

    /**
    * 検索条件に一致する社員データを取得します
    *
    * @param Request $request
    * @return View
    */
    public function searchEmployee(Request $request): View
    {
        DB::connection()->enableQueryLog();
        $worker_id = $request->input('worker_id');
        $workers = DB::table('workers')->where('worker_id', 'like', '%' .$worker_id .'%')->get();
        dd(\DB::getQueryLog());
        return view('/employee/search', ['workers' => $workers]);

    }

    /**
    * 更新対象の社員データを取得します
    *
    * @param Request $request
    * @return View
    */
    public function getUpdateEmployee(Request $request): View
    {
        $workers = DB::table('workers')->where('worker_id', $request->worker_id)->get();
        $workers->isEmpty() ? Session::flash('message', '更新対象の社員データは存在しません。社員検索画面に戻ります。') : null ;
        return view('/employee/update', ['workers' => $workers]);
    }

    /**
    * 社員データを更新します
    *
    * @param EmployeeFormRequest $request
    * @return View
    */
    public function updateEmployee(EmployeeFormRequest $request): View
    {
        try {
            $param = [
                'worker_name' => $request->worker_name,
                'sex' => $request->sex,
                'age' => $request->age,
                'address' => $request->address,
                'department' => $request->department,
                'division' => $request->division,
                'hire_date' => $request->hire_date,
            ];
            DB::beginTransaction();
            DB::table('workers')->where('worker_id',$request->worker_id)->update($param);
            DB::commit();
            $workers = DB::table('workers')->where('worker_id', $request->worker_id)->get();
            Session::flash('message', '更新が完了しました。社員検索画面に戻ります。');
            return view('employee/update', ['workers' => $workers]);
        } catch (QueryException $e) {
            DB::rollBack();
            $workers = DB::table('workers')->where('worker_id', $request->worker_id)->get();
            Session::flash('message', '更新に失敗しました。社員検索画面に戻ります。');
            return view('employee/update', ['workers' => $workers]);
        }
    }

    /**
    * 削除対象の社員データを取得します
    *
    * @param Request $request
    * @return View
    */
    public function getDeleteEmployee(Request $request): View
    {
        $workers = DB::table('workers')->where('worker_id', $request->worker_id)->get();
        $workers->isEmpty() ? Session::flash('message', '削除対象の社員データは存在しません。社員検索画面に戻ります。') : null ;
        return view('/employee/delete', ['workers' => $workers]);
    }

    /**
    * 社員データを削除します
    *
    * @param Request $request
    * @return View
    */
    public function deleteEmployee(Request $request): View
    {
        try {
            if (isset($request['agree'])) {
                DB::beginTransaction();
                DB::table('workers')->where('worker_id',$request->worker_id)->delete();
                DB::commit();
                Session::flash('message', '削除が完了しました。社員検索画面に戻ります。');
                return view('employee/delete', ['worker_id', $request->worker_id]);
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('message', '削除に失敗しました。社員検索画面に戻ります。');
            return view('employee/delete', ['worker_id', $request->worker_id]);
        }
    }

    /**
    * ログインユーザーのパスワードを更新します。
    *
    * @param UpdatePasswordRequest $request
    * @return View
    */
    public function updatePassword(UpdatePasswordRequest $request): View
    {  
        try {
            $param = [
                'password' => bcrypt($request->password),
            ];
            $worker_id = Auth::id();
            DB::beginTransaction();
            DB::table('workers')->where('worker_id', $worker_id)->update($param);
            DB::commit();
            Session::flash('message', 'パスワード更新が完了しました。トップ画面に戻ります。');
            return view('employee/update_password');
        } catch (QueryException $e) {
            DB::rollBack();
            Session::flash('message', 'パスワード更新に失敗しました。トップ画面に戻ります。');
            return view('employee/update_password');
        }
    }

    /**
    * 社員のパスワードをリセットします。
    *
    * @param Request $request
    * @return RedirectResponse
    */
    public function resetPassword(Request $request): RedirectResponse
    {
        try {
            $worker_id = Auth::id();
            if ($worker_id === Worker::administrator_number) {
                $password = str_pad(rand(0,99999999),8,0, STR_PAD_LEFT);
                $param = [
                    'password' => bcrypt($password),
                ];
                DB::beginTransaction();
                DB::table('workers')->where('worker_id',$request->worker_id)->update($param);
                DB::commit();
                $flashmassage = '新しいパスワードは「' . $password . '」です。';
                Session::flash('password_message', $flashmassage);
                return redirect('/employee/search');
            } else {
            throw new Exception();
            }
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('password_message', 'パスワードリセットに失敗しました。検索画面に戻ります。');
            return redirect('/employee/search');
        }
    }
}