--
-- PostgreSQL database dump
--

-- Dumped from database version 11.7
-- Dumped by pg_dump version 12.0

-- Started on 2020-06-29 18:34:46

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 7 (class 2615 OID 17544)
-- Name: zeus; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA zeus;


ALTER SCHEMA zeus OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 17237)
-- Name: cita_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cita_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cita_id_seq OWNER TO postgres;

SET default_tablespace = '';

--
-- TOC entry 214 (class 1259 OID 17269)
-- Name: citas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.citas (
    id bigint NOT NULL,
    id_paciente bigint NOT NULL,
    id_parentezco bigint NOT NULL,
    id_estado_seguimiento bigint NOT NULL,
    id_servicio_aplicado bigint NOT NULL,
    id_personal_salud bigint NOT NULL,
    id_servicio_complementario bigint NOT NULL,
    id_periodo_academico bigint NOT NULL,
    acudiente character varying(200) NOT NULL,
    fecha_cita date NOT NULL,
    hora_cita time(0) without time zone NOT NULL,
    observaciones text
);


ALTER TABLE public.citas OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 17267)
-- Name: citas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.citas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.citas_id_seq OWNER TO postgres;

--
-- TOC entry 3081 (class 0 OID 0)
-- Dependencies: 213
-- Name: citas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.citas_id_seq OWNED BY public.citas.id;


--
-- TOC entry 199 (class 1259 OID 17239)
-- Name: estado_seguimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estado_seguimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estado_seguimiento_id_seq OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 17287)
-- Name: estados_seguimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estados_seguimientos (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.estados_seguimientos OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 17285)
-- Name: estados_seguimientos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estados_seguimientos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estados_seguimientos_id_seq OWNER TO postgres;

--
-- TOC entry 3082 (class 0 OID 0)
-- Dependencies: 215
-- Name: estados_seguimientos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estados_seguimientos_id_seq OWNED BY public.estados_seguimientos.id;


--
-- TOC entry 200 (class 1259 OID 17241)
-- Name: estudiante_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estudiante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiante_id_seq OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 17295)
-- Name: estudiantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estudiantes (
    id bigint NOT NULL,
    id_programa bigint NOT NULL,
    id_semestre bigint NOT NULL,
    id_persona bigint NOT NULL,
    codigo character varying(50) NOT NULL
);


ALTER TABLE public.estudiantes OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 17293)
-- Name: estudiantes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estudiantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiantes_id_seq OWNER TO postgres;

--
-- TOC entry 3083 (class 0 OID 0)
-- Dependencies: 217
-- Name: estudiantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estudiantes_id_seq OWNED BY public.estudiantes.id;


--
-- TOC entry 197 (class 1259 OID 17232)
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.migration_versions OWNER TO postgres;

--
-- TOC entry 3084 (class 0 OID 0)
-- Dependencies: 197
-- Name: COLUMN migration_versions.executed_at; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.migration_versions.executed_at IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 201 (class 1259 OID 17243)
-- Name: modalidad_afiliacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.modalidad_afiliacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modalidad_afiliacion_id_seq OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 17306)
-- Name: modalidades_afiliacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modalidades_afiliacion (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.modalidades_afiliacion OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 17304)
-- Name: modalidades_afiliacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.modalidades_afiliacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modalidades_afiliacion_id_seq OWNER TO postgres;

--
-- TOC entry 3085 (class 0 OID 0)
-- Dependencies: 219
-- Name: modalidades_afiliacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.modalidades_afiliacion_id_seq OWNED BY public.modalidades_afiliacion.id;


--
-- TOC entry 202 (class 1259 OID 17245)
-- Name: paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paciente_id_seq OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 17314)
-- Name: pacientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pacientes (
    id bigint NOT NULL,
    id_estudiante bigint NOT NULL,
    id_modalidad_afiliacion bigint NOT NULL,
    eps character varying(50) NOT NULL
);


ALTER TABLE public.pacientes OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 17312)
-- Name: pacientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pacientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pacientes_id_seq OWNER TO postgres;

--
-- TOC entry 3086 (class 0 OID 0)
-- Dependencies: 221
-- Name: pacientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pacientes_id_seq OWNED BY public.pacientes.id;


--
-- TOC entry 203 (class 1259 OID 17247)
-- Name: parentezco_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parentezco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parentezco_id_seq OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 17324)
-- Name: parentezcos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parentezcos (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.parentezcos OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 17322)
-- Name: parentezcos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parentezcos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parentezcos_id_seq OWNER TO postgres;

--
-- TOC entry 3087 (class 0 OID 0)
-- Dependencies: 223
-- Name: parentezcos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.parentezcos_id_seq OWNED BY public.parentezcos.id;


--
-- TOC entry 204 (class 1259 OID 17249)
-- Name: periodo_academico_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.periodo_academico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodo_academico_id_seq OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 17332)
-- Name: periodos_academicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.periodos_academicos (
    id bigint NOT NULL,
    anio integer NOT NULL,
    periodo smallint NOT NULL
);


ALTER TABLE public.periodos_academicos OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 17330)
-- Name: periodos_academicos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.periodos_academicos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodos_academicos_id_seq OWNER TO postgres;

--
-- TOC entry 3088 (class 0 OID 0)
-- Dependencies: 225
-- Name: periodos_academicos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.periodos_academicos_id_seq OWNED BY public.periodos_academicos.id;


--
-- TOC entry 205 (class 1259 OID 17251)
-- Name: persona_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_id_seq OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 17349)
-- Name: personal_salud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_salud (
    id bigint NOT NULL,
    id_persona bigint NOT NULL,
    id_tipo_personal_salud bigint NOT NULL
);


ALTER TABLE public.personal_salud OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 17253)
-- Name: personal_salud_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_salud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_salud_id_seq OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17347)
-- Name: personal_salud_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_salud_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_salud_id_seq1 OWNER TO postgres;

--
-- TOC entry 3089 (class 0 OID 0)
-- Dependencies: 227
-- Name: personal_salud_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_salud_id_seq1 OWNED BY public.personal_salud.id;


--
-- TOC entry 229 (class 1259 OID 17357)
-- Name: personal_salud_periodos_academicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_salud_periodos_academicos (
    id_personal_salud bigint NOT NULL,
    id_periodo_academico bigint NOT NULL
);


ALTER TABLE public.personal_salud_periodos_academicos OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 17513)
-- Name: personas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personas (
    id bigint NOT NULL,
    id_tipo_identificacion bigint NOT NULL,
    identificacion integer NOT NULL,
    lugar_expedicion character varying(20) NOT NULL,
    primer_nombre character varying(50) NOT NULL,
    segundo_nombre character varying(50),
    primer_apellido character varying(50) NOT NULL,
    segundo_apellido character varying(50),
    genero character varying(2) NOT NULL,
    fecha_nacimiento date NOT NULL,
    telefono character varying(10) NOT NULL,
    celular character varying(10) NOT NULL,
    correo_electronico character varying(50) NOT NULL,
    direccion character varying(50) NOT NULL,
    barrio character varying(50) NOT NULL,
    estrato smallint NOT NULL
);


ALTER TABLE public.personas OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 17535)
-- Name: personas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_id_seq OWNER TO postgres;

--
-- TOC entry 3090 (class 0 OID 0)
-- Dependencies: 243
-- Name: personas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personas_id_seq OWNED BY public.personas.id;


--
-- TOC entry 207 (class 1259 OID 17255)
-- Name: programa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.programa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.programa_id_seq OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 17366)
-- Name: programas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.programas (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.programas OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 17364)
-- Name: programas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.programas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.programas_id_seq OWNER TO postgres;

--
-- TOC entry 3091 (class 0 OID 0)
-- Dependencies: 230
-- Name: programas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.programas_id_seq OWNED BY public.programas.id;


--
-- TOC entry 208 (class 1259 OID 17257)
-- Name: semestre_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.semestre_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.semestre_id_seq OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 17374)
-- Name: semestres; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.semestres (
    id bigint NOT NULL,
    numero character varying(2) NOT NULL,
    grupo character varying(2) NOT NULL,
    jornada character varying(10) NOT NULL
);


ALTER TABLE public.semestres OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 17372)
-- Name: semestres_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.semestres_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.semestres_id_seq OWNER TO postgres;

--
-- TOC entry 3092 (class 0 OID 0)
-- Dependencies: 232
-- Name: semestres_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.semestres_id_seq OWNED BY public.semestres.id;


--
-- TOC entry 209 (class 1259 OID 17259)
-- Name: servicio_aplicado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicio_aplicado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicio_aplicado_id_seq OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 17261)
-- Name: servicio_complementario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicio_complementario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicio_complementario_id_seq OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 17382)
-- Name: servicios_aplicados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servicios_aplicados (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.servicios_aplicados OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 17380)
-- Name: servicios_aplicados_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicios_aplicados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicios_aplicados_id_seq OWNER TO postgres;

--
-- TOC entry 3093 (class 0 OID 0)
-- Dependencies: 234
-- Name: servicios_aplicados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.servicios_aplicados_id_seq OWNED BY public.servicios_aplicados.id;


--
-- TOC entry 237 (class 1259 OID 17390)
-- Name: servicios_complementarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servicios_complementarios (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.servicios_complementarios OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 17388)
-- Name: servicios_complementarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicios_complementarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicios_complementarios_id_seq OWNER TO postgres;

--
-- TOC entry 3094 (class 0 OID 0)
-- Dependencies: 236
-- Name: servicios_complementarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.servicios_complementarios_id_seq OWNED BY public.servicios_complementarios.id;


--
-- TOC entry 211 (class 1259 OID 17263)
-- Name: tipo_identificacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_identificacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_identificacion_id_seq OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 17265)
-- Name: tipo_personal_salud_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_personal_salud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_personal_salud_id_seq OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 17398)
-- Name: tipos_identificacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipos_identificacion (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.tipos_identificacion OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 17396)
-- Name: tipos_identificacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_identificacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_identificacion_id_seq OWNER TO postgres;

--
-- TOC entry 3095 (class 0 OID 0)
-- Dependencies: 238
-- Name: tipos_identificacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipos_identificacion_id_seq OWNED BY public.tipos_identificacion.id;


--
-- TOC entry 241 (class 1259 OID 17406)
-- Name: tipos_personal_salud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipos_personal_salud (
    id bigint NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE public.tipos_personal_salud OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 17404)
-- Name: tipos_personal_salud_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_personal_salud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_personal_salud_id_seq OWNER TO postgres;

--
-- TOC entry 3096 (class 0 OID 0)
-- Dependencies: 240
-- Name: tipos_personal_salud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipos_personal_salud_id_seq OWNED BY public.tipos_personal_salud.id;


--
-- TOC entry 245 (class 1259 OID 17547)
-- Name: pract_practicas_estudiantes; Type: TABLE; Schema: zeus; Owner: postgres
--

CREATE TABLE zeus.pract_practicas_estudiantes (
    id bigint NOT NULL,
    id_estudiante bigint NOT NULL,
    fecha_inicio timestamp(6) without time zone NOT NULL,
    fecha_fin timestamp(6) without time zone NOT NULL,
    activa boolean NOT NULL
);


ALTER TABLE zeus.pract_practicas_estudiantes OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 17545)
-- Name: pract_practicas_estudiantes_id_seq; Type: SEQUENCE; Schema: zeus; Owner: postgres
--

CREATE SEQUENCE zeus.pract_practicas_estudiantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE zeus.pract_practicas_estudiantes_id_seq OWNER TO postgres;

--
-- TOC entry 3097 (class 0 OID 0)
-- Dependencies: 244
-- Name: pract_practicas_estudiantes_id_seq; Type: SEQUENCE OWNED BY; Schema: zeus; Owner: postgres
--

ALTER SEQUENCE zeus.pract_practicas_estudiantes_id_seq OWNED BY zeus.pract_practicas_estudiantes.id;


--
-- TOC entry 2815 (class 2604 OID 17272)
-- Name: citas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas ALTER COLUMN id SET DEFAULT nextval('public.citas_id_seq'::regclass);


--
-- TOC entry 2816 (class 2604 OID 17290)
-- Name: estados_seguimientos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados_seguimientos ALTER COLUMN id SET DEFAULT nextval('public.estados_seguimientos_id_seq'::regclass);


--
-- TOC entry 2817 (class 2604 OID 17298)
-- Name: estudiantes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes ALTER COLUMN id SET DEFAULT nextval('public.estudiantes_id_seq'::regclass);


--
-- TOC entry 2818 (class 2604 OID 17309)
-- Name: modalidades_afiliacion id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modalidades_afiliacion ALTER COLUMN id SET DEFAULT nextval('public.modalidades_afiliacion_id_seq'::regclass);


--
-- TOC entry 2819 (class 2604 OID 17317)
-- Name: pacientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pacientes ALTER COLUMN id SET DEFAULT nextval('public.pacientes_id_seq'::regclass);


--
-- TOC entry 2820 (class 2604 OID 17327)
-- Name: parentezcos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parentezcos ALTER COLUMN id SET DEFAULT nextval('public.parentezcos_id_seq'::regclass);


--
-- TOC entry 2821 (class 2604 OID 17335)
-- Name: periodos_academicos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.periodos_academicos ALTER COLUMN id SET DEFAULT nextval('public.periodos_academicos_id_seq'::regclass);


--
-- TOC entry 2822 (class 2604 OID 17352)
-- Name: personal_salud id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud ALTER COLUMN id SET DEFAULT nextval('public.personal_salud_id_seq1'::regclass);


--
-- TOC entry 2829 (class 2604 OID 17537)
-- Name: personas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas ALTER COLUMN id SET DEFAULT nextval('public.personas_id_seq'::regclass);


--
-- TOC entry 2823 (class 2604 OID 17369)
-- Name: programas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programas ALTER COLUMN id SET DEFAULT nextval('public.programas_id_seq'::regclass);


--
-- TOC entry 2824 (class 2604 OID 17377)
-- Name: semestres id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semestres ALTER COLUMN id SET DEFAULT nextval('public.semestres_id_seq'::regclass);


--
-- TOC entry 2825 (class 2604 OID 17385)
-- Name: servicios_aplicados id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_aplicados ALTER COLUMN id SET DEFAULT nextval('public.servicios_aplicados_id_seq'::regclass);


--
-- TOC entry 2826 (class 2604 OID 17393)
-- Name: servicios_complementarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_complementarios ALTER COLUMN id SET DEFAULT nextval('public.servicios_complementarios_id_seq'::regclass);


--
-- TOC entry 2827 (class 2604 OID 17401)
-- Name: tipos_identificacion id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_identificacion ALTER COLUMN id SET DEFAULT nextval('public.tipos_identificacion_id_seq'::regclass);


--
-- TOC entry 2828 (class 2604 OID 17409)
-- Name: tipos_personal_salud id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_personal_salud ALTER COLUMN id SET DEFAULT nextval('public.tipos_personal_salud_id_seq'::regclass);


--
-- TOC entry 2830 (class 2604 OID 17550)
-- Name: pract_practicas_estudiantes id; Type: DEFAULT; Schema: zeus; Owner: postgres
--

ALTER TABLE ONLY zeus.pract_practicas_estudiantes ALTER COLUMN id SET DEFAULT nextval('zeus.pract_practicas_estudiantes_id_seq'::regclass);


