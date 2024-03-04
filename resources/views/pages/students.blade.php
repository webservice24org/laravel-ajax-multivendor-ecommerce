@extends('layouts.admin-master')
@section('admin')
    @include('admin-components.students.index')
    @include('admin-components.students.create-student')
    @include('admin-components.students.edit')
@endsection