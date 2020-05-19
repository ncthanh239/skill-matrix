@extends('layouts.master')
@section('content')
<section class="content-header">
  <h1>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li><a href="{{route('level')}}">Levels</a></li>
    <li class="active">Add Skill Level</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-add-product">
            <form method="POST" action="{{ Route('addLevel') }}" enctype="multipart/form-data">
              @csrf
              {{ csrf_field() }}
              <h1 class="text-center">Add Skill Levels</h1>
              <hr>
              <div class="form-group">
                <div class="form-group">
                  <label for="inputLevelNumber">Level Number</label>
                  <input type="text" class="form-control" id="inputLevelNumber" name="inputLevelNumber" required>
                </div>                         
                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <input type="text" class="form-control" id="inputDescription" name="inputDescription" required>
                </div>
                <div class="form-group">
                  <label for="inputColor">Level Color</label>
                  <input type="color" class="form-control" id="inputLevelColor" name="inputLevelColor" required>
                </div>
                <button class="btn btn-success" id="btn-add-level">Add Level</button>
              </div>
            </form>
          </div>
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