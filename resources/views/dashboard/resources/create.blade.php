{{-- @extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal resource-form" data-action="create" method="POST" action="{{ route('dashboard.resources.store') }}">
                    {{ csrf_field() }}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Немецкий</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ru_resource_tab" data-toggle="tab" href="#ru_resource" role="tab" aria-controls="profile" aria-selected="false">Русский</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1>Новый документ: <span class="doc-title"></span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="de_title" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                    <input type="text" class="form-control" name="de_meta_title" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="de_meta_description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="de_meta_keywords" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Категория</label>
                                        <div class="board-custom-select">
                                            <input type="text" class="form-control cusom-select-input-value" name="de_category" value="">
                                            <input type="text" class="form-control cusom-select-input" value="">
                                            <div class="select-options-list">
                                                <div class="custom-select-option" data-value="1">Home</div>
                                                <div class="custom-select-option" data-value="3"></div>
                                                <div class="custom-select-option" data-value="3"></div>
                                                <div class="custom-select-option" data-value=""></div>
                                                <div class="custom-select-option" data-value=""></div>
                                                <div class="custom-select-option" data-value=""></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="de_alias" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="de_uri" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Позиция в меню</label>
                                        <input type="number" class="form-control" name="menuindex" value="0">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="de_published" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="published" checked="checked" value="1">
                                        <label class="custom-control-label" for="published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="de_menushow" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="menushow" checked="checked" value="1">
                                        <label class="custom-control-label" for="menushow">Показывать в меню</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <textarea rows="10" type="text" class="form-control" name="de_content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ru_resource" role="tabpanel" aria-labelledby="ru_resource_tab">
                            <h1>Новый документ: <span class="doc-title"></span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                        <input type="text" class="doc-title-input form-control" name="ru_title" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="ru_meta_title" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="ru_meta_description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="ru_meta_keywords" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="ru_alias" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="ru_uri" value="">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="ru_published" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_published" checked="checked" value="">
                                        <label class="custom-control-label" for="ru_published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="ru_menushow" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_menushow" checked="checked" value="">
                                        <label class="custom-control-label" for="ru_menushow">Показывать в меню</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <textarea rows="10" type="text" class="form-control" name="de_content"></textarea>
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
@endsection --}}


@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal resource-form" data-action="create" method="POST" action="{{ route('dashboard.resources.store') }}">
                    {{ csrf_field() }}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Немецкий</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ru_resource_tab" data-toggle="tab" href="#ru_resource" role="tab" aria-controls="profile" aria-selected="false">Русский</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings_tab" data-toggle="tab" href="#settings" role="tab" aria-controls="profile" aria-selected="false">Дополнительно</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1 class="doc-title"></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="de_title" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                    <input type="text" class="form-control" name="de_meta_title" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="de_meta_description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="de_meta_keywords" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Категория</label>
                                        <div class="board-custom-select">
                                            <input type="text" class="form-control cusom-select-input-value" name="parent_id" value="0">
                                            <input type="text" class="form-control cusom-select-input category-display-text" value="">
                                            <div class="select-options-list">
                                                @forelse ($categories as $category)
                                                    <div class="category-option custom-select-option" data-value="{{ $category->id}}">{{ $category->de_title}}</div>
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="de_alias" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="de_uri" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Позиция в меню</label>
                                        <input type="number" class="form-control" name="menuindex" value="0">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="de_published" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="published" checked="checked" value="1">
                                        <label class="custom-control-label" for="published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="de_menushow" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="menushow" checked="checked" value="1">
                                        <label class="custom-control-label" for="menushow">Показывать в меню</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input name="is_category" type="checkbox" class="custom-control-input bool-checkbox" id="is_category" value="0">
                                        <label class="custom-control-label" for="is_category">Категория</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" style="display:none;" >
                                        <label>Содержимое</label>
                                        <textarea id="content" rows="10" type="text" class="form-control" name="de_content"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <div class="pb-layout">
                                            <div class="pb-header">
                                                <div class="form-group-inline">
                                                    <label>Блоки</label>
                                                    <div class="board-custom-select pb-select" style="margin: 0 0 0 15px;">
                                                        <input type="text" class="form-control cusom-select-input-value" name="de_category" value="">
                                                        <input type="text" class="form-control cusom-select-input" value="Выберите блок" style="cursor:pointer;" readonly>
                                                        <div class="select-options-list">
                                                            @forelse ($chunks as $chunk)
                                                                <div class="custom-select-option" data-value="{{ $chunk->id }}">{{ $chunk->title }}</div>
                                                            @empty
                                                                <div class="custom-select-option" data-value="0">Данные отсутствуют</div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-body">
                                                <textarea name="" id="editor" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ru_resource" role="tabpanel" aria-labelledby="ru_resource_tab">
                            <h1 class="doc-title"></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="ru_title" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                    <input type="text" class="form-control" name="ru_meta_title" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="ru_meta_description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="ru_meta_keywords" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="ru_alias" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="ru_uri" value="">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="ru_published" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_published" checked="checked" value="">
                                        <label class="custom-control-label" for="ru_published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="1" name="ru_menushow" class="checked-field hidden">
                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_menushow" checked="checked" value="">
                                        <label class="custom-control-label" for="ru_menushow">Показывать в меню</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" style="display:none;" >
                                        <label>Содержимое</label>
                                        <textarea id="ru_content" rows="10" type="text" class="form-control" name="ru_content"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <div class="pb-layout">
                                            <div class="pb-header">
                                                <div class="form-group-inline">
                                                    <label>Блоки</label>
                                                    <div class="ru_board-custom-select ru_pb-select" style="margin: 0 0 0 15px;">
                                                        <input type="text" class="form-control ru_cusom-select-input-value" name="de_category" value="">
                                                        <input type="text" class="form-control ru_cusom-select-input" value="Выберите блок" style="cursor:pointer;" readonly>
                                                        <div class="select-options-list">
                                                            @forelse ($chunks as $chunk)
                                                                <div class="custom-select-option" data-value="{{ $chunk->id }}">{{ $chunk->title }}</div>
                                                            @empty
                                                                <div class="custom-select-option" data-value="0">Данные отсутствуют</div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-body">
                                                <textarea name="" id="ru_editor" cols="30" rows="40"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings_tab" style="padding: 0 20px;">
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                <input name="use_review" type="checkbox" class="custom-control-input bool-checkbox" id="use_reviews" value="0">
                                <label class="custom-control-label" for="use_reviews">Выводить отзывы</label>
                            </div>
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                {{-- <input type="number" value="0" name="use_faq" class="checked-field hidden"> --}}
                                <input name="use_faq" type="checkbox" class="custom-control-input bool-checkbox" id="use_faq" value="0">
                                <label class="custom-control-label" for="use_faq">Выводить вопросы</label>
                            </div>
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                {{-- <input type="number" value="0" name="use_citylist" class="checked-field hidden"> --}}
                                <input name="use_citylist" type="checkbox" class="custom-control-input bool-checkbox" id="use_citylist" value="0">
                                <label class="custom-control-label" for="use_citylist">Выводить список городов</label>
                            </div>
                            <div class="row" style="margin: 0 0 0 -40px;width: calc(100% + 80px);">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Schema</label>
                                        <textarea rows="10" style="display:none;" type="text" class="form-control" name="content"></textarea>
                                        <div class="ace-wrap">
                                            <div id="ace-editor"></div>
                                        </div>
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
            selector: '#editor',
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