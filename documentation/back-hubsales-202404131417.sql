--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2
-- Dumped by pg_dump version 16.2

-- Started on 2024-04-13 14:17:06

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
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 4918 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 16921)
-- Name: abonos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.abonos (
    abono_id integer NOT NULL,
    abono_monto numeric(18,2) NOT NULL,
    abono_fecha date NOT NULL,
    abono_fac_id integer
);


ALTER TABLE public.abonos OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16920)
-- Name: abonos_abono_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.abonos_abono_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.abonos_abono_id_seq OWNER TO postgres;

--
-- TOC entry 4919 (class 0 OID 0)
-- Dependencies: 219
-- Name: abonos_abono_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.abonos_abono_id_seq OWNED BY public.abonos.abono_id;


--
-- TOC entry 222 (class 1259 OID 16933)
-- Name: categorias_productos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorias_productos (
    cat_id integer NOT NULL,
    cat_nombre character varying(45) NOT NULL,
    cat_descripcion character varying(255) NOT NULL
);


ALTER TABLE public.categorias_productos OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16932)
-- Name: categorias_productos_cat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categorias_productos_cat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categorias_productos_cat_id_seq OWNER TO postgres;

--
-- TOC entry 4920 (class 0 OID 0)
-- Dependencies: 221
-- Name: categorias_productos_cat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categorias_productos_cat_id_seq OWNED BY public.categorias_productos.cat_id;


--
-- TOC entry 216 (class 1259 OID 16902)
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clientes (
    cli_id integer NOT NULL,
    cli_nombre character varying(45) NOT NULL,
    cli_apellido character varying(45) NOT NULL,
    cli_cedula character varying(25) NOT NULL,
    cli_direccion character varying(45) NOT NULL,
    cli_correo character varying(45) NOT NULL,
    cli_telefono character varying(15) NOT NULL
);


ALTER TABLE public.clientes OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16901)
-- Name: clientes_cli_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clientes_cli_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.clientes_cli_id_seq OWNER TO postgres;

--
-- TOC entry 4921 (class 0 OID 0)
-- Dependencies: 215
-- Name: clientes_cli_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clientes_cli_id_seq OWNED BY public.clientes.cli_id;


--
-- TOC entry 226 (class 1259 OID 16952)
-- Name: detalles_facturas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.detalles_facturas (
    det_id integer NOT NULL,
    det_subtotal numeric(18,2) NOT NULL,
    det_cantidad integer NOT NULL,
    det_fac_id integer,
    det_prod_id integer
);


ALTER TABLE public.detalles_facturas OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16951)
-- Name: detalles_facturas_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.detalles_facturas_det_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.detalles_facturas_det_id_seq OWNER TO postgres;

--
-- TOC entry 4922 (class 0 OID 0)
-- Dependencies: 225
-- Name: detalles_facturas_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.detalles_facturas_det_id_seq OWNED BY public.detalles_facturas.det_id;


--
-- TOC entry 218 (class 1259 OID 16909)
-- Name: facturas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facturas (
    fac_id integer NOT NULL,
    fac_fecha date NOT NULL,
    fac_fecha_venc date NOT NULL,
    fac_cli_id integer NOT NULL,
    fac_user_id integer
);


ALTER TABLE public.facturas OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16908)
-- Name: facturas_fac_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.facturas_fac_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.facturas_fac_id_seq OWNER TO postgres;

--
-- TOC entry 4923 (class 0 OID 0)
-- Dependencies: 217
-- Name: facturas_fac_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.facturas_fac_id_seq OWNED BY public.facturas.fac_id;


--
-- TOC entry 224 (class 1259 OID 16940)
-- Name: productos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.productos (
    prod_id integer NOT NULL,
    prod_nombre character varying(45) NOT NULL,
    prod_descripcion character varying(255) NOT NULL,
    prod_precio_unitario numeric(18,2) NOT NULL,
    prod_existencias integer NOT NULL,
    prod_cat_id integer
);


