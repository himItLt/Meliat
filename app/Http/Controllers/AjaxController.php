<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Review;
use App\Question;

class AjaxController extends Controller
{

    public function reviewStore(Request $request, Review $review)
    {
        $newReview = Review::create([
            'name' => (string) $request->name,
            'lastname' => (string) $request->vorname,
            'email' => (string) $request->email,
            'vote' => (int) $request->review_vote,
            'text' => (string) $request->msg,
            'local' => (string) $request->locale
        ]);
        $appUrl = config('app.url');
        if ($newReview) {
            $to = "info@innenausbau-spanndecken.com";
            $subject = "MELIAT Bewertung";
            
            $message = "
                <h1>Новый отзыв на сайте Meliat</h1>
                <p>На сайте оставлен новый отзыв.</p>
                <p>Для публикации отзыва перейдите по ссылке в панель управления: <a href='{$appUrl}ck5e974ldld5782pnbp5fh73hj5dk/review/{$newReview->id}/edit'>Перейти в панель управления</a></p>
            ";
            
            $header = "From: info@innenausbau-spanndecken.com \r\n";
            $header.="Subject: {$subject}\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=UTF-8\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
        }

        $data = ['msg' => 'success'];
        return $data;
    }

    public function questionStore(Request $request)
    {
        
        $newQst = Question::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'question' => $request->msg,
            'locale' => $request->locale
        ]);
        
        $appUrl = config('app.url');
        if ($newQst) {
            $to = "info@innenausbau-spanndecken.com";
            $subject = "MELIAT Fragen-Antworten";
            
            $message = "
                <h1>Новый вопрос на сайте Meliat</h1>
                <p>На сайте задан новый вопрос.</p>
                <p>Для публикации вопроса перейдите по ссылке в панель управления: <a href='{$appUrl}ck5e974ldld5782pnbp5fh73hj5dk/questions/{$newQst->id}/edit'>Перейти в панель управления</a></p>
            ";
            
            $header = "From: info@innenausbau-spanndecken.com \r\n";
            $header.="Subject: {$subject}\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=UTF-8\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
        }

        $data = ['msg' => $request->name];
        return $data;
    }

    public function sendEmail(Request $request)
    {

        $result = 'error';

        if ($request->ajax()) {

            $to = "info@innenausbau-spanndecken.com";
            $subject = "MELIAT Kontakt";
            
            $message = "
                <h1>Обращение с сайта Meliat</h1>
                <p><b>Обращение:</b> {$request->anrede}</p>
                <p><b>Имя:</b> {$request->vorname}</p>
                <p><b>Фамилия:</b> {$request->name}</p>
                <p><b>Телефон:</b> {$request->telefon}</p>
                <p><b>E-mail:</b> {$request->email}</p>
                <p><b>Улица и номер дома:</b> {$request->address}</p>
                <p><b>Почтовый индекс:</b> {$request->plz}</p>
                <p><b>Город:</b> {$request->ort}</p>
                <p><b>Сообщение:</b> {$request->msg}</p>
            ";
            
            $header = "From:{$request->email} \r\n";
            //$header .= "Cc:afgh@somedomain.com \r\n";
            $header.="Subject: {$subject}\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=UTF-8\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
            
            if( $retval == true ) {
                $result = "Message sent successfully...";
            }else {
                $result = "Message could not be sent...";
            }
        }

        return response()->json(['result' => $result]);
    }

    public function sendCallback(Request $request)
    {

        $result = 'error';
        
        if ($request->ajax()) {

            $to = "info@innenausbau-spanndecken.com";
            $subject = "MELIAT Rückruf";
            
            $message = "
                <h1>Заказ звонка на сайте Meliat</h1>
                <p><b>Имя:</b> {$request->name}</p>
                <p><b>Телефон:</b> {$request->telefon}</p>
            ";
            
            $header = "From: info@innenausbau-spanndecken.com \r\n";
            $header.="Subject: {$subject}\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=UTF-8\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
            
            if( $retval == true ) {
                $result = "Message sent successfully...";
            }else {
                $result = "Message could not be sent...";
            }
        }

        return response()->json(['result' => $result]);
    }

    public function cookieCheck(Request $request)
    {
        if ((int) $request->value == 1){
            $session = $request->session()->all();
            session(['cookie_check' => 1]);

            return response()->json(['status' => 'ok'], 200);
        }
    }
}
