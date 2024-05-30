@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal resource-form" method="POST" action="{{ route('dashboard.resources.update', $resource) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" value="{{ $resource->id }}">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @if($resource->is_category == 1)
                            <li class="nav-item">
                                <a class="nav-link active" id="resource_list_tab" data-toggle="tab" href="#resource_list" role="tab" aria-controls="profile" aria-selected="false">Дочерние страницы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Немецкий</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Немецкий</a>
                            </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link" id="ru_resource_tab" data-toggle="tab" href="#ru_resource" role="tab" aria-controls="profile" aria-selected="false">Русский</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gallery_tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="profile" aria-selected="false">Галерея</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings_tab" data-toggle="tab" href="#settings" role="tab" aria-controls="profile" aria-selected="false">Дополнительно</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @if($resource->is_category == 1)
                        <div class="tab-pane fade show active" id="resource_list" role="tabpanel" aria-labelledby="resource_list_tab" style="padding: 0 20px;">
                            <table class="table resource-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Страница</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($children as $child)
                                        <tr class="resource-tdrow">
                                            @if ($child->is_category == 1)
                                                <td scope="row"><i class="fa fa-folder"></i></td>
                                            @else
                                                <td scope="row"><i class="fa fa-file"></i></td>
                                            @endif
                                            <td><a href="{{ route('dashboard.resources.edit', ['id' => $child->id]) }}">{{ $child->de_title }}</a></td>
                                            <td class="actions-row">
                                                <div class="row">
                                                    <a class="action-btn" href="{{ route('dashboard.resources.edit', ['id' => $child->id]) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="action-btn remove" data-method="delete" data-route="{{ route('dashboard.resources.destroy', ['id' => $child->id]) }}" href="#">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center">Данные отсутствуют</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $children->links() }}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                        @else
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                        @endif
                            <h1 class="doc-title">{{ $resource->de_title }}</h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="de_title" value="{{ $resource->de_title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                    <input type="text" class="form-control" name="de_meta_title" value="{{ $resource->de_meta_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="de_meta_description" class="form-control" cols="30" rows="3">{{ $resource->de_meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="de_meta_keywords" value="{{ $resource->de_meta_keywords }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Категория</label>
                                        <div class="board-custom-select">
                                            <input type="text" class="form-control cusom-select-input-value" name="parent_id" value="{{ $resource->parent_id}}">
                                            <input type="text" class="form-control cusom-select-input category-display-text" value="">
                                            <div class="select-options-list">
                                                @forelse ($categories as $category)
                                                    @if ($resource->parent_id == $category->id)
                                                        <div class="category-option custom-select-option selected" data-value="{{ $category->id}}">{{ $category->de_title}}</div>
                                                    @else
                                                        <div class="category-option custom-select-option" data-value="{{ $category->id}}">{{ $category->de_title}}</div>
                                                    @endif
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="de_alias" value="{{ $resource->de_alias }}">
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="de_uri" value="{{ $resource->de_uri }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Позиция в меню</label>
                                        <input type="number" class="form-control" name="menuindex" value="{{ $resource->menuindex }}">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="{{ $resource->de_published }}" name="de_published" class="checked-field hidden">
                                        @if ($resource->de_published == 1)
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="published" checked="checked" value="{{ $resource->de_published }}">
                                        @else
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="published" value="{{ $resource->de_published }}">
                                        @endif
                                        <label class="custom-control-label" for="published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="{{ $resource->de_menushow }}" name="de_menushow" class="checked-field hidden">
                                        @if ($resource->de_menushow == 1)
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="menushow" checked="checked" value="{{ $resource->de_menushow }}">
                                        @else
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="menushow" value="0">
                                        @endif
                                        <label class="custom-control-label" for="menushow">Показывать в меню</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        @if ($resource->is_category == 1)
                                            <input name="is_category" type="checkbox" class="custom-control-input bool-checkbox" id="is_category" checked="checked" value="{{ $resource->is_category }}">
                                        @else
                                            <input name="is_category" type="checkbox" class="custom-control-input bool-checkbox" id="is_category" value="0">
                                        @endif
                                        <label class="custom-control-label" for="is_category">Категория</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" style="display:none;" >
                                        <label>Содержимое</label>
                                        <textarea id="content" rows="10" type="text" class="form-control" name="de_content">{{ $resource->de_content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <div class="pb-layout">
                                            <div class="pb-header">
                                                <div class="form-group-inline">
                                                    <label>Блоки</label>
                                                    <div class="board-custom-select pb-select">
                                                        <input type="text" class="form-control cusom-select-input-value" name="de_category" value="">
                                                        <input type="text" class="form-control cusom-select-input" value="">
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
                                                <textarea name="" id="editor" cols="30" rows="10">{{ $resource->de_content }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ru_resource" role="tabpanel" aria-labelledby="ru_resource_tab">
                            <h1 class="doc-title">{{ $resource->ru_title }}</h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="ru_title" value="{{ $resource->ru_title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                    <input type="text" class="form-control" name="ru_meta_title" value="{{ $resource->ru_meta_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="ru_meta_description" class="form-control" cols="30" rows="3">{{ $resource->ru_meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="ru_meta_keywords" value="{{ $resource->ru_meta_keywords }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Алиас</label>
                                        <input type="text" class="form-control" name="ru_alias" value="{{ $resource->ru_alias }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>uri</label>
                                        <input type="text" class="form-control" name="ru_uri" value="{{ $resource->ru_uri }}">
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="{{ $resource->ru_published }}" name="ru_published" class="checked-field hidden">
                                        @if ($resource->ru_published == 1)
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_published" checked="checked" value="{{ $resource->ru_published }}">
                                        @else
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_published" value="{{ $resource->ru_published }}">
                                        @endif
                                        <label class="custom-control-label" for="ru_published">Опубликован</label>
                                    </div>
                                    <div class="custom-control custom-checkbox check-parent">
                                        <input type="number" value="{{ $resource->ru_menushow }}" name="ru_menushow" class="checked-field hidden">
                                        @if ($resource->ru_menushow == 1)
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_menushow" checked="checked" value="{{ $resource->ru_menushow }}">
                                        @else
                                            <input type="checkbox" class="custom-control-input bool-checkbox" id="ru_menushow" value="0">
                                        @endif
                                        <label class="custom-control-label" for="ru_menushow">Показывать в меню</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" style="display:none;" >
                                        <label>Содержимое</label>
                                        <textarea id="ru_content" rows="10" type="text" class="form-control" name="ru_content">{{ $resource->ru_content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Содержимое</label>
                                        <div class="pb-layout">
                                            <div class="pb-header">
                                                <div class="form-group-inline">
                                                    <label>Блоки</label>
                                                    <div class="ru_board-custom-select ru_pb-select">
                                                        <input type="text" class="form-control ru_cusom-select-input-value" name="de_category" value="">
                                                        <input type="text" class="form-control ru_cusom-select-input" value="">
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
                                                <textarea name="" id="ru_editor" cols="30" rows="40">{{ $resource->ru_content }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery_tab">
                            <div class="gallery-header">
                                <div class="row">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary getImg get-gallery-files" data-toggle="modal" data-target="#exampleModalLong">
                                            <i class="fa fa-file-image-o"></i><span> Выберите изображения</span>
                                        </button>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                                    <input type="number" value="{{ $resource->use_gallery }}" name="use_gallery" class="checked-field hidden">
                                                    @if ($resource->use_gallery == 1)
                                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="use_gallery" checked="checked" value="{{ $resource->use_gallery }}">
                                                    @else
                                                        <input type="checkbox" class="custom-control-input bool-checkbox" id="use_gallery" value="0">
                                                    @endif
                                                    <label class="custom-control-label" for="use_gallery">Выводить галерею</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="per_page">Выводить по </label>
                                                    <input type="number" class="form-control" name="per_page" id="per_page" value="{{ $resource->per_page }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-body">
                                <div class="gallery-list-layout">
                                    @forelse ($gallery as $file)
                                    <div class="gallery-item">
                                        <input type="hidden" name="gallery_id" value="{{ $file->id }}">
                                        <input type="hidden" name="gallery_route" value="{{ route('dashboard.gallery.update', $file) }}">
                                        <div class="gallery-item-wrap">
                                            <div class="gallery-thumb">
                                                <img class="gallery-thumb-img" src="{{ $file->root_path }}{{$file->filename}}">
                                            </div>
                                            <div class="gallery-item-details dz-details">
                                                <div class="dz-filename">
                                                    @if ($file->title != '')
                                                        <span>{{ $file->title }}</span>
                                                    @else
                                                        <span>{{ $file->filename }}</span>    
                                                    @endif
                                                </div>
                                                <div class="dz-edit">
                                                    <button type="button" class="dz-edit-btn">Редактировать</button>
                                                </div>
                                                <div class="dz-remove">
                                                    <button type="button" class="dz-remove-btn">Удалить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    
                                    @endforelse
                                    
                                </div>
                                
                                       
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings_tab" style="padding: 0 20px;">
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                <input type="number" value="{{ $resource->use_review }}" name="use_gallery" class="checked-field hidden">
                                @if ($resource->use_review == 1)
                                    <input name="use_review" type="checkbox" class="custom-control-input bool-checkbox" id="use_reviews" checked="checked" value="{{ $resource->use_review }}">
                                @else
                                    <input name="use_review" type="checkbox" class="custom-control-input bool-checkbox" id="use_reviews" value="0">
                                @endif
                                <label class="custom-control-label" for="use_reviews">Выводить отзывы</label>
                            </div>
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                <input type="number" value="{{ $resource->use_faq }}" name="use_gallery" class="checked-field hidden">
                                @if ($resource->use_faq == 1)
                                    <input name="use_faq" type="checkbox" class="custom-control-input bool-checkbox" id="use_faq" checked="checked" value="{{ $resource->use_faq }}">
                                @else
                                    <input name="use_faq" type="checkbox" class="custom-control-input bool-checkbox" id="use_faq" value="0">
                                @endif
                                <label class="custom-control-label" for="use_faq">Выводить вопросы</label>
                            </div>
                            <div class="custom-control custom-checkbox check-parent" style="padding: 7px 0;">
                                <input type="number" value="{{ $resource->use_citylist }}" name="use_gallery" class="checked-field hidden">
                                @if ($resource->use_citylist == 1)
                                    <input name="use_citylist" type="checkbox" class="custom-control-input bool-checkbox" id="use_citylist" checked="checked" value="{{ $resource->use_faq }}">
                                @else
                                    <input name="use_citylist" type="checkbox" class="custom-control-input bool-checkbox" id="use_citylist" value="0">
                                @endif
                                <label class="custom-control-label" for="use_citylist">Выводить список городов</label>
                            </div>
                            <div class="row" style="margin: 0 0 0 -40px;width: calc(100% + 80px);">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Schema</label>
                                        <textarea rows="10" style="display:none;" type="text" class="form-control" name="content">{{ $resource->schema_data }}</textarea>
                                        <div class="ace-wrap">
                                            <div id="ace-editor">{{ $resource->schema_data }}</div>
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

    <div class="modal fade" id="gallery-item-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Данные изображения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="gallery-item-form">
                    <div class="row">
                        <div class="col-6">
                            <div class="gallery-item-preview">
                                <img class="edit-gallery-thumb" src="" alt="">
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="gallery_item_id" class="form-control" value="">
                            <div class="form-group">
                                <label for="">Alt</label>
                                <input type="text" name="gallery_alt" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="gallery_title" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Описание</label>
                                <textarea name="gallery_caption" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save-btn">Сохранить</button>
            </div>
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