ALTER TABLE public.productos OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16939)
-- Name: productos_prod_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.productos_prod_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.productos_prod_id_seq OWNER TO postgres;

--
-- TOC entry 4924 (class 0 OID 0)
-- Dependencies: 223
-- Name: productos_prod_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.productos_prod_id_seq OWNED BY public.productos.prod_id;


--
-- TOC entry 228 (class 1259 OID 16969)
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    rol_id integer NOT NULL,
    rol_nombre character varying(45) NOT NULL,
    rol_descripcion character varying(255) NOT NULL
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 16968)
-- Name: roles_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_rol_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_rol_id_seq OWNER TO postgres;

--
-- TOC entry 4925 (class 0 OID 0)
-- Dependencies: 227
-- Name: roles_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_rol_id_seq OWNED BY public.roles.rol_id;


--
-- TOC entry 230 (class 1259 OID 16976)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    user_id integer NOT NULL,
    user_nombre character varying(45) NOT NULL,
    user_apellido character varying(45) NOT NULL,
    user_rol integer,
    user_correo character varying(45) NOT NULL,
    user_contrasenia character varying(60) NOT NULL,
    token character varying(15),
    confirmado character varying
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 16975)
-- Name: usuarios_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_user_id_seq OWNER TO postgres;

--
-- TOC entry 4926 (class 0 OID 0)
-- Dependencies: 229
-- Name: usuarios_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_user_id_seq OWNED BY public.usuarios.user_id;


--
-- TOC entry 4725 (class 2604 OID 16924)
-- Name: abonos abono_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abonos ALTER COLUMN abono_id SET DEFAULT nextval('public.abonos_abono_id_seq'::regclass);


--
-- TOC entry 4726 (class 2604 OID 16936)
-- Name: categorias_productos cat_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias_productos ALTER COLUMN cat_id SET DEFAULT nextval('public.categorias_productos_cat_id_seq'::regclass);


--
-- TOC entry 4723 (class 2604 OID 16905)
-- Name: clientes cli_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes ALTER COLUMN cli_id SET DEFAULT nextval('public.clientes_cli_id_seq'::regclass);


--
-- TOC entry 4728 (class 2604 OID 16955)
-- Name: detalles_facturas det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalles_facturas ALTER COLUMN det_id SET DEFAULT nextval('public.detalles_facturas_det_id_seq'::regclass);


--
-- TOC entry 4724 (class 2604 OID 16912)
-- Name: facturas fac_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facturas ALTER COLUMN fac_id SET DEFAULT nextval('public.facturas_fac_id_seq'::regclass);


--
-- TOC entry 4727 (class 2604 OID 16943)
-- Name: productos prod_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos ALTER COLUMN prod_id SET DEFAULT nextval('public.productos_prod_id_seq'::regclass);


--
-- TOC entry 4729 (class 2604 OID 16972)
-- Name: roles rol_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN rol_id SET DEFAULT nextval('public.roles_rol_id_seq'::regclass);


--
-- TOC entry 4730 (class 2604 OID 16979)
-- Name: usuarios user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN user_id SET DEFAULT nextval('public.usuarios_user_id_seq'::regclass);


--
-- TOC entry 4902 (class 0 OID 16921)
-- Dependencies: 220
-- Data for Name: abonos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.abonos (abono_id, abono_monto, abono_fecha, abono_fac_id) FROM stdin;
\.


--
-- TOC entry 4904 (class 0 OID 16933)
-- Dependencies: 222
-- Data for Name: categorias_productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categorias_productos (cat_id, cat_nombre, cat_descripcion) FROM stdin;
1	Café negro	Café sin aditivos ni mezclas, puro y fuerte
2	Café aromatizado	Café con sabores añadidos como vainilla, caramelo, etc.
3	Café orgánico	Café cultivado sin pesticidas ni fertilizantes químicos
4	Café gourmet	Café de alta calidad, con granos seleccionados y procesos especiales de producción
\.


--
-- TOC entry 4898 (class 0 OID 16902)
-- Dependencies: 216
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.clientes (cli_id, cli_nombre, cli_apellido, cli_cedula, cli_direccion, cli_correo, cli_telefono) FROM stdin;
\.


