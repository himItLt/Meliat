@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal chunk-form" method="POST" action="{{ route('dashboard.chunks.update', $chunk) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                        <h1 class="doc-title">{{ $chunk->title }}</h1>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Заголовок</label>
                                    <input type="text" class="form-control doc-title-input" name="title" value="{{ $chunk->title }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Иконка</label>
                                    <div class="uibox-row media-input">
                                        <input type="text" name="icon" class="form-control icon-input" value="">
                                        <button type="button" class="btn btn-primary getImg" data-toggle="modal" data-target="#exampleModalLong">
                                            <i class="fa fa-file-image-o"></i>
                                        </button>
                                        <div class="current-file-img">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Содержимое</label>
                                    <textarea rows="10" style="display:none;" type="text" class="form-control" name="content">{{ $chunk->content }}</textarea>
                                    <div class="ace-wrap">
                                        <div id="ace-editor">{{ $chunk->content }}</div>
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
            </div>
        </div>
    </div>
    
@endsection