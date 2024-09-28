@extends('layouts.admin')

@section('content')
<div class="level">
  <!-- Left side -->
  <div class="level-left">
    <h1>Sizes List</h1>
  </div>

  <div class="level-right">
    <a href="{{ route('admin.sizes.create') }}" class="button is-info">Create Size</a>
  </div>
</div>

@include('admin.sizes.table')
@include('admin.helpers.confirm-modal')
@endsection