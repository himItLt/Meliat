<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}/ck5e974ldld5782pnbp5fh73hj5dk">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="/" target="_blank">Сайт</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index')}}/resources">Страницы</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.review.index') }}">Отзывы</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.questions.index') }}">Вопрос-ответ</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index')}}/chunks">Элементы</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard.profile.edit', ['id' => 1]) }}">Профиль</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 admin-content">
            @yield('content')
        </main>
    </div>
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Подтвердите действие</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Удалить данный документ безвозвратно?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary remove-back">Отменить</button>
                <button type="button" class="btn btn-primary confirm-remove" data-dismiss="modal">Удалить</button>
              
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade bd-example-modal-lg" id="manager-upload-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg img-modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Перетащите файлы в поле</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropzone drop-wrap">
                        <form action="" class="dropzone">
                            <div class="fallback"></div>
                        </form>
                        <div class="dropimage-wrap">
                            <div id="dropimage" class="d-dropzone" data-action="{{ route('dashboard.gallery.store') }}">
                                <div class="drop-overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg img-modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">/</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3" style="border-right:1px solid #ddd;">
                            <ul class="modal-dirs-list">

                            </ul>
                        </div>
                        <div class="col-9">
                            <div class="modal-img-list"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary manager-getupload-file-btn">Загрузить файлы</button>
                    <button type="button" class="btn btn-primary change-img-file">OK</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="{{ asset('js/dropzone.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.dropzone.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/pb.js') }}"></script>
    <script src="{{ asset('js/ace/src-noconflict/ace.js') }}"></script>
</body>
</html>