@extends('layouts.master')
@section('content')
<section class="content-header">
  <h1></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('level')}}">Skill Level</a></li>
    <li class="active">Edit Skill Level</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
         <div class="form-edit-level">
           <form style="width: 50%; margin: auto;" method="POST" action="{{asset('')}}level/editLevel/{{$skillLevels->id}}" enctype="multipart/form-data">
            @csrf
            {{ csrf_field() }}
            <h1>Edit Skill Level</h1>
            <hr>
            <div class="form-group">
              <div class="form-group">
                <label for="inputLevelNumber">Level Number</label>
                <input type="text" class="form-control" id="inputLevelNumber" name="inputLevelNumber" value="{{$skillLevels->level_number}}" required>
              </div>

              <div class="form-group">
                <label for="inputDescription">Description</label>
                <input type="text" class="form-control" id="inputDescription" name="inputDescription" value="{{$skillLevels->description}}" required>
              </div>
              <div class="form-group">
                <label for="inputLevelColor">Color</label>
                <input type="color" class="form-control" id="inputLevelColor" name="inputLevelColor" value="{{$skillLevels->color}}" required>
              </div>
              <button type="" class="btn btn-success" id="btn-edit-level">Edit Level</button>
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