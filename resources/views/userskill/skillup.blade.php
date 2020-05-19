@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="../css/datepicker.css">
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-list">
          <h3>Skill Matrix</h3>
          <ul class="list-skill">
            @if(count($levels)>0)
            @foreach($levels as $value)
            <li class="skill-items">
              <div class="skill-value" style="background-color: {{$value->color}}">{{$value->level_number}}</div>
              <span class="skill-desc">{{$value->description}}</span> 
            </li>
            @endforeach
            @endif
          </ul>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>{{__('text.STT')}}</th>
                <th>{{__('text.name')}}</th>
                <th>{{__('text.skill')}}</th>
                <th>{{__('text.level')}}</th>
                <th>{{__('text.levelup')}}</th>
                <th>{{__('text.updateby')}}</th>
                <th >{{__('text.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value['name']}}</td>
                <td>{{$value['skill']}}</td>
                <td>{{$value['level']}}</td>
                <td>{{$value['level_up_at']}}</td>
                @if($value['update_by']=='')
                <td>{{__('text.waiting')}}</td>
                @else
                <td>{{$value['update_by']}}</td>
                @endif
                <td>
                  @if($value['update_by']=='')
                  <button  class="btn btn-sm btn-success btn-accept-skill" data-user="{{$value['id']}}" data-skill="{{$value['skill']}}" data-level="{{$value['level']}}">{{__('text.confirm')}}</button>
                 @else
                  <button class="btn btn-sm btn-danger">{{__('text.confirmed')}}</button> 
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@section('foot')
<script type="text/javascript" src="../js/message.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="../js/updateskill.js"></script>
@endsection
