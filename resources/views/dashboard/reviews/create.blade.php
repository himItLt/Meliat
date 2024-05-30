@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal review-form" data-action="create" method="POST" action="{{ route('dashboard.review.store') }}">
                    {{ csrf_field() }}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="de_resource_tab" data-toggle="tab" href="#de_resource" role="tab" aria-controls="home" aria-selected="true">Отзыв</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="de_resource" role="tabpanel" aria-labelledby="de_resource_tab">
                            <h1>Новый отзыв: <span class="doc-title"></span></h1>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Имя</label>
                                    <input type="text" class="form-control doc-title-input" name="name" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Фамилия</label>
                                    <input type="text" class="form-control" name="lastname" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Оценка (от 0 до 5)</label>
                                        <input type="number" class="form-control" name="vote" value="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Локализация</label>
                                        <select name="local" class="form-control">
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
                                        <label>Текст отзыва</label>
                                        <textarea rows="10" type="text" class="form-control" name="text" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resource-action-panel">
                        <div class="resource-action-panel-wrap">
                            <button class="btn btn-primary review-submit-btn">Сохранить</button>
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
@endsection