--
-- TOC entry 3044 (class 0 OID 17269)
-- Dependencies: 214
-- Data for Name: citas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.citas (id, id_paciente, id_parentezco, id_estado_seguimiento, id_servicio_aplicado, id_personal_salud, id_servicio_complementario, id_periodo_academico, acudiente, fecha_cita, hora_cita, observaciones) FROM stdin;
27	23	1	2	7	2	2	3	No tiene	2020-07-02	08:00:00	Pobre chico.
26	22	1	3	6	1	6	3	No tiene	2020-07-08	16:00:00	
24	21	1	1	2	1	1	3	Dora la exploradora	2020-06-29	07:30:00	Es mala.
\.


--
-- TOC entry 3046 (class 0 OID 17287)
-- Dependencies: 216
-- Data for Name: estados_seguimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estados_seguimientos (id, nombre) FROM stdin;
1	PENDIENTE
2	ASISTENCIA EFECTIVA
3	INASISTENCIA
\.


--
-- TOC entry 3048 (class 0 OID 17295)
-- Dependencies: 218
-- Data for Name: estudiantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estudiantes (id, id_programa, id_semestre, id_persona, codigo) FROM stdin;
1	1	8	3	I022146
2	1	8	6	P320006
3	1	8	8	S079995
4	4	3	10	D218481
5	8	5	2	CP00199
6	1	8	9	P231447
\.


--
-- TOC entry 3027 (class 0 OID 17232)
-- Dependencies: 197
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20200512152431	2020-05-12 16:00:33
\.


--
-- TOC entry 3050 (class 0 OID 17306)
-- Dependencies: 220
-- Data for Name: modalidades_afiliacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modalidades_afiliacion (id, nombre) FROM stdin;
1	Contribuyente
2	Subsidiado
3	Cotizante
4	Beneficiario
\.


--
-- TOC entry 3052 (class 0 OID 17314)
-- Dependencies: 222
-- Data for Name: pacientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pacientes (id, id_estudiante, id_modalidad_afiliacion, eps) FROM stdin;
21	1	2	SaludCoop
22	4	2	CafeSalud
23	5	4	SaludCoop
\.


--
-- TOC entry 3054 (class 0 OID 17324)
-- Dependencies: 224
-- Data for Name: parentezcos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.parentezcos (id, nombre) FROM stdin;
1	SIN REGISTRO
2	MADRE
3	PADRE
4	HERMANO(A)
5	TIO(A)
6	AMIGO
7	OTRO
\.


--
-- TOC entry 3056 (class 0 OID 17332)
-- Dependencies: 226
-- Data for Name: periodos_academicos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.periodos_academicos (id, anio, periodo) FROM stdin;
1	2019	1
2	2019	2
3	2020	1
4	2020	2
5	2021	1
6	2021	2
\.


--
-- TOC entry 3058 (class 0 OID 17349)
-- Dependencies: 228
-- Data for Name: personal_salud; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_salud (id, id_persona, id_tipo_personal_salud) FROM stdin;
1	7	2
2	8	1
4	5	2
3	4	2
5	9	1
\.


--
-- TOC entry 3059 (class 0 OID 17357)
-- Dependencies: 229
-- Data for Name: personal_salud_periodos_academicos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_salud_periodos_academicos (id_personal_salud, id_periodo_academico) FROM stdin;
1	3
2	3
1	2
1	4
4	4
3	3
4	3
4	6
5	3
2	4
\.


--
-- TOC entry 3072 (class 0 OID 17513)
-- Dependencies: 242
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personas (id, id_tipo_identificacion, identificacion, lugar_expedicion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, telefono, celular, correo_electronico, direccion, barrio, estrato) FROM stdin;
3	1	1087420191	TUQUERRES	ANGIE	MELISSA	RAMIREZ	PUPIALES	02	1994-07-03	3153196461	3154963802	ANGIE@test.com	CARRERA 9 E NO 15-61	EL TRIUNFO	2
7	1	1053461312	PASTO	IVAN	\N	TEJADA	\N	01	1993-07-04	777777	33333333	teja@hotmail.com	una direciion	LAS BRISAS	3
8	1	1025416155	PASTO	YESENIA	\N	ZUÑIGA	GUERRERO	02	1995-02-28	555555	444444444	yes@yahoo.com	es privado	LAS CUADRAS	2
6	1	1085324679	PASTO	ISAAC	SANTIAGO	BENAVIDES	RIASCOS	01	1995-02-21	7222972\n	3106213243	isaacslam20@gmail.com\n	DIAGONAL16#46-34\n	FIGUEROA\n	1
10	1	1088599074	CUMBAL	EDDIE	SANTIAGO	RUEDA	MARTINEZ	01	1999-02-18	3154097408	3233506082	sati12350@hotmail.com	APTO 506 TORRE 3	MIRADOR DE AQUINE	3
2	1	1004133957	PASTO\n	CHRISTIAN	ANDRES	NARVAEZ	MADROÑERO	01	1999-08-06	3165537380	3185180715	cristian.nar2011@hotmail.com\n	CALLE 19 # 19 -44\n	CENTRO\n	3
4	1	110132013	POPAYAN	ALEJANDRO	\N	GRANJA	LUNA	01	1998-04-23	6746342	25344532	granjaluna@hotmail.com	No tiene	CENTRO	3
5	1	1111111	PASTO	ALEXANDRA	\N	SALDAÑA	ARAUJO	02	1990-06-12	77457543	25231	alexan@gmail.com	CALLE 14	LAS CUADRAS	2
9	2	22222222	PASTO	NIDIA	ALEXANDRA	MUÑOZ	\N	02	1998-04-02	8754674	6656436563	NIDIESITA@gmail.com	CARRERA 21A	LAS BRISAS	4
\.


