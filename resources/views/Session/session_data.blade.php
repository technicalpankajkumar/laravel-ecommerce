@if (session()->exists('success'))
<div class="alert alert-success alert-dismissible" role="alert">
      {{session('success')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>   
@endif

@if (session()->exists('danger'))
<div class="alert alert-danger alert-dismissible" role="alert">
      {{session('danger')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif

@if (session()->exists('warning'))
<div class="alert alert-warning alert-dismissible" role="alert">
      {{session('warning')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif

@if (session()->exists('primary'))
<div class="alert alert-primary alert-dismissible" role="alert">
      {{session('primary')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif