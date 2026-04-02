@php

$layout = Auth::user()->role == 'laboran'
        ? 'layouts.laboran'
        : 'layouts.mahasiswa';

@endphp


@extends($layout)


@section('content')

<div class="p-4 md:p-6">

{{-- HEADER --}}
<h1 class="text-2xl font-bold text-gray-800 mb-6">
Profile
</h1>


<div class="space-y-6 max-w-4xl">

{{-- UPDATE PROFILE --}}
<div class="p-4 md:p-6 bg-white shadow rounded-lg">

<div class="max-w-xl">
@include('profile.partials.update-profile-information-form')
</div>

</div>



{{-- UPDATE PASSWORD --}}
<div class="p-4 md:p-6 bg-white shadow rounded-lg">

<div class="max-w-xl">
@include('profile.partials.update-password-form')
</div>

</div>



{{-- DELETE USER --}}
<div class="p-4 md:p-6 bg-white shadow rounded-lg">

<div class="max-w-xl">
@include('profile.partials.delete-user-form')
</div>

</div>


</div>

</div>

@endsection