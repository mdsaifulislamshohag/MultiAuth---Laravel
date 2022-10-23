<div class="col-md-3 hide-md">
    <a href="/admin/compose" class="btn btn-primary btn-block margin-bottom">Compose</a>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Folders</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li class="{{ request()->is('admin*/mailbox') ? 'active' : '' }}">
                    <a href="{{ route('admin.inbox') }}"><i class="fa fa-inbox"></i> Inbox
                    <span class="label label-primary pull-right">{{ count($msgtop) }}</span></a>
                </li>
                <li class="{{ request()->is('admin*/sent') ? 'active' : '' }}">
                    <a href="{{ route('admin.sent') }}"><i class="fa fa-envelope-o"></i> Sent</a>
                </li>
                <li class="{{ request()->is('admin*/draft') ? 'active' : '' }}">
                    <a href="{{ route('admin.draft') }}"><i class="fa fa-file-text-o"></i> Drafts</a>
                </li>
                @admin('super')
                <li class="{{ request()->is('admin*/trash') ? 'active' : '' }}"><a href="{{ route('admin.trash') }}"><i class="fa fa-trash-o"></i> Trash</a></li>
                @endadmin
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>