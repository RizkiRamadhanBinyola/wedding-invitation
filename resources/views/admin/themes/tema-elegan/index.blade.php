@extends('layouts.blank')

@php($slug = 'tema-elegan') {{-- agar bisa dipakai includeIf --}}

@section('content')
@includeIf("admin.themes.$slug.sections.hero",   get_defined_vars())
@includeIf("admin.themes.$slug.sections.couple", get_defined_vars())
@includeIf("admin.themes.$slug.sections.event",  get_defined_vars())
@includeIf("admin.themes.$slug.sections.greetings", get_defined_vars()) {{-- Tambahan --}}
@endsection