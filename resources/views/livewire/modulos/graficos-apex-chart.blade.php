<div class="row">

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">TOTAL POR MODALIDAD</h4>
                <div id="bar_total_modalidad" class="apex-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">TOTAL ESTUDIANTES</h4>
                <div id="chart-pie-total-estudiantes" class="apex-charts"></div>
            </div>
        </div>
    </div>

@can('estadisticas.detalladas')
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">PERIODO - GESTIÓN</h4>
                <div id="chart-bar-gestiones" class="apex-charts"></div>
            </div>
        </div>
    </div>


    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4" id="title-gestion-actual">PERIODO - GESTIÓN</h4>
                <div id="chart-bar-gestion-actual" class="apex-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">CONVOCATORIA ESTUDIANTE</h4>
                <div id="chart-bar-gestion-actual-tipo_estudiante" class="apex-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">SIADI ASIGNATURAS</h4>
                <div id="chart-bar-gestion-actual-tipo_estudiante-asignaturas" class="apex-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">SIADI ASIGNATURA NIVELES</h4>
                <div id="chart-bar-gestion-actual-tipo_estudiante-asignaturas-niveles" class="apex-charts"></div>
            </div>
        </div>
    </div>
@endcan

</div>
        

@push('navi-js')
<script>
    const llenarChartPieEstudents = (() =>{
        const selectorJETG = document.querySelector("#chart-pie-total-estudiantes");
        //const dataJETG = [];
        fetch("{{ url('api/count_by_gender') }}")
        .then(res => res.json())
        .then(res => {
            if(res.success===true){
                if(res.data.length> 0){
                    const optionPer = {
                        title: {
                            text: "ESTUDIANTES INSCRITOS POR GÉNERO",
                            align: "center",
                            margin: 30,
                            style: {
                                fontWeight: "bold",
                                color: "#3b5de7"
                            }
                        },
                        chart: {
                            width: '100%',
                            type: 'donut',
                            toolbar: {
                                show: true
                            },
                        },
                        series: res.data.map(item => item.estudiantes_inscritos),
                        labels:
                            res.data.map(item => item.genero_persona),
                        colors: ["#eeb902", "#ff715b", "#3b5de7"],
                        legend: {
                            position: "bottom", // left
                            formatter: function(val, opts) {
                                return opts.w.globals.series[opts.seriesIndex] + " " + val
                            },
                            offsetY: 0, // 30
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            showAlways: true,
                                            label: 'Total', // 'Total estudiantes'
                                            fontWeight: 600,
                                            //fontSize: '16px'
                                        }
                                    },
                                    size: '60%'
                                }
                            }
                        },
                        /* responsive: [{
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: 'bottom',
                                    offsetY: 0
                                },
                                chart: {
                                    width: '100%'
                                },
                            
                            }
                        }, {
                            breakpoint: 720,
                            options: {
                                legend: {
                                    position: 'bottom',
                                    offsetY: 0
                                },
                                chart: {
                                    width: '100%'
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            labels: {
                                                total: {
                                                    fontSize: '13px'
                                                }
                                            }
                                        }
                                    }
                                }
                            
                            }
                        }, {
                            breakpoint: 1195, 
                            options: {
                                legend: {
                                    position: 'left',
                                    offsetY: 30
                                },
                                chart: {
                                    width: '70%'
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            labels: {
                                                total: {
                                                    fontSize: '16px'
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }] */
                    };

                    var chartper = new ApexCharts(selectorJETG, optionPer);
                    chartper.render();
                } else {
                    selectorJETG.innerText = "No hay datos Total";
                    selectorJETG.classList.add("text-center");
                }
            }
        })
        .catch( err => console.error(err));
    });

    const llenarChartPorModalidad = (()=> {
        const selectorModalidad = document.querySelector("#bar_total_modalidad");
        fetch("{{ url('api/count_tipo_convocatoria') }}")
        .then(res => res.json())
        .then(res => {
            if(res.success===true){
               
                if(res.data.length> 0){
                    
                    //console.log(res.data);
                    const optionPorModalidad = {
                        title: {
                            text: "TOTAL ESTUDIANTES POR MODALIDAD",
                            align: "center",
                            margin: 40,
                            style: {
                                fontWeight: "bold",
                                color: "#3b5de7"
                            }
                        },
                        
                        chart: {
                            toolbar: {
                                tools: {
                                    zoom: false,
                                    zoomin: false,
                                    zoomout: false,
                                },
                                autoSelected: 'pan'
                            },
                            zoom: {
                                enabled: true
                            },
                            type: "bar",
                            height: '180%',
                        },
                        dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#000']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                        },
                        series: [
                            {
                                //type: "line",
                                name: "Total Estudiantes",
                                data: res.data.map(item => item.total_inscritos) 
                            },
                        ],
                        plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                        colors: [
                            "#0caadc",
                            "#45cb85",
                            "#ff715b",
                            "#eeb902",
                            "#2b908f",
                            "#f9a3a4",
                            "#90ee7e",
                            '#546E7A'
                        ],
                        stroke: {
                            width: 1,
                            colors: ['#fff']
                        },
                        xaxis: {
                            categories: res.data.map(item => item.modalidad),
                            title: {
                                text: "S.I.A.D.I",
                            }
                        },
                        yaxis: {
                            labels: {
                                show: false
                            }
                        },
                    }
                    var chartPorModalidad = new ApexCharts(selectorModalidad, optionPorModalidad);
                    chartPorModalidad.render();
                }else {
                    selectorModalidad.innerText = "No hay datos por Modalidades";
                    selectorModalidad.classList.add("text-center");
                }
            }
        })
        .catch( err => console.error(err));
    });

    document.addEventListener('livewire:load', function() {
        llenarChartPorModalidad();
        llenarChartPieEstudents();
    });
