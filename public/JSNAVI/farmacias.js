
document.addEventListener('livewire:load', function () {


   Livewire.on('abrirmodalfarmaciaf', function () {
        $('#modalfarmaciam').modal('show');
    });
    Livewire.on('cerrarmodalfarmaciaf', function () {
        $('#modalfarmaciam').modal('hide');
    });

});


