@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Элементы</h1>
    <div class="card">
        <div class="card-body">
        <a class="btn btn-primary" href="{{ route('dashboard.chunks.create') }}">Создать чанк</a>
            <br>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Элементы</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($chunks as $chunk)
                        <tr>
                            <td><a href="{{ route('dashboard.chunks.edit', ['id' => $chunk->id]) }}">{{ $chunk->title }}</a></td>
                            <td class="actions-row">
                                <div class="row">
                                    <a class="action-btn" href="{{ route('dashboard.chunks.edit', ['id' => $chunk->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="action-btn remove" data-method="delete" data-route="{{ route('dashboard.chunks.destroy', ['id' => $chunk->id]) }}" href="#">
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