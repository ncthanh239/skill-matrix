@extends('layouts.master')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('../css/bootstrap-datepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('../css/viewChart.css')}}">
@endsection
@section('content')
	<div class="container-fluid">
		<h1 class="text-uppercase font-weight-bold text-center">{{__('msg.titlePage')}}</h1>
		<div class="member row">
			<div class="title">
				<label for="" class="">{{__('msg.selectMember')}} <span class="text-danger font-italic">*</span></label>
				@if(isset($id))
				<input type="hidden" class="hidden-userId" value="{{$id}}">
				@endif
			</div>
			<div class="form-group col-md-4 col-sm-12">
				<select name="member-select" id="member-select" class="form-control form-control-sm member-select">
					<option value="0">{{__('msg.inSelectMember')}}</option>
					@foreach($dataUser as $user)
						@if((isset($id)) && ($user->id == $id))
						<option value="{{$user->id}}" selected>{{$user->last_name." ".$user->first_name}}</option>
						@else
						<option value="{{$user->id}}">{{$user->last_name." ".$user->first_name}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="row time-range">
			<div class="title">
				<label for="" class="" id="click">{{__('msg.selectTimerange')}}</label>
			</div>
			<div class="form-group col-md-2 col-xs-6">
          		<input class="form-control datepicker1" type="text" id="datepickerStart" readonly="true" placeholder="{{__('msg.dateStart')}}">
        	</div>
        	<div class="form-group col-md-2 col-xs-6">
          		<input class="form-control datepicker1" type="text" id="datepickerEnd" readonly="true" placeholder="{{__('msg.dateEnd')}}">
        	</div>
        	<div class="col-md-12 error-date">
        		<span id="error-date" class="text-danger text font-italic d-block"></span>
        	</div>
		</div>
		<div id="chart-option" class="row">
			<div class="option form-row col-md-12">
				<div class="select-skill col-md-4 col-sm-12">
					<label>{{__('msg.selectSkill')}}</label>
					<div class="row">
						<div class="form-group col-md-10 col-xs-10">
							<select name="my-select" id="my-select" class="form-control form-control-sm my-select">
								<option value="0">{{__('msg.inSelectSkill')}}</option>
								@foreach($dataSkill as $skill)
								<option value="{{$skill->id}}">{{$skill->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2 col-xs-2">
							<button class="btn btn-danger text-white btn-remove"><i class="fa fa-times" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
				<div class="select-priority col-md-2 col-sm-12">
					<label>{{__('msg.priority')}}</label>
					<div class="form-group">
						<input type="number" name="" id="input-number" value="0" min="0" class="form-control form-control-sm input-number">
					</div>
				</div>
			</div>
		</div>
		<div class="direct my-3 row"></label>
			<label for="" class="d-inline-block ml-3">{{__('msg.clickAdd')}}</label>
			<button class="btn btn-info text-white btn-add" id="btn-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
			<label for="" class="d-inline-block ml-3">{{__('msg.refresh')}}</label>
			<button class="btn btn-warning text-white btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
		</div>
		<div class="show-chart row">
			<button class="btn btn-success text-white" id="btn-show-chart">{{__('msg.clickShow')}}</button>
			<span class="text-danger text font-italic" id="error"></span>
			<div id="chartdiv"></div>
		</div>
	</div>

@endsection
@section('foot')
	<script type="text/javascript" src="{{asset('../js/chartText.js')}}"></script>
	<script type="text/javascript" src="{{asset('../js/amcharts.js')}}"></script>
	<script type="text/javascript" src="{{asset('../js/serial.js')}}"></script>
	<script type="text/javascript" src="{{asset('../js/bootstrap-datepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset('../js/viewChart.js')}}"></script>
@endsection