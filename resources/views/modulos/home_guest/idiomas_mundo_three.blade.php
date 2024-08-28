@push('navi-css-front')
    <style>	
		#canvas {
			width: 340px;
			height: 340px;
			border: solid red 1px;
			margin-left: auto;
			margin-right: auto;
		}

		@media only screen and (min-width: 640px){
            #canvas { 
				width: 550px;
				height: 550px;
                border-color: blue;
            }
        }
        @media only screen and (min-width: 768px){
            #canvas {
                border-color: yellow;
            }
        }
        @media only screen and (min-width: 1024px){
            #canvas {
                border-color: green;
            }
		}
	</style>
@endpush
    <canvas id="canvas"></canvas>
@push('navi-js-front')
    <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.139.2/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.139.2/examples/jsm/"
            }
        }
        {{-- {
			"imports": {
				"three": "{{ asset('assets/libs/three.js/build/three.module.js') }}",
				"three/addons/": "{{ asset('assets/libs/three.js/examples/jsm') }}"+"/"
			}
		} --}}
    </script>
    <script type="module">
	
    	//console.log('Loas sucees thre');
	    import * as THREE from 'three';
		import { TextureLoader } from 'three';
		import {OrbitControls} from 'three/addons/controls/OrbitControls.js';
		
		const canvas = document.querySelector('#canvas');
		let scene, renderer;
		let camera;
		let light
		
		let esferaConPuntos; 
		let materialEsfera;
		let texturaEsfera;
		let path_worlds = "{{ asset('') }}"+"assets/front_images/images_world/wolds/";
		let list_worlds = [
			"earth_black.jpg",
			"earth_blue.jpg",
			"earth_yellow.jpg",
			"earth_base.jpg"
		];
		//console.log(path_worlds);
		let texturesWorlds = [];
		let indiceWorlds = 0;
		let path_flags = "{{ asset('') }}" + "assets/front_images/images_world/flags/";
		let list_flags = [
		    {
		        idioma: "AYMARA",
		        src_name: "idioma_aymara.jpg"
		    },
		    {
		        idioma: "GUARANÍ",
		        src_name: "idioma_guarani.jpg"
		    },
		    {
		        idioma: "QUECHUA",
		        src_name: "idioma_quechua.jpg"
		    },
		    {
		        idioma: "INGLÉS",
		        src_name: "idioma_ingles.jpg"
		    },
		    {
		        idioma: "CHINO MANDARÍN",
		        src_name: "idioma_chino_mandarin.jpg"
		    },
		    {
		        idioma: "FRANCÉS",
		        src_name: "idioma_frances.jpg"
		    },
		    {
		        idioma: "PORTUGUÉS",
		        src_name: "idioma_portugues.jpg"
		    },
		    {
		        idioma: "ALEMÁN",
		        src_name: "idioma_aleman.jpg"
		    },
		];
		let flagsMesh = [];
		let logoMesh;
		let control;

		window.onload = function() {
			init();
			setTimeout(animate, 100);
		}
		
		function init(){
		    renderer = new THREE.WebGLRenderer({canvas, alpha: true, antialias: true});
		    renderer.setPixelRatio = window.devicePixelRatio;
		    renderer.setSize(canvas.clientWidth, canvas.clientHeight);
		
		    camera = new THREE.PerspectiveCamera(30, canvas.clientWidth/canvas.clientHeight, .1, 1000);
		    camera.position.z = -50;
		    //camera.position.x = 40;
		    camera.lookAt(0, 0, 0);
		
		    scene = new THREE.Scene();
		    scene.background = null; // new THREE.Color(0x333333); //0x999999
		    {
		        const color = 0xffffff;
		        const intensity = 1;
		        light = new THREE.AmbientLight(color, intensity);
		        light.position.set(-1, 2, 4);
		        scene.add(light);
		
		        /* const light2 = new THREE.DirectionalLight(color, intensity);
		        light2.position.set(1, -2, -4);
		        scene.add(light2); */
		    }
		    // Esfera con puntos
		    {
		        const radius = 10;
		        const widthSegments = 30; //12;
		        const heightSegments = 30; //8;
		        const geometry = new THREE.SphereGeometry(radius, widthSegments, heightSegments);
		
				texturaEsfera = new THREE.TextureLoader().load( path_worlds+"earth_base_prueba.png"); // earth_blue.jpg
				//texturaEsfera.mapping = THREE.EquirectangularReflectionMapping;
				
		        /*const material = new THREE.PointsMaterial({
		            color: 'black',
		            size: 1,
		            envMap: texturaEsfera,
		            transparent: true
		        });
		        material.needsUpdate = true;*/
		        
		        materialEsfera = new THREE.MeshPhongMaterial({
		            map: texturaEsfera
		        });
		        
		        //esferaConPuntos = new THREE.Points(geometry, material);
		        esferaConPuntos = new THREE.Mesh(geometry, materialEsfera);
		        addObjects(0, 0, esferaConPuntos);
		
		        // crea planegemotry base
		        const meshFlagGeomtry = new THREE.PlaneGeometry(8, 6.5);
		
		        list_flags.forEach(element_flag => {
		            const loader = new THREE.TextureLoader();
		            const texture = loader.load( path_flags+element_flag.src_name, (texture)=> {
						texture.wrapS = THREE.RepeatWrapping;
		    			texture.repeat.x = -1;
					});
		            texture.colorSpace = THREE.SRGBColorSpace;
		            const flag_material = new THREE.MeshBasicMaterial({map: texture, side: THREE.DoubleSide});
		            
		            const flag_mesh = new THREE.Mesh(meshFlagGeomtry, flag_material);
		            scene.add(flag_mesh);
		            flagsMesh.push(flag_mesh);
		        });
		        
		        const logoGeometry = new THREE.PlaneGeometry(11, 11);
		        const loader = new THREE.TextureLoader();
				
		        const logoTexture = loader.load( "{{ $intitucion->intitucion_url_banner2 }}", (texture)=> { // 'assets/front_images/images_world/logos/logo_departamento_idiomas.png'
					texture.wrapS = THREE.RepeatWrapping;
		    		texture.repeat.x = -1;
				});
				const logoMaterial = new THREE.MeshBasicMaterial({map: logoTexture, side: THREE.DoubleSide, transparent: true});
		    	logoMesh = new THREE.Mesh(logoGeometry, logoMaterial);
				scene.add(logoMesh);
				
		    }
		    
		    // texturas de tierra
		    /*{
		    	list_worlds.forEach(element_world => {
		    		const textureWo = new THREE.TextureLoader().load( path_worlds+element_world);
		    		texturesWorlds.push(textureWo);
		    	});
			}*/
		    control = new OrbitControls(camera, canvas);
		    control.enablePan = false;
		
			//control.minAzimuthAngle = -Math.PI / 4;
			//control.maxAzimuthAngle = Math.PI / 4;
			
			control.minDistance = 30; // Distancia mínima de zoom
			control.maxDistance = 80; // Distancia máxima de zoom
			//cambiaTextura();
			cambiaBrillo();
		}
		function animate(){
		    requestAnimationFrame(animate);
		    render();
		}
		
		function render(){
		    girarEsfera();
		    giraBanderas();
		    //console.log(control.position.x+', '+control.position.y+', '+control.position.z);
		    renderer.render(scene, camera);
		}
		
		function addObjects(x, y, mesh){
		    scene.add(mesh);
		    mesh.position.x = x;
		    mesh.position.y = y;
		}
		
		function girarEsfera(){
		    const time = .0001*Date.now();
		    esferaConPuntos.rotation.y = time;
		    //esferaConPuntos.rotation.x = time;
		}
		
		function giraBanderas(){
		    const msTime = performance.now();
		    const distance = 15;
		    const velocity = .00005;
		    const lookAtVector = new THREE.Vector3(0, 0, 0);
		    flagsMesh.forEach((mesh_element, index) => {   
		        const angle = (msTime * velocity) - (index * .6);
		
		        const planeX = Math.cos(angle) * distance;
		        const planeZ = Math.sin(angle) * distance;
		        mesh_element.position.set(planeX, 0, planeZ);
		        mesh_element.lookAt(lookAtVector);
		    });
		    const angleLogo = (msTime * velocity) + 1;
		    logoMesh.position.set(Math.cos(angleLogo) * distance, 0, Math.sin(angleLogo) * distance);
		    logoMesh.lookAt(lookAtVector);
		}
		
		function cambiaTextura(){
			indiceWorlds++;
			if(indiceWorlds >= texturesWorlds.length){
				indiceWorlds = 0;
			}
			materialEsfera.map = texturesWorlds[indiceWorlds];
			materialEsfera.needsUpdate = true;
			setTimeout(cambiaTextura, 3000);
		}
		
		function cambiaBrillo(){
			const hora = new Date().getHours();
			let intensity = 1;
			if(hora<=6 && hora>=19){
				intensity = .2;
			} else if(hora>8 && hora<=16){
				intensity = 1;
			} else if(hora==8 || hora==18){
				intensity = .7;
			} else {
				intensity = .4;
			}
			light.intensity = intensity;
			setTimeout(cambiaBrillo, 60000 * 10);
		}
	</script>
@endpush