--
-- TOC entry 3061 (class 0 OID 17366)
-- Dependencies: 231
-- Data for Name: programas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.programas (id, nombre) FROM stdin;
1	PSICOLOGÍA
2	ARQUITECTURA
3	LICENCIATURA EN EDUCACIÓN INFANTIL
4	DERECHO
5	TECNOLOGÍA EN CONTABILIDAD Y FINANZAS
6	LICENCIATURA EN EDUCACIÓN FÍSICA
7	ADMINISTRACIÓN DE EMPRESAS
8	CONTADURÍA PÚBLICA
\.


--
-- TOC entry 3063 (class 0 OID 17374)
-- Dependencies: 233
-- Data for Name: semestres; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.semestres (id, numero, grupo, jornada) FROM stdin;
1	1	A	M
2	2	A	M
3	3	A	M
4	4	A	M
5	5	A	M
6	6	A	M
7	7	A	M
8	8	A	M
9	9	A	M
10	10	A	M
\.


--
-- TOC entry 3065 (class 0 OID 17382)
-- Dependencies: 235
-- Data for Name: servicios_aplicados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servicios_aplicados (id, nombre) FROM stdin;
1	Pendiente
2	Consulta por primera vez
3	Consulta seguimiento
4	Inasistencia
5	Caso cerrado
6	Deserción de consulta
7	Orientación
8	Atención en crisis
\.


--
-- TOC entry 3067 (class 0 OID 17390)
-- Dependencies: 237
-- Data for Name: servicios_complementarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servicios_complementarios (id, nombre) FROM stdin;
1	Ninguno
2	Permanencia
3	EPS atención psiquiátrica: Hospital San Rafael
4	EPS atención psiquiátrica: Hospital Perpetuo Socor
5	Laboratorio de pruebas
6	Unidad de Salud
7	Inclusión
8	Trabajo social
9	Acompañamiento
\.


--
-- TOC entry 3069 (class 0 OID 17398)
-- Dependencies: 239
-- Data for Name: tipos_identificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipos_identificacion (id, nombre) FROM stdin;
1	CEDULA DE CIUDADANIA
2	TARJETA DE IDENTIDAD
3	CEDULA DE EXTRANJERIA
4	PASAPORTE
\.


--
-- TOC entry 3071 (class 0 OID 17406)
-- Dependencies: 241
-- Data for Name: tipos_personal_salud; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipos_personal_salud (id, nombre) FROM stdin;
1	PRACTICANTE
2	PROFESIONAL
3	OTRO
\.


--
-- TOC entry 3075 (class 0 OID 17547)
-- Dependencies: 245
-- Data for Name: pract_practicas_estudiantes; Type: TABLE DATA; Schema: zeus; Owner: postgres
--

COPY zeus.pract_practicas_estudiantes (id, id_estudiante, fecha_inicio, fecha_fin, activa) FROM stdin;
2	3	2020-02-01 00:00:00	2020-06-20 00:00:00	t
5	6	2020-01-07 00:00:00	2020-06-25 00:00:00	t
\.


--
-- TOC entry 3098 (class 0 OID 0)
-- Dependencies: 198
-- Name: cita_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cita_id_seq', 1, false);


--
-- TOC entry 3099 (class 0 OID 0)
-- Dependencies: 213
-- Name: citas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.citas_id_seq', 27, true);


--
-- TOC entry 3100 (class 0 OID 0)
-- Dependencies: 199
-- Name: estado_seguimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estado_seguimiento_id_seq', 1, false);


--
-- TOC entry 3101 (class 0 OID 0)
-- Dependencies: 215
-- Name: estados_seguimientos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estados_seguimientos_id_seq', 3, true);


--
-- TOC entry 3102 (class 0 OID 0)
-- Dependencies: 200
-- Name: estudiante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estudiante_id_seq', 1, false);


--
-- TOC entry 3103 (class 0 OID 0)
-- Dependencies: 217
-- Name: estudiantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estudiantes_id_seq', 6, true);


--
-- TOC entry 3104 (class 0 OID 0)
-- Dependencies: 201
-- Name: modalidad_afiliacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.modalidad_afiliacion_id_seq', 1, false);


--
-- TOC entry 3105 (class 0 OID 0)
-- Dependencies: 219
-- Name: modalidades_afiliacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.modalidades_afiliacion_id_seq', 4, true);


--
-- TOC entry 3106 (class 0 OID 0)
-- Dependencies: 202
-- Name: paciente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.paciente_id_seq', 1, false);


--
-- TOC entry 3107 (class 0 OID 0)
-- Dependencies: 221
-- Name: pacientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pacientes_id_seq', 23, true);


--
-- TOC entry 3108 (class 0 OID 0)
-- Dependencies: 203
-- Name: parentezco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.parentezco_id_seq', 1, false);


--
-- TOC entry 3109 (class 0 OID 0)
-- Dependencies: 223
-- Name: parentezcos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.parentezcos_id_seq', 7, true);


