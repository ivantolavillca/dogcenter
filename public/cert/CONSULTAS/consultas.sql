-- ver gestiones, materia
SELECT 
	siadi_planificar_asignaturas.id_planificar_asignatura,
    siadi_asignaturas.id_siadi_asignatura,
    siadi_asignaturas.sigla_asignatura,
    siadi_idiomas.nombre_idioma,
    siadi_nivel_idiomas.descripcion_nivel_idioma,
    siadi_convocatorias.periodo,
    siadi_gestions.nombre_gestion
FROM siadi_planificar_asignaturas
	INNER JOIN siadi_asignaturas ON(siadi_planificar_asignaturas.id_siadi_asignatura = siadi_asignaturas.id_siadi_asignatura)
    INNER JOIN siadi_idiomas ON(siadi_idiomas.id_idioma = siadi_asignaturas.id_idioma)
    INNER JOIN siadi_nivel_idiomas ON(siadi_nivel_idiomas.id_nivel_idioma = siadi_asignaturas.id_idioma)
    INNER JOIN siadi_convocatorias ON(siadi_convocatorias.id_siadi_convocatoria = siadi_planificar_asignaturas.id_siadi_convocatoria)
    INNER JOIN siadi_gestions ON(siadi_gestions.id_gestion = siadi_convocatorias.id_gestion);




