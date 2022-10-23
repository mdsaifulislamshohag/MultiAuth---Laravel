<!-- TO DO List -->
<div class="box box-primary">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">To Do List</h3>
        <div class="box-tools pull-right">
            {{ $todos->links() }}
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="todo-list">
            <form action="{{ route('todo.add') }}" method="POST" accept-charset="utf-8">
                @csrf
                <input type="text" name="task" class="form-control" placeholder="Add New Task">
            </form>
            @foreach($todos as $todo)
            <li>
                <!-- drag handle -->
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                {{-- <input type="checkbox" value=""> --}}
                <!-- todo text -->
                <span class="text">
                    @if($todo->task != 0)
                    {{ str_limit($todo->task, $limit = 30, $end = '...') }}
                    @else
                    <del style="opacity: 0.7;">{{ str_limit($todo->task, $limit = 30, $end = '...') }}</del>
                    @endif
                </span>
                <!-- Emphasis label -->
                <small class="label label-danger"><i class="fa fa-clock-o"></i> {{ $todo->created_at->diffForHumans(null, true) }}</small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <form action="{{ route('todo.delete',[Crypt::encrypt($todo->id)]) }}" method="POST">
                        @csrf @method('delete')
                        <a href="#" data-target="#edit_todo"
                            data-toggle="modal"
                            class="edit_task btn btn-xs btn-default"
                            data-id="{{ $todo->id }}"
                            data-task="{{ $todo->task }}"
                            >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteconfig()"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
{{-- Modal for Edit --}}
<div class="modal fade" id="edit_todo" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <form action="{{ route('todo.update') }}" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="id" id="id" value="" />
                    <fieldset class="form-group">
                        <input type="text" name="task" class="form-control" id="task">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(".edit_task").click(function () {
            var id = $(this).data('id');
            var task = $(this).data('task');
            $(".modal-body #id").val(id);
            $(".modal-body #task").val(task);
        })
    });


//checkbox


</script>

</div>