--
-- TOC entry 3110 (class 0 OID 0)
-- Dependencies: 204
-- Name: periodo_academico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.periodo_academico_id_seq', 1, false);


--
-- TOC entry 3111 (class 0 OID 0)
-- Dependencies: 225
-- Name: periodos_academicos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.periodos_academicos_id_seq', 6, true);


--
-- TOC entry 3112 (class 0 OID 0)
-- Dependencies: 205
-- Name: persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.persona_id_seq', 1, false);


--
-- TOC entry 3113 (class 0 OID 0)
-- Dependencies: 206
-- Name: personal_salud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_salud_id_seq', 5, true);


--
-- TOC entry 3114 (class 0 OID 0)
-- Dependencies: 227
-- Name: personal_salud_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_salud_id_seq1', 4, true);


--
-- TOC entry 3115 (class 0 OID 0)
-- Dependencies: 243
-- Name: personas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personas_id_seq', 9, true);


--
-- TOC entry 3116 (class 0 OID 0)
-- Dependencies: 207
-- Name: programa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.programa_id_seq', 1, false);


--
-- TOC entry 3117 (class 0 OID 0)
-- Dependencies: 230
-- Name: programas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.programas_id_seq', 8, true);


--
-- TOC entry 3118 (class 0 OID 0)
-- Dependencies: 208
-- Name: semestre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.semestre_id_seq', 1, false);


--
-- TOC entry 3119 (class 0 OID 0)
-- Dependencies: 232
-- Name: semestres_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.semestres_id_seq', 10, true);


--
-- TOC entry 3120 (class 0 OID 0)
-- Dependencies: 209
-- Name: servicio_aplicado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicio_aplicado_id_seq', 1, false);


--
-- TOC entry 3121 (class 0 OID 0)
-- Dependencies: 210
-- Name: servicio_complementario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicio_complementario_id_seq', 1, false);


--
-- TOC entry 3122 (class 0 OID 0)
-- Dependencies: 234
-- Name: servicios_aplicados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicios_aplicados_id_seq', 8, true);


--
-- TOC entry 3123 (class 0 OID 0)
-- Dependencies: 236
-- Name: servicios_complementarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicios_complementarios_id_seq', 9, true);


--
-- TOC entry 3124 (class 0 OID 0)
-- Dependencies: 211
-- Name: tipo_identificacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_identificacion_id_seq', 1, false);


--
-- TOC entry 3125 (class 0 OID 0)
-- Dependencies: 212
-- Name: tipo_personal_salud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_personal_salud_id_seq', 1, false);


--
-- TOC entry 3126 (class 0 OID 0)
-- Dependencies: 238
-- Name: tipos_identificacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_identificacion_id_seq', 4, true);


--
-- TOC entry 3127 (class 0 OID 0)
-- Dependencies: 240
-- Name: tipos_personal_salud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_personal_salud_id_seq', 3, true);


--
-- TOC entry 3128 (class 0 OID 0)
-- Dependencies: 244
-- Name: pract_practicas_estudiantes_id_seq; Type: SEQUENCE SET; Schema: zeus; Owner: postgres
--

SELECT pg_catalog.setval('zeus.pract_practicas_estudiantes_id_seq', 5, true);


--
-- TOC entry 2834 (class 2606 OID 17277)
-- Name: citas citas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT citas_pkey PRIMARY KEY (id);


--
-- TOC entry 2843 (class 2606 OID 17292)
-- Name: estados_seguimientos estados_seguimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados_seguimientos
    ADD CONSTRAINT estados_seguimientos_pkey PRIMARY KEY (id);


--
-- TOC entry 2845 (class 2606 OID 17300)
-- Name: estudiantes estudiantes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT estudiantes_pkey PRIMARY KEY (id);


--
-- TOC entry 2832 (class 2606 OID 17236)
-- Name: migration_versions migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- TOC entry 2850 (class 2606 OID 17311)
-- Name: modalidades_afiliacion modalidades_afiliacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modalidades_afiliacion
    ADD CONSTRAINT modalidades_afiliacion_pkey PRIMARY KEY (id);


--
-- TOC entry 2853 (class 2606 OID 17319)
-- Name: pacientes pacientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT pacientes_pkey PRIMARY KEY (id);


--
-- TOC entry 2858 (class 2606 OID 17329)
-- Name: parentezcos parentezcos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parentezcos
    ADD CONSTRAINT parentezcos_pkey PRIMARY KEY (id);


--
-- TOC entry 2860 (class 2606 OID 17337)
-- Name: periodos_academicos periodos_academicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.periodos_academicos
    ADD CONSTRAINT periodos_academicos_pkey PRIMARY KEY (id);


--
-- TOC entry 2870 (class 2606 OID 17361)
-- Name: personal_salud_periodos_academicos personal_salud_periodos_academicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud_periodos_academicos
    ADD CONSTRAINT personal_salud_periodos_academicos_pkey PRIMARY KEY (id_personal_salud, id_periodo_academico);


--
-- TOC entry 2863 (class 2606 OID 17354)
-- Name: personal_salud personal_salud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud
    ADD CONSTRAINT personal_salud_pkey PRIMARY KEY (id);


--
-- TOC entry 2885 (class 2606 OID 17518)
-- Name: personas personas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (id);


--
-- TOC entry 2872 (class 2606 OID 17371)
-- Name: programas programas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programas
    ADD CONSTRAINT programas_pkey PRIMARY KEY (id);


--
-- TOC entry 2874 (class 2606 OID 17379)
-- Name: semestres semestres_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semestres
    ADD CONSTRAINT semestres_pkey PRIMARY KEY (id);


--
-- TOC entry 2876 (class 2606 OID 17387)
-- Name: servicios_aplicados servicios_aplicados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_aplicados
    ADD CONSTRAINT servicios_aplicados_pkey PRIMARY KEY (id);


--
-- TOC entry 2878 (class 2606 OID 17395)
-- Name: servicios_complementarios servicios_complementarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_complementarios
    ADD CONSTRAINT servicios_complementarios_pkey PRIMARY KEY (id);


--
-- TOC entry 2880 (class 2606 OID 17403)
-- Name: tipos_identificacion tipos_identificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_identificacion
    ADD CONSTRAINT tipos_identificacion_pkey PRIMARY KEY (id);


--
-- TOC entry 2882 (class 2606 OID 17411)
-- Name: tipos_personal_salud tipos_personal_salud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_personal_salud
    ADD CONSTRAINT tipos_personal_salud_pkey PRIMARY KEY (id);


--
-- TOC entry 2855 (class 2606 OID 17539)
-- Name: pacientes uk_id_estudiante_paciente; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT uk_id_estudiante_paciente UNIQUE (id_estudiante);


--
-- TOC entry 2865 (class 2606 OID 17559)
-- Name: personal_salud uk_id_persona_personal_salud; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud
    ADD CONSTRAINT uk_id_persona_personal_salud UNIQUE (id_persona);


--
-- TOC entry 2887 (class 2606 OID 17552)
-- Name: pract_practicas_estudiantes pract_practicas_estudiantes_pkey; Type: CONSTRAINT; Schema: zeus; Owner: postgres
--

ALTER TABLE ONLY zeus.pract_practicas_estudiantes
    ADD CONSTRAINT pract_practicas_estudiantes_pkey PRIMARY KEY (id);


--
-- TOC entry 2846 (class 1259 OID 17302)
-- Name: idx_3b3f3fad4d65622c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3b3f3fad4d65622c ON public.estudiantes USING btree (id_semestre);


--
-- TOC entry 2847 (class 1259 OID 17301)
-- Name: idx_3b3f3fade598bedf; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3b3f3fade598bedf ON public.estudiantes USING btree (id_programa);


--
-- TOC entry 2835 (class 1259 OID 17281)
-- Name: idx_3e379a62360b5e6c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62360b5e6c ON public.citas USING btree (id_servicio_aplicado);


--
-- TOC entry 2836 (class 1259 OID 17282)
-- Name: idx_3e379a62547464fd; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62547464fd ON public.citas USING btree (id_personal_salud);


--
-- TOC entry 2837 (class 1259 OID 17278)
-- Name: idx_3e379a626b021723; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a626b021723 ON public.citas USING btree (id_paciente);


--
-- TOC entry 2838 (class 1259 OID 17283)
-- Name: idx_3e379a629f860de7; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a629f860de7 ON public.citas USING btree (id_servicio_complementario);


--
-- TOC entry 2839 (class 1259 OID 17279)
-- Name: idx_3e379a62c2849151; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62c2849151 ON public.citas USING btree (id_parentezco);


--
-- TOC entry 2840 (class 1259 OID 17280)
-- Name: idx_3e379a62eeca02ef; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62eeca02ef ON public.citas USING btree (id_estado_seguimiento);


--
-- TOC entry 2841 (class 1259 OID 17284)
-- Name: idx_3e379a62f0795d13; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3e379a62f0795d13 ON public.citas USING btree (id_periodo_academico);


--
-- TOC entry 2867 (class 1259 OID 17362)
-- Name: idx_4c254fe8a5430cea; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4c254fe8a5430cea ON public.personal_salud_periodos_academicos USING btree (id_personal_salud);


--
-- TOC entry 2868 (class 1259 OID 17363)
-- Name: idx_4c254fe8fc89acb7; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4c254fe8fc89acb7 ON public.personal_salud_periodos_academicos USING btree (id_periodo_academico);


--
-- TOC entry 2883 (class 1259 OID 17524)
-- Name: idx_51e5b69b65963a51; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_51e5b69b65963a51 ON public.personas USING btree (id_tipo_identificacion);


--
-- TOC entry 2851 (class 1259 OID 17321)
-- Name: idx_c6cba95e4be9ec44; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_c6cba95e4be9ec44 ON public.pacientes USING btree (id_modalidad_afiliacion);


--
-- TOC entry 2861 (class 1259 OID 17356)
-- Name: idx_fac9a1c42f52ae7e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_fac9a1c42f52ae7e ON public.personal_salud USING btree (id_tipo_personal_salud);


--
-- TOC entry 2848 (class 1259 OID 17303)
-- Name: uniq_3b3f3fad50720d6e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_3b3f3fad50720d6e ON public.estudiantes USING btree (id_persona);


--
-- TOC entry 2856 (class 1259 OID 17320)
-- Name: uniq_c6cba95ee771dd5c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_c6cba95ee771dd5c ON public.pacientes USING btree (id_estudiante);


