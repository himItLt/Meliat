<!DOCTYPE html>
<html lang="{{ $loc }}" prefix="og: http://ogp.me/ns#">
<head>
        <base href="{{ config('app.url') }}">
        


<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-12TR4KC80Q"></script>	
		<script>
  			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
 			gtag('js', new Date());
  			gtag('config', 'G-12TR4KC80Q');
		</script>
<!-- Google tag (gtag.js) -->
        
        
        
		<meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ !empty($resource[$loc . '_meta_title']) ? $resource[$loc . '_meta_title'] : $resource[$loc . '_title']}}</title>
        <meta name="description" content="{{ !empty($resource[$loc . '_meta_description']) ? $resource[$loc . '_meta_description'] : ''}}">
        <meta name="keywords" content="{{ !empty($resource[$loc . '_meta_keywords']) ? $resource[$loc . '_meta_keywords'] : ''}}">

		<?php if ($_SERVER["REQUEST_URI"]=="/de/datenschutz"): ?>
		<meta name="robots" content="noindex, nofollow">
		<?php endif ?>

        <link rel="icon" href="/favicon.ico" type="image/gif">
        <link rel="shortcut icon" href="/favicon.ico" type="image/gif">
        <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        
        <script>
            function doWork(){
                return 'ok'
            }
        
            performance.mark("startWork");
            doWork(); // Код для замера
            performance.mark("endWork");
        </script>
        
        <link rel="stylesheet" href="/css/style.min.css" media="screen">
        
        <link rel="alternate" hreflang="de-de" href="{{ config('app.url') }}de{{ $resource['de_uri'] == '/' ? '' : '/' . $resource['de_uri']}}">
        <link rel="alternate" hreflang="ru-de" href="{{ config('app.url') }}ru{{ $resource['ru_uri'] == '/' ? '' : '/' . $resource['ru_uri']}}">
        
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{ config('app.url') }}img/logo.png">
        <meta property="og:image:width" content="133">
        <meta property="og:image:height" content="56">
        <meta property="og:locale" content="{{ $loc }}">
        <meta property="og:title" content="{{ !empty($resource[$loc . '_meta_title']) ? $resource[$loc . '_meta_title'] : $resource[$loc . '_title']}}">
        <meta property="og:description" content="{{ !empty($resource[$loc . '_meta_description']) ? $resource[$loc . '_meta_description'] : ''}}">
        <meta property="og:url" content="{{ config('app.url') }}{{ $loc }}{{ $resource['ru_uri'] == '/' ? '' : '/' . $resource['ru_uri']}}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <link rel="canonical" href="{{ config('app.url') }}{{ $loc }}{{ $resource[$loc . '_uri'] == '/' ? '' : '/' . $resource[$loc . '_uri']}}">

        {!! $schema !!}
        {!! $resource->schema_data !!}
        
        @if (count($reviewsPagin) > 0)
            {!! PaginateRoute::renderRelLinks($reviewsPagin) !!}
        @endif