-- sumatoria por carga horaria 
SELECT 
	siadi_notas.id_nota,
    siadi_notas.id_inscripcion AS id_inscripcion, 
    CONCAT(ci_persona, ' ', expedido_persona) AS ci,
    UPPER(CONCAT(CASE paterno_persona WHEN '' THEN '' ELSE concat(paterno_persona, ' ') END, CASE materno_persona WHEN '' THEN '' ELSE concat(materno_persona, ' ') END, nombres_persona)) AS nombres_persona,
    CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS idioma,
     CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion,
     siadi_gestions.nombre_gestion AS anio,
     siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante,
     
	 siadi_planificar_asignaturas.carga_horaria_planificar_asignartura carga,
     (
         SELECT SUM(pas2.carga_horaria_planificar_asignartura)
         FROM siadi_planificar_asignaturas pas2
         	INNER JOIN siadi_asignaturas sas2 ON(pas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
         	INNER JOIN siadi_idiomas sid2 ON(sid2.id_idioma = sas2.id_idioma)
         	INNER JOIN siadi_nivel_idiomas sni2 ON(sni2.id_nivel_idioma = sas2.id_nivel_idioma)
         
         	-- INNER JOIN siadi_convocatorias sco2 ON(sco2.id_siadi_convocatoria = pas2.id_siadi_convocatoria)
         	INNER JOIN siadi_inscripcions sin2 ON(sin2.id_planificar_asignatura = pas2.id_planificar_asignatura)
         WHERE 
         	siadi_idiomas.id_idioma = sid2.id_idioma
         	AND sni2.nombre_nivel_idioma <= siadi_nivel_idiomas.nombre_nivel_idioma
         	AND sin2.id_siadi_persona = siadi_inscripcions.id_siadi_persona
     ) AS sumatoria
FROM siadi_notas
	INNER JOIN siadi_inscripcions ON(siadi_inscripcions.id_inscripcion = siadi_notas.id_inscripcion)
    INNER JOIN siadi_personas ON(siadi_personas.id_siadi_persona = siadi_inscripcions.id_siadi_persona)
    INNER JOIN siadi_planificar_asignaturas ON(siadi_planificar_asignaturas.id_planificar_asignatura = siadi_inscripcions.id_planificar_asignatura)
    INNER JOIN siadi_asignaturas ON(siadi_asignaturas.id_siadi_asignatura = siadi_planificar_asignaturas.id_siadi_asignatura)
    INNER JOIN siadi_nivel_idiomas ON(siadi_nivel_idiomas.id_nivel_idioma = siadi_asignaturas.id_nivel_idioma)
    INNER JOIN siadi_idiomas ON(siadi_idiomas.id_idioma = siadi_asignaturas.id_idioma)
    INNER JOIN siadi_paralelos ON(siadi_paralelos.id_paralelo = siadi_planificar_asignaturas.id_paralelo)
    INNER JOIN siadi_convocatorias ON(siadi_convocatorias.id_siadi_convocatoria = siadi_planificar_asignaturas.id_siadi_convocatoria)
    INNER JOIN siadi_gestions ON(siadi_gestions.id_gestion = siadi_convocatorias.id_gestion)
    INNER JOIN siadi_tipo_convocatorias ON(siadi_tipo_convocatorias.id_tipo_convocatoria = siadi_convocatorias.id_tipo_convocatoria)
    INNER JOIN siadi_convocartoria_estudiantes ON(siadi_convocartoria_estudiantes.id_convocartoria_estudiante = siadi_tipo_convocatorias.id_convocartoria_estudiante)
    INNER JOIN siadi_costos ON(siadi_costos.id_costo = siadi_tipo_convocatorias.id_costo)
WHERE siadi_notas.final_nota >= 51
	AND ci_persona = '5678'
ORDER BY siadi_idiomas.id_idioma, siadi_nivel_idiomas.nombre_nivel_idioma





-- sumatoria por carga horaria por pares
SELECT 
	siadi_notas.id_nota,
    siadi_notas.id_inscripcion AS id_inscripcion, 
    CONCAT(ci_persona, ' ', expedido_persona) AS ci,
    UPPER(CONCAT(CASE paterno_persona WHEN '' THEN '' ELSE concat(paterno_persona, ' ') END, CASE materno_persona WHEN '' THEN '' ELSE concat(materno_persona, ' ') END, nombres_persona)) AS nombres_persona,
    CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS idioma,
     CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion,
     siadi_gestions.nombre_gestion AS anio,
     siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante,
     siadi_planificar_asignaturas.carga_horaria_planificar_asignartura carga_individual,
     CASE 
     	WHEN siadi_nivel_idiomas.nombre_nivel_idioma LIKE '1.1' AND siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante = 'TGN' THEN 0
     	WHEN siadi_nivel_idiomas.nombre_nivel_idioma LIKE '%.2' AND siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante = 'TGN' THEN
     (
         SELECT SUM(pas2.carga_horaria_planificar_asignartura)
         FROM siadi_planificar_asignaturas pas2
         	INNER JOIN siadi_asignaturas sas2 ON(pas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
         	INNER JOIN siadi_idiomas sid2 ON(sid2.id_idioma = sas2.id_idioma)
         	INNER JOIN siadi_nivel_idiomas sni2 ON(sni2.id_nivel_idioma = sas2.id_nivel_idioma)
         	INNER JOIN siadi_inscripcions sin2 ON(sin2.id_planificar_asignatura = pas2.id_planificar_asignatura)
         WHERE 
         	siadi_idiomas.id_idioma = sid2.id_idioma
         	AND sni2.nombre_nivel_idioma <= siadi_nivel_idiomas.nombre_nivel_idioma
         	AND sin2.id_siadi_persona = siadi_inscripcions.id_siadi_persona
     ) WHEN siadi_nivel_idiomas.nombre_nivel_idioma LIKE '%.1' AND siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante = 'TGN' THEN (
         SELECT SUM(pas2.carga_horaria_planificar_asignartura)
         FROM siadi_planificar_asignaturas pas2
         	INNER JOIN siadi_asignaturas sas2 ON(pas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
         	INNER JOIN siadi_idiomas sid2 ON(sid2.id_idioma = sas2.id_idioma)
         	INNER JOIN siadi_nivel_idiomas sni2 ON(sni2.id_nivel_idioma = sas2.id_nivel_idioma)
         	INNER JOIN siadi_inscripcions sin2 ON(sin2.id_planificar_asignatura = pas2.id_planificar_asignatura)
         WHERE 
         	siadi_idiomas.id_idioma = sid2.id_idioma
         	AND sni2.nombre_nivel_idioma < siadi_nivel_idiomas.nombre_nivel_idioma
         	AND sin2.id_siadi_persona = siadi_inscripcions.id_siadi_persona
     ) ELSE 
     	siadi_planificar_asignaturas.carga_horaria_planificar_asignartura 
     END sumatoria,
     CASE 
     	WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 9 THEN 'T'
        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(3, 7) THEN 'C'
        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(6, 8) THEN 'H'
        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 1 THEN 'A'
        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 5 THEN 'M'
        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 2 THEN 'E'
        ELSE ''
    END AS inicial
FROM siadi_notas
	INNER JOIN siadi_inscripcions ON(siadi_inscripcions.id_inscripcion = siadi_notas.id_inscripcion)
    INNER JOIN siadi_personas ON(siadi_personas.id_siadi_persona = siadi_inscripcions.id_siadi_persona)
    INNER JOIN siadi_planificar_asignaturas ON(siadi_planificar_asignaturas.id_planificar_asignatura = siadi_inscripcions.id_planificar_asignatura)
    INNER JOIN siadi_asignaturas ON(siadi_asignaturas.id_siadi_asignatura = siadi_planificar_asignaturas.id_siadi_asignatura)
    INNER JOIN siadi_nivel_idiomas ON(siadi_nivel_idiomas.id_nivel_idioma = siadi_asignaturas.id_nivel_idioma)
    INNER JOIN siadi_idiomas ON(siadi_idiomas.id_idioma = siadi_asignaturas.id_idioma)
    INNER JOIN siadi_paralelos ON(siadi_paralelos.id_paralelo = siadi_planificar_asignaturas.id_paralelo)
    INNER JOIN siadi_convocatorias ON(siadi_convocatorias.id_siadi_convocatoria = siadi_planificar_asignaturas.id_siadi_convocatoria)
    INNER JOIN siadi_gestions ON(siadi_gestions.id_gestion = siadi_convocatorias.id_gestion)
    INNER JOIN siadi_tipo_convocatorias ON(siadi_tipo_convocatorias.id_tipo_convocatoria = siadi_convocatorias.id_tipo_convocatoria)
    INNER JOIN siadi_convocartoria_estudiantes ON(siadi_convocartoria_estudiantes.id_convocartoria_estudiante = siadi_tipo_convocatorias.id_convocartoria_estudiante)
    INNER JOIN siadi_costos ON(siadi_costos.id_costo = siadi_tipo_convocatorias.id_costo)
WHERE siadi_notas.final_nota >= 51
	-- AND ci_persona = '5678'
ORDER BY siadi_idiomas.id_idioma, siadi_nivel_idiomas.nombre_nivel_idioma



-- AGRUPAR ESTUDIANTES INSCRITOS POR PERIODO - GESTION 
SELECT 
    CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion_literal,
    COUNT(siadi_inscripcions.id_inscripcion) total_inscritos,
    (
        SELECT 
			COUNT(sn.id_nota)
		FROM siadi_inscripcions si
    		INNER JOIN siadi_notas sn ON(sn.id_inscripcion = si.id_inscripcion)
    		INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
    		INNER JOIN siadi_convocatorias sc ON(sc.id_siadi_convocatoria = spa.id_siadi_convocatoria)
    		INNER JOIN siadi_gestions sg ON(sc.id_gestion = sc.id_gestion)
		WHERE 
			CONCAT(sc.periodo, '-', sg.nombre_gestion) = gestion_literal
    	AND sn.observacion_nota = 'APROBADO'
    ) AS aprobados,
    (
        SELECT 
			COUNT(sn.id_nota)
		FROM siadi_inscripcions si
    		INNER JOIN siadi_notas sn ON(sn.id_inscripcion = si.id_inscripcion)
    		INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
    		INNER JOIN siadi_convocatorias sc ON(sc.id_siadi_convocatoria = spa.id_siadi_convocatoria)
    		INNER JOIN siadi_gestions sg ON(sc.id_gestion = sc.id_gestion)
		WHERE 
			CONCAT(sc.periodo, '-', sg.nombre_gestion) = gestion_literal
    	AND sn.observacion_nota = 'REPROBADO'
    ) AS reprobados,
    (
        SELECT 
			COUNT(sn.id_nota)
		FROM siadi_inscripcions si
    		INNER JOIN siadi_notas sn ON(sn.id_inscripcion = si.id_inscripcion)
    		INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
    		INNER JOIN siadi_convocatorias sc ON(sc.id_siadi_convocatoria = spa.id_siadi_convocatoria)
    		INNER JOIN siadi_gestions sg ON(sc.id_gestion = sc.id_gestion)
		WHERE 
			CONCAT(sc.periodo, '-', sg.nombre_gestion) = gestion_literal
    	AND sn.observacion_nota = 'NO SE PRESENTO'
    ) AS no_presentes,
    (
        SELECT 
			COUNT(sn.id_nota)
		FROM siadi_inscripcions si
    		INNER JOIN siadi_notas sn ON(sn.id_inscripcion = si.id_inscripcion)
    		INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
    		INNER JOIN siadi_convocatorias sc ON(sc.id_siadi_convocatoria = spa.id_siadi_convocatoria)
    		INNER JOIN siadi_gestions sg ON(sc.id_gestion = sc.id_gestion)
		WHERE 
			CONCAT(sc.periodo, '-', sg.nombre_gestion) = gestion_literal
    	AND sn.observacion_nota = 'NO ASIGNADO'
    ) AS no_asignados
FROM siadi_inscripcions 
	INNER JOIN siadi_notas ON (siadi_notas.id_inscripcion = siadi_inscripcions.id_inscripcion)
    INNER JOIN siadi_planificar_asignaturas ON(siadi_planificar_asignaturas.id_planificar_asignatura = siadi_inscripcions.id_planificar_asignatura)
    INNER JOIN siadi_convocatorias ON(siadi_convocatorias.id_siadi_convocatoria = siadi_planificar_asignaturas.id_siadi_convocatoria)
    INNER JOIN siadi_gestions ON(siadi_gestions.id_gestion = siadi_convocatorias.id_gestion)
GROUP BY gestion_literal;