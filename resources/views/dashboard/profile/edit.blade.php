@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal profile-form" data-action="update" method="POST" action="{{ route('dashboard.profile.update', $profile) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Вопрос</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1><span class="doc-title">{{ $profile->name }}</span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Имя</label>
                                        <input type="text" class="form-control doc-title-input" name="name" value="{{ $profile->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="{{ $profile->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Новый пароль</label>
                                        <input type="password" class="form-control" name="pass" value="" autocomplete="new-password"> 
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
                Профиль успешно сохранен
            </div>
        </div>
    </div>
@endsection