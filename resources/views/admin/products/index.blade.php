@extends('layouts.admin')

@section('content')
<div class="level">
  <!-- Left side -->
  <div class="level-left">
    <h1>Products List</h1>
  </div>

  <div class="level-right">
    <a href="{{ route('admin.products.create') }}" class="button is-info">Create Product</a>
  </div>
</div>

@include('admin.products.table')
@include('admin.helpers.confirm-modal')
@endsection