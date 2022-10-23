<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
            @if($mailbox == 0)
            Inbox
            @elseif($mailbox == 1 )
            Sent Messages
            @elseif($mailbox == 2)
            Draft Messages
            @elseif($mailbox == 3)
            Trash Messages
            @else
            Search Result
            @endif
            </h3>
            <div class="box-tools pull-right">
                {{-- Search Form --}}
                <form action="{{ route('admin.search_message') }}" method="POST">
                    @csrf
                    <div class="has-feedback">
                        <input type="text" name="search" class="form-control input-sm" placeholder="Search Mail" required>
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            {{-- Form for delete/mark read/unread action --}}
            <form id="selectform" onsubmit='return checkselected()' action="{{ route('admin.deletemessage') }}" method="POST">
                @csrf
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                        <i class="fa fa-square-o"></i>
                    </button>

                    <div class="btn-group">
                        @if($mailbox == 3)
                        <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete" onclick="return deleteconfig()">
                        @else
                        <input type="submit" name="trash" class="btn btn-danger btn-sm" value="Delete" onclick="return deleteconfig()">
                        @endif
                    </div>
                    <!-- /.btn-group -->
                    @if($mailbox == 0)
                    <input type="submit" name="markread" class="btn btn-success btn-sm" value="Mark As Read">
                    <input type="submit" name="markunread" class="btn btn-default btn-sm" value="Mark As Unread">
                    @endif
                    @if($mailbox == 3)
                    <input type="submit" name="moveback" class="btn btn-default btn-sm" value="Move Back">
                    @endif
                    <div class="pull-right hide-sm" style="margin-top: -20px;">
                        @if($messages->total() > $messages->perPage())
                        Showing {{ $messages->firstItem() }} - {{ $messages->lastItem() }}/{{ $messages->total() }}  &nbsp;
                        @endif
                        <div class="btn-group" >
                            <span>{{ $messages->links() }}</span>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                            
                            @foreach($messages as $message)
                            <tr @if($message->read != 0) style="opacity: 0.6;color:#42433E;" @endif>
                                <td>
                                    <input type="checkbox" name="checked[]" value="{{ $message->id }}">
                                </td>
                                <td class="mailbox-star">
                                        @php
                                            if($message->sender == 0){
                                                $icon = 'envelope-o';
                                            }
                                            if($message->sender == 1){
                                                $icon = 'inbox';
                                            }
                                            if($message->sender == null){
                                                $icon = 'file-text-o';
                                            }
                                        @endphp
                                        <i class="fa fa-{{ $icon }}" @if($message->read != 0) style="color:#8F8E8C;" @endif></i>
                                </td>
                                <td class="mailbox-name">
                                    <a href="{{route('admin.message',[Crypt::encrypt($message->id)])}}">
                                        <p>{{ str_limit($message->name, $limit = 20, $end = '...') }}
                                        <small>{{ str_limit($message->from, $limit = 30, $end = '...') }}</small></p>
                                    </a>
                                </td>
                                <td class="mailbox-subject hide-sm">
                                    <b>{{ str_limit($message->subject, $limit = 160, $end = '...') }}</b><br>
                                    <small>{{ str_limit($message->message, $limit = 190, $end = '...') }}</small>
                                </td>
                                <td class="mailbox-date hide-md" style="color: #367FA9;">
                                    <i><i class="fa fa-clock-o"></i>&nbsp;{{ $message->created_at->diffForHumans(null, true) }}</i>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <div class="clearfix"></div>
                <div class="pull-left" style="margin-top: -20px;">
                    
                    <div class="btn-group" >
                        <span>{{ $messages->links() }}</span>
                    </div>
                    @if($messages->total() > $messages->perPage())
                    <span class="hide-sm">
                    &nbsp; Showing {{ $messages->firstItem() }} - {{ $messages->lastItem() }}/{{ $messages->total() }}
                    </span>
                    @endif
                    <!-- /.btn-group -->
                </div>
                <!-- /.mail-box-messages -->
            </form>
        </div>
    </div>
    <!-- /. box -->
</div>
