@extends('site.app')

@section('title','Chat Dashboard')
@include('site.layouts.header')

@include('chat')
@push('styles')
      <link rel="stylesheet" href="{{asset('admin')}}/dist/css/adminlte.min.css">
@endpush