@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', 'Извините за временные неудобства! Мы далаем сайт лучше!')
@section('message', __($exception->getMessage() ?: 'nominal.com.ua'))
