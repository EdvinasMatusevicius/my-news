@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $article->title }}</div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div>
                        @isset($article->author)
                            <p class="float-left">{{ $article->author->name }}</p>
                        @endisset
                        <em class="float-right">{{ $article->created_at->format('Y-m-d H:i') }}</em>
                    </div>

                    @isset($article->poster)
                        <div>
                            <img class="img-fluid"
                                 src="{{ \Illuminate\Support\Facades\Storage::url($article->poster) }}">
                        </div>
                    @endisset

                    <div>
                        <p>{{ $article->content }}</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-md-8" id="comments">
                    @foreach($article->comments as $comment)
                        <div class="border-bottom mb-2">
                            <p>
                                <em>{{ $comment->email }}</em>
                                <em class="float-right">{{ $comment->created_at->format('Y-m-d H:i') }}</em>
                            </p>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="commentStatus"></div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" value="">
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" name="comment" id="comment"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="submitComment();">
                            Comment
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function submitComment() {
            let token = $('meta[name="csrf-token"]').attr('content');
            let email = $("#email").val();
            let comment = $('#comment').val();
            let articleId = {{ $article->id }};
            $.ajax({
                method: "POST",
                url: "{{ route('comment.store') }}",
                data: {
                    _token: token,
                    article_id: articleId,
                    email: email,
                    comment: comment
                },
                statusCode: {
                    422: function (data) {
                        let errors = data.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (index, value) {
                            errorMessages = errorMessages + '<p>'+ value[0]+'</p>';
                        })
                        let message = '<div class="alert alert-danger">' + errorMessages + '</div>';
                        $("#commentStatus").html(message);
                    },
                    200: function (data) {
                        let message = '<div class="alert alert-success">' + data['message'] + '</div>';
                        $("#commentStatus").html(message);
                        $("#email").val("");
                        $('#comment').val("");
                        let comment = data['comment'];
                        let component = '<div class="border-bottom mb-2">\n' +
                            '<p>\n' +
                            '    <em>' + comment['email'] + '</em>\n' +
                            '    <em class="float-right">' + comment['created_at'] + '</em>\n' +
                            '</p>\n' +
                            '<p>' + comment['comment'] + '</p>\n' +
                            '</div>';
                        $('#comments').prepend(component)
                    }
                },
            });
        }
    </script>
@endsection