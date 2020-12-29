<li class="{{ Request::is('category*') ? 'active' : '' }}">
    <a href="{{ url('admin/category') }}"><i class="fa fa-edit"></i><span>Category</span></a>
</li>

<li class="{{ Request::is('video*') ? 'active' : '' }}">
    <a href="{{ url('admin/video') }}"><i class="fa fa-edit"></i><span>Videos</span></a>
</li>
<li class="{{ Request::is('import*') ? 'active' : '' }}">
    <a href="{{ url('admin/import') }}"><i class="fa fa-edit"></i><span>Import Videos</span></a>
</li>
