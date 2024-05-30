@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Отзывы</h1>
    <div class="card">
        <div class="card-body">
            <div style="display:flex;justify-content: space-between;align-items: center;">
                <a class="btn btn-primary" href="{{ route('dashboard.review.create') }}">Создать отзыв</a>
                <div class="form-group">
                    <label>С отмеченными:</label>
                    <select class="mass-select form-control">
                        <option value="0">Ничего не делать</option>
                        <option value="destroy">Удалить</option>
                    </select>
                </div>
            </div>
            <table class="table resource-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 50px;"><input type="checkbox" class="mass-list-checkbox"></th>
                        <th scope="col" style="width: 50px;"></th>
                        <th scope="col">Автор</th>
                        <th>Дата добавления</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resources as $resource)
                        <tr class="resource-tdrow" @if($resource->published == 0) style="opacity:.5;" @endif>
                            <td style="width: 50px;" class="mass-check-td"><input type="checkbox" class="reslist-checkbox" value="{{ $resource->id }}" data-route="{{ route('dashboard.review.destroy', ['id' => $resource->id]) }}"></td>
                            <td scope="row" style="width: 50px;"><i class="fa fa-file"></i></td>
                            <td><a href="{{ route('dashboard.review.edit', ['id' => $resource->id]) }}">{{ $resource->name }} {{ $resource->lastname }}</a></td>
                            <td>{{ $resource->created_at}}</td>
                            <td class="actions-row">
                                <div class="row">
                                    <a class="action-btn" href="{{ route('dashboard.review.edit', ['id' => $resource->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="action-btn remove" data-method="delete" data-route="{{ route('dashboard.review.destroy', ['id' => $resource->id]) }}" href="#">
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
            <div>{{ $resources->links() }}</div>
        </div>
    </div>
</div>
@endsection