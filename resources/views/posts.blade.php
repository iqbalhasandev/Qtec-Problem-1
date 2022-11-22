@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
              <div class="card-body table-responsive">
                <div class="d-flex justify-context-between pb-2" style="justify-content: space-between;">
                    <a href="#" class="btn btn-secondary rounded-0">Search Activities</a>
                    <form action="{{ route('post') }}" class="search_form" style="max-width: 320px;">
                        <div class="input-group">
                            <input type="text" id="search" name="search" class="form-control rounded-0" placeholder="Search Here..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="input-group-text bg-secondary text-white border-secondary rounded-0" style="border: 1px solid;">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-secondary">
                      <th class="text-white" scope="col">#</th>
                      <th class="text-white" scope="col">Title</th>
                      <th class="text-white" scope="col">Content</th>
                      <th class="text-white" scope="col">Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($posts as $key => $post)
                    <tr>
                        <td>{{ ++$key; }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="5">No Data Found!</td>
                    </tr>
                    @endforelse

                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
