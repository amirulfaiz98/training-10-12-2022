@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Article Show') }}</div>

                <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" readonly>{{ $article->body }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="attachment">Attachment</label>
                            <a href="{{ config('app.url') }}/storage/{{ $article->attachment }}" class="btn btn-primary" target="_blank">Open Attachment</a>

                        <div class="form-group">
                            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
