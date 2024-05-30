@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal faq-form" data-action="update" method="POST" action="{{ route('dashboard.questions.update', $question) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Вопрос</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1><span class="doc-title">{{ $question->subject }}</span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Имя</label>
                                        <input type="text" class="form-control doc-title-input" name="name" value="{{ $question->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Тема</label>
                                        <input type="text" class="form-control" name="subject" value="{{ $question->subject }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="{{ $question->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Локализация</label>
                                        <select name="locale" class="form-control">
                                            @if ($question->locale == 'de')
                                                <option value="de" selected="selected">DE</option>
                                                <option value="ru">RU</option>
                                            @else
                                                <option value="de">DE</option>
                                                <option value="ru" selected="selected">RU</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        @if ($question->published == 1)
                                            <input name="published" type="checkbox" class="custom-control-input bool-checkbox" id="published" value="1" checked="checked">
                                            <label class="custom-control-label" for="published">Опубликован</label>
                                        @else
                                            <input name="published" type="checkbox" class="custom-control-input bool-checkbox" id="published" value="1">
                                            <label class="custom-control-label" for="published">Опубликован</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Вопрос</label>
                                        <textarea rows="10" type="text" class="form-control" name="question" required>{{ $question->question }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Ответ</label>
                                        <textarea id="ask-editor" rows="20" type="text" class="form-control" name="ask">{{ $question->ask }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resource-action-panel">
                        <div class="resource-action-panel-wrap">
                            <button type="submit" class="btn btn-primary submit-btn">Сохранить</button>
                            <a href="{{ route('dashboard.index')}}" class="btn btn-primary white-btn">Отменить</a>
                            <button type="button" class="btn btn-primary white-btn remove-faq-btn-top" data-route="{{ route('dashboard.questions.destroy', ['id' => $question->id]) }}">Удалить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="action-msg">
        <div class="action-msg-wrap">
            <div class="msg">
                Документ успешно сохранен
            </div>
        </div>
    </div>
    
    <script>
        tinymce.init({
            selector: '#ask-editor',
            content_css: '/css/pbinside.css?v=1,/css/components/uibox-normalize/css/uibox-normalize.css,/css/components/uibox-grid/css/uibox-grid.css,/css/font-awesome.css,/css/style.css?v=1',
            language: 'ru',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
                ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
            valid_elements: '*[*]',
            relative_urls: false,
            convert_urls: false,
            remove_script_host : false,
            paste_data_images: true,
            image_advtab: true,
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $.ajax({
                        url: '/ck5e974ldld5782pnbp5fh73hj5dk/ajax/files',
                        type: "GET",
                        success: function(data) {
                            for (var i = 0; i < data['files'].length; i++) {
                            var filename = data['files'][i]['filename']
                            var filteExt = filename.substring(filename.lastIndexOf('.')+1, filename.length)
                            if (filteExt == 'jpeg' || filteExt == 'JPEG' || filteExt == 'jpg' || filteExt == 'JPG' || filteExt == 'png' || filteExt == 'PNG' || filteExt == 'GIF' || filteExt == 'gif') {
                                $('.modal-img-list').append('<div class="modal-img-item"><img class="file-img-item" src="/' + data['files'][i]['file'] + '"><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                            } else {
                                $('.modal-img-list').append('<div class="modal-img-item"><i class="fa fa-file-o"></i><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                            }
                            }
                            for (var i = 0; i < data['dirs'].length; i++) {
                                var icon = '<i class="fa fa-minus-circle"></i>'

                                if (data['dirs'][i]['status'] == 1) {
                                    icon = '<i class="fa fa-folder"></i>'
                                }
                                $('.modal-dirs-list').append('<li class="dir-item" data-dir="'+data['dirs'][i]['dir']+'"><div class="listflex">'+icon+'<span>' + data['dirs'][i]['dir'] + '</span></div></li>')
                            }
                        },
                        error: function(msg) {}
                    })
                    $('#exampleModalLong').modal('show')
                }
            }
        });
        tinymce.init({
            selector: '#ru_editor',
            content_css: '/css/pbinside.css?v=1,/css/components/uibox-normalize/css/uibox-normalize.css,/css/components/uibox-grid/css/uibox-grid.css,/css/font-awesome.css,/css/style.css',
            language: 'ru',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
                ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
            valid_elements: '*[*]',
            relative_urls: false,
            convert_urls: false,
            remove_script_host : false,
            paste_data_images: true,
            image_advtab: true,
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $.ajax({
                        url: '/ck5e974ldld5782pnbp5fh73hj5dk/ajax/files',
                        type: "GET",
                        success: function(data) {
                            for (var i = 0; i < data['files'].length; i++) {
                            var filename = data['files'][i]['filename']
                            var filteExt = filename.substring(filename.lastIndexOf('.')+1, filename.length)
                            if (filteExt == 'jpeg' || filteExt == 'JPEG' || filteExt == 'jpg' || filteExt == 'JPG' || filteExt == 'png' || filteExt == 'PNG' || filteExt == 'GIF' || filteExt == 'gif') {
                                $('.modal-img-list').append('<div class="modal-img-item"><img class="file-img-item" src="/' + data['files'][i]['file'] + '"><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                            } else {
                                $('.modal-img-list').append('<div class="modal-img-item"><i class="fa fa-file-o"></i><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                            }
                            }
                            for (var i = 0; i < data['dirs'].length; i++) {
                                var icon = '<i class="fa fa-minus-circle"></i>'

                                if (data['dirs'][i]['status'] == 1) {
                                    icon = '<i class="fa fa-folder"></i>'
                                }
                                $('.modal-dirs-list').append('<li class="dir-item" data-dir="'+data['dirs'][i]['dir']+'"><div class="listflex">'+icon+'<span>' + data['dirs'][i]['dir'] + '</span></div></li>')
                            }
                        },
                        error: function(msg) {}
                    })
                    $('#exampleModalLong').modal('show')
                }
            }
        });
    </script>
@endsection