</script>
@endpush

@can('estadisticas.detalladas')
@push('navi-js')
<!-- graficos apexchart en Dashboard -->
<script>
    
    

    // variables globales
    var dataCBG = [];
    var dataArrayConvocatoriaEstudiante = [];
    var dataArrayAsignaturas = [];

    // charts
    var chartGestionActual;
    
    var chartGestionTipoEstudiante;

    var chartGestionTipoEstudianteAsignatura;

    var chartGestionTipoEstudianteAsignaturaNiveles;


    var indiceSiadiAsignatura = null;

    const llenarChartBarGestiones = (() => {
        const selectorCBG = document.querySelector("#chart-bar-gestiones");
        dataCBG = [];
        fetch("{{ url('api/count_by_tipo_convocatoria') }}")
        .then(res => res.json())
        .then(res => {
            if(res.success===true){
               
                if(res.data.length> 0){
                    tamanio = res.data.length>=15? 15: res.data.length;  
                    for(let u=0; u<=tamanio; u++){
                        dataCBG.push(res.data[u]);
                    }
                    //console.log(res.data);
                    //dataCBG = res.data;
                    const optionGetion = {
                        title: {
                            text: "ESTUDIANTES INSCRITOS POR PERIODO GESTIÓN",
                            align: "center",
                            margin: 40,
                            style: {
                                fontWeight: "bold",
                                color: "#3b5de7"
                            }
                        },
                        
                        chart: {
                            toolbar: {
                                tools: {
                                    zoom: false,
                                    zoomin: false,
                                    zoomout: false,
                                },
                                autoSelected: 'pan'
                            },
                            zoom: {
                                enabled: true
                            },
                            type: "area",
                            height: '180%',
                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    //console.log(dataCBG[config.dataPointIndex].gestion_literal);
                                    actualizarBarGestionActual(config.dataPointIndex);
                                    actualizarBarGestionTipoEstudiante(config.dataPointIndex);
                                    
                                    //if(chartGestionTipoEstudianteAsignatura.length > 0){
                                        //if(indiceSiadiAsignatura !== config.dataPointIndex){
                                            reseteaBarGestionTIpoEstudianteAsignaturas();
                                            reseteaBarGestionTipoEstudianteAsignaturasNiveles();
                                        //}
                                    //}
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            enabledOnSeries: [0],
                            style: {
                                colors: ["#fff"]
                            },
                            background: {
                                enabled: true,
                                foreColor: '#000',
                            },
                            offsetY: -5,
                        },
                        series: [
                            {
                                //type: "line",
                                name: "Total Estudiantes",
                                data: dataCBG.map(item => item.total_estudiantes) //[19, 23, 18, 11, 24, 45, 56]
                            },
                            {
                                //type: "bar",
                                name: "Aprobados",
                                data: dataCBG.map(item => item.estudiantes_aprobados) //[13, 20, 12, 08, 18, 30, 50]
                            },
                            {
                                //type: "bar",
                                name: "Reprobados",
                                data: dataCBG.map(item => item.estudiantes_reprobados) //[01, 02, 04, 02, 03, 10, 03]
                            },
                            {
                                //type: "bar",
                                name: "No se presentaron",
                                data: dataCBG.map(item => item.estudiantes_no_se_presentaron) //[04, 02, 01, 01, 02, 05, 03]
                            },
                            {
                                //type: "bar",
                                name: "Inscritos",
                                data: dataCBG.map(item => item.estudiantes_inscritos) //[01, 00, 01, 00, 01, 00, 00]
                            }
                        ],
                        colors: [
                            "#0caadc",
                            "#45cb85",
                            "#ff715b",
                            "#eeb902",
                            "#9095ad",
                        ],
                        xaxis: {
                            categories: dataCBG.map(item => item.periodo_gestion), //["I-2023", "II-2023", "I-2024", "II-2024", "I-2025", "II-2025", "I-2026"]
                            title: {
                                text: "S.I.A.D.I",
                            }
                        },
                        
                        stroke: {
                            curve: 'straight'
                        },
                        states: {
                            active: {
                                allowMultipleDataPointsSelection: false,
                            }
                        },
                        tooltip: {
                            shared: false,
                            intersect: true,
                        },
                        markers: {
                            size: 4,
                        }
                    }
                    var chartGestion = new ApexCharts(selectorCBG, optionGetion);
                    chartGestion.render();

                    // mostrar el primero 
                    actualizarBarGestionActual(0);
                }else {
                    selectorCBG.innerText = "No hay datos Gestiones";
                    selectorCBG.classList.add("text-center");
                }
            }
        })
        .catch( err => console.error(err));
    });

    const inicializarBarGestionActual = (() => {
        const selectorCBGActual = document.querySelector("#chart-bar-gestion-actual");

        let optionGestionActual = {
            title: {
                text: '', 
                align: "center",
                margin: 40,
                style: {
                    fontWeight: "bold",
                    color: "#3b5de7"
                }
            },
            chart: {
                type: 'bar',
                height: '180%',
                stacked: false
            },
            series: [],
            colors: [
                //"#0caadc",
                "#45cb85",
                "#ff715b",
                "#eeb902",
                "#9095ad",
            ],
            xaxis: {
                categories: [""],
                title: {
                    text: "S.I.A.D.I",
                }
            },
            yaxis: {
                title: {
                    text: "",
                }
            },
            stroke: {
                width: 3
            },
            legend: {
                show: true,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 5,
                    borderRadiusApplication: 'end',
                    columnWidth: 35,
                    dataLabels: {
                        total: {
                            enabled: true
                        }
                    }
                },
            },
        };

        chartGestionActual = new ApexCharts(selectorCBGActual, optionGestionActual);
        chartGestionActual.render();
    });

    const actualizarBarGestionActual = ((indice) => {
        let dataActual = dataCBG[indice];
        //console.log(dataActual);

        chartGestionActual.updateOptions({
            title: {
                text: dataActual.periodo_gestion,
            },
            xaxis: {
                categories: [("Gestión "+ dataActual.periodo_gestion)]
            },
            yaxis: {
                title: {
                    text: "Total Estudiantes: "+ dataActual.total_estudiantes,
                }
            },
        });
        
        chartGestionActual.updateSeries([
            {
                name: "Aprobados",
                data: [dataActual.estudiantes_aprobados] //[13, 20, 12, 08, 18, 30, 50]
            },
            {
                name: "Reprobados",
                data: [dataActual.estudiantes_reprobados] //[01, 02, 04, 02, 03, 10, 03]
            },
            {
                name: "No se presentaron",
                data: [dataActual.estudiantes_no_se_presentaron] //[04, 02, 01, 01, 02, 05, 03]
            },
            {
                name: "Inscritos",
                data: [dataActual.estudiantes_inscritos] //[01, 00, 01, 00, 01, 00, 00]
            }
        ]);
    });



    const inicializarBarGestionTipoEstudiante = (() => {
        const opcionGestionActualTipoEstudiante = {
            title: {
                text: '', 
                align: "center",
                margin: 40,
                style: {
                    fontWeight: "bold",
                    color: "#3b5de7"
                }
            },
            chart: {
                type: 'bar',
                height: 0,
                stacked: true,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        //console.log("Funciona ", config.dataPointIndex);
                        actualizaBarGestionTIpoEstudianteAsignaturas(config.dataPointIndex);
                        reseteaBarGestionTipoEstudianteAsignaturasNiveles();
                    }
                }
            },
            series: [],
            colors: [
                //"#0caadc",
                "#45cb85",
                "#ff715b",
                "#eeb902",
                "#9095ad",
            ],
            xaxis: {
                categories: [""]
            },
            stroke: {
                width: 3
            },
            legend: {
                show: true,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 5,
                    borderRadiusApplication: 'end',
                    columnWidth: 40,
                    dataLabels: {
                        total: {
                            enabled: true,
                        }
                    }
                }
            },
            tooltip: {
                y: {
                    /* formatter: function(value, {series}){
                        return value + " >> "+ dataPointIndex;
                    } */
                }
            }
            
        };

        const selectorCBGActualTipoEstudiante = document.querySelector("#chart-bar-gestion-actual-tipo_estudiante");
        chartGestionTipoEstudiante = new ApexCharts(selectorCBGActualTipoEstudiante, opcionGestionActualTipoEstudiante);
        chartGestionTipoEstudiante.render();
    });

    const actualizarBarGestionTipoEstudiante = ((indice) => {
        let dataActual = dataCBG[indice]; 
        fetch("{{ url('api/count_by_tipo_convocatoria') }}"+"/"+dataActual.periodo_gestion)
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    //console.log(res.data);
                    if(res.data.length > 0){

                        let maxValue = Math.ceil( Math.max( res.data.map(item => item.total_inscritos) ) % 5) * 5;
                        dataArrayConvocatoriaEstudiante = res.data;

                        chartGestionTipoEstudiante.updateOptions({
                            title: {
                                text: "CONVOCATORIAS "+ res.data[0].periodo_gestion,
                            },
                            xaxis: {
                                categories: res.data.map(item => item.modalidad) // []
                            },
                            yaxis: {
                                // max: maxValue,
                                tickAmount: 4,
                            },
                            chart: {
                                height: '200%',
                                toolbar: {
                                    show: true,
                                    tools: {
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: true
                                    },
                                    autoSelected: 'pan', 
                                    zoom: {
                                        enabled: true
                                    }
                                }
                            },
                        });

                        chartGestionTipoEstudiante.updateSeries([
                            /* {
                                type: "area", // line
                                name: "Total Inscritos",
                                data: res.data.map(item => item.total_inscritos)
                            }, */
                            {
                                type: "bar",
                                name: "Aprobados",
                                data: res.data.map(item => item.estudiantes_aprobados) 
                            },
                            {
                                type: "bar",
                                name: "Reprobados",
                                data: res.data.map(item => item.estudiantes_reprobados) 
                            },
                            {
                                type: "bar",
                                name: "No se presentaron",
                                data: res.data.map(item => item.estudiantes_no_se_presentaron) 
                            },
                            {
                                type: "bar",
                                name: "Inscritos",
                                data: res.data.map(item => item.estudiantes_inscritos) 
                            }
                        ]);
                    } else {
                        chartGestionTipoEstudiante.updateOptions({
                            title: {
                                text: "CONVOCATORIA "+ dataActual.gestion_literal + " (sin datos)",
                            },
                            xaxis: {
                                categories: []
                            },
                            yaxis: {
                                max: 0,
                            },
                            chart: {
                                height: '10%',
                            }
                        });
                        chartGestionTipoEstudiante.updateSeries([]);
                    }
                }/*  else {
                    dataArrayConvocatoriaEstudiante = [];
                    chartGestionTipoEstudiante.updateOptions({
                        title: {
                            text: "CONVOCATORIA "+ dataActual.gestion_literal + " (error)"
                        },
                        xaxis: {
                            categories: [""]
                        },
                        yaxis: {
                            max: 0,
                        },
                        chart: {
                            height: '10%',
                        } 
                    });
                    chartGestionTipoEstudiante.updateSeries([]);
                } */
            })
            .catch( err => console.error(err));
        
    });



    const inicializaBarGestionTipoEstudianteAsignaturas = (() => {
        const opcionGestionActualTipoEstudianteAsignaturas = {
            title: {
                text: '', 
                align: "center",
                margin: 40,
                style: {
                    fontWeight: "bold",
                    color: "#3b5de7"
                }
            },
            chart: {
                type: 'bar',
                height: 0,
                stacked: true,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        actualizaBarGestionTipoEstudianteAsignaturasNiveles(config.dataPointIndex);
                    }
                }
            },
            series: [],
            colors: [
                //"#0caadc",
                "#45cb85",
                "#ff715b",
                "#eeb902",
                "#9095ad",
            ],
            xaxis: {
                categories: [""]
            },
            yaxis: {
                title: {
                    text: 'Estudiantes',
                },
            },
            stroke: {
                width: 3
            },
            legend: {
                show: true
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 5,
                    borderRadiusApplication: 'end',
                    columnWidth: 30,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                color: '#000000',
                            }
                        }
                    }
                }
            },
            
        };

        const selectorCBGActualTipoEstudianteAsignatura = document.querySelector("#chart-bar-gestion-actual-tipo_estudiante-asignaturas");
        chartGestionTipoEstudianteAsignatura = new ApexCharts(selectorCBGActualTipoEstudianteAsignatura, opcionGestionActualTipoEstudianteAsignaturas);
        chartGestionTipoEstudianteAsignatura.render();
    });

    const actualizaBarGestionTIpoEstudianteAsignaturas = ((indice) => {
        let dataActual = dataArrayConvocatoriaEstudiante[indice];
        indiceSiadiAsignatura = indice;
        //console.log("Materias de ", dataActual);
        fetch("{{ url('api/count_by_tipo_convocatoria') }}"+"/"+dataActual.periodo_gestion+"/"+dataActual.id_modalidad)
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    //console.log(res.data);
                    dataArrayAsignaturas = res.data;

                    if(res.data.length > 0){
                        chartGestionTipoEstudianteAsignatura.updateOptions({
                            title: {
                                text: res.data[0].modalidad + " "+ res.data[0].periodo_gestion,
                            },
                            xaxis: {
                                categories: res.data.map(item => item.nombre_idioma),
                                title: {
                                    text: "S.I.A.D.I."
                                }
                            },
                            yaxis: {
                                //max: maxValue,
                                tickAmount: 4,
                            },
                            chart: {
                                height: '200%',
                            },
                            
                        });

                        chartGestionTipoEstudianteAsignatura.updateSeries([
                            /* {
                                type: "area", // line
                                name: "Total Inscritos",
                                data: res.data.map(item => item.total_estudiantes)
                            }, */
                            {
                                //type: "bar",
                                name: "Aprobados",
                                data: res.data.map(item => item.estudiantes_aprobados) 
                            },
                            {
                                //type: "bar",
                                name: "Reprobados",
                                data: res.data.map(item => item.estudiantes_reprobados) 
                            },
                            {
                                //type: "bar",
                                name: "No se presentaron",
                                data: res.data.map(item => item.estudiantes_no_se_presentaron) 
                            },
                            {
                                //type: "bar",
                                name: "Inscritos",
                                data: res.data.map(item => item.estudiantes_inscritos) 
                            }
                        ]);
                    } else {
                        reseteaBarGestionTIpoEstudianteAsignaturas();
                    }
                } else {
                    console.log(res.error);
                }
            })
            .catch( err => console.error(err));
    });

    const reseteaBarGestionTIpoEstudianteAsignaturas = (() => {
        dataArrayAsignaturas = [];
        chartGestionTipoEstudianteAsignatura.updateSeries([]);
        chartGestionTipoEstudianteAsignatura.updateOptions({
            title: {
                text: "",
            },
            xaxis: {
                categories: [""]
            },
            yaxis: {
                tickAmount: 4,
            },
            chart: {
                height: 0,
            },
            
        });
    });



    const inicializaBarGestionTipoEstudianteAsignaturasNiveles = (() => {
        const optionGetionAsignaturaNivel = {
                title: {
                    text: "",
                    align: "center",
                    margin: 40,
                    style: {
                        fontWeight: "bold",
                        color: "#3b5de7"
                    }
                },
                
                chart: {
                    toolbar: {
                        tools: {
                            zoom: false,
                            zoomin: false,
                            zoomout: false,
                        },
                        autoSelected: 'pan'
                    },
                    zoom: {
                        enabled: true
                    },
                    type: "area",
                    height: '0',
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [0],
                    style: {
                        colors: ["#fff"]
                    },
                    background: {
                        enabled: true,
                        foreColor: '#000',
                    },
                    offsetY: -5,
                },
                series: [],
                colors: [
                    "#0caadc",
                    "#45cb85",
                    "#ff715b",
                    "#eeb902",
                    "#9095ad",
                ],
                xaxis: {
                    categories:[""]
                },
                stroke: {
                    curve: 'straight'
                },
                markers: {
                    size: 2,
                },
                legend: {
                    tooltipHoverFormatter: function(seriesName, opts) {
                        return seriesName + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>'
                    }
                }
            }

        const selectorNiveles = document.querySelector("#chart-bar-gestion-actual-tipo_estudiante-asignaturas-niveles");
        chartGestionTipoEstudianteAsignaturaNiveles = new ApexCharts(selectorNiveles, optionGetionAsignaturaNivel);
        chartGestionTipoEstudianteAsignaturaNiveles.render();
    });

    const actualizaBarGestionTipoEstudianteAsignaturasNiveles = ((indice) => {
        let dataActual = dataArrayAsignaturas[indice];
        //console.log(indice, "::", dataActual);
        
        fetch("{{ url('api/count_by_tipo_convocatoria') }}"+"/"+dataActual.periodo_gestion+"/"+dataActual.id_modalidad +"/"+dataActual.id_idioma)
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    //console.log(res.data);

                    if(res.data.length > 0){
                        chartGestionTipoEstudianteAsignaturaNiveles.updateOptions({
                            title: {
                                text: res.data[0].nombre_idioma +" - "+ res.data[0].modalidad +" "+ res.data[0].periodo_gestion,
                            },
                            xaxis: {
                                categories: res.data.map(item => item.nombre_asignatura), // [],
                                title: {
                                    text: "S.I.A.D.I."
                                }
                            },
                            chart: {
                                height: '180%',
                            },
                            
                        });

                        chartGestionTipoEstudianteAsignaturaNiveles.updateSeries([
                            {
                                type: "line", // area
                                name: "Total Estudiantes",
                                data: res.data.map(item => item.total_estudiantes)
                            },
                            {
                                type: "area",
                                name: "Aprobados",
                                data: res.data.map(item => item.estudiantes_aprobados) 
                            },
                            {
                                type: "area",
                                name: "Reprobados",
                                data: res.data.map(item => item.estudiantes_reprobados) 
                            },
                            {
                                type: "area",
                                name: "No se presentaron",
                                data: res.data.map(item => item.estudiantes_no_se_presentaron) 
                            },
                            {
                                type: "area",
                                name: "Inscritos",
                                data: res.data.map(item => item.estudiantes_inscritos) 
                            }
                        ]);
                    } else {
                        reseteaBarGestionTipoEstudianteAsignaturasNiveles();
                    }
                } else {
                    console.log(res.error);
                }
            })
            .catch( err => console.error(err)); 
            
    });

    const reseteaBarGestionTipoEstudianteAsignaturasNiveles = (() => {
        chartGestionTipoEstudianteAsignaturaNiveles.updateSeries([]);
        chartGestionTipoEstudianteAsignaturaNiveles.updateOptions({
            title: {
                text: "",
            },
            xaxis: {
                categories: [""]
            },
            chart: {
                height: 0,
            },
            
        });
    });

    document.addEventListener('livewire:load', function() {
        inicializarBarGestionActual();
        llenarChartBarGestiones();
        inicializarBarGestionTipoEstudiante();
        inicializaBarGestionTipoEstudianteAsignaturas();
        inicializaBarGestionTipoEstudianteAsignaturasNiveles();
    });
</script>
@endpush
@endcan
