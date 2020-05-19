@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('../css/datepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('../css/bootstrap-datepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('../css/userskill-table.css')}}">
<link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
        <div  class="table-responsive table-scroll" id="table-scroll">
          <div>
            <select class="section-option">
             @if(count($sections)>0)
             @foreach($sections as $section)
             <option value="{{$section->id}}">{{$section->name}}</option>
             @endforeach
             @endif
             <option value="0">{{__('text.all')}}</option>
           </select>
         </div>
         <table class="table table-hover">
          <thead>
            <tr>
              <th class="blackhd "><span>{{__('text.STT')}}</span></th>
              <th class="blackhd col-code"><span>{{__('text.code')}}</span></th>
              <th class="blackhd col-name"><span>{{__('text.name')}}</span></th>
              @if(count($skills)>0)
              @foreach($skills as $key => $skill)
              <th class="blackhd "><span class="vert">{{$skill->name}}</span></th>
              @endforeach
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($userValues as $key => $value)
            <tr>
              <td>{{$key}}</td>
              <td>{{$value['code']}}</td>
              <td>{{$value['name']}}</td>
              @foreach($value['level'] as $key1 => $level)
              <td  class="td-skill">
                <select class="skill-option" data-skill="{{$key1}}" data-user="{{$value['id']}}" value="" style="background-color: {{$value['color'][$key1]}}">
                  <option enable> {{$level}}</option>
                  @if(count($levels)>0)
                  @foreach($levels as $lv)
                  <option value="{{$lv['id']}}" style="background-color: {{$lv->color}}">{{$lv->level_number}}</option>
                  @endforeach
                  @endif
                </select>
              </td>
              @endforeach
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
<input type="hidden" class="hidden-userId">
<input type="hidden" class="hidden-skillId">
<input type="hidden" class="hidden-levelSkill">
<div class="modal fade" id="modal-id">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">{{__('text.add_level')}}</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          <div class="form-group"> 
            <label for="">{{__('text.choose_date')}} (<span>*</span>)</label>
            <input class="form-control" type="text" id="datepicker1" readonly="true">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update-skill-up">{{__('text.save')}}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('foot')
<script type="text/javascript" src="{{asset('../js/message.js')}}"></script>
<script type="text/javascript" src="{{asset('../js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('../js/updateskill.js')}}"></script>
@endsection
