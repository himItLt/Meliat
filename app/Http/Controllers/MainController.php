<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Gallery;
use App\Review;
use App\Question;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;


class MainController extends Controller
{
    public function index(Request $request, $uri)
    {
        $locale = app()->getLocale();
        $resource = Resource::where($locale . '_alias', $uri)->first();
        $menu = Resource::where([
                [$locale . '_published', '=', 1],
                [$locale . '_menushow', 1],
                ['parent_id', 0]
            ])->get();

        $footerMenu = Resource::where([
                [$locale . '_published', '=', 1],
                ['parent_id', 0]
            ])->get();

        $gallery = [];
        $pagin = [];
		$videoObject1_Arr =[];
		$videoObject1  = '';					
		$videoObject2_Arr =[];
		$videoObject2  = '';

        if ($resource['use_gallery'] == 1) {
            $perPage = $resource['per_page'];
            //$gallery = Gallery::where('resource_id', $resource['id'])->simplePaginate($perPage);
            $gallery = Gallery::where('resource_id', $resource['id'])->orderBy('created_at', 'desc')->get();
            // $galleryp = Gallery::where('resource_id', $resource['id'])->get();
            // $galleryp = collect($galleryp);

            // $pagin = new LengthAwarePaginator($galleryp, count($galleryp), $perPage);
        }
        
        $reviews = [];
        $aggregateRating = 0;
        $reviewsPagin = [];
        $reviewCount = 0;
        
        if ($resource['use_review'] == 1) {
            $reviews = Review::where([
                    //['local', $locale],
                    ['published', 1]
                ])->orderBy('id', 'desc')->simplePaginate(10);

            $reviewsp = Review::where([
                //['local', $locale],
                ['published', 1]
            ])->get();
            
            $reviewCount = count($reviewsp);
            $aggregateRating = 0;
            foreach ($reviewsp as $review) {
                $aggregateRating = $aggregateRating + $review['vote'];
            }
            if($aggregateRating > 0) {
                $aggregateRating = number_format((float)$aggregateRating / $reviewCount, 2, '.', '');
            }
            $reviewsp = collect($reviewsp);

            $reviewsPagin = new LengthAwarePaginator($reviewsp, count($reviewsp), 10);
        }

        $questions = [];
        $questionsPagin = [];
        if ($resource['use_faq'] == 1) {
            $questions = Question::where([
                ['locale', $locale],
                ['published', 1]
            ])->orderBy('id', 'desc')->simplePaginate(10);

            $questionsp = Question::where([
                ['locale', $locale],
                ['published', 1]
            ])->get();
            $questionsp = collect($questionsp);

            $questionsPagin = new LengthAwarePaginator($questionsp, count($questionsp), 10);
        }

        $cities = [];
        if($resource['use_citylist'] == 1) {
            $cities = Resource::where('parent_id', $resource['id'])->get();
        }



        if(!empty($resource) && $resource->id == 3){						

            $reviews = Review::where([
                ['local', $locale],
                ['published', 1]
            ])->limit(3)->orderBy('id', 'desc')->get();
    
            $aggregateRating = 0;
            
            if (count($reviews) > 0) {
                $reviewsAll = Review::where([
                    ['local', $locale],
                    ['published', 1]
                ])->get();  
                $reviewCount = count($reviewsAll);
                foreach ($reviewsAll as $review) {
                    $aggregateRating = $aggregateRating + $review['vote'];
                }
                $aggregateRating = number_format((float)$aggregateRating / $reviewCount, 2, '.', '');
            }
    
            $reviewsPagin = [];
        }
		
		
		
		
		
		
		if (!empty($resource)) {
            if ($resource->id == 10){
				$videoObject1_Arr =[
					"@context" => "http://schema.org",
					"@type" => "VideoObject",
					"name" => "MELIAT Spanndecken - Montage an einem Tag",
					"description" => "Erleben Sie die unglaubliche Montage einer Spanndecke an einem Tag! In diesem Zeitraffer-Video sehen Sie den kompletten Prozess vom Beginn bis zum Abschluss der Installation. Wir sind stolz darauf, Ihnen unsere schnelle und effektive Arbeitsweise zu präsentieren. Schauen Sie jetzt rein und lassen Sie sich beeindrucken!",
					"thumbnailUrl" => "https://innenausbau-spanndecken.com/img/Hauptbild_ Montage an einem Tag.jpg",
					"uploadDate" => "2023-04-25T08:00:00+08:00",
					"duration" => "PT0M45S",
					"publisher" => [
						"@type"=>"Organization",
						"name"=>"MELIAT Spanndecken",
						"logo"=>
							[
							"@type"=>"ImageObject",
							"url"=>"https://innenausbau-spanndecken.com/img/logo.png",
							"width"=>600,"height"=>60
							]
					],
					"contentUrl"=>"https://innenausbau-spanndecken.com/de","embedUrl"=>"https://youtu.be/RnCYykUsOaY","interactionCount"=>"100"
				];
				
			$videoObject1  = '<script type="application/ld+json">' . json_encode($videoObject1_Arr, JSON_UNESCAPED_UNICODE) . '</script>';	
			}
		}	
	
	
	
	
		
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
        
        $orgArr = [
            "@context" => "http://schema.org",
            "@type" => "Organization",
            "address" => [
                "@type" => "PostalAddress",
                "postalCode" => "58710",
                "addressLocality" => "Menden",
                "streetAddress" => "Oberm Rohlande 110",
                ],
            "contactPoint" => [
                  "@type" => "ContactPoint",
                  "telephone" => "+49 15777 053 056",
                  "contactType" => "customer service",
                  "areaServed" => "DE",
                  "availableLanguage" => "Deutsch",
                  "availableLanguage" => "Russisch"
                ],
            "contactPoint" => [
                  "@type" => "ContactPoint",
                  "telephone" => "+49 15777 053 056",
                  "contactType" => "technical support",
                  "areaServed" => "DE",
                  "availableLanguage" => "Deutsch",
                  "availableLanguage" => "Russisch"
                ],
            "name" => "Meliat Spanndecken",
            "url" => config('app.url') . $resource[$locale . '_uri'],
            "logo" =>  config('app.url') . 'img/logo.png',
            "email" => 'info@innenausbau-spanndecken.com'
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
            "copyrightHolder" => "Copyright MELIAT Spanndecken",
            "copyrightYear" => date('Y')
        ];
        
        $serviceArr = [];
				
        if (!empty($resource)) {
            if ($resource->id == 3 && $reviewCount > 0){
                $serviceArr = [
                    "@context" => "http://schema.org/",
                    "@type" => "Product",
                    "name" => "Spanndecke mit Montage. Preis - Leistung Verhältnis optimal angepasst. 10 Jahre - Garantie.",
                    "image" => "https://innenausbau-spanndecken.com/images/ProduktMicrodataImage/Spanndecken-Wohnzimmer-16x9.jpg",
                    "description" => "EU zertifizierte hochwertige Spanndecke mit Montage von Fachfirma mit vieljährigen Erfahrung und 10-jährige Garantie.",
                    "brand" => [
                        "@type" => "Brand",
                        "name" => "MELIAT Spanndecken"
                        ],
                    "offers" =>
                        [
                            "@type" => "AggregateOffer",
                            "priceCurrency" => "EUR",
                            "lowPrice" => "42.00",
                            "highPrice" => "81.00",
                            "priceValidUntil" => "2023-01-15",
                            "itemCondition" => "http://schema.org/UsedCondition",
                            "availability" => "http://schema.org/InStock",
                            "offerCount" => "33507",
                            "seller" =>
                                [
                                    "@type" => "Organization",
                                    "name" => "MELIAT Spanndecken"
                                ],
                        ],
                    "aggregateRating" => [
                        "@type" => "AggregateRating",
                        "ratingValue" => $aggregateRating,
                        "reviewCount" => $reviewCount
                        ],
                    "review" => [
                        "@type" => "Review",
                        "name" => "Review",
                        "description" => $reviews[0]['text'],
                        "author" => [
							"@type" => "Person",
							"name" => $reviews[0]['name']
						] 
                    ],
                    "sku" => "01"
                ];
				//Video 2 site_preise
				$videoObject2_Arr =[
					"@context" => "http://schema.org",
					"@type" => "VideoObject",
					"name" => "MELIAT - Spanndecken: Widerstandsfähigkeit und Vorsicht im Umgang mit scharfen Gegenständen",
					"description" => "Willkommen zu unserem Video über Spanndecken! In dieser Präsentation zeigen wir Ihnen, wie widerstandsfähig Spanndeckenfolie wirklich ist. Sehen Sie selbst, wie eine Dachlatte gegen die Decke schlägt, ohne sie zu beschädigen. Dieses beeindruckende Beispiel verdeutlicht, dass diese Folie starken Einwirkungen standhält. 
Doch Vorsicht ist geboten! In einem weiteren Test demonstrieren wir, wie ein Messer mühelos durch die Folie schneidet. Das verdeutlicht, dass scharfe Gegenstände die Folie schnell beschädigen können. Daher möchten wir Ihnen dringend empfehlen, äußerste Vorsicht beim Umgang mit scharfen Gegenständen walten zu lassen.",
					"thumbnailUrl" => "https://innenausbau-spanndecken.com/img/MELIAT Spanndecken - Widerstandsfähigkeit und Vorsicht im Umgang mit scharfen Gegenständen.jpg",
					"uploadDate" => "2023-04-25T08:00:00+08:00",
					"duration" => "PT1M02S",
					"publisher" => [
						"@type"=>"Organization",
						"name"=>"MELIAT Spanndecken",
						"logo"=>
							[
							"@type"=>"ImageObject",
							"url"=>"https://innenausbau-spanndecken.com/img/logo.png",
							"width"=>600,"height"=>60
							]
					],
					"contentUrl"=>"https://innenausbau-spanndecken.com/de/preise","embedUrl"=>"https://youtu.be/0m3RuJ9qbjE","interactionCount"=>"100"
				];
				
			$videoObject2  = '<script type="application/ld+json">' . json_encode($videoObject2_Arr, JSON_UNESCAPED_UNICODE) . '</script>';	
			
            } else if ($reviewCount > 0) {
                $serviceArr = [
                    "@context" => "http://schema.org/",
                    "@type" => "Organization",
                    "aggregateRating" => [
                            "@type" => "AggregateRating",
                            "ratingValue" => $aggregateRating,
                            "reviewCount" => $reviewCount,
                    		"itemreviewed" => "Organization",
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
                    //       "telephone" => "+49 15777 053 056",
                    //       "contactType" => "customer service",
                    //       "areaServed" => "DE"
                    //     ],
                    //     "name" => "Meliat Spanndecken",
                    //     "url" => config('app.url') . $resource[$locale . '_uri'],
                    //     "logo" => config('app.url') . 'img/logo.png',
                    //     "email" => 'info@innenausbau-spanndecken.com',
                    //     "priceRange" => "42-71",
                    //     "telephone" => "+49 15777 053 056"
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
                      "telephone" => "+49 15777 053 056",
                      "contactType" => "customer service",
                      "areaServed" => "DE"
                    ],
                    "name" => "Meliat Spanndecken",
                    "url" => config('app.url') . $resource[$locale . '_uri'],
                    "logo" => config('app.url') . 'img/logo.png',
                    "email" => 'info@innenausbau-spanndecken.com',
                    "priceRange" => "42-81",
                    "telephone" => "+49 15777 053 056"
                ]
            ];
            }
        }  
		
		
	
	
        $webSite = '<script type="application/ld+json">' . json_encode($webSiteArr, JSON_UNESCAPED_UNICODE) . '</script>';
        // $org = '<script type="application/ld+json">' . json_encode($orgArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $wpHeader = '<script type="application/ld+json">' . json_encode($wpHeaderArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $wpFooter = '<script type="application/ld+json">' . json_encode($wpFooterArr, JSON_UNESCAPED_UNICODE) . '</script>';
        $service = '<script type="application/ld+json">' . json_encode($serviceArr, JSON_UNESCAPED_UNICODE) . '</script>';
        
        $schema = $videoObject1 . $videoObject2 . $webSite . $wpHeader . $wpFooter . $service;

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
        
        if (!empty($resource)) {
    		return view('main', [
                'resource' => $resource,
                'menu' => $menu,
                'loc' => $locale,
                'gallery' => $gallery,
                'pagin' => $pagin,
                'footerMenu' => $footerMenu,
                'reviews' => $reviews,
                'reviewsPagin' => $reviewsPagin,
                'rating' => $aggregateRating,
                'reviewCount' => $reviewCount,
                'questions' => $questions,
                'questionsPagin' => $questionsPagin,
                'cities' => $cities,
                'schema' => $schema,
                'cookie_check' => $cookie_check,
                'cprDate' => $cprDate,
                'i' => $i = 1
            ]);
        } else {
    		return response(view('errors.404', [
                'resource' => $resource,
                'menu' => $menu,
                'loc' => $locale,
                'gallery' => $gallery,
                'pagin' => $pagin,
                'footerMenu' => $footerMenu,
                'reviews' => $reviews,
                'reviewsPagin' => $reviewsPagin,
                'rating' => $aggregateRating,
                'questions' => $questions,
                'questionsPagin' => $questionsPagin,
                'cprDate' => $cprDate
            ]), 404);
    	}
        
    }
}
