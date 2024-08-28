
document.addEventListener('livewire:load', function () {

    Livewire.on('cerrarmodalcirugiapre', function () {
        $('#modalcirugiapre').modal('hide');
    });
    Livewire.on('abrirmodalcirugiapre', function () {
        $('#modalcirugiapre').modal('show');
    });

    Livewire.on('cerrarmodalcirugia', function () {
        $('#modalcirugia').modal('hide');
    });

    Livewire.on('abrirmodalcirugia', function () {
        $('#modalcirugia').modal('show');
    });
   Livewire.on('abrirmodalfarmaciaf', function () {
        $('#modalfarmaciam').modal('show');
    });
    Livewire.on('cerrarmodalfarmaciaf', function () {
        $('#modalfarmaciam').modal('hide');
    });
    Livewire.on('abrirmodalcirugiaimagen', function () {
        $('#modalcirugiaimagen').modal('show');
    });
    Livewire.on('cerrarmodalcirugiaimagen', function () {
        $('#modalcirugiaimagen').modal('hide');
    });




});


