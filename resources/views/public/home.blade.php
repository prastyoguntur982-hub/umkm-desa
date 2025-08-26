 @extends('layouts.public')

 @section('content')
     <div class="class relative">
         @include('components.public.pengumuman-section')
         <x-public.slider />

{{-- 
         @include('components.public.profilDesa-section') --}}
     </div>


     @include('components.public.umkm-section')
     
     <div class="h-px bg-gray-300 dark:bg-gray-600"></div>

     @include('components.public.support-section')
 @endsection
