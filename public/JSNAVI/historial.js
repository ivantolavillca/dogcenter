
document.addEventListener('livewire:load', function() {
    Livewire.on('crearhistorial', function() {
        $('#modalcrearhistorial').modal('show');
    });
    Livewire.on('cerrarmodalcamara', function() {
        $('#capturarImagenModal').modal('hide');
    });
    Livewire.on('crearmodalcrearhistorial', function() {
        $('#modalcrearhistorial').modal('hide');
    });
    Livewire.on('abrirmodaleditarcliente', function() {
        $('#modaleditarcliente').modal('show');
    });
    Livewire.on('AbrirModalEditarHistorial', function() {
        $('#modalcrearhistorial').modal('show');
    });
    Livewire.on('abrirmodalvervacunas', function () {
        $('#VerVacunas').modal('show');
    });
    Livewire.on('abrirmodalcirugiapre', function () {
        $('#modalcirugiapre').modal('show');
    });
    Livewire.on('AbrirModalCrearMascota', function() {
        $('#modalcrearmascota').modal('show');
    });
    Livewire.on('cerrarModarCrearMascota', function() {
        $('#modalcrearmascota').modal('hide');
    });
    Livewire.on('AbrirModalVerMascotas', function() {
        $('#modalvermascotas').modal('show');
    });
    Livewire.on('CerrarModalVerMascotas', function() {
        $('#modalvermascotas').modal('hide');
    });
    Livewire.on('Abrirmodaltratamiento', function() {
        $('#modaltratamiento').modal('show');
    });
    Livewire.on('Cerrarmodaltratamiento', function() {
        $('#modaltratamiento').modal('hide');
    });
    Livewire.on('abrirmodalhistorial', function() {
        $('#modalcrearh        @endpushistorial').modal('show');
    });
    Livewire.on('vermodaltratamietnoshistorial', function() {
        $('#vertratamientos').modal('show');
    });
    Livewire.on('cerrarmodalvertratamiento', function() {
        $('#vertratamientos').modal('hide');
    });
    Livewire.on('vermodalcreartratamiento', function() {
        $('#creartratamiento').modal('show');
    });
    Livewire.on('cerrarmodalcreartratamiento', function() {
        $('#creartratamiento').modal('hide');
    });
    Livewire.on('vermodaltratamietnoshistorialinternacion', function() {
        $('#creartratamientointernacion').modal('show');
    });
    Livewire.on('cerrarmodaltratamietnoshistorialinternacion', function() {
        $('#creartratamientointernacion').modal('hide');
    });
    Livewire.on('vermodaltratamietnoshistorialinternacionlistar', function() {
        $('#vertratamientointernacion').modal('show');
    });
    Livewire.on('cerrarmodalvertratamientointernacion', function() {
        $('#vertratamientointernacion').modal('hide');
    });


});

