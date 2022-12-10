@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Article List') }}
                  <div class="float-right">
                    <form action="{{ route('articles.index') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                            aria-describedby="btnNavbarSearch" name="keyword"value="{{ request()->get('keyword') }}">
                                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create</a>
                </div>
                </div>

                <div class="card-body">
                   <table class="table">
                          <thead>
                            <tr>
                                 <th>Title</th>
                                 <th>Body</th>
                                 <th>Created By</th>
                                 <th>Created At</th>
                                 <th>Updated At</th>
                                 <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($articles as $article)
                                 <tr>
                                      <td>{{ $article->title }}</td>
                                      <td>{{ $article->body }}</td>
                                      <td>{{ $article->user_id ? $article->user->name : "" }}</td>
                                      <td>{{ $article->created_at }}</td>
                                      <td>{{ $article->updated_at }}</td>
                                      <td>
                                        <a href="{{ route('articles.show', $article) }}" class="btn btn-info">Show</a>
                                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('articles.delete', $article) }}" class="btn btn-danger"
                                         onclick="return confirm('Are you sure want to delete')">Delete</a>
                                      </td>
                                 </tr>
                            @endforeach
                          </tbody>
                   </table>
                   {{ $articles->appends(['keyword' => request()->get('keyword')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
