@extends('layout.app')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h1>Task List</h1>
        </div>
        <div class="card-body">
            <div class="row p-2">
                <div class="col text-end">
                    <a href="{{route('task.create')}}" class="btn btn-success btn-sm btn-block">Add New</a>
                </div>
            </div>
            <!-- Header row with responsive breakpoints -->
            <div class="row m-1 bg-light p-2 d-none d-md-flex">
                <div class="col-md-1">
                    Priority
                </div>
                <div class="col-md-5 text-start">
                    Task Name
                </div>
                <div class="col-md-3 text-start">
                    Created at
                </div>
                <div class="col-md-3 text-center">
                    Action
                </div>
            </div>
            
            <div id="task-list">
                @foreach($tasks as $task)
                    <!-- Desktop layout -->
                    <div class="row border m-1 p-2 d-none d-md-flex align-items-center">
                        <div class="col-md-1">
                            <span class="badge bg-primary">#{{$task->priority}}</span>
                        </div>
                        <div class="col-md-5 text-start">
                            <div class="text-truncate" title="{{$task->title}}">
                                {{$task->title}}
                            </div>
                        </div>
                        <div class="col-md-3 text-start">
                            <small>{{$task->created_at->format('M d, Y h:i A')}}</small>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm" style="padding:.35rem .5rem;font-size:.9rem;line-height:1;" title="Edit">Edit</a>

                                <form action="{{ route('task.destroy', $task->id) }}" method="post" class="m-0" role="none" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile layout -->
                    @if($loop->first)
                        <div class="row m-1 bg-light p-2 d-flex d-md-none">
                            <div class="col-3">Priority</div><div class="col-3 text-start">Task Name</div><div class="col-3 text-start">Created at</div><div class="col-3 text-end">Action</div>
                            
                        </div>
                    @endif
                    <div class="row border m-1 p-2 d-flex d-md-none align-items-center">
                        <div class="col-2">
                            <span class="badge bg-primary">#{{$task->priority}}</span>
                        </div>
                        <div class="col-6 text-start">
                            <div class="text-truncate" title="{{$task->title}}">
                                {{$task->title}}
                            </div>
                            <small class="text-muted d-block d-sm-none">{{$task->created_at->format('M d, Y h:i A')}}</small>
                        </div>
                        <div class="col-4 text-end">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm" style="padding:.35rem .5rem;font-size:.9rem;line-height:1;" title="Edit">Edit</a>

                                <form action="{{ route('task.destroy', $task->id) }}" method="post" class="m-0" role="none" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <small class="text-muted d-none d-sm-block mt-1">{{$task->created_at->format('M d, Y h:i A')}}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@extends('layout.footer')
@section('script')
    <script>
        $(document).ready(function () {
            $('#task-list').sortable();
        });
    </script>
@endsection








