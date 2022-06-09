@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-6">
            <div class="p-5 card">
                <h3 class="text-center">Edit book details</h3>
                <form action="{{route('update-book-details', $book->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Book title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="title" value="{{$book->title}}" aria-describedby="">
                    </div>

                    <div class="mb-3">
                        <label for="cover_message" class="form-label">Book cover message</label>
                        <textarea class="form-control" name="cover_message" id="cover_message" rows="3">{{$book->cover_message}}</textarea>
                    </div>

                    <div class="form-check">
                        <input name="accepting_message" class="form-check-input" type="checkbox" value="1" id="accepting_message" @if($book->accepting_message) checked @endif
                        >
                        <label class="form-check-label" for="accepting_message">
                            Accepting messages
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="public" value="1" id="public" @if($book->public) checked @endif>
                        <label class="form-check-label" for="public">
                            Public book
                        </label>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn__primary">Update Book Content</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection