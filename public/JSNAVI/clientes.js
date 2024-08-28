
document.addEventListener('livewire:load', function () {

    Livewire.on('cerrarmodalcrearclientee', function () {
        $('#modalcrearcliente').modal('hide');
    });
    Livewire.on('abrirmodaleditarcliente', function () {
        $('#modaleditarcliente').modal('show');
    });
    Livewire.on('cerrarmodaleditarcliente', function () {
        $('#modaleditarcliente').modal('hide');
    });
    Livewire.on('AbrirModalCrearMascota', function () {
        $('#modalcrearmascota').modal('show');
    });
    Livewire.on('cerrarModarCrearMascota', function () {
        $('#modalcrearmascota').modal('hide');
    });
    Livewire.on('abrirmodaleditarmascota', function () {
        $('#modaleditarmascota').modal('show');
    });
    Livewire.on('cerrarmodaleditarmascota', function () {
        $('#modaleditarmascota').modal('hide');
    });
    Livewire.on('AbrirModalVerMascotas', function () {
        $('#modalvermascotas').modal('show');
    });
    Livewire.on('CerrarModalVerMascotas', function () {
        $('#modalvermascotas').modal('hide');
    });
    Livewire.on('AbrirModalConsultas', function () {
        $('#modalcrearhistorial').modal('show');
    });
    Livewire.on('cerrarmodalhistorial', function () {
        $('#modalcrearhistorial').modal('hide');
    });
    Livewire.on('Abrirmodalinternacion', function () {
        $('#modalinternacion').modal('show');
    });
    Livewire.on('Cerrarmodalinternacion', function () {
        $('#modalinternacion').modal('hide');
    });
    Livewire.on('abrirmodalvervacunas', function () {
        $('#VerVacunas').modal('show');
    });
    Livewire.on('adsadad', function () {
        $('#modalcrearhistorial').modal('hide');
    });
    Livewire.on('AbrirModalPreciosTotal', function () {
        $('#atencionesdeldia').modal('show');
    });
    Livewire.on('Abrirmodalestudios', function () {
        $('#modalestudios').modal('show');
    });
    Livewire.on('Cerrarmodalestudios', function () {
        $('#modalestudios').modal('hide');
    });
    Livewire.on('Abrirmodalestudioscaptura2', function () {
        $('#nuevomodaldecaptura').modal('show');
    });
    Livewire.on('Cerrarmodalestudioscaptura2', function () {
        $('#nuevomodaldecaptura').modal('hide');
    });
    Livewire.on('cerrarmodalcamara', function () {
        $('#capturarImagenModal').modal('hide');
    });
   
    
});
livewire.on('borrarcliente', id_cliente => {
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
            livewire.emit('eliminarcliente', id_cliente);
            Swal.fire(
                'Eliminado!',
                'El cliente ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de cliente esta seguro...',
                icon: 'info',
            })
        }
    })
});
livewire.on('BorrarVacula', id_vacuna => {
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
            livewire.emit('EliminarVacuna', id_vacuna);
            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de cliente esta seguro...',
                icon: 'info',
            })
        }
    })
});
livewire.on('BorrarDesparacitacion', id_desparacitaciones => {
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
            livewire.emit('EliminarDesparacitaciones', id_desparacitaciones);
            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de cliente esta seguro...',
                icon: 'info',
            })
        }
    })
});

livewire.on('eliminarcarro', id_dato => {
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
            livewire.emit('eliminarcarro', id_dato);
            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de cliente esta seguro...',
                icon: 'info',
            })
        }
    })
});
livewire.on('borrarmascota', id_mascota => {
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
            livewire.emit('EliminarMascota', id_mascota);
            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de Mascota esta seguro...',
                icon: 'info',
            })
        }
    })
});
livewire.on('borrar_estudios', id_estudio => {
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
            livewire.emit('EliminarEstudio', id_estudio);
            Swal.fire(
                'Eliminado!',
                'El cliente ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro  esta seguro...',
                icon: 'info',
            })
        }
    })
});

