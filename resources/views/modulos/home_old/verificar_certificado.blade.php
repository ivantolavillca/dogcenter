@extends('modulos.home_old.home-front') {{-- layouts.home-front --}}
       
@section('body-page-old') {{-- body-page --}}

    <br><br><br><br><br><br>
    <section class="tf-section tf_team mt-5">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-10">
                    @livewire('verificar')
                </div>
            </div>
        </div>
    </section>
      
@endsection