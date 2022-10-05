@extends('cms.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
                <p>{!! $post->content !!}</p>
                <hr>
                @if($canAction)
                    <a href="/admin/blog/{{ $post->id }}/edit" class="btn btn-outline-primary">Edit Blog</a>
                    <br><br>
                    <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete Blog</button>
                    </form>
                    <br>
                    <form id="delete-frm" class="" action="" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-success">Publish Blog</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
