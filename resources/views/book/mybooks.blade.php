@extends('layouts.app')
@section('content')

<div class="mybooks container">
    <h3>My books</h3>
    <div class="row">
        @foreach($books as $key => $book)
        <div class="col-md-3">
            <div class="book-card shadow-sm">
                <div class="book-card__type">{{$book->category->name}}</div>
                <div class="book-card__image">
                    <img class="book-card__image--picture" src="{{$book->image}}" alt="book tittle">
                </div>
                <div class="book-card__content">
                    <div class="book-card__content--header text-secondary">{{ $book->title }}</div>
                    <div class="book-card__content--description">
                        {{ $book->cover_message }}
                    </div>
                </div>
                <div class="book-card__cta p-2">
                    <a href="{{route('book-show', $book->id)}}" title="Edit book content" class="book-card__cta-btn btn btn-sm btn-info">
                        <i class="fa fa-edit"></i> Content
                    </a>

                    <a href="{{route('edit-book-details', $book->id)}}" title="Edit cover content" class="book-card__cta-btn btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i> Cover
                    </a>

                    <span class="">
                        @if($book->public)
                        <span class="btn btn-sm btn-warning">public</span>
                        @else
                        <span class="btn btn-sm btn-primary">private</span>
                        @endif
                    </span>

                    <span class="">
                        @if($book->published)
                        <span class="btn btn-sm btn-success">published</span>
                        @else
                        <span class="btn btn-sm btn-info">draft</span>
                        @endif
                    </span>
                </div>
                <div class="book-card__cta p-2">
                    <span>
                        @if($book->accepting_message)
                        <a href="{{ route('book-view-messages-pictures', $book->id) }}" title="view book messages" class="book-card__cta-btn btn btn-sm btn-primary">
                            <i class="fa fa-envelope"></i> Messages
                        </a>
                        @else
                        <span class="btn btn-sm btn-primary">No message</span>
                        @endif
                    </span>

                    <span>
                        @if($book->accepting_message)
                        <a href="{{ route('book-view-messages-pictures', $book->id) }}" title="view book pictures" class="book-card__cta-btn btn btn-sm btn-info">
                            <i class="fa fa-image"></i> Pictures
                        </a>
                        @else
                        <span class="btn btn-sm btn-primary">No pictures</span>
                        @endif
                    </span>

                    <a href="{{route('readBookPDf', $book->id)}}" title="Read book" class="book-card__cta-btn btn btn-sm btn-success">
                            <i class="fa fa-book"></i> Read
                        </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- <div class="table-responsive bg-white p-3 hidden" style="display: none;">
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

                    <td>
                        <span class="table__item">
                            <a href="{{route('readBookPDf', $book->id)}}" class="btn btn-sm btn-success">
                                <i class="fa fa-book me-2" aria-hidden="true"></i>
                                Read
                            </a>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->
</div>

@endsection