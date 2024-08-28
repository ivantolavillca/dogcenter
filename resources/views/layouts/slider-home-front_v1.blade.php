<ul id="menu-primary-menu" class="menu" role="tablist">
    {{-- <li class="menu-item menu-item-has-children @if(request()->route()->getName()=='inicio.index') current-menu-item @endif">
        <a href="{{ route('inicio.index') }}" id="tab1-tab" data-bs-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">INICIO</a>
        <ul class="sub-menu">
            <li class="menu-item "><a href="#">SOBRE NOSOTROS</a></li>
            <li class="menu-item"><a href="#">CONTACTO</a></li>
        </ul>
    </li>
    <li class="menu-item ">
        <a href="#convocatorias" id="convocatorias-tab" data-bs-toggle="tab" role="tab" aria-controls="convocatorias" aria-selected="false">CONVOCATORIAS</a>
    </li>
    <li class="menu-item ">
        <a href="#comunicados">COMUNICADOS</a>
    </li> --}} 
     <li class="menu-item ">
        <a href="/">INICIO</a>
    </li>
    <li class="menu-item @if(request()->route()->getName()=='verificar.index') current-menu-item @endif">
        <a href="{{ route('verificar.index') }}">VERIFICAR CERTIFICADO</a>
    </li>
    <li class="menu-item ">
        <a href="https://www.upea.bo/" target="_blank">UPEA</a>
    </li>

    <li>
        
    </li>
</ul>