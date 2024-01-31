@if(session('message'))
<div class="alert alert-info" role="alert">
    <i class="ti ti-alert-triangle"></i>
    {{session('message')}}
    </div>
 @endif

 @if(session('message-failed'))
<div class="alert alert-danger" role="alert">
    <i class="ti ti-alert-triangle"></i>
    {{session('message-failed')}}
    </div>
 @endif