@extends('layouts.app')
@section('content')
<div class="book-message container">
    <form action="{{route('friend-upload-image')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center book-create__row">
            <div class="col-md-11 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-image" aria-hidden="true"></i>
                        </div>
                        <span>Upload image to the book.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-5 text-start">
                    <div class="mb-3">
                        <label for="image" class="form-label">Add an image to the book gallery.</label>
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="relationship" placeholder="eg. Brother">
                    </div>
                    <div class="mb-3">
                      <label for="caption" class="form-label">Add image caption (Optional)</label>
                      <input type="text"
                        class="form-control" name="caption" id="caption" aria-describedby="caption" placeholder="">
                      <small id="caption" class="form-text text-muted">This is an optional field</small>
                    </div>
                    <input hidden type="text" name="book_id" value="{{$id}}">
                </div>

            </div>

            <div class="col-md-8">
                <div class="book-create__btns">
                    <button class="btn btn-block btn-lg btn__primary mt-3">
                        Upload Image
                        <i class="fa fa-upload ms-2" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
</form>
</div>
@endsection