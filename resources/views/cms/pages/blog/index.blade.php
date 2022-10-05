@extends('cms.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Our Blog!</h1>
                        <p>Enjoy reading our blogs. Click on a blog to read!</p>
                    </div>
                    <div class="col-4">
                        <p>Create new Blog</p>
                        <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm">Add Blog</a>
                    </div>
                </div>
                <table id="blog-datatable" class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script_inline')
    <script type="text/javascript">
        var table = $('#blog-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('blog.datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {
                    data: 'status',
                    name: 'status',
                    render: function (data) {
                        if (data === 0) {
                            return 'Unpublish'
                        }
                        return 'Published';
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function (data) {
                        return moment.utc(data).local().format('DD/MM/YYYY HH:mm:ss');
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/blog/" + id,
                dataType: 'json',
                success: function (res) {
                    if (res.status === "ok")
                        table.ajax.reload();
                }
            });
        });

        $(document).on('click', '.publish', function () {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "PUT",
                url: "/admin/blog/" + id,
                dataType: 'json',
                success: function (res) {
                    if (res.status === "ok")
                        table.ajax.reload();
                }
            });
        });
    </script>
@endsection
