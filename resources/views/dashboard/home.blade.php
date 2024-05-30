@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="card">
        <div class="card-body">
        <a class="btn btn-primary" href="{{ route('dashboard.resources.create') }}">Создать страницу</a>
            <br>
            <br>
            <table class="table resource-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Страница</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resources as $resource)
                        <tr class="resource-tdrow">
                            @if ($resource->is_category == 1)
                                <td scope="row">({{ $resource->id }}) <i class="fa fa-folder"></i></td>
                            @else
                                <td scope="row">({{ $resource->id }}) <i class="fa fa-file"></i></td>
                            @endif
                            <td><a href="{{ route('dashboard.resources.edit', ['id' => $resource->id]) }}">{{ $resource->de_title }}</a></td>
                            <td class="actions-row">
                                <div class="row">
                                    <a class="action-btn" href="{{ route('dashboard.resources.edit', ['id' => $resource->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="action-btn remove" data-method="delete" data-route="{{ route('dashboard.resources.destroy', ['id' => $resource->id]) }}" href="#">
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
        </div>
    </div>
</div>
@endsection