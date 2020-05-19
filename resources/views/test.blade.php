@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('text.table')}}</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
                <th>{{__('text.table')}}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
                <td>{{__('text.table')}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection