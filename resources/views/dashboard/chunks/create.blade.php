@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                    

                <form class="form-horizontal chunk-form" method="POST" action="{{ route('dashboard.chunks.store') }}" data-action="create">
                    {{ csrf_field() }}
                    <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                        <h1>Новый чанк: <span class="doc-title"></span></h1>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Имя</label>
                                    <input type="text" class="form-control doc-title-input" name="title" value="" required>
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
                                    <textarea rows="10" style="display:none;" type="text" class="form-control" name="content"></textarea>
                                    <div class="ace-wrap">
                                        <pre id="ace-editor"></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resource-action-panel">
                        <div class="resource-action-panel-wrap">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
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

      
      <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg img-modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">img/</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-img-list"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary change-img-file">OK</button>
                </div>
            </div>
        </div>
    </div>

    
@endsection