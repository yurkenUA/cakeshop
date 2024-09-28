@extends('layouts.admin')

@section('content')
<div class="level">
  <!-- Left side -->
  <div class="level-left">
    <h1>{{ isset($size) ? "Change Size $size->size inches" : 'Create Size' }}</h1>
  </div>

  <div class="level-right">
    <a href="{{ route('admin.sizes.index') }}" class="button is-info">Size List</a>
  </div>
</div>
<form action="{{ route('admin.sizes.save') }}" method="POST">
    @csrf
    @if (isset($size))
    <input type="hidden" name="size_id" value="{{ $size->id }}" />
    @endif

    <div class="columns">
      <div class="column is-one-quarter">
        <input class="input is-info" type="number" placeholder="Select Size" name="size" value="{{ old('size', isset($size) ? $size->size : '') }}"/>
        @error('size')
          <div class="has-text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    </div>
    
    <button type="submit" class="button is-link is-rounded mr-6">Save</button>
    <a href="{{ route('admin.sizes.index') }}" class="button has-background-warning is-rounded">Go Back</a>


</form>
@endsection