--
-- TOC entry 4908 (class 0 OID 16952)
-- Dependencies: 226
-- Data for Name: detalles_facturas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.detalles_facturas (det_id, det_subtotal, det_cantidad, det_fac_id, det_prod_id) FROM stdin;
\.


--
-- TOC entry 4900 (class 0 OID 16909)
-- Dependencies: 218
-- Data for Name: facturas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.facturas (fac_id, fac_fecha, fac_fecha_venc, fac_cli_id, fac_user_id) FROM stdin;
\.


--
-- TOC entry 4906 (class 0 OID 16940)
-- Dependencies: 224
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.productos (prod_id, prod_nombre, prod_descripcion, prod_precio_unitario, prod_existencias, prod_cat_id) FROM stdin;
1	Café colombiano	Café 100% arábica cultivado en las montañas de Colombia	5.99	100	2
2	Café guatemalteco	Café de altura con notas afrutadas y chocolate	6.49	80	3
3	Café etíope	Café con cuerpo ligero y notas florales	7.99	120	1
4	Café brasileño	Café con sabor a nuez y bajo nivel de acidez	6.99	90	4
5	Café costarricense	Café con cuerpo medio y notas cítricas	7.49	110	2
6	Café jamaicano Blue Mountain	Café premium con notas suaves y delicadas	14.99	50	3
7	Café mexicano Chiapas	Café orgánico con sabor a chocolate y caramelo	8.49	70	1
8	Café peruano	Café de altura con notas a frutas tropicales	7.99	100	4
9	Café venezolano	Café con cuerpo intenso y aroma a cacao	6.99	80	2
10	Café ecuatoriano	Café con sabor dulce y suave acidez	8.99	90	3
11	Café colombiano	Café 100% arábica cultivado en las montañas de Colombia	5.99	100	2
12	Café guatemalteco	Café de altura con notas afrutadas y chocolate	6.49	80	3
13	Café brasileño	Café con sabor a nuez y bajo nivel de acidez	6.99	90	4
14	Café costarricense	Café con cuerpo medio y notas cítricas	7.49	110	2
15	Café jamaicano Blue Mountain	Café premium con notas suaves y delicadas	14.99	50	3
16	Café mexicano Chiapas	Café orgánico con sabor a chocolate y caramelo	8.49	70	1
17	Café peruano	Café de altura con notas a frutas tropicales	7.99	100	4
18	Café venezolano	Café con cuerpo intenso y aroma a cacao	6.99	80	2
19	Café ecuatoriano	Café con sabor dulce y suave acidez	8.99	90	3
20	Café etíope	Café con cuerpo ligero y notas florales	7.99	120	1
\.


--
-- TOC entry 4910 (class 0 OID 16969)
-- Dependencies: 228
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (rol_id, rol_nombre, rol_descripcion) FROM stdin;
1	Admin	Administrador del sistema
2	usuario	usuario base
\.


--
-- TOC entry 4912 (class 0 OID 16976)
-- Dependencies: 230
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (user_id, user_nombre, user_apellido, user_rol, user_correo, user_contrasenia, token, confirmado) FROM stdin;
1	juan	cano	1	admin@admin.com	$2y$10$XzGsNxsQkZy/ZaMNz05t6u4SS8Ql3U6dyVO5Dt1IYBt6oFU9quQoq		1
4	juanito	alimaÑa	2	correocorreo@correo.com	$2y$10$cXpa5yWTE6lk5umMuBKw4uGEzj4GHeoI2YsoA7nmBoyAG5lt2IIqS		1
\.


--
-- TOC entry 4927 (class 0 OID 0)
-- Dependencies: 219
-- Name: abonos_abono_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.abonos_abono_id_seq', 1, false);


--
-- TOC entry 4928 (class 0 OID 0)
-- Dependencies: 221
-- Name: categorias_productos_cat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categorias_productos_cat_id_seq', 4, true);


