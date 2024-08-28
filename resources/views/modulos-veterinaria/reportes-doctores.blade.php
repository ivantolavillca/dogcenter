@extends('layouts.admin_principal')
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">CONTROL DE COBROS <span class="text-danger">
                </span></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>

                    <li class="breadcrumb-item active">Cobros</li>
                </ol>
            </div>

        </div>
    </div>
</div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
    
                    {{-- <h4 class="card-title">Justify Tabs</h4>
                    <p class="card-title-desc">Use the tab JavaScript plugin—include it individually or
                        through the compiled <code class="highlighter-rouge">bootstrap.js</code> file—to
                        extend our navigational tabs and pills to create tabbable panes of local
                        content, even via dropdown menus.</p> --}}
    
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-money-check-alt"></i></span>
                                <span class="d-none d-sm-block">COBROS EN CAJAS</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-money-bill-wave-alt"></i></span>
                                <span class="d-none d-sm-block">TRABAJO Y COBROS REALIZADOS POR PERSONA</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-chart-line"></i></span>
                                <span class="d-none d-sm-block">RESPORTES ESTADISTICOS</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#settings-1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Settings</span>
                            </a>
                        </li> --}}
                    </ul>
    
                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="home-1" role="tabpanel">
                            @livewire('modulos-v.cobros-cajas-index')
                        </div>
                        <div class="tab-pane" id="profile-1" role="tabpanel">
                            @livewire('modulos-v.cobros-trabajos-index')
                        </div>
                        <div class="tab-pane" id="messages-1" role="tabpanel">
                            @livewire('modulos-v.cobros-trabajos-personal-index')
                        </div>
                        {{-- <div class="tab-pane" id="messages-1" role="tabpanel">
                            <p class="mb-0">
                                Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out
                                mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.
                                Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                                locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR
                                banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg
                                banh mi whatever gluten-free.
                            </p>
                        </div>
                        <div class="tab-pane" id="settings-1" role="tabpanel">
                            <p class="mb-0">
                                Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party
                                before they sold out master cleanse gluten-free squid scenester freegan
                                cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf
                                cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR,
                                banh mi before they sold out farm-to-table.
                            </p>
                        </div> --}}
                    </div>
    
                </div>
            </div>
        </div>
    </div>
   
@endsection
