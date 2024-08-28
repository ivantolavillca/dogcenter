
    <section class="tf-section tf-token bg-secondary bg-statics">
        <div class="overlay">
            <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_project2.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tf-title aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                        <h2 class="title">
                            ESTUDIANTES INSCRITOS
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="counter_wrapper">
                            <div class="box">
                                <div class="image">
                                    <img src="{{ asset('assets/risebothtml/assets/images/common/counter_1.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <p class="desc ">Total Inscritos</p>
                                    <div class="box-couter counter">
                                        <div class="number-content">
                                            <span class="count-number" data-speed="2000" data-inviewport="yes" id="total">0</span> <!-- data-to="359"  359 -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="{{ asset('assets/risebothtml/assets/images/common/counter_2.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <p class="desc ">Usuarios Activos</p>
                                    <div class="box-couter counter">
                                        <div class="number-content">
                                            <span class="count-number"  data-speed="2000" data-inviewport="yes" id="total-users">0</span> <!-- data-to="742"  742-->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="{{ asset('assets/risebothtml/assets/images/common/counter_22.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <p class="desc ">Ultimos sesiones <br> en línea</p>
                                    <div class="box-couter counter">
                                        <div class="number-content">
                                            <span class="count-number" data-speed="2000" data-inviewport="yes" id="total-en-linea">0</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            {{--
                            <div class="box">
                                <div class="image">
                                    <img src="{{ asset('assets/risebothtml/assets/images/common/counter_3.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <p class="desc">Raised Capital</p>
                                    <div class="box-couter counter">
                                        <div class="number-content">
                                            <span>$</span><span class="count-number" data-to="17" data-speed="2000" data-inviewport="yes">17</span><span>M</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="{{ asset('assets/risebothtml/assets/images/common/counter_4.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <p class="desc">Initial Market Cap</p>
                                    <div class="box-couter counter">
                                        <div class="number-content">
                                            <span>$</span><span class="count-number" data-to="32" data-speed="2000" data-inviewport="yes">32</span><span>M</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>--}}
                        </div>
                        <div class="char_wrapper">
                            <ul class="describe_chart" id="describe_chart_label"></ul>
                            <div class="chart_inner aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                                <div class="content_inner">
                                    <img class="stat_img" src="{{ asset('assets/front_images/logo_subir_verdader.png') }}" alt="logo"> {{-- $intitucion->intitucion_url_logo --}}
                                    <!-- <p style="color: #86FF00;">Totales por modalidad</p>-->
                                </div>
                                <div id="container" data-highcharts-chart="0" style="overflow: hidden;"><div id="highcharts-fg96f9y-0" style="position: relative; overflow: hidden; width: 490px; height: 490px; text-align: left; line-height: normal; z-index: 0; user-select: none; touch-action: manipulation; outline: none; left: 0.299988px; top: 0.216675px;" dir="ltr" class="highcharts-container "><svg version="1.1" class="highcharts-root" style="font-family: Helvetica, Arial, sans-serif; font-size: 1rem;" xmlns="http://www.w3.org/2000/svg" width="490" height="490" viewBox="0 0 490 490" role="img" aria-label=""><desc>Created with Highcharts 11.1.0</desc><defs><filter id="highcharts-drop-shadow-0"><feDropShadow dx="1" dy="1" flood-color="#000000" flood-opacity="0.75" stdDeviation="2.5"></feDropShadow></filter><clipPath id="highcharts-fg96f9y-8-"><rect x="0" y="0" width="470" height="465" fill="none"></rect></clipPath></defs><rect fill="none" class="highcharts-background" filter="none" x="0" y="0" width="490" height="490" rx="0" ry="0"></rect><rect fill="none" class="highcharts-plot-background" x="10" y="10" width="470" height="465" filter="none"></rect><rect fill="none" class="highcharts-plot-border" data-z-index="1" stroke="#cccccc" stroke-width="0" x="10" y="10" width="470" height="465"></rect><g class="highcharts-series-group" data-z-index="3" filter="none"><g class="highcharts-series highcharts-series-0 highcharts-pie-series highcharts-tracker" data-z-index="0.1" opacity="1" transform="translate(10,10) scale(1 1)" filter="none" style="cursor: pointer;" clip-path="none"><path fill="#ACE5F2" d="M 21.868022416482773 294.61690696854686 A 0.5 0.5 0 0 1 21.247777043961406 294.2757005735424 A 222.5 222.5 0 0 1 234.18982710490144 10.001475016394664 A 0.5 0.5 0 0 1 234.6916472358324 10.500777211782037 L 234.6916472358324 10.500777211782037 A 0.5 0.5 0 0 1 234.19346833139628 11.00146838710748 A 221.5 221.5 0 0 0 22.20846119207843 293.99805697545906 A 0.5 0.5 0 0 1 21.868022416482773 294.61690696854686 Z" class="highcharts-halo highcharts-color-6" data-z-index="-1" fill-opacity="0.25" visibility="hidden"></path><path fill="#AFC5FF" d="M 234.95529790751658 13.020506648746505 A 3 3 0 0 1 237.99568915980666 10.020167551173728 A 222.5 222.5 0 0 1 331.6051850827058 32.06624981022742 A 3 3 0 0 1 332.987065976894 36.10808341166427 L 295.92598124450785 110.38826915732513 A 3 3 0 0 1 291.9615242755957 111.76212378793171 A 133.5 133.5 0 0 0 237.906882068239 99.0316515549797 A 3 3 0 0 1 234.97220532300787 96.03297384548921 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-0"></path><path fill="#FDEBB3" d="M 333.1834088672214 36.206168657260065 A 3 3 0 0 1 337.24507618152006 34.883719302697244 A 222.5 222.5 0 0 1 426.4474382564125 119.12395144891886 A 3 3 0 0 1 425.35936760748496 123.2545828692187 L 353.360838187612 164.57384904526148 A 3 3 0 0 1 349.29907648949813 163.52195194376793 A 133.5 133.5 0 0 0 297.3304600147659 114.44423455693631 A 3 3 0 0 1 296.0480624920105 110.44925618427563 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-1"></path><path fill="#ACF2C4" d="M 425.4685178267323 123.44499682780362 A 3 3 0 0 1 429.5827458244129 124.5935357477045 A 222.5 222.5 0 0 1 456.72789948432757 251.01995114107842 A 3 3 0 0 1 453.4477659502237 253.75614149737186 L 370.8255230779781 245.7165532796427 A 3 3 0 0 1 368.1245050449902 242.50580614075594 A 133.5 133.5 0 0 0 352.2837555480471 168.7287628742712 A 3 3 0 0 1 353.4287051468316 164.69224382679494 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-2"></path><path fill="#CDBDF3" d="M 453.42640058839515 253.97457859884426 A 3 3 0 0 1 456.11418582350257 257.2944918804473 A 222.5 222.5 0 0 1 385.9246312111917 395.98701995499755 A 3 3 0 0 1 381.6577665085962 395.7873219901352 L 326.18824247448276 334.02809677333136 A 3 3 0 0 1 326.3669778165554 329.8361462390467 A 133.5 133.5 0 0 0 367.54027581972855 248.47890126480172 A 3 3 0 0 1 370.8122386141454 245.852372171807 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-3"></path><path fill="#E89F8E" d="M 381.49440588494343 395.9338980885466 A 3 3 0 0 1 381.23214590806094 400.19737476515127 A 222.5 222.5 0 0 1 177.03965770953556 447.31817595718525 A 3 3 0 0 1 174.9356720891001 443.60074967325886 L 197.6534575836122 363.7573265366202 A 3 3 0 0 1 201.2963170978989 361.67550758109917 A 133.5 133.5 0 0 0 321.8999319803678 333.84422441267907 A 3 3 0 0 1 326.08666880051334 334.11923423656367 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-4"></path><path fill="#6574EB" d="M 174.7246014067718 443.5405798049926 A 3 3 0 0 1 170.97671516805093 445.5898143960127 A 222.5 222.5 0 0 1 22.323575381421023 297.8833955332537 A 3 3 0 0 1 24.348823139897576 294.12249335635363 L 104.02220693557157 270.8153719017807 A 3 3 0 0 1 107.72462721212916 272.7893221798097 A 133.5 133.5 0 0 0 195.524654431867 360.0301811034411 A 3 3 0 0 1 197.5222189522215 363.71991437177047 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-5"></path><path fill="rgb(172,229,242)" d="M 24.287305982391302 293.911811403358 A 3 3 0 0 1 20.556513337741023 291.83161912617555 A 222.5 222.5 0 0 1 231.64998148553417 10.025220809295462 A 3 3 0 0 1 234.69514738059394 13.020713813625576 L 234.81045003453156 96.03310265558687 A 3 3 0 0 1 231.88055286406973 99.03645048341426 A 133.5 133.5 0 0 0 106.0424595260121 267.02828919740693 A 3 3 0 0 1 103.98395705894677 270.6843749728616 Z" transform="translate(0,0)" stroke="#ffffff" stroke-width="0" opacity="1" stroke-linejoin="round" class="highcharts-point highcharts-color-6"></path></g><g class="highcharts-markers highcharts-series-0 highcharts-pie-series" data-z-index="0.1" opacity="1" transform="translate(10,10) scale(1 1)" clip-path="none"></g></g><text x="245" text-anchor="middle" class="highcharts-title" data-z-index="4" style="font-size: 1.2em; color: rgb(51, 51, 51); font-weight: bold; fill: rgb(51, 51, 51);" y="25"></text><text x="245" text-anchor="middle" class="highcharts-subtitle" data-z-index="4" style="color: rgb(102, 102, 102); font-size: 0.8em; fill: rgb(102, 102, 102);" y="24"></text><text x="10" text-anchor="start" class="highcharts-caption" data-z-index="4" style="color: rgb(102, 102, 102); font-size: 0.8em; fill: rgb(102, 102, 102);" y="487"></text><g class="highcharts-data-labels highcharts-series-0 highcharts-pie-series highcharts-tracker" data-z-index="6" opacity="1" transform="translate(10,10) scale(1 1)" style="cursor: pointer;"><g class="highcharts-label highcharts-data-label highcharts-data-label-color-0" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(275,35)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-1" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(366,84)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-2" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(423,186)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-3" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(406,317)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-4" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(274,420)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-5" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(91,368)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g><g class="highcharts-label highcharts-data-label highcharts-data-label-color-6" data-z-index="1" style="cursor: pointer;" filter="none" transform="translate(72,109)" opacity="1"><text x="5" data-z-index="1" y="17" style="color: rgb(255, 255, 255); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; fill: rgb(255, 255, 255);"></text></g></g><g class="highcharts-legend highcharts-no-tooltip" data-z-index="7" visibility="hidden"><rect fill="none" class="highcharts-legend-box" rx="0" ry="0" stroke="#999999" stroke-width="0" filter="none" x="0" y="0" width="8" height="8"></rect><g data-z-index="1"><g></g></g></g><g class="highcharts-label highcharts-tooltip highcharts-color-6" style="cursor: default; pointer-events: none;" data-z-index="8" filter="url(#highcharts-drop-shadow-0)" transform="translate(115,60)" opacity="0" visibility="hidden"><path fill="#ffffff" class="highcharts-label-box highcharts-tooltip-box" d="M 3 0 L 68 0 A 3 3 0 0 1 71 3 L 71 40 A 3 3 0 0 1 68 43 L 3 43 A 3 3 0 0 1 0 40 L 0 3 A 3 3 0 0 1 3 0 Z" stroke-width="0" stroke="#ACE5F2"></path><text x="8" data-z-index="1" y="18" style="color: rgb(51, 51, 51); font-size: 0.8em; fill: rgb(51, 51, 51);"><tspan style="font-size: 0.8em;">Private Sale</tspan><tspan class="highcharts-br" dy="15" x="8">​</tspan><tspan style="font-weight: bold;">29.5%</tspan></text></g></svg></div></div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