</head>
<body>
    <header class="page-header">
        <div class="uibox-container">
            <div class="uibox-row header-row">
                <div class="col s2 header-left">
                    <a href="/{{ $loc }}" class="logo-wrap">
                        <img src="img/logo.png" alt="Meliat Spanndecken">
                    </a>
                </div>
                <div class="col s4 header-l-center hotline">
                    <i class="fa fa-phone"></i>
                    <span>{{ __('theme.header_hotline') }}</span>
                     <a href="tel:+4915777053056"> +49 (0)15777 053 056</a>
                </div>
                <div class="header-r-center">
                    <div class="uibox-row">
                        @if ($loc == 'de')
                            <a href="/de/preise" class="link-btn header-btn">{{ __('theme.header_price_btn') }}</a>
                            <a href="/de/design-de" class="link-btn header-btn">{{ __('theme.header_design_btn') }}</a>
                        @else
                            <a href="/ru/preise-ru" class="link-btn header-btn">{{ __('theme.header_price_btn') }}</a>
                            <a href="/ru/design-ru" class="link-btn header-btn">{{ __('theme.header_design_btn') }}</a>
                        @endif
                    </div>
                </div>
                <div class="header-right">
                    <div class="uibox-row langs-row">
                        <div class="mobile-lang">
                            @if ($loc == 'de')
                                <span class="changed-lang">DE</span>
                            @else
                                <span class="changed-lang">RU</span>
                            @endif
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <ul class="langs-list">
                            <li>
                                <a href="/de{{$resource->de_uri === '/' ? '' : '/' . $resource->de_uri}}">
                                    <img src="img/de-flag.png" alt="de">
                                </a>
                            </li>
                            <li>
                                <a href="/ru{{ $resource->ru_uri === '/' ? '' : '/' . $resource->ru_uri }}">
                                    <img src="img/ru-flag.png" alt="ru">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="nav-layout">
        <div class="uibox-container">
            <button class="nav-toggle"><i class="fa fa-bars"></i></button>
            <ul class="nav">
                @foreach ($menu as $item)
                    @if ($item->id == $resource->id)
                        @if ($item->id == 1)
                            <li class="active"><a href="{{ $loc }}">{{ $item[$loc . '_title'] }}</a></li>
                        @else
                            <li class="active"><a href="{{ $loc }}/{{ $item[$loc . '_uri'] }}">{{ $item[$loc . '_title'] }}</a></li>
                        @endif
                    @else
                        @if ($item->id == 1)
                            <li><a href="{{ $loc }}">{{ $item[$loc . '_title'] }}</a></li>
                        @else
                            <li><a href="{{ $loc }}/{{ $item[$loc . '_uri'] }}">{{ $item[$loc . '_title'] }}</a></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
    @if ($resource->id != 1)
        <div class="crumbs-layout">
            <div class="crumbs">
                <div class="uibox-container">
                    <ul class="crumbs-list">
                        <li class="crumb-home"><a href="/{{ $loc }}"><i class="fa fa-home"></i></a></li>
                        <li class="crumb-separator"><i class="fa fa-chevron-right"></i></li>
                        <li>{{ $resource[$loc . '_title'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    <div class="section action-section">
        <div class="uibox-container">
            <div class="uibox-row action-row">
                <div class="col s6 action-layout">
                    <div class="action-block">
                        <div class="subtitle">{{ __('theme.actions_callback_title') }}</div>
                        <div class="uibox-row action-body">
                            <div class="action-descr callback-descr">
                                {{ __('theme.actions_callback_descr') }}
                            </div>
                        </div>
                        <div class="center action-btn-wrap">
                            <button class="btn callback-btn" data-fancybox data-src="#callback-modal">{{ __('theme.actions_caallback_btn') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col s6 callback-layout">
                    <div class="action-block">
                        <div class="subtitle">{{ __('theme.actions_calc_title') }}</div>
                        <div class="uibox-row action-body">
                            <div class="action-descr calc-descr">
                                {{ __('theme.actions_calc_descr') }}
                            </div>
                        </div>
                        <div class="center action-btn-wrap">
                            @if ($loc == 'de')
                                <a class="link-btn calc-link" href="/de/preise">{{ __('theme.actions_calc_btn') }}</a>    
                            @else
                                <a class="link-btn calc-link" href="/ru/preise-ru">{{ __('theme.actions_calc_btn') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section feedback-section form-container">
        <div class="uibox-container">
            <div class="main-form-layout form-layout">
                <div class="success-msg-layout">
                    <div class="success-msg">
                        <button class="success-remove-btn"><i class="fa fa-times"></i></button>
                        <div class="center">
                            <div class="h2">{{ __('theme.feedback_form_success_title') }}</div>
                            <div class="success-text">{{ __('theme.feedback_form_success_text') }}</div>
                        </div>
                        <div class="center">
                            <div id="footer-feedback-success-icon"></div>
                        </div>
                    </div>
                </div>
                <div class="col s10 feedback-form-layout form-outer">
                    <div class="h2">{{ __('theme.feedback_form_title') }}</div>
                    <form id="feedback-form" action="fakepath" method="post">
                        <div class="uibox-row form-row">
                            <div class="col s6 form-col">
                                <div class="form-group fullname">
                                    <label>Anrede<sup>*</sup></label>
                                    <input type="text" class="text-input" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_gender') }}</label>
                                    <div class="custom-select">
                                        <select class="select anrede" name="anrede">
                                            <option value="">{{ __('theme.select_option_default') }}</option>
                                            <option value="Herr">{{ __('theme.select_option_man') }}</option>
                                            <option value="Frau">{{ __('theme.select_option_women') }}</option>
                                        </select>
                                        <div class="error-msg"></div>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_lastname') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="vorname">
                                    <div class="error-msg"></div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_name') }}</label>
                                    <input type="text" class="text-input" name="name">
                                    <div class="error-msg"></div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_phone') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="telefon">
                                    <div class="error-msg"></div>
                                </div>
                            </div>
                            <div class="col s6 form-col">
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_email') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="email">
                                    <div class="error-msg"></div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_address') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="address">
                                    <div class="error-msg"></div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_postal_index') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="plz">
                                    <div class="error-msg"></div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('theme.feedback_form_label_city') }}<sup>*</sup></label>
                                    <input type="text" class="text-input empty-field" name="ort">
                                    <div class="error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group textarea-block">
                            <label>{{ __('theme.feedback_form_label_comment') }}<sup>*</sup></label>
                            <textarea name="msg" cols="30" rows="5" class="empty-field"></textarea>
                            <div class="error-msg"></div>
                        </div>
                        <div class="center">
                            <button type="submit" class="btn send-btn">{{ __('theme.send_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer">
        <div class="main-footer">
            <div class="uibox-container">
                <div class="uibox-row">
                    <div class="col s6 footer-nav-layout">
                        <ul class="footer-nav">
                            @foreach ($footerMenu as $item)
                                @if ($item->id == 1)
                                    <li><a href="{{ $loc }}">{{ $item[$loc . '_title'] }}</a></li>
                                @else
                                    <li><a href="{{ $loc }}/{{ $item[$loc . '_uri'] }}">{{ $item[$loc . '_title'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col s6 footer-contacts-layout">
                        <div class="footer-social">
                            <ul class="footer-soc-list">
<!--                            <li><a class="social-icon fb" href="http://facebook.com/spanndecken.nrw.bau/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                                <li><i class="fa fa-google-plus"></i></a></li>    -->
                            </ul>
                        </div>
                        <ul class="footer-contacts">
<!--
                            <li><i class="fa fa-phone"></i> {{ __('theme.footer_contacts_phone_de') }}: <a href="tel:+49015777053056">+49 (0)15 777 053 056</a></li>
                            <li><i class="fa fa-phone"></i> {{ __('theme.footer_contacts_phone_ru') }}: <a href="tel:+49017663473934">+49 (0)176 6347 3934 </a></li>
-->
                            
                            <li><i class="fa fa-phone"></i> {{ __('theme.footer_contacts_phone_de') }}: <a href="tel:+49015777053056">+49 (0)15 777 053 056</a></li>
                            <li><i class="fa fa-envelope-o"></i> E-Mail: <a href="mailto:info@innenausbau-spanndecken.com">info@innenausbau-spanndecken.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="cpr-block">
            <div class="uibox-container">
                <div class="cpr">Copyright MELIAT Spanndecken ® 2009-{{ $cprDate }} | <a href="/de/impressum-2">Impressum</a> | <a href="/de/datenschutz">Datenschutzerklärung</a></div>
            </div>
        </div>
    </footer>
    <div id="callback-modal">
        <div class="modal-body">
            <div class="success-modal">
                <div class="h2">{{ __('theme.callback_modal_success_title') }}</div>
                <div class="modal-success-text">{{ __('theme.callback_modal_success_text') }}</div>
                <div class="center">
                   <div id="modal-feedback-success-icon"></div>
                </div>
            </div>
            <div class="callback-form-wrap">
                <div class="h2">{{ __('theme.callback_modal_title') }}</div>
                <form id="callback-form" class="form" action="fakepath/" method="post">
                    {{ csrf_field() }}
                    <div class="form-group fullname">
                        <label>fullname</label>
                        <input type="text" name="fullname" value="">
                        <div class="error-msg"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('theme.callback_modal_label_name') }}</label>
                        <input type="text" name="name" class="text-input">
                        <div class="error-msg"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('theme.callback_modal_label_phone') }}<sup>*</sup></label>
                        <input type="text" name="telefon" class="text-input">
                        <div class="error-msg"></div>
                    </div>
                    <button type="submit" class="btn clb">{{ __('theme.send_btn') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="messengers">
        <a href="https://wa.me/4915777053056" class="messenger wa">
            <img src="images/whatsapp-icon.png" alt="">
            <div class="msg-tooltip">WhatsApp</div>
        </a>
    </div>
    <div class="scroll-top">
        <i class="fa fa-chevron-up"></i>
    </div>
    @if ($cookie_check == 0)
        <div class="cookie-check-layout">
            <div class="uibox-container">
                <div class="uibox-row">
                    <div class="cookie-check-text">
                        Unsere Webseite verwendet Cookies
                    </div>
                    <div class="cookie-check-actions">
                        <ul class="cookie-check-list">
                            <li><a class="cookie-check-link" href="de/datenschutz">Datenschutz</a></li>
                            <li><button type="button" class="btn cookie-check-btn">OK</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var ww = document.body.clientWidth
        if (ww < 1024) {
            $('.lazyload').attr('src', '')
        }
        window.lazySizesConfig = window.lazySizesConfig || {};
        window.lazySizesConfig.expand = 10;
	</script>
    <script src="/js/lazy/plugins/unveilhooks/ls.unveilhooks.min.js" async=""></script>
    <script src="/js/lazy/lazysizes.min.js" async=""></script>
    
    <!--<script src="/js/jquery.fancybox.js"></script>-->
    <!--<script src="/js/calc.js"></script>-->
    <!--<script src="/js/design.js"></script>-->
    <!--<script src="/js/jscolor.js"></script>-->
    
    <script src="/js/svg.js"></script>
    <script src="/js/scripts.min.js"></script>     
    <!--<script src="/js/calc.js"></script>-->
    <script>
        (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54781103-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-54781103-1');
</script>

</body>
</html>