<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Resource;
//use Symfony\DomCrawler\Crawler;
class ParserController extends Controller
{
    public function index()
    {
        set_time_limit(0);

        $resources = Resource::where([
            ['parent_id', 7]
        ])->get();

        foreach($resources as $res){
            $uri = $res->de_alias;
            $alias = $res->de_uri;

            $res->de_alias = $alias;
            $res->de_uri = $uri;
            $res->de_menushow = 0;
            $res->ru_menushow = 0;
            $res->save();
        }
        echo 'ok';

//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, 'https://innenausbau-spanndecken.com/de/spanndecken-in-ihrer-naehe-top/');
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0');
//         //curl_setopt($ch, CURLOPT_HEADER, true);
//         //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);

//         $html = curl_exec($ch);
//         curl_close($ch);

//         $home = 'https://innenausbau-spanndecken.com';

//         $crawler = new Crawler(null, $home);
//         $crawler->addHtmlContent($html, 'UTF-8');



//         $links = $crawler->filter('.list-title a')->each(function (Crawler $node, $i) {
//             return $node->attr('href');
//         });

//         $data = [];
//         foreach ($links as $link) {
//             $url = $home . $link;
//             $ch = curl_init();
//             curl_setopt($ch, CURLOPT_URL, $url);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//             curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0');

//             $html = curl_exec($ch);
//             curl_close($ch);

//             $crawler = new Crawler(null, $url);
//             $crawler->addHtmlContent($html, 'UTF-8');

//             $parsePagetitle = $crawler->filter('h1')->text();


//             $keywords = $crawler->filter('meta[name=keywords]')->attr('content');
//             $description = $crawler->filter('meta[name=description]')->attr('content');
//             $meta_title = $crawler->filter('title')->text();

//             $title = str_replace('Spanndecken in ', '', trim($parsePagetitle));
//             $pagetitle = '
// <div class="content-section">
//     <div class="content-section-wrap">
//         <div class="uibox-container">
//             <div class="page-title">
//                 <h1>'.trim($parsePagetitle).'</h1>
//             </div>
//         </div>
//     </div>
// </div>';

//             $img1 = $crawler->filter('.item-page img')->first()->attr('src');
//             $img2 = $crawler->filter('.item-page img')->last()->attr('src');

//             $content = '
// <div class="content-section">
//     <div class="content-section-wrap">
//         <div class="section">
//             <div class="uibox-container">
//                 <div class="section-text">
//                     <p>
//                         <img src="'.$img1.'" style="float: left; margin: 0 20px 0 0;" data-mce-style="float: left; margin: 0 20px 0 0;" alt="spanndecken in '.$title.'">Wollen Sie in Ihrer Wohnung oder in Ihrem Haus eine Spanndecke machen lassen?</p>
//                     <p>Kennen Sie keine Firma die so was in Haltern treibt? Sie sind sensibel gegen Staub und möchten das Raumklima in Ihrem Schlafzimmer mit einer Spanndecke verbessern – oder Sie haben eine kreative Idee, wie Sie in Ihrem Ladenlokal Ihre Decke modernisieren und Ihre Räume mit einer kreativen Folienbespannung gestalten können? <strong>MELIAT Innenausbau</strong> berät Sie vor Ort in <strong>'.$title.'</strong> – lassen Sie sich heute noch Ihren Spanndecken-Preis kalkulieren.&nbsp;
//                     </p>
//                     <p>
//                         <br data-mce-bogus="1">
//                     </p>
//                     <p>
//                         <img src="'.$img2.'" style="float: right; margin: 5px 0 0 20px;" data-mce-style="float: right; margin: 5px 0 0 20px;" alt="spanndecken in '.$title.'" width="320" height="240">Wir können Ihnen ein optimales und interessantes <strong>Preisleistungsverhältnis</strong> garantieren und passen die Decken auf Ihren Geschmack an. Unsere Spanndecken sind passend fur alle Stilrichtungen. Für Neubau sowie zur Deckenrenovierung für geschwungene, bogenförmige, horizontale, vertikale und schräge Flächen geeignet. Ideal für Schlafzimmer, Küche, Bad, Eingangshalle, Büro.
//                     </p>
//                     <p>Mit unserem Online-Rechner können Sie den <a href="/de/preise" data-mce-href="/de/preise">Preis für Ihre Spanndecke SOFORT ermitteln</a>.</p><p>Was Sie noch interessieren könte:</p>
//                     <ul>
//                         <li><a href="/de#spanndecken_allgemeine_beschreibung" data-mce-href="/de#spanndecken_allgemeine_beschreibung">Was soll ich über die Spanndecken wissen?</a><br data-mce-bogus="1">
//                         </li>
//                         <li><a href="/de#spanndecken_montage" data-mce-href="/de#spanndecken_montage">Montage und technische Aspekte</a><br data-mce-bogus="1">
//                         </li>
//                         <li><a href="/de#vorbereitung" data-mce-href="/de#vorbereitung">Vorbereiten von Räumen</a><br data-mce-bogus="1"></li>
//                         <li><a href="/de#spanndecken_beleuchtung" data-mce-href="/de#spanndecken_beleuchtung">Lichtdecken, Beleuchtung in Spanndecken</a><br data-mce-bogus="1"></li>
//                     </ul>
//                     <p>
//                         <a class="link-btn" href="/de/preise" data-mce-href="/de/preise">Preis Online-Rechner</a>
//                         <br data-mce-bogus="1">
//                     </p>
//                 </div>
//             </div>
//         </div>
//     </div>
// </div>
//             ';

//             $parseLink = substr($link, 1);
//             $parts = explode('/', $parseLink);
//             $alias = array_pop($parts);
//             $uri = str_replace('de/', '', $parseLink);

//             $fullContent = $pagetitle . $content;

//             $data[] = [
//                 'de_title' => $title,
//                 'de_meta_title' => $meta_title,
//                 'de_meta_description' => $description,
//                 'de_meta_keywords' => $keywords,
//                 'de_content' => $fullContent,
//                 'parent_id' => 7,
//                 'de_menushow' => 1,
//                 'de_published' => 1,
//                 'de_uri' => $alias,
//                 'de_alias' => $uri
//             ];
//         }

//         foreach($data as $value){
//             Resource::create($value);
//         }
//             // $link = substr('/de/spanndecken-in-ihrer-naehe-top/600-spanndecken-aachen', 1);
//         // $parts = explode('/', $link);
//         // $alias = array_pop($parts);
//         // $uri = str_replace('de/', '', $link);

//         print('<pre>');
//         print_r('ok');
//         //echo $html;

//         //echo 'ok';
    }
}