livewire.on('borrar_history', id_historial => {
    Swal.fire({
        title: 'Esta seguro/segura ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {

            // livewire.emitTo('servidor-index', 'delete', ServidorId);
            livewire.emit('eliminar_historial', id_historial);

            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});
livewire.on('borrar_tratamiento', id_tratamiento => {
    Swal.fire({
        title: 'Esta seguro/segura ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {

            // livewire.emitTo('servidor-index', 'delete', ServidorId);
            livewire.emit('eliminar_tratamiento', id_tratamiento);

            Swal.fire(
                'Eliminado!',
                'El tratamiento ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});
livewire.on('borrartratamientodato', id_comentario => {
    Swal.fire({
        title: 'Esta seguro/segura ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {

            // livewire.emitTo('servidor-index', 'delete', ServidorId);
            livewire.emit('borrartratamientodato', id_comentario);

            Swal.fire(
                'Eliminado!',
                'El tratamiento ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});
livewire.on('borrartratamientocuerpo', id_comentario => {
    Swal.fire({
        title: 'Esta seguro/segura ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {

            // livewire.emitTo('servidor-index', 'delete', ServidorId);
            livewire.emit('borrartratamientocuerpo', id_comentario);

            Swal.fire(
                'Eliminado!',
                'El tratamiento ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});
livewire.on('borrar_tratamiento_internacion', id_tratamiento => {
    Swal.fire({
        title: 'Esta seguro/segura ?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {

            // livewire.emitTo('servidor-index', 'delete', ServidorId);
            livewire.emit('eliminar_tratamiento_internacion', id_tratamiento);

            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});

document.addEventListener('livewire:load', function() {
    const cameraFeed = document.getElementById('cameraFeed');
    let stream;

    Livewire.on('refreshCamara', function(facingMode) {
        if (stream) {
            stream.getTracks().forEach(function(track) {
                track.stop();
            });
        }

        navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: facingMode
                }
            })
            .then(function(newStream) {
                stream = newStream;
                cameraFeed.srcObject = stream;
            })
            .catch(function(error) {
                console.error('Error al cambiar la cámara:', error);
            });
    });
    // todo para enviar al cotrolador
    document.getElementById('capturarBtn').addEventListener('click', function() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const width = cameraFeed.videoWidth;
        const height = cameraFeed.videoHeight;
        canvas.width = width;
        canvas.height = height;

        // Ajustar el enfoque
        context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

        // Obtener la imagen capturada
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

        // Convertir la imagen a una matriz de píxeles OpenCV
        const src = cv.matFromImageData(imageData);

        // Aplicar un filtro de mejora de nitidez (unsharp mask)
        const dst = new cv.Mat();
        cv.GaussianBlur(src, dst, {
            width: 0,
            height: 0
        }, 3);
        cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);

        // Convertir la imagen de salida a un objeto de imagen
        const outputImageData = new ImageData(
            new Uint8ClampedArray(dst.data),
            dst.cols,
            dst.rows
        );

        // Renderizar la imagen de salida en el lienzo
        context.putImageData(outputImageData, 0, 0);

        // Obtener la imagen procesada
        const processedImageData = canvas.toDataURL('image/jpeg', 1.0);

        // Enviar la imagen procesada al componente Livewire
        Livewire.emit('imagenCapturada', processedImageData);

        // Cerrar la modal
        $('#capturarImagenModal').modal('hide');

        // Liberar memoria
        src.delete();
        dst.delete();
    });



});

document.addEventListener('livewire:load', function() {

    Livewire.on('Reconocer', function() {

        let recognition = new webkitSpeechRecognition();
        let caja = document.getElementById("contenedor");
        recognition.lang = 'es-ES';

        recognition.onresult = function(event) {
            for (let result of event.results) {
                let texto = result[0].transcript;
                caja.value = texto; // Set the value of the input field directly
                Livewire.emit('resultadoReconocimiento', texto); // Emit the text
            }
        };

        recognition.start();

    });

});

document.addEventListener('livewire:load', function () {

    Livewire.on('ReconocerAnamensis', function () {

        let recognition = new webkitSpeechRecognition();
        let caja = document.getElementById("contenedor-anamensis");
        recognition.lang = 'es-ES';

        recognition.onresult = function (event) {
            for (let result of event.results) {
                let texto = result[0].transcript;
                caja.value = texto;
                Livewire.emit('resultadoReconocimientoAnamensis', texto);
            }
        };

        recognition.start();

    });  

});
document.addEventListener('livewire:load', function () {

    Livewire.on('ReconocerMotivoDeconsulta', function () {

        let recognition = new webkitSpeechRecognition();
        let caja = document.getElementById("contenedor-motivo-consulta");
        recognition.lang = 'es-ES';
 
        recognition.onresult = function (event) {
            for (let result of event.results) {
                let texto = result[0].transcript;
                caja.value = texto;
                Livewire.emit('resultadoReconocimientoMotivoConsulta', texto);
            }
        };

        recognition.start();

    });

});