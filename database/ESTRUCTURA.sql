DROP DATABASE IF EXISTS `sider_unificada_produccion`;
CREATE DATABASE IF NOT EXISTS `sider_unificada_produccion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sider_unificada_produccion`;



--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre_barrio` varchar(2000) CHARACTER SET latin1 NOT NULL,
  `id_barrio_tipo` int(11) DEFAULT NULL,
  `comuna_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_estrato` int(11) DEFAULT NULL,
  `codigo` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=146 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario_grupos`
--

CREATE TABLE `beneficiario_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `id_persona_beneficiario` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inscripcion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clubes_deportivos`
--

CREATE TABLE `clubes_deportivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_club` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `id` int(11) UNSIGNED NOT NULL,
  `path` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `codigo_comuna` varchar(191) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `nombre_comuna` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_departamento` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios`
--

CREATE TABLE `escenarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipoescenario_id` int(10) UNSIGNED NOT NULL,
  `nombre_escenario` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo_grupo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `observaciones` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `programa_id` int(10) UNSIGNED DEFAULT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_grupos`
--

CREATE TABLE `horario_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED NOT NULL,
  `dia` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_institucion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_dane` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_rector` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barrio_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `corregimiento_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_tax` int(11) NOT NULL,
  `item_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_municipio` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `cod_municipio` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `iso` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_pais` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacional_beneficiarios`
--