--
-- TOC entry 2866 (class 1259 OID 17355)
-- Name: uniq_fac9a1c450720d6e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_fac9a1c450720d6e ON public.personal_salud USING btree (id_persona);


--
-- TOC entry 2896 (class 2606 OID 17452)
-- Name: estudiantes fk_3b3f3fad4d65622c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT fk_3b3f3fad4d65622c FOREIGN KEY (id_semestre) REFERENCES public.semestres(id);


--
-- TOC entry 2897 (class 2606 OID 17525)
-- Name: estudiantes fk_3b3f3fad50720d6e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT fk_3b3f3fad50720d6e FOREIGN KEY (id_persona) REFERENCES public.personas(id);


--
-- TOC entry 2895 (class 2606 OID 17447)
-- Name: estudiantes fk_3b3f3fade598bedf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudiantes
    ADD CONSTRAINT fk_3b3f3fade598bedf FOREIGN KEY (id_programa) REFERENCES public.programas(id);


--
-- TOC entry 2891 (class 2606 OID 17427)
-- Name: citas fk_3e379a62360b5e6c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a62360b5e6c FOREIGN KEY (id_servicio_aplicado) REFERENCES public.servicios_aplicados(id);


--
-- TOC entry 2892 (class 2606 OID 17432)
-- Name: citas fk_3e379a62547464fd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a62547464fd FOREIGN KEY (id_personal_salud) REFERENCES public.personal_salud(id);


--
-- TOC entry 2888 (class 2606 OID 17412)
-- Name: citas fk_3e379a626b021723; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a626b021723 FOREIGN KEY (id_paciente) REFERENCES public.pacientes(id);


--
-- TOC entry 2893 (class 2606 OID 17437)
-- Name: citas fk_3e379a629f860de7; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a629f860de7 FOREIGN KEY (id_servicio_complementario) REFERENCES public.servicios_complementarios(id);


--
-- TOC entry 2889 (class 2606 OID 17417)
-- Name: citas fk_3e379a62c2849151; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a62c2849151 FOREIGN KEY (id_parentezco) REFERENCES public.parentezcos(id);


--
-- TOC entry 2890 (class 2606 OID 17422)
-- Name: citas fk_3e379a62eeca02ef; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a62eeca02ef FOREIGN KEY (id_estado_seguimiento) REFERENCES public.estados_seguimientos(id);


--
-- TOC entry 2894 (class 2606 OID 17442)
-- Name: citas fk_3e379a62f0795d13; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_3e379a62f0795d13 FOREIGN KEY (id_periodo_academico) REFERENCES public.periodos_academicos(id);


--
-- TOC entry 2902 (class 2606 OID 17487)
-- Name: personal_salud_periodos_academicos fk_4c254fe8a5430cea; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud_periodos_academicos
    ADD CONSTRAINT fk_4c254fe8a5430cea FOREIGN KEY (id_personal_salud) REFERENCES public.personal_salud(id) ON DELETE CASCADE;


--
-- TOC entry 2903 (class 2606 OID 17492)
-- Name: personal_salud_periodos_academicos fk_4c254fe8fc89acb7; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud_periodos_academicos
    ADD CONSTRAINT fk_4c254fe8fc89acb7 FOREIGN KEY (id_periodo_academico) REFERENCES public.periodos_academicos(id) ON DELETE CASCADE;


--
-- TOC entry 2904 (class 2606 OID 17519)
-- Name: personas fk_51e5b69b65963a51; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT fk_51e5b69b65963a51 FOREIGN KEY (id_tipo_identificacion) REFERENCES public.tipos_identificacion(id);


--
-- TOC entry 2899 (class 2606 OID 17467)
-- Name: pacientes fk_c6cba95e4be9ec44; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT fk_c6cba95e4be9ec44 FOREIGN KEY (id_modalidad_afiliacion) REFERENCES public.modalidades_afiliacion(id);


--
-- TOC entry 2898 (class 2606 OID 17462)
-- Name: pacientes fk_c6cba95ee771dd5c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pacientes
    ADD CONSTRAINT fk_c6cba95ee771dd5c FOREIGN KEY (id_estudiante) REFERENCES public.estudiantes(id);


--
-- TOC entry 2900 (class 2606 OID 17482)
-- Name: personal_salud fk_fac9a1c42f52ae7e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud
    ADD CONSTRAINT fk_fac9a1c42f52ae7e FOREIGN KEY (id_tipo_personal_salud) REFERENCES public.tipos_personal_salud(id);


--
-- TOC entry 2901 (class 2606 OID 17530)
-- Name: personal_salud fk_fac9a1c450720d6e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_salud
    ADD CONSTRAINT fk_fac9a1c450720d6e FOREIGN KEY (id_persona) REFERENCES public.personas(id);


--
-- TOC entry 2905 (class 2606 OID 17553)
-- Name: pract_practicas_estudiantes fk_estudiante_pract_practicas_estudiantes; Type: FK CONSTRAINT; Schema: zeus; Owner: postgres
--

ALTER TABLE ONLY zeus.pract_practicas_estudiantes
    ADD CONSTRAINT fk_estudiante_pract_practicas_estudiantes FOREIGN KEY (id_estudiante) REFERENCES public.estudiantes(id);


-- Completed on 2020-06-29 18:34:50

--
-- PostgreSQL database dump complete
--

