<!DOCTYPE html>
<html lang="en">
<head>
        <base href="{{ config('app.url') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>404</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="robots" content="noindex, nofollow">
        
        <link rel="icon" href="/favicon.ico" type="image/gif">
        <link rel="shortcut icon" href="/favicon.ico" type="image/gif">
        <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        
        <link rel="stylesheet" href="css/components/uibox-normalize/css/uibox-normalize.css" media="screen">
        <link rel="stylesheet" href="css/components/uibox-grid/css/uibox-grid.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.css" media="screen">
        <link rel="stylesheet" href="css/jquery.fancybox.css" media="screen">
        <link rel="stylesheet" href="css/style.css" media="screen">
        
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{ config('app.url') }}img/logo.png">
        <meta property="og:image:width" content="133">
        <meta property="og:image:height" content="56">
        <meta property="og:locale" content="de_DE">
        <meta property="og:title" content="Meliat">
        <meta property="og:description" content="description">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="content">
        <link rel="caconical" href="">
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
                    <a href="tel:+4915777053056">+49(0)15 777 053 056</a>
                </div>
                <div class="header-r-center">
                    <div class="uibox-row">
                        @if ($loc == 'de')
                            <a href="/de/preise" class="link-btn header-btn">{{ __('theme.header_price_btn') }}</a>
                            <a href="/de/design" class="link-btn header-btn">{{ __('theme.header_design_btn') }}</a>
                        @else
                            <a href="/ru/preise-ru" class="link-btn header-btn">{{ __('theme.header_price_btn') }}</a>
                            <a href="/ru/design-ru" class="link-btn header-btn">{{ __('theme.header_design_btn') }}</a>
                        @endif
                    </div>
                </div>
                <div class="header-right">
                    <div class="uibox-row langs-row">
                        <div class="mobile-lang">
                            <span class="changed-lang">DE</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <ul class="langs-list">
                            <li>
                                <a href="/de/">
                                    <img src="img/de-flag.png" alt="de">
                                </a>
                            </li>
                            <li>
                                <a href="/ru/">
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
                @if ($loc == 'de')
                    @foreach ($menu as $item)
                        <li><a href="{{ $loc }}/{{ $item->de_uri }}">{{ $item->de_title }}</a></li>
                    @endforeach
                @else
                    @foreach ($menu as $item)
                        <li><a href="{{ $loc }}/{{ $item->ru_uri }}">{{ $item->ru_title }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
    <main class="content">
        <div class="uibox-container" style="padding:40px 0 0 0;">
            <div class="page-title">
                <h1>{{ __('theme.404_title') }}</h1>
            </div>
        </div>
        <div class="text-content">
            <div class="uibox-container">
                <div class="wrap-404">
                    <div class="msg-404">404</div>
                    <div class="center">
                        <a class="link-btn btn-404" href="/{{ $loc }}">{{ __('theme.home_btn') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer">
        <div class="main-footer">
            <div class="uibox-container">
                <div class="uibox-row">
                    <div class="col s6 footer-nav-layout">
                        <ul class="footer-nav">
                            @if ($loc == 'de')
                                @foreach ($footerMenu as $item)                                   
                                    <li><a href="{{ $loc }}/{{ $item->de_uri }}">{{ $item->de_title }}</a></li>
                                @endforeach
                            @else
                                @foreach ($footerMenu as $item)
                                    <li><a href="{{ $loc }}/{{ $item->ru_uri }}">{{ $item->ru_title }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col s6 footer-contacts-layout">
                        <div class="footer-social">
                            <ul class="footer-soc-list">
<!--                           <li><a class="social-icon fb" href="http://facebook.com/spanndecken.nrw/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                               <li><a class="social-icon google-plus" href="https://plus.google.com/+Innenausbau-spanndecken" target="_blank"><i class="fa fa-google-plus"></i></a></li>
 -->
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
                <div class="cpr">Copyright MELIAT Spanndecken ® 2009-<?php echo(now()->format('Y')); ?> | <a href="/de/impressum-2">Impressum</a> | <a href="/de/datenschutz">Datenschutzerklärung</a></div>
            </div>
        </div>
    </footer>
    <div class="messengers">
        <a href="" class="messenger wa">
            <img src="images/whatsapp-icon.png" alt="">
            <div class="msg-tooltip">WhatsApp</div>
        </a>
    </div>
    <div class="scroll-top">
        <i class="fa fa-chevron-up"></i>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/jquery.fancybox.js"></script>
    <script src="/js/calc.js"></script>
    <script src="/js/jscolor.js"></script>
    <script src="/js/main.js"></script>
    <script>
        (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
</body>
</html>