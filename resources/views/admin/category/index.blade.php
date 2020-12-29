@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Categories
        </h1>
        
        <span class="breadcrumb"><a href='{{ route("category.create") }}' class="btn btn-sm btn-primary"><i
                class="fa fa-plus-square"></i>&nbsp;&nbsp;Create New Category</a></span>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-striped table-hover tbl_repeat" id="sortable">
                    <thead>
                        <th>No.</th>
                        <th>Name</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                    <?php $index = 1; ?>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{!! $category->name !!}</td>
                            <td>
                            <a href="{!! route('category.edit', [$category->id]) !!}"
                               class='btn btn-xs btn-primary'><i class="fa fa-check-square-o"></i>&nbsp;Edit</a>
                            <a href="#" type="button" data-id="{{ $category->id }}"
                               class="btn btn-xs btn-danger" data-toggle="modal"
                               data-url="{{ url('admin/category/'.$category->id) }}"
                               data-target="#deleteFormModal"><i
                                    class="fa fa-trash-o"></i>&nbsp;Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $categories->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection