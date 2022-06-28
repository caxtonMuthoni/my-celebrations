@extends('layouts.app')
@section('content')

<div class="mybooks container">
    <h3>My books</h3>
    <div class="table-responsive bg-white p-3">
        <table class="table">
            <thead>
                <th></th>
                <th>Cover Image</th>
                <th>Book title</th>
                <th>Cover Message</th>
                <th>Access</th>
                <th>Status</th>
                <th>Accepting Messages</th>
                <th>Friends Messages and Pictures</th>
                <th>Edit Cover Details</th>
                <th>Edit Book Content</th>
            </thead>
            <tbody>
                @foreach($books as $key => $book)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <img class="mybooks__img" src="{{ $book->image }}" alt="">
                    </td>
                    <td class=""><span class="table__item">{{ $book->title }}</span></td>
                    <td><span class="table__item">{{ $book->cover_message }}</span></td>
                    <td><span class="table__item">
                            @if($book->public)
                            <span class="badge bg-warning">public</span>
                            @else
                            <span class="badge bg-primary">private</span>
                            @endif
                        </span>
                    </td>
                    <td><span class="table__item">
                            @if($book->published)
                            <span class="badge bg-success">published</span>
                            @else
                            <span class="badge bg-info">draft</span>
                            @endif
                        </span>
                    </td>
                    <td><span class="table__item">
                            @if($book->accepting_message)
                            <span class="badge bg-warning">YES</span>
                            @else
                            <span class="badge bg-primary">NO</span>
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="table__item">
                            <a href="{{route('book-view-messages-pictures', $book->id)}}" class="btn btn-sm btn-primary"> <i class="fa fa-envelope me-2" aria-hidden="true"></i> View</a>
                        </span>
                    </td>
                    <td>
                        <span class="table__item">
                            <a href="{{route('edit-book-details', $book->id)}}" class="btn btn-sm btn__primary">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                        </span>
                    </td>
                    <td>
                        <span class="table__item">
                            <a href="{{route('book-show', $book->id)}}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection