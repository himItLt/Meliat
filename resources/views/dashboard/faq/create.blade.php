@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal faq-form" data-action="create" method="POST" action="{{ route('dashboard.questions.store') }}">
                    {{ csrf_field() }}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Вопрос</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1>Новый вопрос: <span class="doc-title"></span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Имя</label>
                                    <input type="text" class="form-control doc-title-input" name="name" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Тема</label>
                                    <input type="text" class="form-control" name="subject" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Локализация</label>
                                        <select name="locale" class="form-control">
                                            <option value="de">DE</option>
                                            <option value="ru">RU</option>
                                        </select>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="dpublished" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="published" value="0">
                                        <label class="custom-control-label" for="published">Опубликован</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Вопрос</label>
                                        <textarea rows="10" type="text" class="form-control" name="question" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Ответ</label>
                                        <textarea id="ask-editor" rows="20" type="text" class="form-control" name="ask"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resource-action-panel">
                        <div class="resource-action-panel-wrap">
                            <button type="submit" class="btn btn-primary submit-btn">Сохранить</button>
                            <a href="{{ route('dashboard.index')}}" class="btn btn-primary white-btn">Отменить</a>
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