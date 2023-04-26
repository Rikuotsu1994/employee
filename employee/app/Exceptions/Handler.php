<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
    * @var array
    */
    protected $levels = [
        //
    ];

    /**
    * @var array
    */
    protected $dontReport = [
        //
    ];

    /**
    * @var array
    */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
    * @return void
    */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
    * 419 HTTPレスポンスの例外処理を実行 
    *
    * @param \Illuminate\Http\Request $request
    * @param Throwable $e
    * @return mixed
    */
    public function render($request, Throwable $e): mixed
    {
        if ($e instanceof TokenMismatchException){
            if (Auth::check()) {
                Auth::logout();
            }
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect('/')->with('message', 'ログインエラー発生のため再ログインをお試しください。');
        }
        return parent::render($request, $e);
    }
}