CREATE TABLE `poblacional_beneficiarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `grupo_pcs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_programa` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_programa` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba_max_insert`
--

CREATE TABLE `prueba_max_insert` (
  `id` int(11) NOT NULL,
  `valor_aleatorio` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(10) UNSIGNED NOT NULL,
  `institucion_id` int(10) UNSIGNED NOT NULL,
  `nombre_sede` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_sede` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_sede` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `sin_planificacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `sin_planificacion` (
`id` int(11)
,`monitor_documento` varchar(191)
,`monitor_nombre` text
,`codigo_grupo` varchar(10)
,`dia` varchar(20)
,`fecha` date
,`hora_inicio` time
,`hora_fin` time
,`nombre_escenario` varchar(191)
,`eje_tematico` text
,`tema` text
,`objetivo` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_colegios_x_equipamiento`
--

CREATE TABLE `tbl_cm_colegios_x_equipamiento` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED DEFAULT NULL,
  `equipamiento_id` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_colegios_x_implementos`
--

CREATE TABLE `tbl_cm_colegios_x_implementos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `implemento_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_config`
--

CREATE TABLE `tbl_cm_config` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `value` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_criterios`
--

CREATE TABLE `tbl_cm_criterios` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `nombre_criterio` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_disciplinas`
--

CREATE TABLE `tbl_cm_disciplinas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_empleado`
--

CREATE TABLE `tbl_cm_empleado` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `hijos_beneficiario` int(11) DEFAULT NULL,
  `cantidad_hijos_beneficiario` int(11) DEFAULT NULL,
  `ocupacion_beneficiario` int(11) DEFAULT NULL,
  `escolaridad_id` int(10) UNSIGNED DEFAULT NULL,
  `estado_escolaridad` int(11) DEFAULT NULL,
  `titulo_obtenido` int(11) DEFAULT NULL,
  `universidad_id` int(10) UNSIGNED DEFAULT NULL,
  `ocupacion_id` int(10) UNSIGNED DEFAULT NULL,
  `hijos_empleado` int(11) DEFAULT NULL,
  `cantidad_hijos` int(11) DEFAULT NULL,
  `etnia_id` int(10) UNSIGNED DEFAULT NULL,
  `enfermedad_permanente` int(11) DEFAULT NULL,
  `otra_enfermedad` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medicamentos` int(11) DEFAULT NULL,
  `otros_medicamentos` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_sangre` int(11) DEFAULT NULL,
  `condicion_discapacidad` int(11) DEFAULT NULL,
  `afiliacion_salud` int(11) DEFAULT NULL,
  `tipoafiliacion_id` int(10) UNSIGNED DEFAULT NULL,
  `eps_id` int(10) UNSIGNED DEFAULT NULL,
  `libreta_militar` int(11) DEFAULT NULL,
  `no_libreta` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito_militar` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype_empleado` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `proyecto_profesional` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `otro_poblacional` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_empleado_discapacidad`
--

CREATE TABLE `tbl_cm_empleado_discapacidad` (
  `id` int(10) UNSIGNED NOT NULL,
  `empleado_id` int(10) UNSIGNED DEFAULT NULL,
  `discapacidad_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_empleado_x_disciplina`
--

CREATE TABLE `tbl_cm_empleado_x_disciplina` (
  `id` int(10) UNSIGNED NOT NULL,
  `empleado_id` int(10) UNSIGNED DEFAULT NULL,
  `disciplina_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_empleado_x_grupo_poblacional`
--

CREATE TABLE `tbl_cm_empleado_x_grupo_poblacional` (
  `id` int(10) UNSIGNED NOT NULL,
  `empleado_id` int(10) UNSIGNED DEFAULT NULL,
  `grupopoblacional_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_evaluaciones`
--

CREATE TABLE `tbl_cm_evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `ficha_id` int(10) UNSIGNED DEFAULT NULL,
  `criterio_id` int(10) UNSIGNED DEFAULT NULL,
  `valor_evaluacion` int(11) NOT NULL,
  `fecha_evaluacion` date NOT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_ficha`
--

CREATE TABLE `tbl_cm_ficha` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_persona_beneficiario` int(10) UNSIGNED DEFAULT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `no_ficha` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modalidad_id` int(10) UNSIGNED DEFAULT NULL,
  `puntoatencion_id` int(10) UNSIGNED DEFAULT NULL,
  `hijos_beneficiario` int(11) DEFAULT NULL,
  `cantidad_hijos_beneficiario` int(11) DEFAULT NULL,
  `ocupacion_beneficiario` int(11) DEFAULT NULL,
  `escolaridad_id` int(10) UNSIGNED DEFAULT NULL,
  `estado_escolaridad` int(11) DEFAULT NULL,
  `cultura_beneficiario` int(11) DEFAULT NULL,
  `discapacidad_beneficiario` int(11) DEFAULT NULL,
  `discapacidad_id` int(10) UNSIGNED DEFAULT NULL,
  `otra_discapacidad_beneficiario` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medicamentos_permanente_beneficiario` int(11) DEFAULT NULL,
  `medicamentos_beneficiario` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `condicion_discapacidad` int(11) DEFAULT NULL,
  `afiliacion_salud` int(11) DEFAULT NULL,
  `tipo_afiliacion` int(11) DEFAULT NULL,
  `salud_sgss_id` int(10) UNSIGNED DEFAULT NULL,
  `id_persona_acudiente` int(10) UNSIGNED DEFAULT NULL,
  `parentesco_acudiente` int(11) DEFAULT NULL,
  `otro_parentesco_acudiente` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `otro_poblacional` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comuna_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_grados`
--

CREATE TABLE `tbl_cm_grados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_grado` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_grupo_poblacional`
--

CREATE TABLE `tbl_cm_grupo_poblacional` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_implementos`
--

CREATE TABLE `tbl_cm_implementos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_implemento` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_messages`
--

CREATE TABLE `tbl_cm_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `recipient_id` int(10) UNSIGNED NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_modalidades`
--

CREATE TABLE `tbl_cm_modalidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_persona_x_discapacidad`
--

CREATE TABLE `tbl_cm_persona_x_discapacidad` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED DEFAULT NULL,
  `discapacidad_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_punto_atencion`
--

CREATE TABLE `tbl_cm_punto_atencion` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_asistencias`
--

CREATE TABLE `tbl_dv_asistencias` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_persona_beneficiario` int(11) NOT NULL,
  `fecha_asistencia` date DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `siasistio` int(11) NOT NULL COMMENT '1=Si asistio\r\n0=No asistio',
  `observacion` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_calificaciones_escala`
--

CREATE TABLE `tbl_dv_calificaciones_escala` (
  `id` int(10) NOT NULL,
  `tipo` varchar(12) CHARACTER SET latin1 NOT NULL,
  `numero` int(10) NOT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_clasificacion_implementos`
--

CREATE TABLE `tbl_dv_clasificacion_implementos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_config`
--

CREATE TABLE `tbl_dv_config` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `value` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_contrato_proveedor`
--

CREATE TABLE `tbl_dv_contrato_proveedor` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `no` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_dados_de_baja`
--

CREATE TABLE `tbl_dv_dados_de_baja` (
  `devolucion_id` int(11) NOT NULL,
  `dano` int(11) DEFAULT NULL,
  `perdida_robo` int(11) DEFAULT NULL,
  `entregado_comunidad` int(11) DEFAULT NULL,
  `implemento_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_deatalle_devolucion`
--

CREATE TABLE `tbl_dv_deatalle_devolucion` (
  `devolucion_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_deatalle_prestamo_devolucion_estado` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_deatalle_devolucion_estado`
--

CREATE TABLE `tbl_dv_deatalle_devolucion_estado` (
  `id` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_deatalle_entrada`
--

CREATE TABLE `tbl_dv_deatalle_entrada` (
  `entrada_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_deatalle_inventario_fisico`
--

CREATE TABLE `tbl_dv_deatalle_inventario_fisico` (
  `inventario_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `enbodega` int(11) NOT NULL,
  `enfisico` int(11) NOT NULL,
  `diferencia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_deatalle_prestamo`
--

CREATE TABLE `tbl_dv_deatalle_prestamo` (
  `prestamo_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_devolucion_inventario`
--

CREATE TABLE `tbl_dv_devolucion_inventario` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `contratista_user_id` int(11) NOT NULL,
  `comuna_id` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '0 = PENDIENTE , 1 = DEVULETO, 2 = CANCELADO',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_disciplinas`
--

CREATE TABLE `tbl_dv_disciplinas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `activo` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=528 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_ejes_tematicos`
--

CREATE TABLE `tbl_dv_ejes_tematicos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado`
--

CREATE TABLE `tbl_dv_empleado` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado_aspirante` int(11) NOT NULL DEFAULT 1,
  `tiene_hijos` int(1) DEFAULT NULL COMMENT '0: No, 1: Si',
  `cuantos_hijos` int(1) DEFAULT NULL,
  `libreta_militar` varchar(20) DEFAULT NULL,
  `no_libreta_militar` varchar(250) DEFAULT NULL,
  `distrito_militar` varchar(250) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `id_disponibilidad` int(1) DEFAULT NULL COMMENT '1. Total 2. Parcial',
  `foto` varchar(100) DEFAULT NULL COMMENT 'Nombre del Archivo adjunto (Ej:  nombreafotomd5.jpg  )',
  `profesion` varchar(100) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `id_ocupacion` int(2) DEFAULT NULL,
  `tiene_discapacidad` int(1) DEFAULT NULL COMMENT '0: No, 1: Si',
  `padece_enfermedad` int(1) DEFAULT NULL COMMENT '0: No, 1: Si',
  `enfermedad` varchar(255) DEFAULT NULL,
  `toma_medicamentos` int(11) DEFAULT NULL COMMENT '0: No, 1: Si',
  `medicamentos` varchar(255) DEFAULT NULL,
  `afiliado_sgsss` int(11) DEFAULT NULL COMMENT '0: No, 1: Si',
  `id_tipo_afiliacion` int(11) DEFAULT NULL COMMENT '1: Regimen contributivo (EPS), 2: Regimen subcidiado (SISBEN), 3: Especial (FFMM, Policia)',
  `id_eps` varchar(255) DEFAULT NULL,
  `proyecto_profesional` text DEFAULT NULL COMMENT 'Descripcion donde el usuario escribe su proyecto profesional hacia el futuro..',
  `id_cargo` int(11) DEFAULT NULL COMMENT 'FK Tabla Cargos',
  `id_escolaridad_nivel` int(11) DEFAULT NULL COMMENT '1: Bachiller, 2: T?cnico, 3: Tecnol?gico, 4: Universitario, 5: Postgrado, 6: Maestria, 7:  Curso, 8: Diplomado, 9: Certificado DUNT, 10: Otro',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_etnia` int(11) DEFAULT NULL,
  `id_institucion_educativa` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT 1 COMMENT '1=no activo\r\n0=no activo',
  `id_presupuesto` int(1) DEFAULT NULL,
  `id_estado_escolaridad` int(11) DEFAULT NULL,
  `nuevo` int(11) DEFAULT 1 COMMENT '1=nuevo\r\n0=actualizado'
) ENGINE=InnoDB AVG_ROW_LENGTH=180 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado_cargo`
--

CREATE TABLE `tbl_dv_empleado_cargo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=1092 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado_x_comuna`
--

CREATE TABLE `tbl_dv_empleado_x_comuna` (
  `id` int(11) NOT NULL,
  `id_ficha_empleado` int(11) DEFAULT NULL,
  `id_comuna` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=37 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado_x_discapacidad`
--

CREATE TABLE `tbl_dv_empleado_x_discapacidad` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL COMMENT 'Este campo es de la tabla tbl_dv_empleado o la misma ficha dub del empleado',
  `id_discapacidad` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado_x_disciplina`
--

CREATE TABLE `tbl_dv_empleado_x_disciplina` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_empleado_x_grupo_poblacional`
--

CREATE TABLE `tbl_dv_empleado_x_grupo_poblacional` (
  `id` int(11) NOT NULL,
  `id_ficha_empleado` int(11) NOT NULL,
  `id_gen_grupo_poblacional` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_entrada_inventario`
--

CREATE TABLE `tbl_dv_entrada_inventario` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_equipamento_tipo`
--

CREATE TABLE `tbl_dv_equipamento_tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=606 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_escenarios`
--

CREATE TABLE `tbl_dv_escenarios` (
  `id` int(11) NOT NULL,
  `tipoescenario_id` int(10) NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion_complemento` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `id_corregimiento` int(11) DEFAULT NULL,
  `id_vereda` int(11) DEFAULT NULL,
  `id_barrio` int(10) DEFAULT NULL,
  `nombre_escenario` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` int(11) DEFAULT 1 COMMENT '1=activo\r\n0=eliminado',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=162 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_escenario_x_equipamiento`
--

CREATE TABLE `tbl_dv_escenario_x_equipamiento` (
  `id` int(11) NOT NULL,
  `id_escenario` int(11) NOT NULL,
  `id_equipamiento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_estado_aspirante`
--

CREATE TABLE `tbl_dv_estado_aspirante` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) NOT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_evaluaciones`
--

CREATE TABLE `tbl_dv_evaluaciones` (
  `id` int(10) NOT NULL,
  `id_grupo` int(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  `id_evplazoyperiodo` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_evaluaciones_plazosyperiodos`
--

CREATE TABLE `tbl_dv_evaluaciones_plazosyperiodos` (
  `id` int(10) NOT NULL,
  `tipo` varchar(12) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `plazo_inicial` date NOT NULL,
  `plazo_final` date NOT NULL,
  `periodo_inicial` date NOT NULL,
  `periodo_final` date NOT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_evaluaciones_resultados`
--

CREATE TABLE `tbl_dv_evaluaciones_resultados` (
  `id` int(10) NOT NULL,
  `id_evaluacion` int(10) NOT NULL,
  `id_persona_beneficiario` int(10) NOT NULL,
  `id_indicador` int(10) NOT NULL,
  `id_calificacion` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_evplazosyperiodos_x_ejes`
--

CREATE TABLE `tbl_dv_evplazosyperiodos_x_ejes` (
  `id` int(10) NOT NULL,
  `id_evplazoyperiodo` int(10) DEFAULT NULL,
  `id_eje` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_ficha`
--

CREATE TABLE `tbl_dv_ficha` (
  `id` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_persona_beneficiario` int(11) DEFAULT NULL,
  `id_escolaridad_nivel` int(11) DEFAULT NULL,
  `id_escolaridad_estado` int(11) DEFAULT NULL,
  `id_etnia` int(11) DEFAULT NULL,
  `id_persona_acudiente` int(11) DEFAULT NULL,
  `id_persona_acudiente_parentesco` int(11) DEFAULT NULL,
  `id_persona_vive_con_parentesco` int(11) DEFAULT NULL,
  `enfermedad_padece_si` enum('si','no') CHARACTER SET latin1 DEFAULT NULL,
  `enfermedad_padece_nombre` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `medicamentos_toma_si` enum('si','no') CHARACTER SET latin1 DEFAULT NULL,
  `medicamentos_toma_nombre` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `salud_afiliado` enum('si','no') CHARACTER SET latin1 DEFAULT NULL,
  `id_salud_regimen` int(11) DEFAULT NULL,
  `id_eps` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL COMMENT 'Campo nuevo, agregar al modelo',
  `grupo_poblacional_otro` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `participacion_anterior_meses` int(11) DEFAULT NULL,
  `participacion_anterior_annos` int(11) DEFAULT NULL,
  `persona_vive_con_parentesco_otro` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `persona_acudiente_parentesco_otro` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `se_reconoce_como_cual` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `id_ocupacion` int(11) DEFAULT NULL,
  `tiene_discapacidad` int(11) DEFAULT 0 COMMENT '0=no\r\n1=si',
  `toma_medicamentos` int(11) DEFAULT NULL,
  `vinculado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_grupos`
--

CREATE TABLE `tbl_dv_grupos` (
  `id` int(11) NOT NULL,
  `id_escenario` int(11) DEFAULT NULL,
  `id_metodologo` int(10) UNSIGNED NOT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `id_monitor` int(11) UNSIGNED DEFAULT NULL COMMENT 'El id es del usuario del monitor. Todo empleado tiene un id_usuario',
  `id_comuna_impacto` int(11) UNSIGNED DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `observaciones` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `codigo_grupo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `activo` int(1) DEFAULT 1 COMMENT '1=Si esta activo\r\n0=No esta activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_grupos_historico_evolucion`
--

CREATE TABLE `tbl_dv_grupos_historico_evolucion` (
  `id` int(11) NOT NULL,
  `id_escenario` int(11) DEFAULT NULL,
  `id_metodologo` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `id_comuna_impacto` int(11) DEFAULT NULL,
  `id_monitor` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `id_usuario_genera_cambio` int(11) DEFAULT NULL,
  `observaciones` text COLLATE latin1_general_ci DEFAULT NULL,
  `codigo_grupo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `fecha_reasignacion` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_grupos_horario`
--

CREATE TABLE `tbl_dv_grupos_horario` (
  `id` int(11) NOT NULL,
  `id_grupo` int(10) NOT NULL,
  `dia` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `id_equipamiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_grupos_horario_planificacion`
--

CREATE TABLE `tbl_dv_grupos_horario_planificacion` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `eje_tematico` text CHARACTER SET latin1 NOT NULL,
  `tema` text CHARACTER SET latin1 NOT NULL,
  `objetivo` text CHARACTER SET latin1 NOT NULL,
  `tiempo1` int(11) NOT NULL,
  `tiempo2` int(11) NOT NULL,
  `tiempo3` int(11) NOT NULL,
  `tiempo4` int(11) NOT NULL,
  `juego` text CHARACTER SET latin1 NOT NULL,
  `habilidades` text CHARACTER SET latin1 NOT NULL,
  `ejercicios_introductorios` text CHARACTER SET latin1 NOT NULL,
  `juego_correctivo` text CHARACTER SET latin1 DEFAULT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `juego_evaluativo` text CHARACTER SET latin1 NOT NULL,
  `ejercicios_avanzados` text CHARACTER SET latin1 DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida`
--

CREATE TABLE `tbl_dv_hoja_vida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(10) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_hoja_vida_estado_contrato` int(11) DEFAULT 1,
  `observacion` text CHARACTER SET latin1 DEFAULT NULL,
  `archivos` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_estado_contrato`
--

CREATE TABLE `tbl_dv_hoja_vida_estado_contrato` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_estudio_no_formal`
--

CREATE TABLE `tbl_dv_hoja_vida_estudio_no_formal` (
  `id` int(11) NOT NULL,
  `id_hoja_vida` int(11) NOT NULL,
  `id_institucion_educativo` int(11) NOT NULL,
  `horas_cursadas` int(11) NOT NULL,
  `curso_tipo` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `titulo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `archivos` text CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_estudio_profesional`
--

CREATE TABLE `tbl_dv_hoja_vida_estudio_profesional` (
  `id` int(11) NOT NULL,
  `id_hoja_vida` int(11) DEFAULT NULL,
  `estudio_estado` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `estado_estudio` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `id_institucion_educativo` int(11) DEFAULT NULL,
  `id_titulos_academicos` int(11) DEFAULT NULL,
  `id_gen_escolaridad_nivel` int(11) DEFAULT NULL,
  `fecha_grado` date DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `tarjeta_profesional` int(11) DEFAULT NULL,
  `horario_clases` text CHARACTER SET latin1 DEFAULT NULL,
  `archivos` text CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_experiencia`
--

CREATE TABLE `tbl_dv_hoja_vida_experiencia` (
  `id` int(11) NOT NULL,
  `id_hoja_vida` int(11) DEFAULT NULL,
  `empresa` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `jefe_inmediato` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `telefono` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `cargo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `correo_empresa` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `tipo_experiencia` text CHARACTER SET latin1 DEFAULT NULL,
  `archivos` text CHARACTER SET latin1 DEFAULT NULL COMMENT 'Formato json\r\n[{\r\n   "nombrearchivo":"prueba",\r\n   "url":"direccion/prueba/prueba.jpg"\r\n}]'
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_experiencia_tipo`
--

CREATE TABLE `tbl_dv_hoja_vida_experiencia_tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_hoja_vida_idiomas`
--

CREATE TABLE `tbl_dv_hoja_vida_idiomas` (
  `id` int(11) NOT NULL,
  `id_idioma` int(11) DEFAULT NULL,
  `id_hoja_vida` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2048 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_implementos`
--

CREATE TABLE `tbl_dv_implementos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `clasificacion_id` int(11) NOT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `especificacion_tecnica` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_indicadores`
--

CREATE TABLE `tbl_dv_indicadores` (
  `id` int(10) NOT NULL,
  `tipo` varchar(12) CHARACTER SET latin1 NOT NULL,
  `id_eje` int(10) DEFAULT NULL,
  `id_nivel` int(10) DEFAULT NULL,
  `id_disciplina` int(10) DEFAULT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_instituciones_educativas`
--

CREATE TABLE `tbl_dv_instituciones_educativas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB AVG_ROW_LENGTH=546 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_inventario_fisico`
--

CREATE TABLE `tbl_dv_inventario_fisico` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `responsable_user_id` int(11) NOT NULL,
  `diferencia` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_metodologos_x_monitores`
--

CREATE TABLE `tbl_dv_metodologos_x_monitores` (
  `id` int(11) NOT NULL,
  `id_monitor` int(11) DEFAULT NULL,
  `id_metodologo` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_niveles`
--

CREATE TABLE `tbl_dv_niveles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `observaciones` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_novedad`
--

CREATE TABLE `tbl_dv_novedad` (
  `id` int(11) NOT NULL,
  `leido_monitor` int(11) NOT NULL DEFAULT 1,
  `id_novedad_tipo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `detalle` text NOT NULL,
  `id_usuario_monitor` int(11) UNSIGNED NOT NULL,
  `fecha_reportar` datetime DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_novedad_reporte`
--

CREATE TABLE `tbl_dv_novedad_reporte` (
  `id` int(11) NOT NULL,
  `fecha_reporte` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre_completo` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `id_metodologo` int(11) NOT NULL,
  `cedula` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_accidente` date DEFAULT NULL,
  `hora_accidente` time DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `direccion_accidente` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `barrio_accidente` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `zona` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `testigo1` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `cedula1` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `testigo2` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `cedula2` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `relato` text COLLATE latin1_general_ci DEFAULT NULL,
  `observaciones` text COLLATE latin1_general_ci DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `razon_social` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `jornada_laboral` int(11) DEFAULT NULL,
  `nit` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `radicado` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cargo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_envio_autorizacion` datetime DEFAULT NULL,
  `fecha_autorizado` datetime DEFAULT NULL,
  `autorizacion` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1024 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_novedad_tipo`
--

CREATE TABLE `tbl_dv_novedad_tipo` (
  `id` int(11) NOT NULL,
  `detalle` text DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_persona_x_discapacidad`
--

CREATE TABLE `tbl_dv_persona_x_discapacidad` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_discapacidad` int(11) DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=910 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_persona_x_ocupacion`
--

CREATE TABLE `tbl_dv_persona_x_ocupacion` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_ocupacion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_prestamo_inventario`
--

CREATE TABLE `tbl_dv_prestamo_inventario` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `contratista_user_id` int(11) NOT NULL,
  `comuna_id` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '0 = PENDIENTE , 1 = ENTREGADO, 2 = CANCELADO',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_presupuesto`
--

CREATE TABLE `tbl_dv_presupuesto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_programas`
--

CREATE TABLE `tbl_dv_programas` (
  `id_programas` int(11) NOT NULL,
  `descripcion` varchar(2000) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_proveedores`
--

CREATE TABLE `tbl_dv_proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_sedes`
--

CREATE TABLE `tbl_dv_sedes` (
  `id` int(11) NOT NULL,
  `institucion_id` int(10) UNSIGNED NOT NULL,
  `literal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_sede` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_tipo_escenarios`
--

CREATE TABLE `tbl_dv_tipo_escenarios` (
  `id` int(11) NOT NULL,
  `nombre_tipo_escenario` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_zonas`
--

CREATE TABLE `tbl_dv_zonas` (
  `id` int(11) NOT NULL,
  `nombre_zona` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado_disponibilidad`
--

CREATE TABLE `tbl_empleado_disponibilidad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_asistencias`
--

CREATE TABLE `tbl_gen_asistencias` (
  `id` int(11) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `ficha_id` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asistencia` tinyint(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_contrato`
--

CREATE TABLE `tbl_gen_contrato` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `rcp` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `dcp` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `contrato_numero` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `contrato_valor` double DEFAULT NULL,
  `contrato_objeto` text CHARACTER SET latin1 DEFAULT NULL,
  `cuotas` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_terminacion` date DEFAULT NULL,
  `tenantId` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `activo` int(11) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `fecha_plazo_ejecucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_contrato_cuenta_cobro`
--

CREATE TABLE `tbl_gen_contrato_cuenta_cobro` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_cuenta_cobro_estado` int(11) NOT NULL,
  `fecha_transaccion` date DEFAULT NULL,
  `planilla_numero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_numero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operador` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `periodo_pago_seguridad_social` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tareas_supervisor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tareas_informe_mensual` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_contrato_cuota` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `periodo_seguridad_social_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_contrato_cuenta_cobro_estado`
--

CREATE TABLE `tbl_gen_contrato_cuenta_cobro_estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_contrato_cuota`
--

CREATE TABLE `tbl_gen_contrato_cuota` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `valor_saldo` double DEFAULT NULL,
  `valor_cuota` double DEFAULT NULL,
  `estado` enum('pago','rechazado','pendiente') CHARACTER SET latin1 DEFAULT NULL,
  `fecha_generacion` date DEFAULT NULL,
  `cuota_numero` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `valor_saldo_texto` varchar(200) DEFAULT NULL,
  `valor_cuota_texto` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_contrato_cuota_estado`
--

CREATE TABLE `tbl_gen_contrato_cuota_estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_corregimientos`
--

CREATE TABLE `tbl_gen_corregimientos` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo_unico` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `estrato` int(11) DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=1092 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_discapacidad`
--

CREATE TABLE `tbl_gen_discapacidad` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_documento_tipo`
--

CREATE TABLE `tbl_gen_documento_tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_2` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_eps`
--

CREATE TABLE `tbl_gen_eps` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_regimen` int(11) DEFAULT 1,
  `activo` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_error`
--

CREATE TABLE `tbl_gen_error` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `error` text CHARACTER SET latin1 NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_escolaridad_estado`
--

CREATE TABLE `tbl_gen_escolaridad_estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_escolaridad_nivel`
--

CREATE TABLE `tbl_gen_escolaridad_nivel` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_estado_civil`
--

CREATE TABLE `tbl_gen_estado_civil` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_etnia`
--

CREATE TABLE `tbl_gen_etnia` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` char(2) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_grupo_poblacional`
--

CREATE TABLE `tbl_gen_grupo_poblacional` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_idiomas`
--

CREATE TABLE `tbl_gen_idiomas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=496 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_ludotecas`
--

CREATE TABLE `tbl_gen_ludotecas` (
  `id` int(11) NOT NULL,
  `nombre_ludoteca` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `barrio_id` int(10) UNSIGNED DEFAULT NULL,
  `corregimiento_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_lugares`
--

CREATE TABLE `tbl_gen_lugares` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tenantId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `barrio_id` int(10) UNSIGNED NOT NULL,
  `comuna_id` int(10) UNSIGNED NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_metas`
--

CREATE TABLE `tbl_gen_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_meta` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `periodo` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `programa_id` int(10) UNSIGNED NOT NULL,
  `meta` int(11) NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_ocupacion`
--

CREATE TABLE `tbl_gen_ocupacion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` enum('si','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_parentesco`
--

CREATE TABLE `tbl_gen_parentesco` (
  `id_persona_parentesco` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_persona`
--

CREATE TABLE `tbl_gen_persona` (
  `id` int(11) NOT NULL,
  `nombre_primero` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nombre_segundo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `apellido_primero` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `apellido_segundo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `documento` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id_documento_tipo` int(11) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL COMMENT '1=Hombre\r\n2=mujer',
  `fecha_nacimiento` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `telefono_fijo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `telefono_movil` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `correo_electronico` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `id_procedencia_pais` int(11) DEFAULT NULL,
  `id_procedencia_municipio` int(11) DEFAULT NULL,
  `id_procedencia_departamento` int(11) DEFAULT NULL,
  `id_residencia_corregimiento` int(11) DEFAULT NULL,
  `otro_municipio` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_residencia_barrio` int(11) DEFAULT NULL,
  `id_residencia_vereda` int(11) DEFAULT NULL,
  `residencia_direccion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `residencia_estrato` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') CHARACTER SET latin1 DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `tenantId` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `other_municipio_nombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `departamento_residencia_id` int(11) DEFAULT NULL,
  `municipio_residencia_id` int(11) DEFAULT NULL,
  `direccion_residencia` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `escolaridad_id` int(11) DEFAULT NULL,
  `estado_escolaridad` int(11) DEFAULT NULL,
  `ocupacion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_persona_x_grupo_poblacional`
--

CREATE TABLE `tbl_gen_persona_x_grupo_poblacional` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_grupo_poblacional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_salud_regimen`
--

CREATE TABLE `tbl_gen_salud_regimen` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_titulos_academicos`
--

CREATE TABLE `tbl_gen_titulos_academicos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_veredas`
--

CREATE TABLE `tbl_gen_veredas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_comuna` int(11) DEFAULT NULL COMMENT 'Cuencas',
  `nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_unico` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_estudio` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estrato` int(11) DEFAULT NULL,
  `corregimiento_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=364 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_indicador_metas`
--

CREATE TABLE `tbl_indicador_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `meta_id` int(10) UNSIGNED NOT NULL,
  `mes` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avance_meta` int(11) NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_adicionales`
--

CREATE TABLE `tbl_pr_adicionales` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `pertenece_a` int(11) NOT NULL,
  `nombre_club` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_asistencias`
--

CREATE TABLE `tbl_pr_asistencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `grupo_id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `observaciones` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asistencia` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_disciplinas`
--

CREATE TABLE `tbl_pr_disciplinas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_disciplina` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tenantId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_ficha`
--

CREATE TABLE `tbl_pr_ficha` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_persona_beneficiario` int(11) DEFAULT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `no_ficha` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hijos_beneficiario` int(11) DEFAULT NULL,
  `cantidad_hijos_beneficiario` int(11) DEFAULT NULL,
  `ocupacion_beneficiario` int(11) DEFAULT NULL,
  `escolaridad_id` int(11) DEFAULT NULL,
  `estado_escolaridad` int(11) DEFAULT NULL,
  `cultura_beneficiario` int(11) DEFAULT NULL,
  `discapacidad_beneficiario` int(11) DEFAULT NULL,
  `otra_discapacidad_beneficiario` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medicamentos_permanente_beneficiario` int(11) DEFAULT NULL,
  `medicamentos_beneficiario` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condicion_discapacidad` int(11) DEFAULT NULL,
  `afiliacion_salud` int(11) DEFAULT NULL,
  `tipo_afiliacion` int(11) DEFAULT NULL,
  `salud_sgss_id` int(11) DEFAULT NULL,
  `id_persona_acudiente` int(11) DEFAULT NULL,
  `parentesco_acudiente` int(11) DEFAULT NULL,
  `otro_parentesco_acudiente` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `otro_poblacional` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `comuna_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_grupos`
--

CREATE TABLE `tbl_pr_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_grupo` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tenantId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lugar_id` int(10) UNSIGNED NOT NULL,
  `disciplina_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_horario_grupos`
--

CREATE TABLE `tbl_pr_horario_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED NOT NULL,
  `dia` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_lugares`
--

CREATE TABLE `tbl_pr_lugares` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tenantId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `barrio_id` int(10) UNSIGNED DEFAULT NULL,
  `comuna_id` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `corregimiento_id` int(10) UNSIGNED DEFAULT NULL,
  `vereda_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_persona_x_discapacidad`
--

CREATE TABLE `tbl_pr_persona_x_discapacidad` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `discapacidad_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pr_poblacional_beneficiarios`
--

CREATE TABLE `tbl_pr_poblacional_beneficiarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `grupo_pcs` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoescenarios`
--

CREATE TABLE `tipoescenarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_escenario` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `primer_nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_nombre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_apellido` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `direccion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_movil` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_fijo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenantId` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isblocked` int(1) DEFAULT 0,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_cdp_documento_equivalente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_cdp_documento_equivalente` (
`id` int(11)
,`id_gen_persona` int(11)
,`fecha_transaccion` date
,`nombre_primero` varchar(200)
,`nombre_segundo` varchar(200)
,`apellido_primero` varchar(200)
,`apellido_segundo` varchar(200)
,`documento` varchar(100)
,`residencia_direccion` varchar(200)
,`telefono` varchar(200)
,`contrato_objeto` text
,`rpc` varchar(100)
,`dcp` varchar(100)
,`contrato_valor` double
,`cuota_numero` int(11)
,`contrato_numero` varchar(100)
,`valor_cuota` double
,`correo_electronico` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_cdp_informe_parcial`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_cdp_informe_parcial` (
`id` int(11)
,`nombre_primero` varchar(200)
,`nombre_segundo` varchar(200)
,`apellido_primero` varchar(200)
,`apellido_segundo` varchar(200)
,`documento` varchar(100)
,`contrato_numero` varchar(100)
,`fecha_transaccion` date
,`contrato_objeto` text
,`fecha_inicio` date
,`fecha_terminacion` date
,`contrato_valor` double
,`valor_cuota` double
,`valor_saldo` double
,`valor_acumulado` double
,`cuota_numero` int(11)
,`planilla_numero` varchar(20)
,`pin_numero` varchar(20)
,`operador` varchar(100)
,`fecha_pago` varchar(34)
,`periodo` varchar(20)
,`periodo_year` year(4)
,`tareas_supervisor` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_discapacidad_persona_ficha`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_discapacidad_persona_ficha` (
`nombre_discapacidad` mediumtext
,`ficha_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_discapacidad_persona_ficha_pr`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_discapacidad_persona_ficha_pr` (
`nombre_discapacidad` mediumtext
,`ficha_id` int(10) unsigned
,`discapacidad_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_beneficiarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_beneficiarios` (
`id` int(11)
,`per_ben_nombre_primero` varchar(200)
,`per_ben_nombre_segundo` varchar(200)
,`per_ben_apellido_primero` varchar(200)
,`per_ben_apellido_segundo` varchar(200)
,`per_ben_documento` varchar(100)
,`per_ben_id_documento_tipo` int(11)
,`per_ben_sexo` int(11)
,`per_ben_fecha_nacimiento` varchar(200)
,`edad` bigint(21)
,`per_ben_telefono_fijo` varchar(200)
,`per_ben_telefono_movil` varchar(200)
,`per_ben_correo_electronico` varchar(200)
,`per_ben_id_procedencia_pais` int(11)
,`per_ben_id_procedencia_municipio` int(11)
,`per_ben_id_procedencia_departamento` int(11)
,`per_ben_id_residencia_corregimiento` int(11)
,`per_ben_id_residencia_barrio` int(11)
,`per_ben_id_residencia_vereda` int(11)
,`per_ben_residencia_direccion` varchar(200)
,`per_ben_residencia_estrato` varchar(2)
,`per_ben_sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-')
,`per_ben_id_estado_civil` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_caracterizacion_fichas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_caracterizacion_fichas` (
`ficha_id` int(11)
,`fecha_registro` date
,`fecha_retiro` date
,`disciplina` varchar(2000)
,`escenario_nombre` varchar(191)
,`escenario_direccion` varchar(200)
,`escenario_barrio` varchar(2000)
,`escenario_comuna` varchar(191)
,`monitor_id` int(11)
,`monitor_nombre1` varchar(200)
,`monitor_nombre2` varchar(200)
,`monitor_apellido1` varchar(200)
,`monitor_apellido2` varchar(200)
,`monitor_documento` varchar(100)
,`codigo_grupo` varchar(10)
,`comuna_de_impacto` varchar(191)
,`grupo_activo` varchar(2)
,`beneficiario_id` int(11)
,`beneficiario_asistencias` decimal(32,0)
,`beneficiario_nombre1` varchar(200)
,`beneficiario_nombre2` varchar(200)
,`beneficiario_apellido1` varchar(200)
,`beneficiario_apellido2` varchar(200)
,`beneficiario_tipo_documento` varchar(200)
,`beneficiario_documento` varchar(100)
,`beneficiario_sexo` varchar(6)
,`beneficiario_fecha_nacimiento` varchar(200)
,`beneficiario_edad` bigint(21)
,`beneficiario_telefono_fijo` varchar(200)
,`beneficiario_telefono_movil` varchar(200)
,`beneficiario_correo_electronico` varchar(200)
,`beneficiario_pais` varchar(191)
,`beneficiario_departamento` varchar(191)
,`beneficiario_municipio` varchar(191)
,`beneficiario_direccion` varchar(200)
,`beneficiario_estrato` varchar(2)
,`beneficiario_barrio` varchar(2000)
,`beneficiario_comuna_residencia` varchar(191)
,`beneficiario_corregimiento` varchar(20)
,`beneficiario_vereda` varchar(191)
,`beneficiario_ocupacion` varchar(191)
,`beneficiario_escolaridad` varchar(200)
,`beneficiario_estado_escolaridad` varchar(200)
,`beneficiario_autoreconoce` varchar(200)
,`beneficiario_discapacidad` varchar(2)
,`beneficiario_tipo_discapacidad` mediumtext
,`benef_grupo_poblacional_indigena` varchar(2)
,`benef_grupo_poblacional_afrodescendiente` varchar(2)
,`benef_grupo_poblacional_victima_del_conflicto` varchar(2)
,`benef_grupo_poblacional_adulto_mayor` varchar(2)
,`benef_grupo_poblacional_lgbti` varchar(2)
,`benef_grupo_poblacional_grupo_mujeres` varchar(2)
,`benef_grupo_poblacional_grupo_jovenes` varchar(2)
,`benef_grupo_poblacional_jac` varchar(2)
,`benef_grupo_poblacional_jal` varchar(2)
,`benef_grupo_poblacional_otro_cual` varchar(200)
,`acudiente_nombre1` varchar(200)
,`acudiente_nombre2` varchar(200)
,`acudiente_apellido1` varchar(200)
,`acudiente_apellido2` varchar(200)
,`acudiente_tipo_documento` varchar(200)
,`acudiente_documento` varchar(100)
,`acudiente_sexo` varchar(6)
,`acudiente_fecha_nacimiento` varchar(200)
,`acudiente_edad` bigint(21)
,`acudiente_telefono_fijo` varchar(200)
,`acudiente_telefono_movil` varchar(200)
,`acudiente_correo_electronico` varchar(200)
,`acudiente_parentesco` varchar(191)
,`acudiente_parentesco_otro` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_cobertura`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_cobertura` (
`metodologo_id` int(11)
,`metodologo_nombre1` varchar(200)
,`metodologo_nombre2` varchar(200)
,`metodologo_apellido1` varchar(200)
,`metodologo_apellido2` varchar(200)
,`metodologo_documento` varchar(100)
,`monitor_id` int(11)
,`monitor_nombre1` varchar(200)
,`monitor_nombre2` varchar(200)
,`monitor_apellido1` varchar(200)
,`monitor_apellido2` varchar(200)
,`monitor_documento` varchar(100)
,`presupuesto_id` int(11)
,`presupuesto` varchar(200)
,`grupo_id` int(11)
,`grupo_codigo` varchar(10)
,`grupo_activo` varchar(2)
,`disciplina_id` int(11)
,`disciplina` varchar(2000)
,`comuna_impacto_id` int(11) unsigned
,`comuna_impacto` varchar(191)
,`escenario_id` int(11)
,`escenario` varchar(191)
,`escenario_direccion` varchar(200)
,`escenario_barrio_id` int(11) unsigned
,`escenario_barrio` varchar(2000)
,`beneficiario_persona_id` int(11)
,`beneficiario_nombre1` varchar(200)
,`beneficiario_nombre2` varchar(200)
,`beneficiario_apellido1` varchar(200)
,`beneficiario_apellido2` varchar(200)
,`beneficiario_documento` varchar(100)
,`beneficiario_ficha_id` int(11)
,`beneficiario_fecha_registro` date
,`beneficiario_fecha_retiro` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_fichas_beneficiarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_fichas_beneficiarios` (
`fich_id` int(11)
,`fich_fecha_registro` date
,`fich_id_persona_beneficiario` int(11)
,`fich_id_escolaridad_nivel` int(11)
,`fich_id_escolaridad_estado` int(11)
,`fich_id_etnia` int(11)
,`fich_id_persona_acudiente` int(11)
,`fich_id_persona_acudiente_parentesco` int(11)
,`fich_id_persona_vive_con_parentesco` int(11)
,`fich_enfermedad_padece_si` enum('si','no')
,`fich_enfermedad_padece_nombre` varchar(200)
,`fich_medicamentos_toma_si` enum('si','no')
,`fich_medicamentos_toma_nombre` varchar(2000)
,`fich_salud_afiliado` enum('si','no')
,`fich_id_salud_regimen` int(11)
,`fich_id_eps` int(11)
,`fich_id_grupo` int(11)
,`fich_updated_at` datetime
,`fich_created_at` datetime
,`fich_fecha_retiro` date
,`fich_grupo_poblacional_otro` varchar(200)
,`fich_participacion_anterior_meses` int(11)
,`fich_participacion_anterior_annos` int(11)
,`fich_persona_vive_con_parentesco_otro` varchar(200)
,`fich_persona_acudiente_parentesco_otro` varchar(200)
,`fich_se_reconoce_como_cual` varchar(200)
,`fich_id_ocupacion` int(11)
,`fich_tiene_discapacidad` int(11)
,`fich_toma_medicamentos` int(11)
,`per_ben_nombre_primero` varchar(200)
,`per_ben_nombre_segundo` varchar(200)
,`per_ben_apellido_primero` varchar(200)
,`per_ben_apellido_segundo` varchar(200)
,`per_ben_documento` varchar(100)
,`per_ben_id_documento_tipo` int(11)
,`per_ben_sexo` int(11)
,`per_ben_fecha_nacimiento` varchar(200)
,`edad` bigint(21)
,`per_ben_telefono_fijo` varchar(200)
,`per_ben_telefono_movil` varchar(200)
,`per_ben_correo_electronico` varchar(200)
,`per_ben_id_procedencia_pais` int(11)
,`per_ben_id_procedencia_municipio` int(11)
,`per_ben_id_procedencia_departamento` int(11)
,`per_ben_id_residencia_corregimiento` int(11)
,`per_ben_id_residencia_barrio` int(11)
,`per_ben_id_residencia_vereda` int(11)
,`per_ben_residencia_direccion` varchar(200)
,`per_ben_residencia_estrato` varchar(2)
,`per_ben_sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-')
,`per_ben_id_estado_civil` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_metodologos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_metodologos` (
`id` int(11)
,`per_met_nombre_primero` varchar(200)
,`per_met_nombre_segundo` varchar(200)
,`per_met_apellido_primero` varchar(200)
,`per_met_apellido_segundo` varchar(200)
,`per_met_documento` varchar(100)
,`per_met_id_documento_tipo` int(11)
,`per_met_sexo` int(11)
,`per_met_fecha_nacimiento` varchar(200)
,`edad` bigint(21)
,`per_met_telefono_fijo` varchar(200)
,`per_met_telefono_movil` varchar(200)
,`per_met_correo_electronico` varchar(200)
,`per_met_id_procedencia_pais` int(11)
,`per_met_id_procedencia_municipio` int(11)
,`per_met_id_procedencia_departamento` int(11)
,`per_met_id_residencia_corregimiento` int(11)
,`per_met_id_residencia_barrio` int(11)
,`per_met_id_residencia_vereda` int(11)
,`per_met_residencia_direccion` varchar(200)
,`per_met_residencia_estrato` varchar(2)
,`per_met_sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-')
,`per_met_id_estado_civil` int(11)
,`id_empleado` int(11)
,`emp_id_persona` int(11)
,`emp_id_estado_aspirante` int(11)
,`emp_tiene_hijos` int(1)
,`emp_cuantos_hijos` int(1)
,`emp_libreta_militar` varchar(20)
,`emp_no_libreta_militar` varchar(250)
,`emp_distrito_militar` varchar(250)
,`emp_skype` varchar(50)
,`emp_id_disponibilidad` int(1)
,`emp_foto` varchar(100)
,`emp_profesion` varchar(100)
,`emp_id_disciplina` int(11)
,`emp_id_ocupacion` int(2)
,`emp_tiene_discapacidad` int(1)
,`emp_padece_enfermedad` int(1)
,`emp_enfermedad` varchar(255)
,`emp_toma_medicamentos` int(11)
,`emp_medicamentos` varchar(255)
,`emp_afiliado_sgsss` int(11)
,`emp_id_tipo_afiliacion` int(11)
,`emp_id_eps` varchar(255)
,`emp_proyecto_profesional` text
,`emp_id_cargo` int(11)
,`emp_id_escolaridad_nivel` int(11)
,`emp_created_at` date
,`emp_updated_at` date
,`emp_id_etnia` int(11)
,`emp_id_institucion_educativa` int(11)
,`emp_activo` int(11)
,`emp_id_presupuesto` int(1)
,`emp_id_estado_escolaridad` int(11)
,`emp_nuevo` int(11)
,`usu_met_primer_nombre` varchar(191)
,`usu_met_email` varchar(191)
,`usu_met_created_at` timestamp
,`usu_met_updated_at` timestamp
,`usu_met_segundo_nombre` varchar(191)
,`usu_met_primer_apellido` varchar(191)
,`usu_met_segundo_apellido` varchar(191)
,`usu_met_tipo_documento` varchar(191)
,`usu_met_numero_documento` varchar(191)
,`usu_met_direccion` varchar(191)
,`usu_met_fecha_nacimiento` date
,`usu_met_telefono_movil` varchar(191)
,`usu_met_telefono_fijo` varchar(191)
,`usu_met_tenantId` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_monitores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_monitores` (
`id` int(11)
,`per_mon_nombre_primero` varchar(200)
,`per_mon_nombre_segundo` varchar(200)
,`per_mon_apellido_primero` varchar(200)
,`per_mon_apellido_segundo` varchar(200)
,`per_mon_documento` varchar(100)
,`per_mon_id_documento_tipo` int(11)
,`per_mon_sexo` int(11)
,`per_mon_fecha_nacimiento` varchar(200)
,`edad` bigint(21)
,`per_mon_telefono_fijo` varchar(200)
,`per_mon_telefono_movil` varchar(200)
,`per_mon_correo_electronico` varchar(200)
,`per_mon_id_procedencia_pais` int(11)
,`per_mon_id_procedencia_municipio` int(11)
,`per_mon_id_procedencia_departamento` int(11)
,`per_mon_id_residencia_corregimiento` int(11)
,`per_mon_id_residencia_barrio` int(11)
,`per_mon_id_residencia_vereda` int(11)
,`per_mon_residencia_direccion` varchar(200)
,`per_mon_residencia_estrato` varchar(2)
,`per_mon_sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-')
,`per_mon_id_estado_civil` int(11)
,`id_empleado` int(11)
,`emp_id_persona` int(11)
,`emp_id_estado_aspirante` int(11)
,`emp_tiene_hijos` int(1)
,`emp_cuantos_hijos` int(1)
,`emp_libreta_militar` varchar(20)
,`emp_no_libreta_militar` varchar(250)
,`emp_distrito_militar` varchar(250)
,`emp_skype` varchar(50)
,`emp_id_disponibilidad` int(1)
,`emp_foto` varchar(100)
,`emp_profesion` varchar(100)
,`emp_id_disciplina` int(11)
,`emp_id_ocupacion` int(2)
,`emp_tiene_discapacidad` int(1)
,`emp_padece_enfermedad` int(1)
,`emp_enfermedad` varchar(255)
,`emp_toma_medicamentos` int(11)
,`emp_medicamentos` varchar(255)
,`emp_afiliado_sgsss` int(11)
,`emp_id_tipo_afiliacion` int(11)
,`emp_id_eps` varchar(255)
,`emp_proyecto_profesional` text
,`emp_id_cargo` int(11)
,`emp_id_escolaridad_nivel` int(11)
,`emp_created_at` date
,`emp_updated_at` date
,`emp_id_etnia` int(11)
,`emp_id_institucion_educativa` int(11)
,`emp_activo` int(11)
,`emp_id_presupuesto` int(1)
,`emp_id_estado_escolaridad` int(11)
,`emp_nuevo` int(11)
,`usu_mon_primer_nombre` varchar(191)
,`usu_mon_email` varchar(191)
,`usu_mon_created_at` timestamp
,`usu_mon_updated_at` timestamp
,`usu_mon_segundo_nombre` varchar(191)
,`usu_mon_primer_apellido` varchar(191)
,`usu_mon_segundo_apellido` varchar(191)
,`usu_mon_tipo_documento` varchar(191)
,`usu_mon_numero_documento` varchar(191)
,`usu_mon_direccion` varchar(191)
,`usu_mon_fecha_nacimiento` date
,`usu_mon_telefono_movil` varchar(191)
,`usu_mon_telefono_fijo` varchar(191)
,`usu_mon_tenantId` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_dv_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_dv_usuarios` (
`id` int(11)
,`estado_aspirante` varchar(200)
,`presupuesto` varchar(200)
,`nombre_primero` varchar(200)
,`nombre_segundo` varchar(200)
,`apellido_primero` varchar(200)
,`apellido_segundo` varchar(200)
,`estado_civil` varchar(100)
,`documento_tipo` varchar(200)
,`numero_documento` varchar(191)
,`sexo` varchar(9)
,`fecha_nacimiento` date
,`edad` bigint(21)
,`telefono_fijo` varchar(200)
,`telefono_movil` varchar(200)
,`correo_electronico` varchar(200)
,`pais` varchar(191)
,`departamento` varchar(191)
,`municipio` varchar(191)
,`direccion` varchar(200)
,`estrato` varchar(2)
,`barrio` text
,`comuna_residencia` varchar(191)
,`corregimiento` varchar(20)
,`vereda` varchar(191)
,`ocupacion` mediumtext
,`titulo_obtenido` char(0)
,`escolaridad` varchar(200)
,`estado_escolaridad` varchar(200)
,`universidad` varchar(200)
,`enfermedad` varchar(255)
,`medicamentos` varchar(255)
,`afiliado_sgsss` varchar(2)
,`cuantos_hijos` bigint(11)
,`autoreconoce` varchar(200)
,`discapacidad` varchar(2)
,`TIPO_DISCAPACIDAD` mediumtext
,`indigena` varchar(2)
,`afrodescendiente` varchar(2)
,`victima_del_conflicto` varchar(2)
,`adulto_mayor` varchar(2)
,`lgbti` varchar(2)
,`Grupo_organizado_de_mujeres` varchar(2)
,`Grupo_organizado_de_jovenes` varchar(2)
,`Junta_de_accion_comunal` varchar(2)
,`Junta_administradora_local` varchar(2)
,`Otro` varchar(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_grupo_poblacional_ficha`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_grupo_poblacional_ficha` (
`nombre` mediumtext
,`ficha_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_grupo_poblacional_ficha_pr`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_grupo_poblacional_ficha_pr` (
`nombre` mediumtext
,`ficha_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_reporte_general`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_reporte_general` (
`tenantId` varchar(20)
,`id` int(10) unsigned
,`codigo_grupo` varchar(10)
,`nombre_grado` varchar(191)
,`nombre_institucion` varchar(191)
,`nombre_sede` varchar(191)
,`tipo_documento` varchar(200)
,`documento` varchar(100)
,`no_ficha` varchar(191)
,`fecha_inscripcion` date
,`nombre_primero` varchar(200)
,`nombre_segundo` varchar(200)
,`apellido_primero` varchar(200)
,`apellido_segundo` varchar(200)
,`correo_electronico` varchar(200)
,`sexo` varchar(6)
,`fecha_nacimiento` varchar(200)
,`edad_persona` bigint(21)
,`nombre_pais` varchar(191)
,`nombre_departamento` varchar(191)
,`nombre_municipio` varchar(191)
,`nombre_corregimiento` varchar(20)
,`nombre_vereda` varchar(191)
,`nombre_barrio` varchar(2000)
,`residencia_estrato` varchar(2)
,`nombre_comuna` varchar(191)
,`residencia_direccion` varchar(200)
,`telefono_fijo` varchar(200)
,`telefono_movil` varchar(200)
,`nivel_escolaridad` varchar(200)
,`estado_escolaridad` varchar(200)
,`ocupacion_beneficiario` varchar(191)
,`estado_civil` varchar(100)
,`hijos_beneficiario` varchar(2)
,`cantidad_hijos_beneficiario` int(11)
,`etnia_beneficiario` varchar(200)
,`grupo_poblacional` mediumtext
,`discapacidades` mediumtext
,`enfermedad_permanente` varchar(2)
,`otra_discapacidad_beneficiario` varchar(191)
,`toma_medicamentos` varchar(2)
,`medicamentos_beneficiario` varchar(191)
,`sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-')
,`afiliacion_salud` varchar(2)
,`tipo_afiliacion` varchar(200)
,`nombre_eps` varchar(191)
,`tipo_documento_acudiente` varchar(200)
,`documento_acudiente` varchar(100)
,`primer_nombre_acudiente` varchar(200)
,`segundo_nombre_acudiente` varchar(200)
,`primer_apellido_acudiente` varchar(200)
,`segundo_apellido_acudiente` varchar(200)
,`sexo_acudiente` varchar(6)
,`fecha_nacimiento_acudiente` varchar(200)
,`telefono_fijo_acudiente` varchar(200)
,`telefono_movil_acudiente` varchar(200)
,`correo_acudiente` varchar(200)
,`parentesco_acudiente` varchar(15)
,`otro_parentesco_acudiente` varchar(191)
,`primer_nombre_usuario` varchar(191)
,`primer_apellido_usuario` varchar(191)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_zona` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_cdp_documento_equivalente`
--
DROP TABLE IF EXISTS `view_cdp_documento_equivalente`;

CREATE VIEW `view_cdp_documento_equivalente`  AS  select `tbl_gen_contrato_cuota`.`id` AS `id`,`tbl_gen_contrato`.`id_persona` AS `id_gen_persona`,`tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion` AS `fecha_transaccion`,`tbl_gen_persona`.`nombre_primero` AS `nombre_primero`,`tbl_gen_persona`.`nombre_segundo` AS `nombre_segundo`,`tbl_gen_persona`.`apellido_primero` AS `apellido_primero`,`tbl_gen_persona`.`apellido_segundo` AS `apellido_segundo`,`tbl_gen_persona`.`documento` AS `documento`,`tbl_gen_persona`.`residencia_direccion` AS `residencia_direccion`,coalesce(`tbl_gen_persona`.`telefono_fijo`,`tbl_gen_persona`.`telefono_movil`) AS `telefono`,`tbl_gen_contrato`.`contrato_objeto` AS `contrato_objeto`,`tbl_gen_contrato`.`rcp` AS `rpc`,`tbl_gen_contrato`.`dcp` AS `dcp`,`tbl_gen_contrato`.`contrato_valor` AS `contrato_valor`,`tbl_gen_contrato_cuota`.`cuota_numero` AS `cuota_numero`,`tbl_gen_contrato`.`contrato_numero` AS `contrato_numero`,`tbl_gen_contrato_cuota`.`valor_cuota` AS `valor_cuota`,`tbl_gen_persona`.`correo_electronico` AS `correo_electronico` from (((`tbl_gen_contrato_cuota` left join `tbl_gen_contrato` on(`tbl_gen_contrato_cuota`.`id_contrato` = `tbl_gen_contrato`.`id`)) left join `tbl_gen_contrato_cuenta_cobro` on(`tbl_gen_contrato_cuota`.`id` = `tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota`)) left join `tbl_gen_persona` on(`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)) ;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Estructura para la vista `view_discapacidad_persona_ficha`
--
DROP TABLE IF EXISTS `view_discapacidad_persona_ficha`;

CREATE VIEW `view_discapacidad_persona_ficha`  AS  select group_concat(`tbl_gen_discapacidad`.`descripcion` separator ',') AS `nombre_discapacidad`,`tbl_cm_persona_x_discapacidad`.`ficha_id` AS `ficha_id` from (`tbl_cm_persona_x_discapacidad` join `tbl_gen_discapacidad` on(`tbl_cm_persona_x_discapacidad`.`discapacidad_id` = `tbl_gen_discapacidad`.`id`)) group by `tbl_cm_persona_x_discapacidad`.`ficha_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_discapacidad_persona_ficha_pr`
--
DROP TABLE IF EXISTS `view_discapacidad_persona_ficha_pr`;

CREATE VIEW `view_discapacidad_persona_ficha_pr`  AS  select group_concat(`tbl_gen_discapacidad`.`descripcion` separator ',') AS `nombre_discapacidad`,`tbl_pr_persona_x_discapacidad`.`ficha_id` AS `ficha_id`,`tbl_pr_persona_x_discapacidad`.`discapacidad_id` AS `discapacidad_id` from (`tbl_pr_persona_x_discapacidad` join `tbl_gen_discapacidad` on(`tbl_pr_persona_x_discapacidad`.`discapacidad_id` = `tbl_gen_discapacidad`.`id`)) group by `tbl_pr_persona_x_discapacidad`.`ficha_id`,`tbl_pr_persona_x_discapacidad`.`discapacidad_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_beneficiarios`
--
DROP TABLE IF EXISTS `view_dv_beneficiarios`;

CREATE VIEW `view_dv_beneficiarios`  AS  select distinct `beneficiario`.`id` AS `id`,`beneficiario`.`nombre_primero` AS `per_ben_nombre_primero`,`beneficiario`.`nombre_segundo` AS `per_ben_nombre_segundo`,`beneficiario`.`apellido_primero` AS `per_ben_apellido_primero`,`beneficiario`.`apellido_segundo` AS `per_ben_apellido_segundo`,`beneficiario`.`documento` AS `per_ben_documento`,`beneficiario`.`id_documento_tipo` AS `per_ben_id_documento_tipo`,`beneficiario`.`sexo` AS `per_ben_sexo`,`beneficiario`.`fecha_nacimiento` AS `per_ben_fecha_nacimiento`,timestampdiff(YEAR,`beneficiario`.`fecha_nacimiento`,curdate()) AS `edad`,`beneficiario`.`telefono_fijo` AS `per_ben_telefono_fijo`,`beneficiario`.`telefono_movil` AS `per_ben_telefono_movil`,`beneficiario`.`correo_electronico` AS `per_ben_correo_electronico`,`beneficiario`.`id_procedencia_pais` AS `per_ben_id_procedencia_pais`,`beneficiario`.`id_procedencia_municipio` AS `per_ben_id_procedencia_municipio`,`beneficiario`.`id_procedencia_departamento` AS `per_ben_id_procedencia_departamento`,`beneficiario`.`id_residencia_corregimiento` AS `per_ben_id_residencia_corregimiento`,`beneficiario`.`id_residencia_barrio` AS `per_ben_id_residencia_barrio`,`beneficiario`.`id_residencia_vereda` AS `per_ben_id_residencia_vereda`,`beneficiario`.`residencia_direccion` AS `per_ben_residencia_direccion`,`beneficiario`.`residencia_estrato` AS `per_ben_residencia_estrato`,`beneficiario`.`sangre_tipo` AS `per_ben_sangre_tipo`,`beneficiario`.`id_estado_civil` AS `per_ben_id_estado_civil` from (`tbl_gen_persona` `beneficiario` join `tbl_dv_ficha` `ficha` on(`ficha`.`id_persona_beneficiario` = `beneficiario`.`id`)) group by `ficha`.`id_persona_beneficiario` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_caracterizacion_fichas`
--
DROP TABLE IF EXISTS `view_dv_caracterizacion_fichas`;

CREATE VIEW `view_dv_caracterizacion_fichas`  AS  select `tbl_dv_ficha`.`id` AS `ficha_id`,`tbl_dv_ficha`.`fecha_registro` AS `fecha_registro`,`tbl_dv_ficha`.`fecha_retiro` AS `fecha_retiro`,`tbl_dv_disciplinas`.`descripcion` AS `disciplina`,`tbl_dv_escenarios`.`nombre_escenario` AS `escenario_nombre`,`tbl_dv_escenarios`.`direccion` AS `escenario_direccion`,`tbl_barrio_escenario`.`nombre_barrio` AS `escenario_barrio`,`tbl_comuna_escenario`.`nombre_comuna` AS `escenario_comuna`,`tbl_dv_monitor`.`id` AS `monitor_id`,`tbl_dv_monitor`.`nombre_primero` AS `monitor_nombre1`,`tbl_dv_monitor`.`nombre_segundo` AS `monitor_nombre2`,`tbl_dv_monitor`.`apellido_primero` AS `monitor_apellido1`,`tbl_dv_monitor`.`apellido_segundo` AS `monitor_apellido2`,`tbl_dv_monitor`.`documento` AS `monitor_documento`,`tbl_dv_grupos`.`codigo_grupo` AS `codigo_grupo`,`comuna_impacto`.`nombre_comuna` AS `comuna_de_impacto`,case when `tbl_dv_grupos`.`activo` = 1 then 'SI' when `tbl_dv_grupos`.`activo` = 0 then 'NO' end AS `grupo_activo`,`tbl_gen_persona`.`id` AS `beneficiario_id`,sum(`tbl_dv_asistencias`.`siasistio`) AS `beneficiario_asistencias`,`tbl_gen_persona`.`nombre_primero` AS `beneficiario_nombre1`,`tbl_gen_persona`.`nombre_segundo` AS `beneficiario_nombre2`,`tbl_gen_persona`.`apellido_primero` AS `beneficiario_apellido1`,`tbl_gen_persona`.`apellido_segundo` AS `beneficiario_apellido2`,`tbl_gen_documento_tipo`.`descripcion` AS `beneficiario_tipo_documento`,`tbl_gen_persona`.`documento` AS `beneficiario_documento`,case when `tbl_gen_persona`.`sexo` = 1 then 'HOMBRE' when `tbl_gen_persona`.`sexo` = 2 then 'MUJER' end AS `beneficiario_sexo`,`tbl_gen_persona`.`fecha_nacimiento` AS `beneficiario_fecha_nacimiento`,timestampdiff(YEAR,`tbl_gen_persona`.`fecha_nacimiento`,curdate()) AS `beneficiario_edad`,`tbl_gen_persona`.`telefono_fijo` AS `beneficiario_telefono_fijo`,`tbl_gen_persona`.`telefono_movil` AS `beneficiario_telefono_movil`,`tbl_gen_persona`.`correo_electronico` AS `beneficiario_correo_electronico`,`paises`.`nombre_pais` AS `beneficiario_pais`,`departamentos`.`nombre_departamento` AS `beneficiario_departamento`,`municipios`.`nombre_municipio` AS `beneficiario_municipio`,`tbl_gen_persona`.`residencia_direccion` AS `beneficiario_direccion`,`tbl_gen_persona`.`residencia_estrato` AS `beneficiario_estrato`,`barrios`.`nombre_barrio` AS `beneficiario_barrio`,`comunas`.`nombre_comuna` AS `beneficiario_comuna_residencia`,`tbl_gen_corregimientos`.`descripcion` AS `beneficiario_corregimiento`,`tbl_gen_veredas`.`nombre` AS `beneficiario_vereda`,`tbl_gen_ocupacion`.`descripcion` AS `beneficiario_ocupacion`,`tbl_gen_escolaridad_nivel`.`descripcion` AS `beneficiario_escolaridad`,`tbl_gen_escolaridad_estado`.`descripcion` AS `beneficiario_estado_escolaridad`,`tbl_dv_ficha`.`se_reconoce_como_cual` AS `beneficiario_autoreconoce`,case when `tbl_dv_ficha`.`tiene_discapacidad` = 1 then 'SI' when `tbl_dv_ficha`.`tiene_discapacidad` = 2 then 'NO' end AS `beneficiario_discapacidad`,(select group_concat(distinct `d`.`descripcion` separator ', ') from (`tbl_dv_persona_x_discapacidad` `ds` join `tbl_gen_discapacidad` `d` on(`d`.`id` = `ds`.`id_discapacidad`)) where `ds`.`id_persona` = `tbl_gen_persona`.`id` group by `ds`.`id_persona`) AS `beneficiario_tipo_discapacidad`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 1 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_indigena`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 2 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_afrodescendiente`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 3 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_victima_del_conflicto`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 4 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_adulto_mayor`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 5 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_lgbti`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 6 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_grupo_mujeres`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 7 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_grupo_jovenes`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 8 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_jac`,ifnull((select 'SI' from `tbl_gen_persona_x_grupo_poblacional` `pg` where `pg`.`id_grupo_poblacional` = 9 and `pg`.`id_persona` = `tbl_gen_persona`.`id` limit 1),'NO') AS `benef_grupo_poblacional_jal`,`tbl_dv_ficha`.`grupo_poblacional_otro` AS `benef_grupo_poblacional_otro_cual`,`tbl_gen_persona_acudiente`.`nombre_primero` AS `acudiente_nombre1`,`tbl_gen_persona_acudiente`.`nombre_segundo` AS `acudiente_nombre2`,`tbl_gen_persona_acudiente`.`apellido_primero` AS `acudiente_apellido1`,`tbl_gen_persona_acudiente`.`apellido_segundo` AS `acudiente_apellido2`,`tbl_gen_tipo_doc_acudiente`.`descripcion` AS `acudiente_tipo_documento`,`tbl_gen_persona_acudiente`.`documento` AS `acudiente_documento`,case when `tbl_gen_persona_acudiente`.`sexo` = 1 then 'HOMBRE' when `tbl_gen_persona_acudiente`.`sexo` = 2 then 'MUJER' end AS `acudiente_sexo`,`tbl_gen_persona_acudiente`.`fecha_nacimiento` AS `acudiente_fecha_nacimiento`,timestampdiff(YEAR,`tbl_gen_persona_acudiente`.`fecha_nacimiento`,curdate()) AS `acudiente_edad`,`tbl_gen_persona_acudiente`.`telefono_fijo` AS `acudiente_telefono_fijo`,`tbl_gen_persona_acudiente`.`telefono_movil` AS `acudiente_telefono_movil`,`tbl_gen_persona_acudiente`.`correo_electronico` AS `acudiente_correo_electronico`,`tbl_gen_parentesco`.`descripcion` AS `acudiente_parentesco`,`tbl_dv_ficha`.`persona_acudiente_parentesco_otro` AS `acudiente_parentesco_otro` from ((((((((((((((((((((((((`tbl_dv_ficha` join `tbl_gen_persona` on(`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)) left join `tbl_dv_grupos` on(`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)) left join `tbl_dv_disciplinas` on(`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)) left join `tbl_dv_escenarios` on(`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)) left join `barrios` `tbl_barrio_escenario` on(`tbl_dv_escenarios`.`id_barrio` = `tbl_barrio_escenario`.`id`)) left join `comunas` `tbl_comuna_escenario` on(`tbl_barrio_escenario`.`comuna_id` = `tbl_comuna_escenario`.`id`)) left join `comunas` `comuna_impacto` on(`tbl_dv_grupos`.`id_comuna_impacto` = `comuna_impacto`.`id`)) join `tbl_dv_empleado` on(`tbl_dv_grupos`.`id_monitor` = `tbl_dv_empleado`.`id_usuario`)) join `tbl_gen_persona` `tbl_dv_monitor` on(`tbl_dv_empleado`.`id_persona` = `tbl_dv_monitor`.`id`)) left join `tbl_gen_documento_tipo` on(`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)) left join `paises` on(`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)) left join `departamentos` on(`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)) left join `municipios` on(`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)) left join `barrios` on(`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)) left join `comunas` on(`barrios`.`comuna_id` = `comunas`.`id`)) left join `tbl_gen_corregimientos` on(`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)) left join `tbl_gen_veredas` on(`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)) left join `tbl_gen_ocupacion` on(`tbl_dv_ficha`.`id_ocupacion` = `tbl_gen_ocupacion`.`id`)) left join `tbl_gen_escolaridad_nivel` on(`tbl_dv_ficha`.`id_escolaridad_nivel` = `tbl_gen_escolaridad_nivel`.`id`)) left join `tbl_gen_escolaridad_estado` on(`tbl_dv_ficha`.`id_escolaridad_estado` = `tbl_gen_escolaridad_estado`.`id`)) left join `tbl_gen_persona` `tbl_gen_persona_acudiente` on(`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona_acudiente`.`id`)) left join `tbl_gen_documento_tipo` `tbl_gen_tipo_doc_acudiente` on(`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_tipo_doc_acudiente`.`id`)) left join `tbl_gen_parentesco` on(`tbl_gen_parentesco`.`id_persona_parentesco` = `tbl_dv_ficha`.`id_persona_acudiente_parentesco`)) left join `tbl_dv_asistencias` on(`tbl_dv_asistencias`.`id_persona_beneficiario` = `tbl_gen_persona`.`id` and `tbl_dv_grupos`.`id` = `tbl_dv_asistencias`.`id_grupo`)) group by `tbl_dv_ficha`.`id`,`tbl_dv_monitor`.`id` order by `tbl_gen_persona`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_cobertura`
--
DROP TABLE IF EXISTS `view_dv_cobertura`;

CREATE VIEW `view_dv_cobertura`  AS  select `met`.`id` AS `metodologo_id`,`met`.`per_met_nombre_primero` AS `metodologo_nombre1`,`met`.`per_met_nombre_segundo` AS `metodologo_nombre2`,`met`.`per_met_apellido_primero` AS `metodologo_apellido1`,`met`.`per_met_apellido_segundo` AS `metodologo_apellido2`,`met`.`per_met_documento` AS `metodologo_documento`,`mon`.`id` AS `monitor_id`,`mon`.`per_mon_nombre_primero` AS `monitor_nombre1`,`mon`.`per_mon_nombre_segundo` AS `monitor_nombre2`,`mon`.`per_mon_apellido_primero` AS `monitor_apellido1`,`mon`.`per_mon_apellido_segundo` AS `monitor_apellido2`,`mon`.`per_mon_documento` AS `monitor_documento`,`pre`.`id` AS `presupuesto_id`,`pre`.`descripcion` AS `presupuesto`,`gru`.`id` AS `grupo_id`,`gru`.`codigo_grupo` AS `grupo_codigo`,case when `gru`.`activo` = 1 then 'SI' when `gru`.`activo` = 0 then 'NO' end AS `grupo_activo`,`dis`.`id` AS `disciplina_id`,`dis`.`descripcion` AS `disciplina`,`com`.`id` AS `comuna_impacto_id`,`com`.`nombre_comuna` AS `comuna_impacto`,`esc`.`id` AS `escenario_id`,`esc`.`nombre_escenario` AS `escenario`,`esc`.`direccion` AS `escenario_direccion`,`bar`.`id` AS `escenario_barrio_id`,`bar`.`nombre_barrio` AS `escenario_barrio`,`ben`.`fich_id_persona_beneficiario` AS `beneficiario_persona_id`,`ben`.`per_ben_nombre_primero` AS `beneficiario_nombre1`,`ben`.`per_ben_nombre_segundo` AS `beneficiario_nombre2`,`ben`.`per_ben_apellido_primero` AS `beneficiario_apellido1`,`ben`.`per_ben_apellido_segundo` AS `beneficiario_apellido2`,`ben`.`per_ben_documento` AS `beneficiario_documento`,`ben`.`fich_id` AS `beneficiario_ficha_id`,`ben`.`fich_fecha_registro` AS `beneficiario_fecha_registro`,`ben`.`fich_fecha_retiro` AS `beneficiario_fecha_retiro` from ((((((((`tbl_dv_grupos` `gru` join `view_dv_metodologos` `met` on(`gru`.`id_metodologo` = `met`.`id`)) join `view_dv_monitores` `mon` on(`gru`.`id_monitor` = `mon`.`id`)) join `tbl_dv_presupuesto` `pre` on(`mon`.`emp_id_presupuesto` = `pre`.`id`)) join `tbl_dv_disciplinas` `dis` on(`gru`.`id_disciplina` = `dis`.`id`)) join `comunas` `com` on(`gru`.`id_comuna_impacto` = `com`.`id`)) join `tbl_dv_escenarios` `esc` on(`gru`.`id_escenario` = `esc`.`id`)) left join `barrios` `bar` on(`esc`.`id_barrio` = `bar`.`id`)) join `view_dv_fichas_beneficiarios` `ben` on(`ben`.`fich_id_grupo` = `gru`.`id`)) order by `met`.`id`,`mon`.`id`,`gru`.`id`,`dis`.`id`,`com`.`codigo_comuna`,`esc`.`id`,`ben`.`per_ben_nombre_primero` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_fichas_beneficiarios`
--
DROP TABLE IF EXISTS `view_dv_fichas_beneficiarios`;

CREATE VIEW `view_dv_fichas_beneficiarios`  AS  select `ficha`.`id` AS `fich_id`,`ficha`.`fecha_registro` AS `fich_fecha_registro`,`ficha`.`id_persona_beneficiario` AS `fich_id_persona_beneficiario`,`ficha`.`id_escolaridad_nivel` AS `fich_id_escolaridad_nivel`,`ficha`.`id_escolaridad_estado` AS `fich_id_escolaridad_estado`,`ficha`.`id_etnia` AS `fich_id_etnia`,`ficha`.`id_persona_acudiente` AS `fich_id_persona_acudiente`,`ficha`.`id_persona_acudiente_parentesco` AS `fich_id_persona_acudiente_parentesco`,`ficha`.`id_persona_vive_con_parentesco` AS `fich_id_persona_vive_con_parentesco`,`ficha`.`enfermedad_padece_si` AS `fich_enfermedad_padece_si`,`ficha`.`enfermedad_padece_nombre` AS `fich_enfermedad_padece_nombre`,`ficha`.`medicamentos_toma_si` AS `fich_medicamentos_toma_si`,`ficha`.`medicamentos_toma_nombre` AS `fich_medicamentos_toma_nombre`,`ficha`.`salud_afiliado` AS `fich_salud_afiliado`,`ficha`.`id_salud_regimen` AS `fich_id_salud_regimen`,`ficha`.`id_eps` AS `fich_id_eps`,`ficha`.`id_grupo` AS `fich_id_grupo`,`ficha`.`updated_at` AS `fich_updated_at`,`ficha`.`created_at` AS `fich_created_at`,`ficha`.`fecha_retiro` AS `fich_fecha_retiro`,`ficha`.`grupo_poblacional_otro` AS `fich_grupo_poblacional_otro`,`ficha`.`participacion_anterior_meses` AS `fich_participacion_anterior_meses`,`ficha`.`participacion_anterior_annos` AS `fich_participacion_anterior_annos`,`ficha`.`persona_vive_con_parentesco_otro` AS `fich_persona_vive_con_parentesco_otro`,`ficha`.`persona_acudiente_parentesco_otro` AS `fich_persona_acudiente_parentesco_otro`,`ficha`.`se_reconoce_como_cual` AS `fich_se_reconoce_como_cual`,`ficha`.`id_ocupacion` AS `fich_id_ocupacion`,`ficha`.`tiene_discapacidad` AS `fich_tiene_discapacidad`,`ficha`.`toma_medicamentos` AS `fich_toma_medicamentos`,`beneficiario`.`nombre_primero` AS `per_ben_nombre_primero`,`beneficiario`.`nombre_segundo` AS `per_ben_nombre_segundo`,`beneficiario`.`apellido_primero` AS `per_ben_apellido_primero`,`beneficiario`.`apellido_segundo` AS `per_ben_apellido_segundo`,`beneficiario`.`documento` AS `per_ben_documento`,`beneficiario`.`id_documento_tipo` AS `per_ben_id_documento_tipo`,`beneficiario`.`sexo` AS `per_ben_sexo`,`beneficiario`.`fecha_nacimiento` AS `per_ben_fecha_nacimiento`,timestampdiff(YEAR,`beneficiario`.`fecha_nacimiento`,curdate()) AS `edad`,`beneficiario`.`telefono_fijo` AS `per_ben_telefono_fijo`,`beneficiario`.`telefono_movil` AS `per_ben_telefono_movil`,`beneficiario`.`correo_electronico` AS `per_ben_correo_electronico`,`beneficiario`.`id_procedencia_pais` AS `per_ben_id_procedencia_pais`,`beneficiario`.`id_procedencia_municipio` AS `per_ben_id_procedencia_municipio`,`beneficiario`.`id_procedencia_departamento` AS `per_ben_id_procedencia_departamento`,`beneficiario`.`id_residencia_corregimiento` AS `per_ben_id_residencia_corregimiento`,`beneficiario`.`id_residencia_barrio` AS `per_ben_id_residencia_barrio`,`beneficiario`.`id_residencia_vereda` AS `per_ben_id_residencia_vereda`,`beneficiario`.`residencia_direccion` AS `per_ben_residencia_direccion`,`beneficiario`.`residencia_estrato` AS `per_ben_residencia_estrato`,`beneficiario`.`sangre_tipo` AS `per_ben_sangre_tipo`,`beneficiario`.`id_estado_civil` AS `per_ben_id_estado_civil` from (`tbl_gen_persona` `beneficiario` join `tbl_dv_ficha` `ficha` on(`ficha`.`id_persona_beneficiario` = `beneficiario`.`id`)) where `ficha`.`vinculado` = 1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_metodologos`
--
DROP TABLE IF EXISTS `view_dv_metodologos`;

CREATE VIEW `view_dv_metodologos`  AS  select `empleado_monitor`.`id_usuario` AS `id`,`monitor`.`nombre_primero` AS `per_met_nombre_primero`,`monitor`.`nombre_segundo` AS `per_met_nombre_segundo`,`monitor`.`apellido_primero` AS `per_met_apellido_primero`,`monitor`.`apellido_segundo` AS `per_met_apellido_segundo`,`monitor`.`documento` AS `per_met_documento`,`monitor`.`id_documento_tipo` AS `per_met_id_documento_tipo`,`monitor`.`sexo` AS `per_met_sexo`,`monitor`.`fecha_nacimiento` AS `per_met_fecha_nacimiento`,timestampdiff(YEAR,`monitor`.`fecha_nacimiento`,curdate()) AS `edad`,`monitor`.`telefono_fijo` AS `per_met_telefono_fijo`,`monitor`.`telefono_movil` AS `per_met_telefono_movil`,`monitor`.`correo_electronico` AS `per_met_correo_electronico`,`monitor`.`id_procedencia_pais` AS `per_met_id_procedencia_pais`,`monitor`.`id_procedencia_municipio` AS `per_met_id_procedencia_municipio`,`monitor`.`id_procedencia_departamento` AS `per_met_id_procedencia_departamento`,`monitor`.`id_residencia_corregimiento` AS `per_met_id_residencia_corregimiento`,`monitor`.`id_residencia_barrio` AS `per_met_id_residencia_barrio`,`monitor`.`id_residencia_vereda` AS `per_met_id_residencia_vereda`,`monitor`.`residencia_direccion` AS `per_met_residencia_direccion`,`monitor`.`residencia_estrato` AS `per_met_residencia_estrato`,`monitor`.`sangre_tipo` AS `per_met_sangre_tipo`,`monitor`.`id_estado_civil` AS `per_met_id_estado_civil`,`empleado_monitor`.`id` AS `id_empleado`,`empleado_monitor`.`id_persona` AS `emp_id_persona`,`empleado_monitor`.`id_estado_aspirante` AS `emp_id_estado_aspirante`,`empleado_monitor`.`tiene_hijos` AS `emp_tiene_hijos`,`empleado_monitor`.`cuantos_hijos` AS `emp_cuantos_hijos`,`empleado_monitor`.`libreta_militar` AS `emp_libreta_militar`,`empleado_monitor`.`no_libreta_militar` AS `emp_no_libreta_militar`,`empleado_monitor`.`distrito_militar` AS `emp_distrito_militar`,`empleado_monitor`.`skype` AS `emp_skype`,`empleado_monitor`.`id_disponibilidad` AS `emp_id_disponibilidad`,`empleado_monitor`.`foto` AS `emp_foto`,`empleado_monitor`.`profesion` AS `emp_profesion`,`empleado_monitor`.`id_disciplina` AS `emp_id_disciplina`,`empleado_monitor`.`id_ocupacion` AS `emp_id_ocupacion`,`empleado_monitor`.`tiene_discapacidad` AS `emp_tiene_discapacidad`,`empleado_monitor`.`padece_enfermedad` AS `emp_padece_enfermedad`,`empleado_monitor`.`enfermedad` AS `emp_enfermedad`,`empleado_monitor`.`toma_medicamentos` AS `emp_toma_medicamentos`,`empleado_monitor`.`medicamentos` AS `emp_medicamentos`,`empleado_monitor`.`afiliado_sgsss` AS `emp_afiliado_sgsss`,`empleado_monitor`.`id_tipo_afiliacion` AS `emp_id_tipo_afiliacion`,`empleado_monitor`.`id_eps` AS `emp_id_eps`,`empleado_monitor`.`proyecto_profesional` AS `emp_proyecto_profesional`,`empleado_monitor`.`id_cargo` AS `emp_id_cargo`,`empleado_monitor`.`id_escolaridad_nivel` AS `emp_id_escolaridad_nivel`,`empleado_monitor`.`created_at` AS `emp_created_at`,`empleado_monitor`.`updated_at` AS `emp_updated_at`,`empleado_monitor`.`id_etnia` AS `emp_id_etnia`,`empleado_monitor`.`id_institucion_educativa` AS `emp_id_institucion_educativa`,`empleado_monitor`.`activo` AS `emp_activo`,`empleado_monitor`.`id_presupuesto` AS `emp_id_presupuesto`,`empleado_monitor`.`id_estado_escolaridad` AS `emp_id_estado_escolaridad`,`empleado_monitor`.`nuevo` AS `emp_nuevo`,`usuario`.`primer_nombre` AS `usu_met_primer_nombre`,`usuario`.`email` AS `usu_met_email`,`usuario`.`created_at` AS `usu_met_created_at`,`usuario`.`updated_at` AS `usu_met_updated_at`,`usuario`.`segundo_nombre` AS `usu_met_segundo_nombre`,`usuario`.`primer_apellido` AS `usu_met_primer_apellido`,`usuario`.`segundo_apellido` AS `usu_met_segundo_apellido`,`usuario`.`tipo_documento` AS `usu_met_tipo_documento`,`usuario`.`numero_documento` AS `usu_met_numero_documento`,`usuario`.`direccion` AS `usu_met_direccion`,`usuario`.`fecha_nacimiento` AS `usu_met_fecha_nacimiento`,`usuario`.`telefono_movil` AS `usu_met_telefono_movil`,`usuario`.`telefono_fijo` AS `usu_met_telefono_fijo`,`usuario`.`tenantId` AS `usu_met_tenantId` from ((((`tbl_dv_empleado` `empleado_monitor` join `tbl_gen_persona` `monitor` on(`empleado_monitor`.`id_persona` = `monitor`.`id`)) join `users` `usuario` on(`empleado_monitor`.`id_usuario` = `usuario`.`id`)) join `role_user` `roles_usuario` on(`roles_usuario`.`user_id` = `usuario`.`id`)) join `roles` on(`roles`.`id` = `roles_usuario`.`role_id`)) where `roles`.`name` = 'Metodólogo' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_monitores`
--
DROP TABLE IF EXISTS `view_dv_monitores`;

CREATE VIEW `view_dv_monitores`  AS  select `empleado_monitor`.`id_usuario` AS `id`,`monitor`.`nombre_primero` AS `per_mon_nombre_primero`,`monitor`.`nombre_segundo` AS `per_mon_nombre_segundo`,`monitor`.`apellido_primero` AS `per_mon_apellido_primero`,`monitor`.`apellido_segundo` AS `per_mon_apellido_segundo`,`monitor`.`documento` AS `per_mon_documento`,`monitor`.`id_documento_tipo` AS `per_mon_id_documento_tipo`,`monitor`.`sexo` AS `per_mon_sexo`,`monitor`.`fecha_nacimiento` AS `per_mon_fecha_nacimiento`,timestampdiff(YEAR,`monitor`.`fecha_nacimiento`,curdate()) AS `edad`,`monitor`.`telefono_fijo` AS `per_mon_telefono_fijo`,`monitor`.`telefono_movil` AS `per_mon_telefono_movil`,`monitor`.`correo_electronico` AS `per_mon_correo_electronico`,`monitor`.`id_procedencia_pais` AS `per_mon_id_procedencia_pais`,`monitor`.`id_procedencia_municipio` AS `per_mon_id_procedencia_municipio`,`monitor`.`id_procedencia_departamento` AS `per_mon_id_procedencia_departamento`,`monitor`.`id_residencia_corregimiento` AS `per_mon_id_residencia_corregimiento`,`monitor`.`id_residencia_barrio` AS `per_mon_id_residencia_barrio`,`monitor`.`id_residencia_vereda` AS `per_mon_id_residencia_vereda`,`monitor`.`residencia_direccion` AS `per_mon_residencia_direccion`,`monitor`.`residencia_estrato` AS `per_mon_residencia_estrato`,`monitor`.`sangre_tipo` AS `per_mon_sangre_tipo`,`monitor`.`id_estado_civil` AS `per_mon_id_estado_civil`,`empleado_monitor`.`id` AS `id_empleado`,`empleado_monitor`.`id_persona` AS `emp_id_persona`,`empleado_monitor`.`id_estado_aspirante` AS `emp_id_estado_aspirante`,`empleado_monitor`.`tiene_hijos` AS `emp_tiene_hijos`,`empleado_monitor`.`cuantos_hijos` AS `emp_cuantos_hijos`,`empleado_monitor`.`libreta_militar` AS `emp_libreta_militar`,`empleado_monitor`.`no_libreta_militar` AS `emp_no_libreta_militar`,`empleado_monitor`.`distrito_militar` AS `emp_distrito_militar`,`empleado_monitor`.`skype` AS `emp_skype`,`empleado_monitor`.`id_disponibilidad` AS `emp_id_disponibilidad`,`empleado_monitor`.`foto` AS `emp_foto`,`empleado_monitor`.`profesion` AS `emp_profesion`,`empleado_monitor`.`id_disciplina` AS `emp_id_disciplina`,`empleado_monitor`.`id_ocupacion` AS `emp_id_ocupacion`,`empleado_monitor`.`tiene_discapacidad` AS `emp_tiene_discapacidad`,`empleado_monitor`.`padece_enfermedad` AS `emp_padece_enfermedad`,`empleado_monitor`.`enfermedad` AS `emp_enfermedad`,`empleado_monitor`.`toma_medicamentos` AS `emp_toma_medicamentos`,`empleado_monitor`.`medicamentos` AS `emp_medicamentos`,`empleado_monitor`.`afiliado_sgsss` AS `emp_afiliado_sgsss`,`empleado_monitor`.`id_tipo_afiliacion` AS `emp_id_tipo_afiliacion`,`empleado_monitor`.`id_eps` AS `emp_id_eps`,`empleado_monitor`.`proyecto_profesional` AS `emp_proyecto_profesional`,`empleado_monitor`.`id_cargo` AS `emp_id_cargo`,`empleado_monitor`.`id_escolaridad_nivel` AS `emp_id_escolaridad_nivel`,`empleado_monitor`.`created_at` AS `emp_created_at`,`empleado_monitor`.`updated_at` AS `emp_updated_at`,`empleado_monitor`.`id_etnia` AS `emp_id_etnia`,`empleado_monitor`.`id_institucion_educativa` AS `emp_id_institucion_educativa`,`empleado_monitor`.`activo` AS `emp_activo`,`empleado_monitor`.`id_presupuesto` AS `emp_id_presupuesto`,`empleado_monitor`.`id_estado_escolaridad` AS `emp_id_estado_escolaridad`,`empleado_monitor`.`nuevo` AS `emp_nuevo`,`usuario`.`primer_nombre` AS `usu_mon_primer_nombre`,`usuario`.`email` AS `usu_mon_email`,`usuario`.`created_at` AS `usu_mon_created_at`,`usuario`.`updated_at` AS `usu_mon_updated_at`,`usuario`.`segundo_nombre` AS `usu_mon_segundo_nombre`,`usuario`.`primer_apellido` AS `usu_mon_primer_apellido`,`usuario`.`segundo_apellido` AS `usu_mon_segundo_apellido`,`usuario`.`tipo_documento` AS `usu_mon_tipo_documento`,`usuario`.`numero_documento` AS `usu_mon_numero_documento`,`usuario`.`direccion` AS `usu_mon_direccion`,`usuario`.`fecha_nacimiento` AS `usu_mon_fecha_nacimiento`,`usuario`.`telefono_movil` AS `usu_mon_telefono_movil`,`usuario`.`telefono_fijo` AS `usu_mon_telefono_fijo`,`usuario`.`tenantId` AS `usu_mon_tenantId` from ((((`tbl_dv_empleado` `empleado_monitor` join `tbl_gen_persona` `monitor` on(`empleado_monitor`.`id_persona` = `monitor`.`id`)) join `users` `usuario` on(`empleado_monitor`.`id_usuario` = `usuario`.`id`)) join `role_user` `roles_usuario` on(`roles_usuario`.`user_id` = `usuario`.`id`)) join `roles` on(`roles`.`id` = `roles_usuario`.`role_id`)) where `roles`.`name` = 'Monitor' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_grupo_poblacional_ficha`
--
DROP TABLE IF EXISTS `view_grupo_poblacional_ficha`;

CREATE VIEW `view_grupo_poblacional_ficha`  AS  select group_concat(`tbl_cm_grupo_poblacional`.`nombre` separator ',') AS `nombre`,`poblacional_beneficiarios`.`ficha_id` AS `ficha_id` from (`poblacional_beneficiarios` join `tbl_cm_grupo_poblacional` on(`poblacional_beneficiarios`.`grupo_pcs` = `tbl_cm_grupo_poblacional`.`id`)) group by `poblacional_beneficiarios`.`ficha_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_grupo_poblacional_ficha_pr`
--
DROP TABLE IF EXISTS `view_grupo_poblacional_ficha_pr`;

CREATE VIEW `view_grupo_poblacional_ficha_pr`  AS  select group_concat(`tbl_gen_grupo_poblacional`.`descripcion` separator ',') AS `nombre`,`tbl_pr_poblacional_beneficiarios`.`ficha_id` AS `ficha_id` from (`tbl_pr_poblacional_beneficiarios` join `tbl_gen_grupo_poblacional` on(`tbl_pr_poblacional_beneficiarios`.`grupo_pcs` = `tbl_gen_grupo_poblacional`.`id`)) group by `tbl_pr_poblacional_beneficiarios`.`ficha_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_reporte_general`
--
DROP TABLE IF EXISTS `vista_reporte_general`;

CREATE VIEW `vista_reporte_general`  AS  select `tbl_cm_ficha`.`tenantId` AS `tenantId`,`tbl_cm_ficha`.`id` AS `id`,`grupos`.`codigo_grupo` AS `codigo_grupo`,`tbl_cm_grados`.`nombre_grado` AS `nombre_grado`,`instituciones`.`nombre_institucion` AS `nombre_institucion`,`sedes`.`nombre_sede` AS `nombre_sede`,`tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,`tbl_gen_persona`.`documento` AS `documento`,`tbl_cm_ficha`.`no_ficha` AS `no_ficha`,`tbl_cm_ficha`.`fecha_inscripcion` AS `fecha_inscripcion`,`tbl_gen_persona`.`nombre_primero` AS `nombre_primero`,`tbl_gen_persona`.`nombre_segundo` AS `nombre_segundo`,`tbl_gen_persona`.`apellido_primero` AS `apellido_primero`,`tbl_gen_persona`.`apellido_segundo` AS `apellido_segundo`,`tbl_gen_persona`.`correo_electronico` AS `correo_electronico`,case when `tbl_gen_persona`.`sexo` = 1 then 'Mujer' when `tbl_gen_persona`.`sexo` = 2 then 'Hombre' else 'Mujer' end AS `sexo`,`tbl_gen_persona`.`fecha_nacimiento` AS `fecha_nacimiento`,timestampdiff(YEAR,`tbl_gen_persona`.`fecha_nacimiento`,curdate()) AS `edad_persona`,`paises`.`nombre_pais` AS `nombre_pais`,`departamentos`.`nombre_departamento` AS `nombre_departamento`,`municipios`.`nombre_municipio` AS `nombre_municipio`,`tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,`tbl_gen_veredas`.`nombre` AS `nombre_vereda`,`barrios`.`nombre_barrio` AS `nombre_barrio`,`tbl_gen_persona`.`residencia_estrato` AS `residencia_estrato`,`comunas`.`nombre_comuna` AS `nombre_comuna`,`tbl_gen_persona`.`residencia_direccion` AS `residencia_direccion`,`tbl_gen_persona`.`telefono_fijo` AS `telefono_fijo`,`tbl_gen_persona`.`telefono_movil` AS `telefono_movil`,`tbl_gen_escolaridad_nivel`.`descripcion` AS `nivel_escolaridad`,`tbl_gen_escolaridad_estado`.`descripcion` AS `estado_escolaridad`,`tbl_gen_ocupacion`.`descripcion` AS `ocupacion_beneficiario`,`tbl_gen_estado_civil`.`descripcion` AS `estado_civil`,case when `tbl_cm_ficha`.`hijos_beneficiario` = 1 then 'Si' else 'No' end AS `hijos_beneficiario`,`tbl_cm_ficha`.`cantidad_hijos_beneficiario` AS `cantidad_hijos_beneficiario`,`tbl_gen_etnia`.`descripcion` AS `etnia_beneficiario`,`view_grupo_poblacional_ficha`.`nombre` AS `grupo_poblacional`,`view_discapacidad_persona_ficha`.`nombre_discapacidad` AS `discapacidades`,case when `tbl_cm_ficha`.`discapacidad_beneficiario` = 1 then 'Si' else 'No' end AS `enfermedad_permanente`,`tbl_cm_ficha`.`otra_discapacidad_beneficiario` AS `otra_discapacidad_beneficiario`,case when `tbl_cm_ficha`.`medicamentos_permanente_beneficiario` = 1 then 'Si' else 'No' end AS `toma_medicamentos`,`tbl_cm_ficha`.`medicamentos_beneficiario` AS `medicamentos_beneficiario`,`tbl_gen_persona`.`sangre_tipo` AS `sangre_tipo`,case when `tbl_cm_ficha`.`afiliacion_salud` = 1 then 'Si' else 'No' end AS `afiliacion_salud`,`tbl_gen_salud_regimen`.`descripcion` AS `tipo_afiliacion`,`tbl_gen_eps`.`descripcion` AS `nombre_eps`,`tipo_documento_acudiente`.`descripcion` AS `tipo_documento_acudiente`,`acudiente_persona`.`documento` AS `documento_acudiente`,`acudiente_persona`.`nombre_primero` AS `primer_nombre_acudiente`,`acudiente_persona`.`nombre_segundo` AS `segundo_nombre_acudiente`,`acudiente_persona`.`apellido_primero` AS `primer_apellido_acudiente`,`acudiente_persona`.`apellido_segundo` AS `segundo_apellido_acudiente`,case when `acudiente_persona`.`sexo` = 1 then 'Mujer' when `acudiente_persona`.`sexo` = 2 then 'Hombre' else 'Mujer' end AS `sexo_acudiente`,`acudiente_persona`.`fecha_nacimiento` AS `fecha_nacimiento_acudiente`,`acudiente_persona`.`telefono_fijo` AS `telefono_fijo_acudiente`,`acudiente_persona`.`telefono_movil` AS `telefono_movil_acudiente`,`acudiente_persona`.`correo_electronico` AS `correo_acudiente`,case when `tbl_cm_ficha`.`parentesco_acudiente` = 1 then 'Madre/Padre' when `tbl_cm_ficha`.`parentesco_acudiente` = 2 then 'Hermana/Hermano' when `tbl_cm_ficha`.`parentesco_acudiente` = 3 then 'Tia/Tio' when `tbl_cm_ficha`.`parentesco_acudiente` = 4 then 'Abuela/Abuelo' when `tbl_cm_ficha`.`parentesco_acudiente` = 5 then 'Cuidador' else 'Otro' end AS `parentesco_acudiente`,`tbl_cm_ficha`.`otro_parentesco_acudiente` AS `otro_parentesco_acudiente`,`users`.`primer_nombre` AS `primer_nombre_usuario`,`users`.`primer_apellido` AS `primer_apellido_usuario` from (((((((((((((((((((((((((((`tbl_cm_ficha` left join `tbl_gen_persona` on(`tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario`)) left join `tbl_gen_persona` `acudiente_persona` on(`acudiente_persona`.`id` = `tbl_cm_ficha`.`id_persona_acudiente`)) left join `poblacional_beneficiarios` on(`tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id`)) left join `tbl_cm_persona_x_discapacidad` on(`tbl_cm_ficha`.`id` = `tbl_cm_persona_x_discapacidad`.`ficha_id`)) left join `grupos` on(`grupos`.`id` = `tbl_cm_ficha`.`grupo_id`)) left join `sedes` on(`sedes`.`id` = `grupos`.`sede_id`)) left join `instituciones` on(`instituciones`.`id` = `sedes`.`institucion_id`)) left join `tbl_cm_grados` on(`tbl_cm_grados`.`id` = `grupos`.`grado_id`)) left join `comunas` on(`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)) left join `users` on(`users`.`id` = `grupos`.`user_id`)) left join `view_grupo_poblacional_ficha` on(`tbl_cm_ficha`.`id` = `view_grupo_poblacional_ficha`.`ficha_id`)) left join `view_discapacidad_persona_ficha` on(`tbl_cm_ficha`.`id` = `view_discapacidad_persona_ficha`.`ficha_id`)) left join `paises` on(`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)) left join `departamentos` on(`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)) left join `municipios` on(`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)) left join `barrios` on(`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)) left join `tbl_gen_corregimientos` on(`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)) left join `tbl_gen_veredas` on(`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)) left join `tbl_gen_estado_civil` on(`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)) left join `tbl_gen_escolaridad_nivel` on(`tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id`)) left join `tbl_gen_documento_tipo` on(`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)) left join `tbl_gen_documento_tipo` `tipo_documento_acudiente` on(`tipo_documento_acudiente`.`id` = `acudiente_persona`.`id_documento_tipo`)) left join `tbl_gen_eps` on(`tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id`)) left join `tbl_gen_ocupacion` on(`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)) left join `tbl_gen_etnia` on(`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)) left join `tbl_gen_escolaridad_estado` on(`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)) left join `tbl_gen_salud_regimen` on(`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)) ;

DELIMITER $$
--
-- Funciones
--
CREATE FUNCTION `fn_dia_fecha` (`fecha` DATE) RETURNS VARCHAR(20) CHARSET latin1 BEGIN

  RETURN (
  CASE
    WHEN DAYOFWEEK(fecha) = 1 THEN 'Domingo'
    WHEN DAYOFWEEK(fecha) = 2 THEN 'Lunes'
    WHEN DAYOFWEEK(fecha) = 3 THEN 'Martes'
    WHEN DAYOFWEEK(fecha) = 4 THEN 'Miercoles'
    WHEN DAYOFWEEK(fecha) = 5 THEN 'Jueves'
    WHEN DAYOFWEEK(fecha) = 6 THEN 'Viernes'
    WHEN DAYOFWEEK(fecha) = 7 THEN 'Sabado'
  
  END
  
  )
  ;
END$$

CREATE FUNCTION `fn_implementos_cantidad` (`id_implemento` INTEGER(11)) RETURNS INT(11) BEGIN
  RETURN (SELECT 
  CASE 
  WHEN `tbl_dv_prestamo_inventario`.`estado`=1 THEN 
  (
   	`tbl_dv_implementos`.`stock`- 
    COALESCE(SUM(`tbl_dv_deatalle_prestamo`.`cantidad`),0)  +
    (
    SELECT 
  		COALESCE(SUM(`cant_nueva`.`cantidad`),0)
	FROM
  		`tbl_dv_deatalle_entrada` `cant_nueva`
	WHERE
  		`cant_nueva`.`implemento_id` =  `tbl_dv_implementos`.`id` 
    )
    +
    (
    SELECT 
  		COALESCE(sum(`devueltos`.`cantidad`),0) as devuelto
	FROM
  		`tbl_dv_deatalle_devolucion` `devueltos`
  	WHERE
    	`devueltos`.`implemento_id`= `tbl_dv_implementos`.`id` 
    AND
    	`devueltos`.`id_deatalle_prestamo_devolucion_estado`=1 
    )
  
  )
  ELSE `tbl_dv_implementos`.`stock`+(SELECT 
  COALESCE(SUM(`cant_nueva`.`cantidad`),0)
FROM
  `tbl_dv_deatalle_entrada` `cant_nueva`
WHERE
  `cant_nueva`.`implemento_id` =  `tbl_dv_implementos`.`id` ) 
  
  END AS  cantidad
FROM
  `tbl_dv_deatalle_prestamo`
  INNER JOIN `tbl_dv_implementos` ON (`tbl_dv_deatalle_prestamo`.`implemento_id` = `tbl_dv_implementos`.`id`)
  INNER JOIN `tbl_dv_prestamo_inventario` ON (`tbl_dv_deatalle_prestamo`.`prestamo_id` = `tbl_dv_prestamo_inventario`.`id`)
WHERE
`tbl_dv_implementos`.`id` = id_implemento );
END$$

CREATE FUNCTION `fn_mes_fecha` (`fecha` DATE) RETURNS VARCHAR(20) CHARSET latin1 BEGIN

 RETURN (
 CASE 
 WHEN month(fecha)=1 THEN 'Enero'
 WHEN month(fecha)=2 THEN 'Febrero'
 WHEN month(fecha)=3 THEN 'Marzo'
 WHEN month(fecha)=4 THEN 'Abril'
 WHEN month(fecha)=5 THEN 'Mayo'
 WHEN month(fecha)=6 THEN 'Junio'
 WHEN month(fecha)=7 THEN 'Julio'
 WHEN month(fecha)=8 THEN 'Agosto'
 WHEN month(fecha)=9 THEN 'Septiembre'
 WHEN month(fecha)=10 THEN 'Octubre'
 WHEN month(fecha)=11 THEN 'Noviembre'
 WHEN month(fecha)=12 THEN 'Diciembre'
 END
 );
END$$

CREATE FUNCTION `fn_total` (`id_grupo_poblacional` INTEGER(11), `id_persona` INTEGER(11)) RETURNS VARCHAR(2) CHARSET utf8 BEGIN

  RETURN (SELECT 
  case
  when count(`tbl_gen_grupo_poblacional`.`descripcion`)>0 then 'SI' else 'NO'
  end
FROM
  `tbl_gen_grupo_poblacional`
  INNER JOIN `tbl_gen_persona_x_grupo_poblacional` ON (`tbl_gen_grupo_poblacional`.`id` = `tbl_gen_persona_x_grupo_poblacional`.`id_grupo_poblacional`)
WHERE
  `tbl_gen_persona_x_grupo_poblacional`.`id_persona`=id_persona
AND
  tbl_gen_grupo_poblacional.id=id_grupo_poblacional);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura para la vista `sin_planificacion`
--
DROP TABLE IF EXISTS `sin_planificacion`;

CREATE VIEW `sin_planificacion`  AS  select `tbl_dv_grupos_horario_planificacion`.`id` AS `id`,`users`.`numero_documento` AS `monitor_documento`,concat_ws(' ',`users`.`primer_nombre`,`users`.`segundo_nombre`,`users`.`primer_apellido`,`users`.`segundo_apellido`) AS `monitor_nombre`,`tbl_dv_grupos`.`codigo_grupo` AS `codigo_grupo`,`fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) AS `dia`,`tbl_dv_grupos_horario_planificacion`.`fecha` AS `fecha`,`tbl_dv_grupos_horario_planificacion`.`hora_inicio` AS `hora_inicio`,`tbl_dv_grupos_horario_planificacion`.`hora_fin` AS `hora_fin`,`tbl_dv_escenarios`.`nombre_escenario` AS `nombre_escenario`,`tbl_dv_grupos_horario_planificacion`.`eje_tematico` AS `eje_tematico`,`tbl_dv_grupos_horario_planificacion`.`tema` AS `tema`,`tbl_dv_grupos_horario_planificacion`.`objetivo` AS `objetivo` from (((`tbl_dv_grupos_horario_planificacion` join `tbl_dv_grupos` on(`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)) join `tbl_dv_escenarios` on(`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)) join `users` on(`tbl_dv_grupos`.`id_monitor` = `users`.`id`)) where `tbl_dv_grupos_horario_planificacion`.`hora_inicio` is null order by `users`.`numero_documento`,`tbl_dv_grupos`.`codigo_grupo`,`tbl_dv_grupos_horario_planificacion`.`fecha`,`tbl_dv_escenarios`.`nombre_escenario` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_dv_usuarios`
--
DROP TABLE IF EXISTS `view_dv_usuarios`;

CREATE VIEW `view_dv_usuarios`  AS  select `tbl_gen_persona`.`id` AS `id`,`tbl_dv_estado_aspirante`.`descripcion` AS `estado_aspirante`,coalesce(`tbl_dv_presupuesto`.`descripcion`,'') AS `presupuesto`,`tbl_gen_persona`.`nombre_primero` AS `nombre_primero`,coalesce(`tbl_gen_persona`.`nombre_segundo`,'') AS `nombre_segundo`,coalesce(`tbl_gen_persona`.`apellido_primero`,'') AS `apellido_primero`,coalesce(`tbl_gen_persona`.`apellido_segundo`,'') AS `apellido_segundo`,`tbl_gen_estado_civil`.`descripcion` AS `estado_civil`,`tbl_gen_documento_tipo`.`descripcion_2` AS `documento_tipo`,`users`.`numero_documento` AS `numero_documento`,case when `tbl_gen_persona`.`sexo` = '1' then 'MASCULINO' when `tbl_gen_persona`.`sexo` = '2' then 'FEMENINO' end AS `sexo`,cast(`tbl_gen_persona`.`fecha_nacimiento` as date) AS `fecha_nacimiento`,timestampdiff(YEAR,`tbl_gen_persona`.`fecha_nacimiento`,current_timestamp()) AS `edad`,coalesce(`tbl_gen_persona`.`telefono_fijo`,'') AS `telefono_fijo`,coalesce(`tbl_gen_persona`.`telefono_movil`,'') AS `telefono_movil`,coalesce(`tbl_gen_persona`.`correo_electronico`,'') AS `correo_electronico`,`paises`.`nombre_pais` AS `pais`,coalesce(`departamentos`.`nombre_departamento`,'') AS `departamento`,coalesce(`municipios`.`nombre_municipio`,'') AS `municipio`,coalesce(`tbl_gen_persona`.`residencia_direccion`,'') AS `direccion`,coalesce(`tbl_gen_persona`.`residencia_estrato`,'') AS `estrato`,coalesce(`barrios`.`nombre_barrio`,'') AS `barrio`,coalesce(`comunas`.`codigo_comuna`,'') AS `comuna_residencia`,coalesce(`tbl_gen_corregimientos`.`descripcion`,'') AS `corregimiento`,coalesce(`tbl_gen_veredas`.`nombre`,'') AS `vereda`,group_concat(distinct coalesce(`tbl_gen_ocupacion`.`descripcion`,'') separator ',') AS `ocupacion`,'' AS `titulo_obtenido`,coalesce(`tbl_gen_escolaridad_nivel`.`descripcion`,'') AS `escolaridad`,coalesce(`tbl_gen_escolaridad_estado`.`descripcion`,'') AS `estado_escolaridad`,coalesce(`tbl_dv_instituciones_educativas`.`nombre`,'') AS `universidad`,coalesce(`tbl_dv_empleado`.`enfermedad`,'') AS `enfermedad`,coalesce(`tbl_dv_empleado`.`medicamentos`,'') AS `medicamentos`,case when `tbl_dv_empleado`.`afiliado_sgsss` = '1' then 'SI' else 'NO' end AS `afiliado_sgsss`,coalesce(`tbl_dv_empleado`.`cuantos_hijos`) AS `cuantos_hijos`,`tbl_gen_etnia`.`descripcion` AS `autoreconoce`,case when (select coalesce(group_concat(`tbl_gen_discapacidad`.`descripcion` separator ','),'') AS `discapacidad` from (`tbl_dv_persona_x_discapacidad` join `tbl_gen_discapacidad` on(`tbl_dv_persona_x_discapacidad`.`id_discapacidad` = `tbl_gen_discapacidad`.`id`)) where `tbl_dv_persona_x_discapacidad`.`id_persona` = `users`.`id`) <> '' then 'SI' else 'NO' end AS `discapacidad`,(select coalesce(group_concat(`tbl_gen_discapacidad`.`descripcion` separator ','),'') AS `discapacidad` from (`tbl_dv_persona_x_discapacidad` join `tbl_gen_discapacidad` on(`tbl_dv_persona_x_discapacidad`.`id_discapacidad` = `tbl_gen_discapacidad`.`id`)) where `tbl_dv_persona_x_discapacidad`.`id_persona` = `users`.`id`) AS `TIPO_DISCAPACIDAD`,`fn_total`(1,`tbl_gen_persona`.`id`) AS `indigena`,`fn_total`(2,`tbl_gen_persona`.`id`) AS `afrodescendiente`,`fn_total`(3,`tbl_gen_persona`.`id`) AS `victima_del_conflicto`,`fn_total`(4,`tbl_gen_persona`.`id`) AS `adulto_mayor`,`fn_total`(5,`tbl_gen_persona`.`id`) AS `lgbti`,`fn_total`(6,`tbl_gen_persona`.`id`) AS `Grupo_organizado_de_mujeres`,`fn_total`(7,`tbl_gen_persona`.`id`) AS `Grupo_organizado_de_jovenes`,`fn_total`(8,`tbl_gen_persona`.`id`) AS `Junta_de_accion_comunal`,`fn_total`(9,`tbl_gen_persona`.`id`) AS `Junta_administradora_local`,`fn_total`(10,`tbl_gen_persona`.`id`) AS `Otro` from (((((((((((((((((((`tbl_dv_empleado` left join `tbl_gen_persona` on(`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)) left join `tbl_gen_documento_tipo` on(`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)) left join `tbl_dv_estado_aspirante` on(`tbl_dv_empleado`.`id_estado_aspirante` = `tbl_dv_estado_aspirante`.`id`)) left join `tbl_gen_escolaridad_nivel` on(`tbl_dv_empleado`.`id_escolaridad_nivel` = `tbl_gen_escolaridad_nivel`.`id`)) left join `tbl_dv_presupuesto` on(`tbl_dv_empleado`.`id_presupuesto` = `tbl_dv_presupuesto`.`id`)) left join `paises` on(`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)) left join `municipios` on(`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)) left join `departamentos` on(`municipios`.`departamento_id` = `departamentos`.`id`)) left join `users` on(`tbl_dv_empleado`.`id_usuario` = `users`.`id`)) left join `barrios` on(`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)) left join `comunas` on(`barrios`.`comuna_id` = `comunas`.`id`)) left join `tbl_dv_persona_x_ocupacion` on(`tbl_gen_persona`.`id` = `tbl_dv_persona_x_ocupacion`.`id_persona`)) left join `tbl_gen_ocupacion` on(`tbl_dv_persona_x_ocupacion`.`id_ocupacion` = `tbl_gen_ocupacion`.`id`)) left join `tbl_gen_escolaridad_estado` on(`tbl_dv_empleado`.`id_estado_escolaridad` = `tbl_gen_escolaridad_estado`.`id`)) left join `tbl_dv_instituciones_educativas` on(`tbl_dv_empleado`.`id_institucion_educativa` = `tbl_dv_instituciones_educativas`.`id`)) left join `tbl_gen_etnia` on(`tbl_dv_empleado`.`id_etnia` = `tbl_gen_etnia`.`id`)) left join `tbl_gen_corregimientos` on(`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)) left join `tbl_gen_veredas` on(`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)) join `tbl_gen_estado_civil` on(`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)) where `users`.`tenantId` = 312312312 group by `tbl_dv_empleado`.`id_usuario` order by `tbl_gen_persona`.`nombre_primero`,`tbl_gen_persona`.`nombre_segundo`,`tbl_gen_persona`.`apellido_primero`,`tbl_gen_persona`.`apellido_segundo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_cdp_informe_parcial`
--
DROP TABLE IF EXISTS `view_cdp_informe_parcial`;

CREATE VIEW `view_cdp_informe_parcial`  AS  select `tbl_gen_contrato_cuota`.`id` AS `id`,`tbl_gen_persona`.`nombre_primero` AS `nombre_primero`,`tbl_gen_persona`.`nombre_segundo` AS `nombre_segundo`,`tbl_gen_persona`.`apellido_primero` AS `apellido_primero`,`tbl_gen_persona`.`apellido_segundo` AS `apellido_segundo`,`tbl_gen_persona`.`documento` AS `documento`,`tbl_gen_contrato`.`contrato_numero` AS `contrato_numero`,`tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion` AS `fecha_transaccion`,`tbl_gen_contrato`.`contrato_objeto` AS `contrato_objeto`,`tbl_gen_contrato`.`fecha_inicio` AS `fecha_inicio`,`tbl_gen_contrato`.`fecha_terminacion` AS `fecha_terminacion`,`tbl_gen_contrato`.`contrato_valor` AS `contrato_valor`,`tbl_gen_contrato_cuota`.`valor_cuota` AS `valor_cuota`,`tbl_gen_contrato_cuota`.`valor_saldo` AS `valor_saldo`,`tbl_gen_contrato`.`contrato_valor` - (`tbl_gen_contrato_cuota`.`valor_cuota` + `tbl_gen_contrato_cuota`.`valor_saldo`) AS `valor_acumulado`,`tbl_gen_contrato_cuota`.`cuota_numero` AS `cuota_numero`,`tbl_gen_contrato_cuenta_cobro`.`planilla_numero` AS `planilla_numero`,`tbl_gen_contrato_cuenta_cobro`.`pin_numero` AS `pin_numero`,`tbl_gen_contrato_cuenta_cobro`.`operador` AS `operador`,concat_ws(' de ',convert(date_format(`tbl_gen_contrato_cuenta_cobro`.`fecha_pago`,'%d') using utf8mb4),convert(`fn_mes_fecha`(`tbl_gen_contrato_cuenta_cobro`.`fecha_pago`) using utf8mb4),convert(date_format(`tbl_gen_contrato_cuenta_cobro`.`fecha_pago`,'%Y') using utf8mb4)) AS `fecha_pago`,`fn_mes_fecha`(cast(concat('2018-',`tbl_gen_contrato_cuenta_cobro`.`periodo_pago_seguridad_social`,'-01') as date)) AS `periodo`,`tbl_gen_contrato_cuenta_cobro`.`periodo_seguridad_social_year` AS `periodo_year`,`tbl_gen_contrato_cuenta_cobro`.`tareas_supervisor` AS `tareas_supervisor` from (((`tbl_gen_contrato_cuota` left join `tbl_gen_contrato` on(`tbl_gen_contrato_cuota`.`id_contrato` = `tbl_gen_contrato`.`id`)) left join `tbl_gen_contrato_cuenta_cobro` on(`tbl_gen_contrato_cuota`.`id` = `tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota`)) left join `tbl_gen_persona` on(`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)) ;