--
-- TOC entry 4929 (class 0 OID 0)
-- Dependencies: 215
-- Name: clientes_cli_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_cli_id_seq', 1, false);


--
-- TOC entry 4930 (class 0 OID 0)
-- Dependencies: 225
-- Name: detalles_facturas_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.detalles_facturas_det_id_seq', 1, false);


--
-- TOC entry 4931 (class 0 OID 0)
-- Dependencies: 217
-- Name: facturas_fac_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.facturas_fac_id_seq', 1, false);


--
-- TOC entry 4932 (class 0 OID 0)
-- Dependencies: 223
-- Name: productos_prod_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.productos_prod_id_seq', 20, true);


--
-- TOC entry 4933 (class 0 OID 0)
-- Dependencies: 227
-- Name: roles_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_rol_id_seq', 2, true);


--
-- TOC entry 4934 (class 0 OID 0)
-- Dependencies: 229
-- Name: usuarios_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_user_id_seq', 8, true);


--
-- TOC entry 4736 (class 2606 OID 16926)
-- Name: abonos abonos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abonos
    ADD CONSTRAINT abonos_pkey PRIMARY KEY (abono_id);


--
-- TOC entry 4738 (class 2606 OID 16938)
-- Name: categorias_productos categorias_productos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias_productos
    ADD CONSTRAINT categorias_productos_pkey PRIMARY KEY (cat_id);


--
-- TOC entry 4732 (class 2606 OID 16907)
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (cli_id);


--
-- TOC entry 4742 (class 2606 OID 16957)
-- Name: detalles_facturas detalles_facturas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalles_facturas
    ADD CONSTRAINT detalles_facturas_pkey PRIMARY KEY (det_id);


--
-- TOC entry 4734 (class 2606 OID 16914)
-- Name: facturas facturas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facturas
    ADD CONSTRAINT facturas_pkey PRIMARY KEY (fac_id);


--
-- TOC entry 4740 (class 2606 OID 16945)
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (prod_id);


--
-- TOC entry 4744 (class 2606 OID 16974)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (rol_id);


--
-- TOC entry 4746 (class 2606 OID 16981)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (user_id);


--
-- TOC entry 4749 (class 2606 OID 16997)
-- Name: abonos abonos_abono_fac_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abonos
    ADD CONSTRAINT abonos_abono_fac_id_fkey FOREIGN KEY (abono_fac_id) REFERENCES public.facturas(fac_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4751 (class 2606 OID 17002)
-- Name: detalles_facturas detalles_facturas_det_fac_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalles_facturas
    ADD CONSTRAINT detalles_facturas_det_fac_id_fkey FOREIGN KEY (det_fac_id) REFERENCES public.facturas(fac_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4752 (class 2606 OID 17007)
-- Name: detalles_facturas detalles_facturas_det_prod_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalles_facturas
    ADD CONSTRAINT detalles_facturas_det_prod_id_fkey FOREIGN KEY (det_prod_id) REFERENCES public.productos(prod_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4747 (class 2606 OID 17012)
-- Name: facturas facturas_fac_cli_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facturas
    ADD CONSTRAINT facturas_fac_cli_id_fkey FOREIGN KEY (fac_cli_id) REFERENCES public.clientes(cli_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4748 (class 2606 OID 17017)
-- Name: facturas facturas_fac_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facturas
    ADD CONSTRAINT facturas_fac_user_id_fkey FOREIGN KEY (fac_user_id) REFERENCES public.usuarios(user_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4750 (class 2606 OID 17022)
-- Name: productos productos_prod_cat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_prod_cat_id_fkey FOREIGN KEY (prod_cat_id) REFERENCES public.categorias_productos(cat_id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- TOC entry 4753 (class 2606 OID 17027)
-- Name: usuarios usuarios_user_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_user_rol_fkey FOREIGN KEY (user_rol) REFERENCES public.roles(rol_id) ON UPDATE SET NULL ON DELETE SET NULL;


-- Completed on 2024-04-13 14:17:06

--
-- PostgreSQL database dump complete
--

