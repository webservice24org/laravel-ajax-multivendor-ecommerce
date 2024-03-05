@extends('layouts.admin-master')
@section('admin')
    @include('admin-components.teachers.index')
    @include('admin-components.teachers.create')
    @include('admin-components.teachers.edit')
@endsection