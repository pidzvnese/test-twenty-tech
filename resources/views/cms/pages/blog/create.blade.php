@extends('cms.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Create a New Blog</h1>
                    <p>Fill and submit this form to create a blog</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Blog Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Blog Title" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="blog_content">Blog Content</label>
                                <textarea id="blog_content" class="form-control" name="blog_content" placeholder="Enter Blog Content"
                                          rows="" required></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Blog
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