livewire.on('BorrarCirugias', id_dato=> {
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
            livewire.emit('BorrarCirugia', id_dato);
            Swal.fire(
                'Eliminado!',
                'El cliente ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'Su registro de cliente esta seguro...',
                icon: 'info',
            })
        }
    })
});
document.addEventListener('livewire:load', function () {
    const cameraFeed = document.getElementById('cameraFeed');
    let stream;
    Livewire.on('refreshCamara', function (facingMode) {
        if (stream) {
            stream.getTracks().forEach(function (track) {
                track.stop();
            });
        }
        navigator.mediaDevices.getUserMedia({
            video: {
                  facingMode: facingMode,
        width: { ideal: 1920 }, // Ancho ideal de 1920px
        height: { ideal: 1080 } // Alto ideal de 1080px
            }
        })
            .then(function (newStream) {
                stream = newStream;
                cameraFeed.srcObject = stream;
            })
            .catch(function (error) {
                console.error('Error al cambiar la cámara:', error);
            });
    });

    document.getElementById('capturarBtn').addEventListener('click', function () {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const width = cameraFeed.videoWidth;
        const height = cameraFeed.videoHeight;
        canvas.width = width;
        canvas.height = height;
        context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const src = cv.matFromImageData(imageData);
        const dst = new cv.Mat();
        cv.GaussianBlur(src, dst, {
            width: 0,
            height: 0
        }, 3);
        cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
        const outputImageData = new ImageData(
            new Uint8ClampedArray(dst.data),
            dst.cols,
            dst.rows
        );
        context.putImageData(outputImageData, 0, 0);
       const processedImageData = canvas.toDataURL('image/jpeg', 0.9);
        Livewire.emit('imagenCapturada', processedImageData);
        $('#capturarImagenModal').modal('hide');
        src.delete();
        dst.delete();
    });
    Livewire.on('refreshCamaraMacota', function(facingMode) {

        const cameraFeed = document.getElementById('CamaraMascota');
        let stream;
        if (stream) {
            stream.getTracks().forEach(function(track) {
                track.stop();
            });
        }
        navigator.mediaDevices.getUserMedia({
                video: {
                      facingMode: facingMode,
        width: { ideal: 1920 }, // Ancho ideal de 1920px
        height: { ideal: 1080 } // Alto ideal de 1080px
                }
            })
            .then(function(newStream) {
                stream = newStream;
                cameraFeed.srcObject = stream;
            })
            .catch(function(error) {
                console.error('Error al cambiar la cámara:', error);
            });
        document.getElementById('capturarBtn').addEventListener('click', function() {

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const width = cameraFeed.videoWidth;
            const height = cameraFeed.videoHeight;
            canvas.width = width;
            canvas.height = height;
            context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const src = cv.matFromImageData(imageData);
            const dst = new cv.Mat();
            cv.GaussianBlur(src, dst, {
                width: 0,
                height: 0
            }, 3);
            cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
            const outputImageData = new ImageData(
                new Uint8ClampedArray(dst.data),
                dst.cols,
                dst.rows
            );
            context.putImageData(outputImageData, 0, 0);
           const processedImageData = canvas.toDataURL('image/jpeg', 0.9);
            Livewire.emit('imagenCapturadaMascota', processedImageData);
            // $('#capturarImagenModal').modal('hide');
            stopStream();
        });

        function stopStream() {
            if (stream) {
                stream.getTracks().forEach(function(track) {
                    track.stop();
                });

            }
        }
    });

    const cameraFeedStudio = document.getElementById('cameraFeedStudio');
    let stream2;
    Livewire.on('refreshCamaraEstudio', function (facingMode) {
        if (stream2) {
            stream2.getTracks().forEach(function (track) {
                track.stop();
            });
        }
        navigator.mediaDevices.getUserMedia({
            video: {
                  facingMode: facingMode,
        width: { ideal: 1920 }, // Ancho ideal de 1920px
        height: { ideal: 1080 } // Alto ideal de 1080px
            }
        })
            .then(function (newStream2) {
                stream2 = newStream2;
                cameraFeedStudio.srcObject = stream2;
            })
            .catch(function (error) {
                console.error('Error al cambiar la cámara:', error);
            });
    });

    document.getElementById('capturarBtnEstudio').addEventListener('click', function () {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const width = cameraFeedStudio.videoWidth;
        const height = cameraFeedStudio.videoHeight;
        canvas.width = width;
        canvas.height = height;
        context.drawImage(cameraFeedStudio, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const src = cv.matFromImageData(imageData);
        const dst = new cv.Mat();
        cv.GaussianBlur(src, dst, {
            width: 0,
            height: 0
        }, 3);
        cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
        const outputImageData = new ImageData(
            new Uint8ClampedArray(dst.data),
            dst.cols,
            dst.rows
        );
        context.putImageData(outputImageData, 0, 0);
       const processedImageData = canvas.toDataURL('image/jpeg', 0.9);
        Livewire.emit('imagenCapturadaEstudio', processedImageData);
        $('#nuevomodaldecaptura').modal('hide');
        // src.delete();
        // dst.delete();
        stopStreamEstudio();
    });
    function stopStreamEstudio() {
        if (stream2) {
            stream2.getTracks().forEach(function (track) {
                track.stop();
            });

        }
    }
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