@push('navi-js-front')
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const colorsUno = ['#6574EB', '#E89F8E', '#ACE5F2','#AFC5FF', '#FDEBB3', '#ACF2C4', '#CDBDF3'];
        const colorDos  = ['#6610f2', '#ffc107', '#198754', '#d63384', '#dc3545', '#0d6efd', '#0dcaf0'];
        const initChart = (() =>{
            fetch("{{ url('api/count_tipo_convocatoria') }}")
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    if(res.data.length > 0){
                        let dataChart = [];
                        let contador = 0;
                        const describeChart = document.querySelector('#describe_chart_label');
                        const labelTotal = document.querySelector('#total');
        	            describeChart.innerHTML = "";
                        total_est = 0;
                        res.data.forEach((elemento)=> {
                            let datoTMp = new Object();
                            datoTMp.name = elemento.modalidad;
                            datoTMp.color = colorsUno[contador];
                            datoTMp.y = elemento.total_inscritos;
                            dataChart.push(datoTMp);
                            total_est += elemento.total_inscritos;

                            // generar etiquetas
                            const li = document.createElement("li");
                            {   
                                // create canvas
                                li.appendChild(generateCanvaHexagon(colorsUno[contador]));
                            }
                            {
                                // create details
                                const descripcion = document.createElement("div");
                                descripcion.classList.add("desc");

                                const pName = document.createElement("p");
                                pName.classList.add("name", "text-plomo");
                                pName.innerText = elemento.modalidad;
                                descripcion.appendChild(pName);

                                const pPrice = document.createElement("p");
                                pPrice.classList.add("number");
                                pPrice.innerText = elemento.total_inscritos;
                                descripcion.appendChild(pPrice);

                                li.appendChild(descripcion);
                            } 
                            describeChart.appendChild(li);
                            contador++;
                        });
                        // dataChart.map(data => ({ name: data.name, y: data.y, color: data.color }))
                        labelTotal.innerText = total_est;
                        labelTotal.dataset.to = total_est;
                        
                        Highcharts.chart('container', {
                            chart: {
                                type: 'pie',
                                plotBackgroundColor: null,
                                backgroundColor: null,
                                width: 490,
                                height: 490,
                            },
                            title: {
                                text: '',
                            },
                            tooltip: {
                                pointFormat: '<b>{point.percentage:.1f}%</b> <br> <b>{point.y}</b> Estudiantes'
                            },
                            credits: {
                                enabled: false
                            },
                            accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                            },
                            plotOptions: {
                                pie: {
                                    states: {
                                        inactive: {
                                            opacity: 0.5
                                        }
                                    },
                                    borderWidth: 0,
                                    allowPointSelect: true,
                                    cursor: 'pointer', 
                                    dataLabels: {
                                        enabled: true,
                                        distance: -25,
                                        format: '',
                                        style: {
                                            fontSize: '12px',
                                            fontFamily: 'Helvetica, Arial, sans-serif',
                                            fontWeight: 'bold',
                                            color: '#fff',
                                            textOutline: 'none'
                                        },
                                        background: {
                                            enabled: false,
                                        },
                                        dropShadow: {
                                            enabled: false,
                                        }
                                    }, 
                                    showInLegend: false,
                                },
                            }, 
                            series: [{
                                type: 'pie',
                                innerSize: '60%',
                                data: dataChart
                                }]
                            });
                        }
                    }
                else {
                    console.log(res.error);
                }
             })
            .catch( err => console.error(err)); 
        });

        window.addEventListener('load', ()=> {
            initChart();
            initDataUser();
            initaLastUserOnline();
        });
        
        const generateCanvaHexagon = ((color) => {
        	const sizeCanva = 36;
        	const canva = document.createElement("canvas");
        	canva.width = sizeCanva;
        	canva.height = sizeCanva;
        	
        	const size = 14;
        	const ctx = canva.getContext('2d');
        	const x = canva.width / 2;
            const y = canva.height / 2;
            ctx.beginPath();
            ctx.moveTo(x + size * Math.cos(Math.PI / 3), y + size * Math.sin(Math.PI / 3));
            for (let i = 1; i <= 6; i++) {
                ctx.lineTo(x + size * Math.cos(i * Math.PI / 3), y + size * Math.sin(i * Math.PI / 3));
            }
            ctx.closePath();

            ctx.lineWidth = 8;
            ctx.strokeStyle = color;
            ctx.stroke();
            return canva;
		});

        const initDataUser = (()=> {
            fetch("{{ url('api/get_count_users') }}")
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    //console.log(res.data);
                    const labelTotalUsers = document.querySelector('#total-users');

                    labelTotalUsers.innerText = res.data.total;
                    labelTotalUsers.dataset.to = res.data.total;
                }
            })
            .catch( err => console.error(err)); 
        });

        const initaLastUserOnline = (() => {
            fetch("{{ url('api/get_lasts_user_online') }}")
            .then(res => res.json())
            .then(res => {
                if(res.success===true){
                    //console.log(res.data);
                    const labelTolaUserOnline = document.querySelector('#total-en-linea');

                    labelTolaUserOnline.innerText = res.data.total;
                    labelTolaUserOnline.dataset.to = res.data.total;
                }
            })
            .catch( err => console.error(err)); 
        });
        
    </script>
@endpush
