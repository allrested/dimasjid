<script>
    $(document).ready(function () {       
        $(".alert").fadeTo(2000, 500).slideUp(300, function () {
            $(".alert").slideUp(500);
        });
    });    
</script>
@if(@session('info'))
<div class="alert alert-primary alert-dismissible" role="alert">
    <div class="alert-message">
        <strong >Berhasil!</strong> 
        <br>{{ session('info') }}
        
    </div>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-message">
            <br>{{ session('error') }}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(@session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-message text-center">
        <strong>Gagal!</strong> 
        <br>{{ session('error') }}
    </div>
</div>
@endif

