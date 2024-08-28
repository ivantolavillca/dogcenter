<div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">REPORTE ESTADISTICO DE GANANCIAS EN EL AÑO O MENSUAL </h4>
                
                <div id="line-chart" class="apex-charts"></div>
            </div>
        </div>  
      

    </div>
    @push('navi-js')
        <script>
            var totalPrecios = @json($precios);
            var colores = ["#45cb85", "#3b5de7", "#2F32DF", "#FFC107", "#FF5722", "#9C27B0", "#00BCD4"];

            var series = Object.keys(totalPrecios).map(function(year, index) {
            return {
                name: year,
                type: "line",
                data: totalPrecios[year] || [], // Asegúrate de que siempre haya un array de 12 meses
                color: colores[index % colores.length] // Asigna un color a la serie
            };
        });
            var options = {
                    series: series,
                    chart: {
                        height: 260,
                        type: "line",
                        toolbar: {
                            show: !1
                        },
                        zoom: {
                            enabled: !1
                        }
                    },
                    colors: series.map(serie => serie.color),
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: "3",
                        dashArray: [4, 0]
                    },
                    markers: {
                        size: 3
                    },
                    xaxis: {
                        categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                            "Octubre", "Nobiembre", "Diciembre"
                        ],
                        title: {
                            text: "Meses"
                        }
                    },
                    fill: {
                        type: "solid",
                        opacity: [1, .1]
                    },
                    legend: {
                        position: "top",
                        horizontalAlign: "right"
                    }
                },
                chart = new ApexCharts(document.querySelector("#line-chart"), options);
            chart.render();
        </script>
    @endpush
</div>
