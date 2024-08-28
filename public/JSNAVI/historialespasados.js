 src="https://docs.opencv.org/4.5.4/opencv.js"

document.addEventListener('livewire:load', function() {
    Livewire.on('cerrarmodalhistorial', function() {
        $('#modalhistoriales').modal('hide');
    });
    Livewire.on('abrirmodalhistorial', function() {
        $('#modalhistoriales').modal('show');
    });
    Livewire.on('cerrarmodalcamara', function() {
        $('#capturarImagenModal').modal('hide');
    });
    Livewire.on('cerrarmodalhistorialreporte', function() {
        $('#modalreporteantiguo').modal('hide');
    });
    Livewire.on('abrirmodalhistorialreporte', function() {
        $('#modalreporteantiguo').modal('show');
    });


    //const cameraFeed cameraFeed  environment
    let miVideo2;
    let miVideo;
    let stream;
    Livewire.on('refreshCamara2', function(facingMode) {
           // const cameraFeed = document.getElementById('cameraFeed');
           miVideo2 = document.getElementById('cameraFeed');
            if (miVideo) {
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
                    miVideo2.srcObject = stream;
                })
        });
        
    Livewire.on('refreshCamara', function(facingMode) {
           // const cameraFeed = document.getElementById('cameraFeed');
           miVideo = document.getElementById('cameraFeed');
            //let stream;
            if (miVideo2) {
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
                    miVideo.srcObject = stream;
                })
        });
        // todo para enviar al cotrolador 
        let Videof;
        Livewire.on('capturarBtn1', function() {

            if(miVideo){Videof=miVideo}else {Videof=miVideo2}
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const width = Videof.videoWidth;
            const height = Videof.videoHeight;
            canvas.width = width;
            canvas.height = height;
            // Ajustar el enfoque
            context.drawImage(Videof, 0, 0, canvas.width, canvas.height);
            // Obtener la imagen capturada
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            // Convertir la imagen a una matriz de píxeles OpenCV
            const src = cv.matFromImageData(imageData);
            // Aplicar un filtro de mejora de nitidez (unsharp mask)
            const dst = new cv.Mat();
            cv.GaussianBlur(src, dst, {
                width: 0, height: 0
            }, 3);
            cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
            // Convertir la imagen de salida a un objeto de imagen
            const outputImageData = new ImageData(
                new Uint8ClampedArray(dst.data),
                dst.cols, dst.rows
            );
            // Renderizar la imagen de salida en el lienzo
            context.putImageData(outputImageData, 0, 0);
            // Obtener la imagen procesada
            const processedImageData = canvas.toDataURL('image/png', 1.0);
            // Enviar la imagen procesada al componente Livewire
            Livewire.emit('imagenCapturada', processedImageData);
            src.delete();
            dst.delete();
        });

        livewire.on('elimnarhistorialanti', id_his => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result2) => {
                if (result2.isConfirmed) {
                    // livewire.emitTo('servidor-index', 'delete', ServidorId);
                    livewire.emit('eliminahistorialaa', id_his);
                    Swal.fire(
                        'Eliminado!',
                        'El Historial se eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro de historial esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
});

