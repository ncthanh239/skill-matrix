@extends('layouts.master')
@section('content')
<section class="content-header">
  <h1>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Data tables</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->    
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <a href="{{ Route('viewadd') }}" class="btn btn-primary">Add Skill Level</a>
            <thead>
              <tr>
                <th>STT</th>
                <th>Level</th>
                <th>Description</th>
                <th>Color</th>
                <th>Modify</th>              
              </tr>
            </thead>          
            <tbody>
              @if(empty($skill_levels))
              <h3 class=text-danger>No Data</h3>
              @else
              <?php $idx = 0; ?>
              @foreach($skill_levels as $skill)
              <tr data-id="{{$skill_levels}}">
               <td>{{++ $idx}}
                <td>{{$skill->level_number}}
                  <td>{{$skill->description}}</td>
                  <td>
                    <div style="background-color: {{$skill->color}}; color: {{$skill->color}}">a</div>
                  </td>            
                  <td>
                    <a data-id="{{$skill->id}}" class="btn btn-warning text-white btn-edit" href="{{asset('')}}level/viewedit/{{$skill->id}}">Edit</a>
                    <form action="{{asset('')}}level/delete/{{$skill->id}}" method="post">
                      <button type="submit" class="btn btn-danger text-white btn-del">Delete
                        @csrf
                        {{ csrf_field() }}
                      </button>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    @endsection