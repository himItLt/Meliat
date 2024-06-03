<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'de'; //основной язык, который не должен отображаться в URl

    public static $languages = ['de', 'ru']; // Указываем, какие языки будем использовать в приложении.


/*
 * Проверяет наличие корректной метки языка в текущем URL
 * Возвращает метку или значеие null, если нет метки
 */
public static function getLocale()
{
    $uri = Request::path(); //получаем URI


    $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"


    //Проверяем метку языка  - есть ли она среди доступных языков
    if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

        //if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];
        return $segmentsURI[0];

    }
    if($segmentsURI[0] == ''){
        return redirect('/de');
    }
    return null;
}

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) {
            App::setLocale($locale);
        } else {
        //если метки нет - устанавливаем основной язык $mainLanguage
            App::setLocale(self::$mainLanguage);
            $uri = Request::path(); //получаем URI
            $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"
            if ($uri == 'preise') {
                return redirect('/de/preise', 301);
            }
            switch ($segmentsURI[0]) {
                case '404':
                    $segmentsURI[0] = false;
                    break;

            }
            if ($segmentsURI[0] != false) {
                return redirect('/404');
            }
        }

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

}
