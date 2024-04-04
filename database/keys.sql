--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beneficiario_grupos`
--
ALTER TABLE `beneficiario_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiario_grupos_grupo_id_foreign` (`grupo_id`),
  ADD KEY `beneficiario_grupos_id_persona_beneficiario_foreign` (`id_persona_beneficiario`);

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamentos_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupos_user_id_foreign` (`user_id`),
  ADD KEY `grupos_sede_id_foreign` (`sede_id`),
  ADD KEY `grupos_programa_id_foreign` (`programa_id`);

--
-- Indices de la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horario_grupos_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instituciones_barrio_id_foreign` (`barrio_id`),
  ADD KEY `corregimiento_id` (`corregimiento_id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_departamento_id_foreign` (`departamento_id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`,`tenantId`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `poblacional_beneficiarios`
--
ALTER TABLE `poblacional_beneficiarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba_max_insert`
--
ALTER TABLE `prueba_max_insert`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`,`tenantId`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institucion_id` (`institucion_id`);

--
-- Indices de la tabla `tbl_cm_colegios_x_equipamiento`
--
ALTER TABLE `tbl_cm_colegios_x_equipamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `tbl_cm_colegios_x_implementos`
--
ALTER TABLE `tbl_cm_colegios_x_implementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_colegios_x_implementos_implemento_id_foreign` (`implemento_id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `tbl_cm_config`
--
ALTER TABLE `tbl_cm_config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_criterios`
--
ALTER TABLE `tbl_cm_criterios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_criterios_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `tbl_cm_disciplinas`
--
ALTER TABLE `tbl_cm_disciplinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_empleado`
--
ALTER TABLE `tbl_cm_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_empleado_id_persona_foreign` (`id_persona`),
  ADD KEY `tbl_cm_empleado_id_usuario_foreign` (`id_usuario`),
  ADD KEY `tbl_cm_empleado_escolaridad_id_foreign` (`escolaridad_id`);

--
-- Indices de la tabla `tbl_cm_empleado_discapacidad`
--
ALTER TABLE `tbl_cm_empleado_discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_empleado_discapacidad_empleado_id_foreign` (`empleado_id`),
  ADD KEY `tbl_cm_empleado_discapacidad_discapacidad_id_foreign` (`discapacidad_id`);

--
-- Indices de la tabla `tbl_cm_empleado_x_disciplina`
--
ALTER TABLE `tbl_cm_empleado_x_disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_empleado_x_disciplina_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `tbl_cm_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_cm_empleado_x_grupo_poblacional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_empleado_x_grupo_poblacional_empleado_id_foreign` (`empleado_id`),
  ADD KEY `tbl_cm_empleado_x_grupo_poblacional_grupopoblacional_id_foreign` (`grupopoblacional_id`);

--
-- Indices de la tabla `tbl_cm_evaluaciones`
--
ALTER TABLE `tbl_cm_evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_evaluaciones_grupo_id_foreign` (`grupo_id`),
  ADD KEY `tbl_cm_evaluaciones_ficha_id_foreign` (`ficha_id`),
  ADD KEY `tbl_cm_evaluaciones_criterio_id_foreign` (`criterio_id`);

--
-- Indices de la tabla `tbl_cm_ficha`
--
ALTER TABLE `tbl_cm_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_ficha_id_persona_beneficiario_foreign` (`id_persona_beneficiario`),
  ADD KEY `tbl_cm_ficha_grupo_id_foreign` (`grupo_id`),
  ADD KEY `tbl_cm_ficha_modalidad_id_foreign` (`modalidad_id`),
  ADD KEY `tbl_cm_ficha_puntoatencion_id_foreign` (`puntoatencion_id`),
  ADD KEY `tbl_cm_ficha_escolaridad_id_foreign` (`escolaridad_id`),
  ADD KEY `tbl_cm_ficha_discapacidad_id_foreign` (`discapacidad_id`),
  ADD KEY `tbl_cm_ficha_salud_sgss_id_foreign` (`salud_sgss_id`),
  ADD KEY `tbl_cm_ficha_id_persona_acudiente_foreign` (`id_persona_acudiente`);

--
-- Indices de la tabla `tbl_cm_grados`
--
ALTER TABLE `tbl_cm_grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_grupo_poblacional`
--
ALTER TABLE `tbl_cm_grupo_poblacional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_implementos`
--
ALTER TABLE `tbl_cm_implementos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_cm_implementos_nombre_implemento_unique` (`nombre_implemento`);

--
-- Indices de la tabla `tbl_cm_messages`
--
ALTER TABLE `tbl_cm_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_modalidades`
--
ALTER TABLE `tbl_cm_modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cm_persona_x_discapacidad`
--
ALTER TABLE `tbl_cm_persona_x_discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_persona_x_discapacidad_ficha_id_foreign` (`ficha_id`),
  ADD KEY `tbl_cm_persona_x_discapacidad_discapacidad_id_foreign` (`discapacidad_id`);

--
-- Indices de la tabla `tbl_cm_punto_atencion`
--
ALTER TABLE `tbl_cm_punto_atencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_asistencias`
--
ALTER TABLE `tbl_dv_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_persona_beneficiario` (`id_persona_beneficiario`);

--
-- Indices de la tabla `tbl_dv_calificaciones_escala`
--
ALTER TABLE `tbl_dv_calificaciones_escala`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_clasificacion_implementos`
--
ALTER TABLE `tbl_dv_clasificacion_implementos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_config`
--
ALTER TABLE `tbl_dv_config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_contrato_proveedor`
--
ALTER TABLE `tbl_dv_contrato_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_deatalle_devolucion_estado`
--
ALTER TABLE `tbl_dv_deatalle_devolucion_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_deatalle_entrada`
--
ALTER TABLE `tbl_dv_deatalle_entrada`
  ADD PRIMARY KEY (`entrada_id`,`implemento_id`);

--
-- Indices de la tabla `tbl_dv_deatalle_inventario_fisico`
--
ALTER TABLE `tbl_dv_deatalle_inventario_fisico`
  ADD PRIMARY KEY (`inventario_id`,`implemento_id`);

--
-- Indices de la tabla `tbl_dv_devolucion_inventario`
--
ALTER TABLE `tbl_dv_devolucion_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_disciplinas`
--
ALTER TABLE `tbl_dv_disciplinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_ejes_tematicos`
--
ALTER TABLE `tbl_dv_ejes_tematicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_empleado`
--
ALTER TABLE `tbl_dv_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_ocupacion` (`id_ocupacion`),
  ADD KEY `id_tipo_afiliacion` (`id_tipo_afiliacion`),
  ADD KEY `id_eps` (`id_eps`),
  ADD KEY `id_institucion_educativa` (`id_institucion_educativa`),
  ADD KEY `id_escolaridad_nivel` (`id_escolaridad_nivel`),
  ADD KEY `id_estado_escolaridad` (`id_estado_escolaridad`),
  ADD KEY `id_presupuesto` (`id_presupuesto`),
  ADD KEY `id_etnia` (`id_etnia`);

--
-- Indices de la tabla `tbl_dv_empleado_cargo`
--
ALTER TABLE `tbl_dv_empleado_cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_empleado_x_comuna`
--
ALTER TABLE `tbl_dv_empleado_x_comuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ficha_empleado` (`id_ficha_empleado`),
  ADD KEY `id_comuna` (`id_comuna`);

--
-- Indices de la tabla `tbl_dv_empleado_x_discapacidad`
--
ALTER TABLE `tbl_dv_empleado_x_discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_discapacidad` (`id_discapacidad`);

--
-- Indices de la tabla `tbl_dv_empleado_x_disciplina`
--
ALTER TABLE `tbl_dv_empleado_x_disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Indices de la tabla `tbl_dv_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_dv_empleado_x_grupo_poblacional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ficha_empleado` (`id_ficha_empleado`),
  ADD KEY `id_gen_grupo_poblacional` (`id_gen_grupo_poblacional`);

--
-- Indices de la tabla `tbl_dv_entrada_inventario`
--
ALTER TABLE `tbl_dv_entrada_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_equipamento_tipo`
--
ALTER TABLE `tbl_dv_equipamento_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_escenarios`
--
ALTER TABLE `tbl_dv_escenarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_escenario_x_equipamiento`
--
ALTER TABLE `tbl_dv_escenario_x_equipamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_escenario` (`id_escenario`),
  ADD KEY `id_equipamiento` (`id_equipamiento`);

--
-- Indices de la tabla `tbl_dv_estado_aspirante`
--
ALTER TABLE `tbl_dv_estado_aspirante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_evaluaciones`
--
ALTER TABLE `tbl_dv_evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupos` (`id_grupo`),
  ADD KEY `fk_ev_evplazoyperiodo` (`id_evplazoyperiodo`);

--
-- Indices de la tabla `tbl_dv_evaluaciones_plazosyperiodos`
--
ALTER TABLE `tbl_dv_evaluaciones_plazosyperiodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_evaluaciones_resultados`
--
ALTER TABLE `tbl_dv_evaluaciones_resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evaluaciones` (`id_evaluacion`),
  ADD KEY `fk_beneficiarios` (`id_persona_beneficiario`),
  ADD KEY `fk_indicadores` (`id_indicador`),
  ADD KEY `fk_calificacion` (`id_calificacion`);

--
-- Indices de la tabla `tbl_dv_evplazosyperiodos_x_ejes`
--
ALTER TABLE `tbl_dv_evplazosyperiodos_x_ejes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evplazoyperiodo` (`id_evplazoyperiodo`),
  ADD KEY `fk_ejestematicos` (`id_eje`);

--
-- Indices de la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona_beneficiario` (`id_persona_beneficiario`),
  ADD KEY `id_escolaridad_nivel` (`id_escolaridad_nivel`),
  ADD KEY `id_escolaridad_estado` (`id_escolaridad_estado`),
  ADD KEY `id_etnia` (`id_etnia`),
  ADD KEY `id_persona_acudiente` (`id_persona_acudiente`),
  ADD KEY `id_persona_acudiente_parentesco` (`id_persona_acudiente_parentesco`),
  ADD KEY `id_salud_regimen` (`id_salud_regimen`),
  ADD KEY `id_eps` (`id_eps`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_ocupacion` (`id_ocupacion`);

--
-- Indices de la tabla `tbl_dv_grupos`
--
ALTER TABLE `tbl_dv_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_escenario` (`id_escenario`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_comuna_impacto` (`id_comuna_impacto`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `id_metodologo` (`id_metodologo`),
  ADD KEY `id_monitor` (`id_monitor`);

--
-- Indices de la tabla `tbl_dv_grupos_historico_evolucion`
--
ALTER TABLE `tbl_dv_grupos_historico_evolucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_grupos_horario`
--
ALTER TABLE `tbl_dv_grupos_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipamiento` (`id_equipamiento`);

--
-- Indices de la tabla `tbl_dv_grupos_horario_planificacion`
--
ALTER TABLE `tbl_dv_grupos_horario_planificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `tbl_dv_hoja_vida`
--
ALTER TABLE `tbl_dv_hoja_vida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hoja_vida_estado_contrato_new` (`id_hoja_vida_estado_contrato`),
  ADD KEY `id_usuario_new` (`id_usuario`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_estado_contrato`
--
ALTER TABLE `tbl_dv_hoja_vida_estado_contrato`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_estudio_no_formal`
--
ALTER TABLE `tbl_dv_hoja_vida_estudio_no_formal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_estudio_profesional`
--
ALTER TABLE `tbl_dv_hoja_vida_estudio_profesional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_experiencia`
--
ALTER TABLE `tbl_dv_hoja_vida_experiencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_experiencia_tipo`
--
ALTER TABLE `tbl_dv_hoja_vida_experiencia_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_hoja_vida_idiomas`
--
ALTER TABLE `tbl_dv_hoja_vida_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idioma` (`id_idioma`),
  ADD KEY `id_hoja_vida` (`id_hoja_vida`);

--
-- Indices de la tabla `tbl_dv_implementos`
--
ALTER TABLE `tbl_dv_implementos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_indicadores`
--
ALTER TABLE `tbl_dv_indicadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ejes` (`id_eje`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Indices de la tabla `tbl_dv_instituciones_educativas`
--
ALTER TABLE `tbl_dv_instituciones_educativas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_inventario_fisico`
--
ALTER TABLE `tbl_dv_inventario_fisico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_metodologos_x_monitores`
--
ALTER TABLE `tbl_dv_metodologos_x_monitores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_niveles`
--
ALTER TABLE `tbl_dv_niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_novedad`
--
ALTER TABLE `tbl_dv_novedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_novedad_tipo` (`id_novedad_tipo`),
  ADD KEY `id_usuario_monitor` (`id_usuario_monitor`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `tbl_dv_novedad_reporte`
--
ALTER TABLE `tbl_dv_novedad_reporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_novedad_tipo`
--
ALTER TABLE `tbl_dv_novedad_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_persona_x_ocupacion`
--
ALTER TABLE `tbl_dv_persona_x_ocupacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_prestamo_inventario`
--
ALTER TABLE `tbl_dv_prestamo_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_presupuesto`
--
ALTER TABLE `tbl_dv_presupuesto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_programas`
--
ALTER TABLE `tbl_dv_programas`
  ADD PRIMARY KEY (`id_programas`);

--
-- Indices de la tabla `tbl_dv_proveedores`
--
ALTER TABLE `tbl_dv_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_sedes`
--
ALTER TABLE `tbl_dv_sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_tipo_escenarios`
--
ALTER TABLE `tbl_dv_tipo_escenarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_zonas`
--
ALTER TABLE `tbl_dv_zonas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_empleado_disponibilidad`
--
ALTER TABLE `tbl_empleado_disponibilidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_asistencias`
--
ALTER TABLE `tbl_gen_asistencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_contrato`
--
ALTER TABLE `tbl_gen_contrato`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tbl_gen_contrato_fk1` (`id_persona`) USING BTREE;

--
-- Indices de la tabla `tbl_gen_contrato_cuenta_cobro`
--
ALTER TABLE `tbl_gen_contrato_cuenta_cobro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_gen_contrato_cuenta_cobro_fk1_new` (`id_contrato`);

--
-- Indices de la tabla `tbl_gen_contrato_cuenta_cobro_estado`
--
ALTER TABLE `tbl_gen_contrato_cuenta_cobro_estado`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tbl_gen_contrato_cuota`
--
ALTER TABLE `tbl_gen_contrato_cuota`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tbl_gen_corregimientos`
--
ALTER TABLE `tbl_gen_corregimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_discapacidad`
--
ALTER TABLE `tbl_gen_discapacidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_documento_tipo`
--
ALTER TABLE `tbl_gen_documento_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_eps`
--
ALTER TABLE `tbl_gen_eps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_regimen` (`id_regimen`);

--
-- Indices de la tabla `tbl_gen_error`
--
ALTER TABLE `tbl_gen_error`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_escolaridad_estado`
--
ALTER TABLE `tbl_gen_escolaridad_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_escolaridad_nivel`
--
ALTER TABLE `tbl_gen_escolaridad_nivel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_estado_civil`
--
ALTER TABLE `tbl_gen_estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_etnia`
--
ALTER TABLE `tbl_gen_etnia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_grupo_poblacional`
--
ALTER TABLE `tbl_gen_grupo_poblacional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_idiomas`
--
ALTER TABLE `tbl_gen_idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_ludotecas`
--
ALTER TABLE `tbl_gen_ludotecas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_lugares`
--
ALTER TABLE `tbl_gen_lugares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_gen_lugares_nombre_lugar_tenantid_unique` (`nombre_lugar`,`tenantId`),
  ADD KEY `tbl_gen_lugares_barrio_id_foreign` (`barrio_id`),
  ADD KEY `tbl_gen_lugares_comuna_id_foreign` (`comuna_id`);

--
-- Indices de la tabla `tbl_gen_metas`
--
ALTER TABLE `tbl_gen_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indice_unicos` (`nombre_meta`,`periodo`,`programa_id`),
  ADD KEY `tbl_gen_metas_programa_id_foreign` (`programa_id`);

--
-- Indices de la tabla `tbl_gen_ocupacion`
--
ALTER TABLE `tbl_gen_ocupacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_parentesco`
--
ALTER TABLE `tbl_gen_parentesco`
  ADD PRIMARY KEY (`id_persona_parentesco`);

--
-- Indices de la tabla `tbl_gen_persona`
--
ALTER TABLE `tbl_gen_persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_documento_tipo` (`id_documento_tipo`);

--
-- Indices de la tabla `tbl_gen_persona_x_grupo_poblacional`
--
ALTER TABLE `tbl_gen_persona_x_grupo_poblacional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_grupo_social` (`id_grupo_poblacional`);

--
-- Indices de la tabla `tbl_gen_salud_regimen`
--
ALTER TABLE `tbl_gen_salud_regimen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_titulos_academicos`
--
ALTER TABLE `tbl_gen_titulos_academicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_veredas`
--
ALTER TABLE `tbl_gen_veredas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_indicador_metas`
--
ALTER TABLE `tbl_indicador_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indice_unicos` (`meta_id`,`mes`);

--
-- Indices de la tabla `tbl_pr_adicionales`
--
ALTER TABLE `tbl_pr_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_adicionales_ficha_id_foreign` (`ficha_id`),
  ADD KEY `tbl_pr_adicionales_disciplina_id_foreign` (`disciplina_id`);

--
-- Indices de la tabla `tbl_pr_asistencias`
--
ALTER TABLE `tbl_pr_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_asistencias_grupo_id_foreign` (`grupo_id`),
  ADD KEY `tbl_pr_asistencias_ficha_id_foreign` (`ficha_id`);

--
-- Indices de la tabla `tbl_pr_disciplinas`
--
ALTER TABLE `tbl_pr_disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_pr_disciplinas_nombre_disciplina_tenantid_unique` (`nombre_disciplina`,`tenantId`);

--
-- Indices de la tabla `tbl_pr_ficha`
--
ALTER TABLE `tbl_pr_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_ficha_grupo_id_foreign` (`grupo_id`),
  ADD KEY `tbl_pr_ficha_comuna_id_foreign` (`comuna_id`),
  ADD KEY `id_persona_beneficiario` (`id_persona_beneficiario`),
  ADD KEY `id_persona_acudiente` (`id_persona_acudiente`),
  ADD KEY `escolaridad_id` (`escolaridad_id`),
  ADD KEY `estado_escolaridad` (`estado_escolaridad`),
  ADD KEY `tipo_afiliacion` (`tipo_afiliacion`),
  ADD KEY `salud_sgss_id` (`salud_sgss_id`);

--
-- Indices de la tabla `tbl_pr_grupos`
--
ALTER TABLE `tbl_pr_grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_pr_grupos_nombre_grupo_tenantid_unique` (`nombre_grupo`,`tenantId`),
  ADD KEY `tbl_pr_grupos_lugar_id_foreign` (`lugar_id`),
  ADD KEY `tbl_pr_grupos_disciplina_id_foreign` (`disciplina_id`),
  ADD KEY `tbl_pr_grupos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `tbl_pr_horario_grupos`
--
ALTER TABLE `tbl_pr_horario_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_horario_grupos_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `tbl_pr_lugares`
--
ALTER TABLE `tbl_pr_lugares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_pr_lugares_nombre_lugar_tenantid_unique` (`nombre_lugar`,`tenantId`),
  ADD KEY `tbl_pr_lugares_barrio_id_foreign` (`barrio_id`),
  ADD KEY `tbl_pr_lugares_comuna_id_foreign` (`comuna_id`);

--
-- Indices de la tabla `tbl_pr_persona_x_discapacidad`
--
ALTER TABLE `tbl_pr_persona_x_discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_persona_x_discapacidad_ficha_id_foreign` (`ficha_id`),
  ADD KEY `tbl_pr_persona_x_discapacidad_discapacidad_id_foreign` (`discapacidad_id`);

--
-- Indices de la tabla `tbl_pr_poblacional_beneficiarios`
--
ALTER TABLE `tbl_pr_poblacional_beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pr_poblacional_beneficiarios_ficha_id_foreign` (`ficha_id`);

--
-- Indices de la tabla `tipoescenarios`
--
ALTER TABLE `tipoescenarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `beneficiario_grupos`
--
ALTER TABLE `beneficiario_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `poblacional_beneficiarios`
--
ALTER TABLE `poblacional_beneficiarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prueba_max_insert`
--
ALTER TABLE `prueba_max_insert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_colegios_x_equipamiento`
--
ALTER TABLE `tbl_cm_colegios_x_equipamiento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_colegios_x_implementos`
--
ALTER TABLE `tbl_cm_colegios_x_implementos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_config`
--
ALTER TABLE `tbl_cm_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_criterios`
--
ALTER TABLE `tbl_cm_criterios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_disciplinas`
--
ALTER TABLE `tbl_cm_disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_empleado`
--
ALTER TABLE `tbl_cm_empleado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_empleado_discapacidad`
--
ALTER TABLE `tbl_cm_empleado_discapacidad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_empleado_x_disciplina`
--
ALTER TABLE `tbl_cm_empleado_x_disciplina`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_cm_empleado_x_grupo_poblacional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_evaluaciones`
--
ALTER TABLE `tbl_cm_evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_ficha`
--
ALTER TABLE `tbl_cm_ficha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_grados`
--
ALTER TABLE `tbl_cm_grados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_grupo_poblacional`
--
ALTER TABLE `tbl_cm_grupo_poblacional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_implementos`
--
ALTER TABLE `tbl_cm_implementos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_messages`
--
ALTER TABLE `tbl_cm_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_modalidades`
--
ALTER TABLE `tbl_cm_modalidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_persona_x_discapacidad`
--
ALTER TABLE `tbl_cm_persona_x_discapacidad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cm_punto_atencion`
--
ALTER TABLE `tbl_cm_punto_atencion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_asistencias`
--
ALTER TABLE `tbl_dv_asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_calificaciones_escala`
--
ALTER TABLE `tbl_dv_calificaciones_escala`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_clasificacion_implementos`
--
ALTER TABLE `tbl_dv_clasificacion_implementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_config`
--
ALTER TABLE `tbl_dv_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_contrato_proveedor`
--
ALTER TABLE `tbl_dv_contrato_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_deatalle_devolucion_estado`
--
ALTER TABLE `tbl_dv_deatalle_devolucion_estado`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_devolucion_inventario`
--
ALTER TABLE `tbl_dv_devolucion_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_disciplinas`
--
ALTER TABLE `tbl_dv_disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_ejes_tematicos`
--
ALTER TABLE `tbl_dv_ejes_tematicos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado`
--
ALTER TABLE `tbl_dv_empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado_cargo`
--
ALTER TABLE `tbl_dv_empleado_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado_x_comuna`
--
ALTER TABLE `tbl_dv_empleado_x_comuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado_x_discapacidad`
--
ALTER TABLE `tbl_dv_empleado_x_discapacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado_x_disciplina`
--
ALTER TABLE `tbl_dv_empleado_x_disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_dv_empleado_x_grupo_poblacional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_entrada_inventario`
--
ALTER TABLE `tbl_dv_entrada_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_equipamento_tipo`
--
ALTER TABLE `tbl_dv_equipamento_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_escenarios`
--
ALTER TABLE `tbl_dv_escenarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_escenario_x_equipamiento`
--
ALTER TABLE `tbl_dv_escenario_x_equipamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_estado_aspirante`
--
ALTER TABLE `tbl_dv_estado_aspirante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_evaluaciones`
--
ALTER TABLE `tbl_dv_evaluaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_evaluaciones_plazosyperiodos`
--
ALTER TABLE `tbl_dv_evaluaciones_plazosyperiodos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_evaluaciones_resultados`
--
ALTER TABLE `tbl_dv_evaluaciones_resultados`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_evplazosyperiodos_x_ejes`
--
ALTER TABLE `tbl_dv_evplazosyperiodos_x_ejes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_grupos`
--
ALTER TABLE `tbl_dv_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_grupos_historico_evolucion`
--
ALTER TABLE `tbl_dv_grupos_historico_evolucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_grupos_horario`
--
ALTER TABLE `tbl_dv_grupos_horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_grupos_horario_planificacion`
--
ALTER TABLE `tbl_dv_grupos_horario_planificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida`
--
ALTER TABLE `tbl_dv_hoja_vida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_estado_contrato`
--
ALTER TABLE `tbl_dv_hoja_vida_estado_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_estudio_no_formal`
--
ALTER TABLE `tbl_dv_hoja_vida_estudio_no_formal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_estudio_profesional`
--
ALTER TABLE `tbl_dv_hoja_vida_estudio_profesional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_experiencia`
--
ALTER TABLE `tbl_dv_hoja_vida_experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_experiencia_tipo`
--
ALTER TABLE `tbl_dv_hoja_vida_experiencia_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_hoja_vida_idiomas`
--
ALTER TABLE `tbl_dv_hoja_vida_idiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_implementos`
--
ALTER TABLE `tbl_dv_implementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_indicadores`
--
ALTER TABLE `tbl_dv_indicadores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_instituciones_educativas`
--
ALTER TABLE `tbl_dv_instituciones_educativas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_inventario_fisico`
--
ALTER TABLE `tbl_dv_inventario_fisico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_metodologos_x_monitores`
--
ALTER TABLE `tbl_dv_metodologos_x_monitores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_niveles`
--
ALTER TABLE `tbl_dv_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_novedad`
--
ALTER TABLE `tbl_dv_novedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_novedad_reporte`
--
ALTER TABLE `tbl_dv_novedad_reporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_novedad_tipo`
--
ALTER TABLE `tbl_dv_novedad_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_persona_x_ocupacion`
--
ALTER TABLE `tbl_dv_persona_x_ocupacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_prestamo_inventario`
--
ALTER TABLE `tbl_dv_prestamo_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_presupuesto`
--
ALTER TABLE `tbl_dv_presupuesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_programas`
--
ALTER TABLE `tbl_dv_programas`
  MODIFY `id_programas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_proveedores`
--
ALTER TABLE `tbl_dv_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_sedes`
--
ALTER TABLE `tbl_dv_sedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_tipo_escenarios`
--
ALTER TABLE `tbl_dv_tipo_escenarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_dv_zonas`
--
ALTER TABLE `tbl_dv_zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_empleado_disponibilidad`
--
ALTER TABLE `tbl_empleado_disponibilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_asistencias`
--
ALTER TABLE `tbl_gen_asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_contrato`
--
ALTER TABLE `tbl_gen_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_contrato_cuenta_cobro`
--
ALTER TABLE `tbl_gen_contrato_cuenta_cobro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_contrato_cuenta_cobro_estado`
--
ALTER TABLE `tbl_gen_contrato_cuenta_cobro_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_contrato_cuota`
--
ALTER TABLE `tbl_gen_contrato_cuota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_corregimientos`
--
ALTER TABLE `tbl_gen_corregimientos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_discapacidad`
--
ALTER TABLE `tbl_gen_discapacidad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_documento_tipo`
--
ALTER TABLE `tbl_gen_documento_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_eps`
--
ALTER TABLE `tbl_gen_eps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_error`
--
ALTER TABLE `tbl_gen_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_escolaridad_estado`
--
ALTER TABLE `tbl_gen_escolaridad_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_escolaridad_nivel`
--
ALTER TABLE `tbl_gen_escolaridad_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_estado_civil`
--
ALTER TABLE `tbl_gen_estado_civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_etnia`
--
ALTER TABLE `tbl_gen_etnia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_grupo_poblacional`
--
ALTER TABLE `tbl_gen_grupo_poblacional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_idiomas`
--
ALTER TABLE `tbl_gen_idiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_ludotecas`
--
ALTER TABLE `tbl_gen_ludotecas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_lugares`
--
ALTER TABLE `tbl_gen_lugares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_metas`
--
ALTER TABLE `tbl_gen_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_ocupacion`
--
ALTER TABLE `tbl_gen_ocupacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_parentesco`
--
ALTER TABLE `tbl_gen_parentesco`
  MODIFY `id_persona_parentesco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_persona`
--
ALTER TABLE `tbl_gen_persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_persona_x_grupo_poblacional`
--
ALTER TABLE `tbl_gen_persona_x_grupo_poblacional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_salud_regimen`
--
ALTER TABLE `tbl_gen_salud_regimen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_titulos_academicos`
--
ALTER TABLE `tbl_gen_titulos_academicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_gen_veredas`
--
ALTER TABLE `tbl_gen_veredas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_indicador_metas`
--
ALTER TABLE `tbl_indicador_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_adicionales`
--
ALTER TABLE `tbl_pr_adicionales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_asistencias`
--
ALTER TABLE `tbl_pr_asistencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_disciplinas`
--
ALTER TABLE `tbl_pr_disciplinas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_ficha`
--
ALTER TABLE `tbl_pr_ficha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_grupos`
--
ALTER TABLE `tbl_pr_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_horario_grupos`
--
ALTER TABLE `tbl_pr_horario_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_lugares`
--
ALTER TABLE `tbl_pr_lugares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_persona_x_discapacidad`
--
ALTER TABLE `tbl_pr_persona_x_discapacidad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pr_poblacional_beneficiarios`
--
ALTER TABLE `tbl_pr_poblacional_beneficiarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoescenarios`
--
ALTER TABLE `tipoescenarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiario_grupos`
--
ALTER TABLE `beneficiario_grupos`
  ADD CONSTRAINT `beneficiario_grupos_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_fk1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  ADD CONSTRAINT `horario_grupos_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_fk1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `sedes_ibfk_1` FOREIGN KEY (`institucion_id`) REFERENCES `instituciones` (`id`);

--
-- Filtros para la tabla `tbl_cm_colegios_x_equipamiento`
--
ALTER TABLE `tbl_cm_colegios_x_equipamiento`
  ADD CONSTRAINT `tbl_cm_colegios_x_equipamiento_ibfk_1` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`);

--
-- Filtros para la tabla `tbl_cm_colegios_x_implementos`
--
ALTER TABLE `tbl_cm_colegios_x_implementos`
  ADD CONSTRAINT `tbl_cm_colegios_x_implementos_ibfk_1` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `tbl_cm_colegios_x_implementos_implemento_id_foreign` FOREIGN KEY (`implemento_id`) REFERENCES `tbl_cm_implementos` (`id`);

--
-- Filtros para la tabla `tbl_cm_criterios`
--
ALTER TABLE `tbl_cm_criterios`
  ADD CONSTRAINT `tbl_cm_criterios_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `tbl_cm_empleado_discapacidad`
--
ALTER TABLE `tbl_cm_empleado_discapacidad`
  ADD CONSTRAINT `tbl_cm_empleado_discapacidad_discapacidad_id_foreign` FOREIGN KEY (`discapacidad_id`) REFERENCES `tbl_gen_discapacidad` (`id`),
  ADD CONSTRAINT `tbl_cm_empleado_discapacidad_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `tbl_cm_empleado` (`id`);

--
-- Filtros para la tabla `tbl_cm_empleado_x_disciplina`
--
ALTER TABLE `tbl_cm_empleado_x_disciplina`
  ADD CONSTRAINT `tbl_cm_empleado_x_disciplina_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `tbl_cm_empleado` (`id`);

--
-- Filtros para la tabla `tbl_cm_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_cm_empleado_x_grupo_poblacional`
  ADD CONSTRAINT `tbl_cm_empleado_x_grupo_poblacional_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `tbl_cm_empleado` (`id`),
  ADD CONSTRAINT `tbl_cm_empleado_x_grupo_poblacional_grupopoblacional_id_foreign` FOREIGN KEY (`grupopoblacional_id`) REFERENCES `tbl_cm_grupo_poblacional` (`id`);

--
-- Filtros para la tabla `tbl_cm_evaluaciones`
--
ALTER TABLE `tbl_cm_evaluaciones`
  ADD CONSTRAINT `tbl_cm_evaluaciones_criterio_id_foreign` FOREIGN KEY (`criterio_id`) REFERENCES `tbl_cm_criterios` (`id`),
  ADD CONSTRAINT `tbl_cm_evaluaciones_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_cm_ficha` (`id`),
  ADD CONSTRAINT `tbl_cm_evaluaciones_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `tbl_cm_persona_x_discapacidad`
--
ALTER TABLE `tbl_cm_persona_x_discapacidad`
  ADD CONSTRAINT `tbl_cm_persona_x_discapacidad_discapacidad_id_foreign` FOREIGN KEY (`discapacidad_id`) REFERENCES `tbl_gen_discapacidad` (`id`),
  ADD CONSTRAINT `tbl_cm_persona_x_discapacidad_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_cm_ficha` (`id`);

--
-- Filtros para la tabla `tbl_dv_asistencias`
--
ALTER TABLE `tbl_dv_asistencias`
  ADD CONSTRAINT `tbl_dv_asistencias_fk2` FOREIGN KEY (`id_persona_beneficiario`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_dv_empleado`
--
ALTER TABLE `tbl_dv_empleado`
  ADD CONSTRAINT `tbl_dv_empleado_fk1` FOREIGN KEY (`id_persona`) REFERENCES `tbl_gen_persona` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk2` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_dv_disciplinas` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk3` FOREIGN KEY (`id_ocupacion`) REFERENCES `tbl_gen_ocupacion` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk4` FOREIGN KEY (`id_tipo_afiliacion`) REFERENCES `tbl_gen_salud_regimen` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk5` FOREIGN KEY (`id_institucion_educativa`) REFERENCES `tbl_dv_instituciones_educativas` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk6` FOREIGN KEY (`id_escolaridad_nivel`) REFERENCES `tbl_gen_escolaridad_nivel` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk7` FOREIGN KEY (`id_estado_escolaridad`) REFERENCES `tbl_gen_escolaridad_estado` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk8` FOREIGN KEY (`id_presupuesto`) REFERENCES `tbl_dv_presupuesto` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_fk9` FOREIGN KEY (`id_etnia`) REFERENCES `tbl_gen_etnia` (`id`);

--
-- Filtros para la tabla `tbl_dv_empleado_x_comuna`
--
ALTER TABLE `tbl_dv_empleado_x_comuna`
  ADD CONSTRAINT `tbl_dv_empleado_x_comuna_fk1` FOREIGN KEY (`id_ficha_empleado`) REFERENCES `tbl_dv_empleado` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_x_comuna_fk2` FOREIGN KEY (`id_comuna`) REFERENCES `comunas` (`id`);

--
-- Filtros para la tabla `tbl_dv_empleado_x_discapacidad`
--
ALTER TABLE `tbl_dv_empleado_x_discapacidad`
  ADD CONSTRAINT `tbl_dv_empleado_x_discapacidad_fk1` FOREIGN KEY (`id_empleado`) REFERENCES `tbl_dv_empleado` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_x_discapacidad_fk2` FOREIGN KEY (`id_discapacidad`) REFERENCES `tbl_gen_discapacidad` (`id`);

--
-- Filtros para la tabla `tbl_dv_empleado_x_disciplina`
--
ALTER TABLE `tbl_dv_empleado_x_disciplina`
  ADD CONSTRAINT `tbl_dv_empleado_x_disciplina_fk1` FOREIGN KEY (`id_empleado`) REFERENCES `tbl_dv_empleado` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_x_disciplina_fk2` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_dv_disciplinas` (`id`);

--
-- Filtros para la tabla `tbl_dv_empleado_x_grupo_poblacional`
--
ALTER TABLE `tbl_dv_empleado_x_grupo_poblacional`
  ADD CONSTRAINT `tbl_dv_empleado_x_grupo_poblacional_fk1` FOREIGN KEY (`id_ficha_empleado`) REFERENCES `tbl_dv_empleado` (`id`),
  ADD CONSTRAINT `tbl_dv_empleado_x_grupo_poblacional_fk2` FOREIGN KEY (`id_gen_grupo_poblacional`) REFERENCES `tbl_gen_grupo_poblacional` (`id`);

--
-- Filtros para la tabla `tbl_dv_escenario_x_equipamiento`
--
ALTER TABLE `tbl_dv_escenario_x_equipamiento`
  ADD CONSTRAINT `tbl_dv_escenario_x_equipamiento_fk1` FOREIGN KEY (`id_escenario`) REFERENCES `tbl_dv_escenarios` (`id`),
  ADD CONSTRAINT `tbl_dv_escenario_x_equipamiento_fk2` FOREIGN KEY (`id_equipamiento`) REFERENCES `tbl_dv_equipamento_tipo` (`id`);

--
-- Filtros para la tabla `tbl_dv_evaluaciones`
--
ALTER TABLE `tbl_dv_evaluaciones`
  ADD CONSTRAINT `fk_ev_evplazoyperiodo` FOREIGN KEY (`id_evplazoyperiodo`) REFERENCES `tbl_dv_evaluaciones_plazosyperiodos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_dv_grupos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tbl_dv_evaluaciones_resultados`
--
ALTER TABLE `tbl_dv_evaluaciones_resultados`
  ADD CONSTRAINT `fk_beneficiarios` FOREIGN KEY (`id_persona_beneficiario`) REFERENCES `tbl_gen_persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificacion` FOREIGN KEY (`id_calificacion`) REFERENCES `tbl_dv_calificaciones_escala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluaciones` FOREIGN KEY (`id_evaluacion`) REFERENCES `tbl_dv_evaluaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_indicadores` FOREIGN KEY (`id_indicador`) REFERENCES `tbl_dv_indicadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_dv_evplazosyperiodos_x_ejes`
--
ALTER TABLE `tbl_dv_evplazosyperiodos_x_ejes`
  ADD CONSTRAINT `fk_ejestematicos` FOREIGN KEY (`id_eje`) REFERENCES `tbl_dv_ejes_tematicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evplazoyperiodo` FOREIGN KEY (`id_evplazoyperiodo`) REFERENCES `tbl_dv_evaluaciones_plazosyperiodos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  ADD CONSTRAINT `tbl_dv_ficha_fk1` FOREIGN KEY (`id_persona_beneficiario`) REFERENCES `tbl_gen_persona` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk2` FOREIGN KEY (`id_escolaridad_nivel`) REFERENCES `tbl_gen_escolaridad_nivel` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk3` FOREIGN KEY (`id_escolaridad_estado`) REFERENCES `tbl_gen_escolaridad_estado` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk4` FOREIGN KEY (`id_etnia`) REFERENCES `tbl_gen_etnia` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk5` FOREIGN KEY (`id_persona_acudiente`) REFERENCES `tbl_gen_persona` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk6` FOREIGN KEY (`id_salud_regimen`) REFERENCES `tbl_gen_salud_regimen` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk7` FOREIGN KEY (`id_eps`) REFERENCES `tbl_gen_eps` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk8` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_dv_grupos` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_fk9` FOREIGN KEY (`id_ocupacion`) REFERENCES `tbl_gen_ocupacion` (`id`);

--
-- Filtros para la tabla `tbl_dv_grupos`
--
ALTER TABLE `tbl_dv_grupos`
  ADD CONSTRAINT `tbl_dv_grupos_fk1` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_dv_disciplinas` (`id`),
  ADD CONSTRAINT `tbl_dv_grupos_fk2` FOREIGN KEY (`id_nivel`) REFERENCES `tbl_dv_niveles` (`id`),
  ADD CONSTRAINT `tbl_dv_grupos_fk3` FOREIGN KEY (`id_comuna_impacto`) REFERENCES `comunas` (`id`),
  ADD CONSTRAINT `tbl_dv_grupos_fk4` FOREIGN KEY (`id_metodologo`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_dv_grupos_fk5` FOREIGN KEY (`id_monitor`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbl_dv_grupos_horario`
--
ALTER TABLE `tbl_dv_grupos_horario`
  ADD CONSTRAINT `tbl_dv_grupos_horario_fk1` FOREIGN KEY (`id_equipamiento`) REFERENCES `tbl_dv_equipamento_tipo` (`id`);

--
-- Filtros para la tabla `tbl_dv_grupos_horario_planificacion`
--
ALTER TABLE `tbl_dv_grupos_horario_planificacion`
  ADD CONSTRAINT `tbl_dv_grupos_horario_planificacion_fk1` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_dv_grupos` (`id`);

--
-- Filtros para la tabla `tbl_dv_hoja_vida`
--
ALTER TABLE `tbl_dv_hoja_vida`
  ADD CONSTRAINT `tbl_dv_hoja_vida_fk1` FOREIGN KEY (`id_hoja_vida_estado_contrato`) REFERENCES `tbl_dv_hoja_vida_estado_contrato` (`id`);

--
-- Filtros para la tabla `tbl_dv_hoja_vida_idiomas`
--
ALTER TABLE `tbl_dv_hoja_vida_idiomas`
  ADD CONSTRAINT `tbl_dv_hoja_vida_idiomas_fk1` FOREIGN KEY (`id_idioma`) REFERENCES `tbl_gen_idiomas` (`id`),
  ADD CONSTRAINT `tbl_dv_hoja_vida_idiomas_fk2` FOREIGN KEY (`id_hoja_vida`) REFERENCES `tbl_dv_hoja_vida` (`id`);

--
-- Filtros para la tabla `tbl_dv_indicadores`
--
ALTER TABLE `tbl_dv_indicadores`
  ADD CONSTRAINT `fk_ejes` FOREIGN KEY (`id_eje`) REFERENCES `tbl_dv_ejes_tematicos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `id_disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_dv_disciplinas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `id_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `tbl_dv_niveles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tbl_dv_novedad`
--
ALTER TABLE `tbl_dv_novedad`
  ADD CONSTRAINT `tbl_dv_novedad_fk1` FOREIGN KEY (`id_novedad_tipo`) REFERENCES `tbl_dv_novedad_tipo` (`id`),
  ADD CONSTRAINT `tbl_dv_novedad_fk2` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_dv_grupos` (`id`),
  ADD CONSTRAINT `tbl_dv_novedad_fk3` FOREIGN KEY (`id_usuario_monitor`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbl_gen_contrato`
--
ALTER TABLE `tbl_gen_contrato`
  ADD CONSTRAINT `tbl_gen_contrato_fk1` FOREIGN KEY (`id_persona`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_gen_lugares`
--
ALTER TABLE `tbl_gen_lugares`
  ADD CONSTRAINT `tbl_gen_lugares_barrio_id_foreign` FOREIGN KEY (`barrio_id`) REFERENCES `barrios` (`id`),
  ADD CONSTRAINT `tbl_gen_lugares_comuna_id_foreign` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`);

--
-- Filtros para la tabla `tbl_gen_metas`
--
ALTER TABLE `tbl_gen_metas`
  ADD CONSTRAINT `tbl_gen_metas_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `tbl_indicador_metas`
--
ALTER TABLE `tbl_indicador_metas`
  ADD CONSTRAINT `tbl_indicador_metas_meta_id_foreign` FOREIGN KEY (`meta_id`) REFERENCES `tbl_gen_metas` (`id`);

--
-- Filtros para la tabla `tbl_pr_adicionales`
--
ALTER TABLE `tbl_pr_adicionales`
  ADD CONSTRAINT `tbl_pr_adicionales_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `tbl_dv_disciplinas` (`id`),
  ADD CONSTRAINT `tbl_pr_adicionales_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_pr_ficha` (`id`);

--
-- Filtros para la tabla `tbl_pr_asistencias`
--
ALTER TABLE `tbl_pr_asistencias`
  ADD CONSTRAINT `tbl_pr_asistencias_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_pr_ficha` (`id`),
  ADD CONSTRAINT `tbl_pr_asistencias_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `tbl_pr_grupos` (`id`);
COMMIT;
