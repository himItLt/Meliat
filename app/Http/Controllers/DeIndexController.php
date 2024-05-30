<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Review;
use Carbon\Carbon;

class DeIndexController extends Controller
{

    public function index(Request $request)
    {
        
        $locale = app()->getLocale();
        $resource = Resource::find(1);
        $menu = Resource::where([
                [$locale . '_published', '=', 1],
                [$locale . '_menushow', 1]
            ])->get();

        $footerMenu = Resource::where([
                [$locale . '_published', '=', 1],
                ['parent_id', 0]
            ])->get();

        $reviews = Review::where([
            //['local', $locale],
            ['published', 1]
        ])->limit(3)->orderBy('id', 'desc')->get();

        $aggregateRating = 0;
        
        $reviewCount = 0;  

        if (count($reviews) > 0) {
            $reviewsAll = Review::where([
            //['local', $locale],
            ['published', 1]])->get();
            $reviewCount = count($reviewsAll);
            $aggregateRating = 0;
            foreach ($reviewsAll as $review) {
                $aggregateRating = $aggregateRating + $review['vote'];
            }
            if($aggregateRating > 0) {
                $aggregateRating = number_format((float)$aggregateRating / $reviewCount, 2, '.', '');
            }
        }

        $reviewsPagin = [];


        $webSiteArr = [
            "@context" => "http://schema.org",
            "@type" => "WebSite",
            "url" => config('app.url'),
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => config('app.url') . $resource[$locale . '_uri'] . "search?query={search_term_string}",
                "query-input" => "required name=search_term_string"
            ]
        ];
        
        $wpHeaderArr = [
            "@context" => "http://schema.org",
            "@type" => "WPHeader",
            "headline" => $resource[$locale . '_meta_title'],
            "description" => $resource[$locale . '_meta_description'],
            "keywords" => $resource[$locale . '_meta_keywords'],
            "url" => config('app.url') . $resource[$locale . '_uri']
        ];
        
        $wpFooterArr = [
            "@context" => "http://schema.org",
            "@type" => "WPFooter",
            "copyrightHolder" => "Copyright MELIAT Inenausbau",
            "copyrightYear" => date('Y')
        ];
        
        if($reviewCount > 0) {
            $serviceArr = [
                "@context" => "http://schema.org/",
                "@type" => "Organization",
                "aggregateRating" => [
                    "@type" => "AggregateRating",
                    "ratingValue" => $aggregateRating,
                    "reviewCount" => $reviewCount,
                	"itemReviewed" => "Organization",
                ],
                // "serviceType" => "Spanndecken service",
                // "provider" => [
                //     "@type" => "LocalBusiness",
                //     "name" => "Meliat Spanndecken",
                //     "image" => config('app.url') . 'img/logo.png',
                //     "address" => [
                //     "@type" => "PostalAddress",
                //         "postalCode" => "58710",
                //         "addressLocality" => "Menden",
                //         "streetAddress" => "Oberm Rohlande 110",
                //         ],
                //     "contactPoint" => [
                //       "@type" => "ContactPoint",
                //       "telephone" => "+49 0 176 63473934",
                //       "contactType" => "customer service",
                //       "areaServed" => "DE"
                //     ],
                //     "name" => "Meliat Spanndecken",
                //     "url" => config('app.url') . $resource[$locale . '_uri'],
                //     "logo" => config('app.url') . 'img/logo.png',
                //     "email" => 'info@innenausbau-spanndecken.com',
                //     "priceRange" => "42-81",
                //     "telephone" => "+49 0 176 63473934"
                // ]
            ];
        } else {
            $serviceArr = [
            "@context" => "http://schema.org/",
            "@type" => "Service",
            "serviceType" => "Spanndecken service",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Meliat Spanndecken",
                "image" => config('app.url') . 'img/logo.png',
                "address" => [
                "@type" => "PostalAddress",
                    "postalCode" => "58710",
                    "addressLocality" => "Menden",
                    "streetAddress" => "Oberm Rohlande 110",
                    ],
                "contactPoint" => [
                  "@type" => "ContactPoint",
                  "telephone" => "+49 0 176 63473934",
                  "contactType" => "customer service",
                  "areaServed" => "DE"
                ],
                "name" => "Meliat Spanndecken",
                "url" => config('app.url') . $resource[$locale . '_uri'],
                "logo" => config('app.url') . 'img/logo.png',
                "email" => 'info@innenausbau-spanndecken.com',
                "priceRange" => "42-71",
                "telephone" => "+49 0 176 63473934"
            ]
        ];
        }
        
        $webSite = '<script type="application/ld+json">' . json_encode($webSiteArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $wpHeader = '<script type="application/ld+json">' . json_encode($wpHeaderArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $wpFooter = '<script type="application/ld+json">' . json_encode($wpFooterArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $service = '<script type="application/ld+json">' . json_encode($serviceArr, JSON_UNESCAPED_UNICODE) . '</script>';
        
        $schema = $webSite . $wpHeader . $wpFooter . $service;

        $session = $request->session()->all();
        
        if (!array_key_exists('cookie_check', $session)) {
            if (empty($session['cookie_check'])) {
                $session['cookie_check'] = 0;
                $cookie_check = 0;
            } else if ($session['cookie_check'] == 1) {
                $cookie_check = 1;
            }
        } else {
            $cookie_check = 1;
        }
        
        $cprDate = Carbon::now()->format('Y');
        
        return view('index', [
            'resource' => $resource,
            'menu' => $menu,
            'loc' => $locale,
            'pagin' => $pagin = [],
            'footerMenu' => $footerMenu,
            'reviews' => $reviews,
            'reviewsPagin' => $reviewsPagin,
            'schema' => $schema,
            'rating' => $aggregateRating,
            'reviewCount' => $reviewCount,
            'cookie_check' => $cookie_check,
            'cprDate' => $cprDate
        ]);
    }
    
}
