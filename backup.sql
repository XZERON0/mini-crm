--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: customers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customers (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    name character varying(100) NOT NULL,
    email character varying(150) NOT NULL,
    phone character varying(20) NOT NULL
);


ALTER TABLE public.customers OWNER TO postgres;

--
-- Name: customers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.customers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.customers_id_seq OWNER TO postgres;

--
-- Name: customers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.customers_id_seq OWNED BY public.customers.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: media; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.media (
    id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL,
    uuid uuid,
    collection_name character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    mime_type character varying(255),
    disk character varying(255) NOT NULL,
    conversions_disk character varying(255),
    size bigint NOT NULL,
    manipulations json NOT NULL,
    custom_properties json NOT NULL,
    generated_conversions json NOT NULL,
    responsive_images json NOT NULL,
    order_column integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.media OWNER TO postgres;

--
-- Name: media_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.media_id_seq OWNER TO postgres;

--
-- Name: media_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.media_id_seq OWNED BY public.media.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO postgres;

--
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO postgres;

--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO postgres;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO postgres;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: tickets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tickets (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    subject character varying(150) NOT NULL,
    text text NOT NULL,
    status character varying(255) DEFAULT 'Новый'::character varying NOT NULL,
    customer_id bigint NOT NULL,
    manager_id bigint,
    CONSTRAINT tickets_status_check CHECK (((status)::text = ANY ((ARRAY['Новый'::character varying, 'В работе'::character varying, 'Обработан'::character varying])::text[])))
);


ALTER TABLE public.tickets OWNER TO postgres;

--
-- Name: tickets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tickets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tickets_id_seq OWNER TO postgres;

--
-- Name: tickets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tickets_id_seq OWNED BY public.tickets.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: customers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers ALTER COLUMN id SET DEFAULT nextval('public.customers_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: media id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media ALTER COLUMN id SET DEFAULT nextval('public.media_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: tickets id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets ALTER COLUMN id SET DEFAULT nextval('public.tickets_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: customers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customers (id, created_at, updated_at, name, email, phone) FROM stdin;
1	2025-12-08 18:54:27	2025-12-08 18:54:27	Muriel Satterfield	alessia.schinner@example.net	+74707633940
2	2025-12-08 18:54:27	2025-12-08 18:54:27	Tyrel Block	czboncak@example.org	+78782305802
3	2025-12-08 18:54:27	2025-12-08 18:54:27	Helen Lowe	morissette.dimitri@example.org	+76783592940
4	2025-12-08 18:54:27	2025-12-08 18:54:27	Mr. Merle Haley DVM	keichmann@example.com	+77729763740
5	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Anais Heaney Jr.	jensen.leannon@example.com	+70592850583
6	2025-12-08 18:54:27	2025-12-08 18:54:27	Oren Glover	slindgren@example.net	+75176523838
7	2025-12-08 18:54:27	2025-12-08 18:54:27	Pattie Bogan	davonte19@example.org	+75649554587
8	2025-12-08 18:54:27	2025-12-08 18:54:27	Madge Borer	verda.barton@example.com	+70013183188
9	2025-12-08 18:54:27	2025-12-08 18:54:27	Jon Hagenes	fkris@example.net	+76483152443
10	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Heaven Lehner	kwiegand@example.net	+79692841166
11	2025-12-08 18:54:27	2025-12-08 18:54:27	Mr. Samir Gerlach PhD	janet62@example.com	+77762818900
12	2025-12-08 18:54:27	2025-12-08 18:54:27	Unique Gorczany	herzog.mack@example.com	+70386724300
13	2025-12-08 18:54:27	2025-12-08 18:54:27	Mrs. Tressa Moen III	mhirthe@example.com	+75570920549
14	2025-12-08 18:54:27	2025-12-08 18:54:27	Mrs. Clemmie Witting	rferry@example.com	+70520438600
15	2025-12-08 18:54:27	2025-12-08 18:54:27	Brooke Hintz	rippin.domenick@example.com	+73875856132
16	2025-12-08 18:54:27	2025-12-08 18:54:27	Ms. Jazmin Bernhard	cordell.oberbrunner@example.net	+74243821040
17	2025-12-08 18:54:27	2025-12-08 18:54:27	Eliza White	roberts.nick@example.com	+78403833187
18	2025-12-08 18:54:27	2025-12-08 18:54:27	Dr. Lolita Schmidt Sr.	mrussel@example.net	+79096491422
19	2025-12-08 18:54:27	2025-12-08 18:54:27	Kay Wilkinson	anderson.rosemarie@example.com	+78355301210
20	2025-12-08 18:54:27	2025-12-08 18:54:27	Isidro Gaylord	elisabeth64@example.org	+75242340796
21	2025-12-08 18:54:27	2025-12-08 18:54:27	Dortha Cronin MD	crist.addison@example.org	+74411783646
22	2025-12-08 18:54:27	2025-12-08 18:54:27	Ernest Jacobi MD	veum.kris@example.net	+71256391465
23	2025-12-08 18:54:27	2025-12-08 18:54:27	Ariane Dach	dedric.blick@example.net	+71297716770
24	2025-12-08 18:54:27	2025-12-08 18:54:27	Garret Nikolaus	toby.pouros@example.com	+76101475643
25	2025-12-08 18:54:27	2025-12-08 18:54:27	Rodolfo Gerlach	xoconnell@example.net	+73750954919
26	2025-12-08 18:54:27	2025-12-08 18:54:27	Eduardo Bahringer	nmertz@example.net	+71973050695
27	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Manley Becker PhD	poconnell@example.net	+70070615080
28	2025-12-08 18:54:27	2025-12-08 18:54:27	Fay Lockman	jaiden80@example.org	+72967506865
29	2025-12-08 18:54:27	2025-12-08 18:54:27	Dr. June Metz	olin75@example.com	+70430973148
30	2025-12-08 18:54:27	2025-12-08 18:54:27	Thaddeus Grimes	goodwin.aleen@example.org	+78029743295
31	2025-12-08 18:54:27	2025-12-08 18:54:27	Wyatt Crooks	tdibbert@example.com	+73541755013
32	2025-12-08 18:54:27	2025-12-08 18:54:27	Luz Murray	okuneva.asa@example.com	+75006322382
33	2025-12-08 18:54:27	2025-12-08 18:54:27	Ms. Susanna Dickinson Sr.	towne.carolyne@example.org	+79034017654
34	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Myah Waelchi III	zbogisich@example.net	+70792773719
35	2025-12-08 18:54:27	2025-12-08 18:54:27	Celestine Pouros	lou.swift@example.org	+72430823310
36	2025-12-08 18:54:27	2025-12-08 18:54:27	Gillian Schulist	kennedy06@example.org	+77744802239
37	2025-12-08 18:54:27	2025-12-08 18:54:27	Geovany Fritsch II	reece53@example.net	+75706001564
38	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Imani Von	nathanael59@example.org	+76984302468
39	2025-12-08 18:54:27	2025-12-08 18:54:27	Ignacio Smith IV	gkreiger@example.org	+73204602004
40	2025-12-08 18:54:27	2025-12-08 18:54:27	Griffin Douglas	dorris.powlowski@example.org	+73035162760
41	2025-12-08 18:54:27	2025-12-08 18:54:27	Prof. Brad Huels V	kimberly73@example.com	+73337170035
42	2025-12-08 18:54:27	2025-12-08 18:54:27	Verlie Bednar	sporer.hillard@example.net	+77302249950
43	2025-12-08 18:54:27	2025-12-08 18:54:27	Griffin Torp	xwintheiser@example.org	+70872693940
44	2025-12-08 18:54:27	2025-12-08 18:54:27	Jillian Doyle	omosciski@example.com	+78111838455
45	2025-12-08 18:54:27	2025-12-08 18:54:27	Bernie Botsford	alva.gorczany@example.com	+78789486715
46	2025-12-08 18:54:27	2025-12-08 18:54:27	Cesar Jacobi	elsa36@example.org	+72727660607
47	2025-12-08 18:54:27	2025-12-08 18:54:27	Miss Cathryn Braun	arno70@example.com	+73980585422
48	2025-12-08 18:54:27	2025-12-08 18:54:27	Albertha Adams	raynor.lempi@example.com	+70672787588
49	2025-12-08 18:54:27	2025-12-08 18:54:27	Christina Rempel	effie32@example.org	+73879108246
50	2025-12-08 18:54:27	2025-12-08 18:54:27	Kirsten Kshlerin DVM	yolanda07@example.org	+78390154588
51	2025-12-08 18:54:27	2025-12-08 18:54:27	Vicenta Ledner	hrutherford@example.com	+79526057653
52	2025-12-08 18:54:27	2025-12-08 18:54:27	Rickie Lynch	ritchie.gavin@example.com	+74821682943
53	2025-12-08 18:54:27	2025-12-08 18:54:27	Dr. Eddie Cummings	dwatsica@example.net	+70556572267
54	2025-12-08 18:54:27	2025-12-08 18:54:27	Jacklyn Schaefer DVM	ucartwright@example.org	+74859874746
55	2025-12-08 18:54:27	2025-12-08 18:54:27	Myriam Stoltenberg PhD	meaghan32@example.com	+77437407632
56	2025-12-08 18:54:27	2025-12-08 18:54:27	Dr. Phoebe Streich I	wunsch.maurice@example.com	+73362943472
57	2025-12-08 18:54:27	2025-12-08 18:54:27	Bria Trantow	mcdermott.timmy@example.net	+79998519918
58	2025-12-08 18:54:27	2025-12-08 18:54:27	Camron Langosh	santos.sauer@example.net	+73890852940
59	2025-12-08 18:54:27	2025-12-08 18:54:27	Ms. Orpha Leannon	thompson.samantha@example.net	+73466597699
60	2025-12-08 18:54:27	2025-12-08 18:54:27	Lilliana Jakubowski	mvonrueden@example.com	+76570202274
61	2025-12-09 21:27:17	2025-12-09 21:27:17	Петр Петров	test2@example.com	+79161234568
62	2025-12-09 21:49:01	2025-12-09 21:49:01	Петр Петров	test3@example.com	+79161234512
65	2025-12-09 21:59:46	2025-12-09 21:59:46	Петр Петров	test4@example.com	+79161234523
66	2025-12-09 22:43:33	2025-12-09 22:43:33	test	test8@gmail.com	+79995534561
67	2025-12-09 22:52:16	2025-12-09 22:52:16	testfromiframe	test.from.i.frame@gmail.com	+79991231235
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
1	default	{"uuid":"647ca6a2-7f97-44e9-b456-c33c2c177b18","displayName":"Spatie\\\\MediaLibrary\\\\ResponsiveImages\\\\Jobs\\\\GenerateResponsiveImagesJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"Spatie\\\\MediaLibrary\\\\ResponsiveImages\\\\Jobs\\\\GenerateResponsiveImagesJob","command":"O:69:\\"Spatie\\\\MediaLibrary\\\\ResponsiveImages\\\\Jobs\\\\GenerateResponsiveImagesJob\\":2:{s:8:\\"\\u0000*\\u0000media\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:49:\\"Spatie\\\\MediaLibrary\\\\MediaCollections\\\\Models\\\\Media\\";s:2:\\"id\\";i:2;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"pgsql\\";s:15:\\"collectionClass\\";N;}s:10:\\"connection\\";s:8:\\"database\\";}"},"createdAt":1765320214,"delay":null}	0	\N	1765320214	1765320214
\.


--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.media (id, model_type, model_id, uuid, collection_name, name, file_name, mime_type, disk, conversions_disk, size, manipulations, custom_properties, generated_conversions, responsive_images, order_column, created_at, updated_at) FROM stdin;
1	App\\Models\\Ticket	25	81eead9a-5ece-46e8-9d4f-bbce19eb15c3	ticket_files	atomic	atomic.txt	text/plain	public	public	12	[]	[]	[]	[]	1	2025-12-09 21:59:47	2025-12-09 21:59:47
2	App\\Models\\Ticket	26	035cb5f9-8c47-4a3a-b3b6-132826998375	ticket_files	photo_5280888511110707483_y	photo_5280888511110707483_y.jpg	image/jpeg	public	public	145162	[]	[]	[]	[]	1	2025-12-09 22:43:33	2025-12-09 22:43:33
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_12_08_120756_create_customers_table	1
5	2025_12_08_120941_create_tickets_table	1
6	2025_12_08_135955_create_permission_tables	1
7	2025_12_08_194334_create_media_table	2
\.


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.model_has_permissions (permission_id, model_type, model_id) FROM stdin;
\.


--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.model_has_roles (role_id, model_type, model_id) FROM stdin;
1	App\\Models\\User	1
2	App\\Models\\User	2
2	App\\Models\\User	3
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role_has_permissions (permission_id, role_id) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, name, guard_name, created_at, updated_at) FROM stdin;
1	admin	web	2025-12-08 18:54:26	2025-12-08 18:54:26
2	manager	web	2025-12-08 18:54:26	2025-12-08 18:54:26
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
3Nh8ahx6IgAf8EIxa7Qk7tOXs6wTZZhUpivdy1NE	1	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36	YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUGtsMUE3c1VibUVZc3hMdDVTYjVnU1pLOUNtYWVTZmxNU0VybVczayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90aWNrZXRzIjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi50aWNrZXRzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3RpY2tldHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=	1765379350
\.


--
-- Data for Name: tickets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tickets (id, created_at, updated_at, subject, text, status, customer_id, manager_id) FROM stdin;
3	2025-12-08 18:54:27	2025-12-08 18:54:27	Ab et ea nobis.	Quae qui illo in. Id laboriosam in officiis quis. Commodi et doloremque delectus minima.	В работе	27	3
4	2025-12-08 18:54:27	2025-12-08 18:54:27	Ab earum delectus laborum alias et laboriosam.	Nobis aut minus voluptate esse sequi. Commodi molestiae recusandae esse quo. Aut et accusamus laudantium consequuntur.	Обработан	35	3
5	2025-12-08 18:54:27	2025-12-08 18:54:27	Optio molestiae odit aut non perferendis quas.	Tempora qui amet tempore ut. Numquam rem quas sit et repellendus. Aspernatur dolor magni sint corrupti aperiam.	Обработан	17	3
6	2025-12-08 18:54:27	2025-12-08 18:54:27	Voluptatem quod beatae animi dolores ea.	Rem sit et saepe rerum adipisci praesentium perspiciatis. Et pariatur placeat atque earum dolores alias. Dolorem consequuntur eum debitis recusandae voluptatem repudiandae nihil. Itaque quam sunt et velit ullam.	Новый	55	3
7	2025-12-08 18:54:27	2025-12-08 18:54:27	Facilis alias beatae et blanditiis illum.	In optio et praesentium sit labore laborum eos. Impedit reprehenderit non minus in ea delectus.	В работе	12	3
8	2025-12-08 18:54:27	2025-12-08 18:54:27	Molestiae eveniet et sequi perspiciatis quod velit et.	Vel pariatur dolores necessitatibus vel est. Ducimus aut exercitationem sed totam.	В работе	31	3
9	2025-12-08 18:54:27	2025-12-08 18:54:27	Repellendus eum aliquam reprehenderit.	Minus ut est provident et velit ipsa vitae. Ut voluptatem consequatur assumenda aut. Magni suscipit iure maxime ut.	Новый	38	3
10	2025-12-08 18:54:27	2025-12-08 18:54:27	Rem voluptatem et cum odio architecto commodi.	Hic animi odio sapiente minus repellat expedita. Neque ut ex aliquam debitis. Et modi quia occaecati praesentium dolor pariatur expedita. Impedit blanditiis fugit consequatur consequatur totam.	Обработан	48	3
11	2025-12-08 18:54:27	2025-12-08 18:54:27	Cum non omnis velit temporibus doloremque.	Eos aut fugiat possimus rerum libero. Mollitia maiores eos quam facilis. Non explicabo commodi velit voluptates corporis eum velit. Dolorem unde neque iste aspernatur pariatur consectetur similique molestias.	Новый	14	3
13	2025-12-08 18:54:27	2025-12-08 18:54:27	Sit quibusdam qui est id consequatur ipsa itaque.	Repellat ipsum tempore ea sit. Architecto rerum accusantium quis ut laboriosam. Et doloremque molestiae adipisci id eius nobis aut.	Обработан	60	3
14	2025-12-08 18:54:27	2025-12-08 18:54:27	Rerum modi numquam ipsam magni.	Consequatur ipsum et et commodi vel minima. Ut animi aut et aut autem mollitia nam optio. Quis sed doloribus sunt dignissimos tenetur distinctio. Excepturi sunt laudantium vero numquam repellendus quidem.	Новый	45	3
15	2025-12-08 18:54:27	2025-12-08 18:54:27	Eos aut quod nisi fugiat sapiente omnis.	Nobis et esse delectus aut dolore non. Dolorem deleniti aspernatur inventore doloribus. Aspernatur vero et eum maxime incidunt iste. Voluptates error dignissimos et quo consequatur.	Новый	43	3
16	2025-12-08 18:54:27	2025-12-08 18:54:27	Asperiores qui aliquid debitis velit expedita.	Cum consequatur beatae ut debitis. Non ipsam soluta molestiae at. Nemo eius sint dolores quisquam tenetur deserunt. Sit ut voluptate consequatur ipsum velit eveniet.	В работе	38	3
17	2025-12-08 18:54:27	2025-12-08 18:54:27	Et atque sint quis et.	Laboriosam ut inventore qui est dolore. Est blanditiis recusandae voluptates rerum eum id. Qui architecto libero quo possimus voluptas.	В работе	13	3
18	2025-12-08 18:54:27	2025-12-08 18:54:27	Provident quas totam porro quas ut saepe et.	Modi porro labore qui alias reprehenderit tenetur assumenda. Reprehenderit reiciendis magni quos maxime laudantium. Magni quia neque illum. Eos sit nulla a ipsa.	Новый	33	3
19	2025-12-08 18:54:27	2025-12-08 18:54:27	Temporibus non accusamus minus est corrupti officia.	Eum aut quis distinctio quos incidunt quisquam. Velit facere architecto sequi inventore in et assumenda. Omnis sequi nemo consequatur enim ipsam est consectetur sed.	Обработан	60	3
20	2025-12-08 18:54:27	2025-12-08 18:54:27	Voluptatem qui repellendus officia temporibus ut eveniet ullam voluptas.	Ut non exercitationem nostrum asperiores sit labore sed. Ex eum consectetur quae laboriosam ut quos corrupti voluptates. Eos provident quo fuga qui incidunt unde.	Обработан	15	3
1	2025-12-08 18:54:27	2025-12-08 19:45:18	Quibusdam tenetur ex iure aperiam quia omnis nostrum.	Eius quae molestiae qui sapiente iure qui. Tempore minima ut quis natus exercitationem. Animi est maiores adipisci aliquid excepturi accusantium. Laborum aut fuga enim ut adipisci. Fugit incidunt aut et rerum aspernatur sapiente eligendi.	Обработан	15	3
12	2025-12-08 18:54:27	2025-12-08 19:45:39	Error natus et quia illum iure provident.	Et odit ipsam ea non molestiae fugit dolores. Eligendi aspernatur adipisci dolores autem. Quos itaque sed deleniti.	Новый	31	3
2	2025-12-08 18:54:27	2025-12-08 19:47:01	Et id ipsum quod quia dolore possimus dolores.	Asperiores atque quos nam nesciunt. Omnis molestiae assumenda dolorem dignissimos quos ut quis voluptate.	Новый	59	3
21	2025-12-09 21:27:17	2025-12-09 21:27:17	Test	Это тестовая заявка с прикрепленными файлами	Новый	61	\N
22	2025-12-09 21:49:01	2025-12-09 21:49:01	Test	Это тестовая заявка с прикрепленными файлами	Новый	62	\N
25	2025-12-09 21:59:46	2025-12-09 21:59:46	Test	Это тестовая заявка с прикрепленными файлами	Новый	65	\N
26	2025-12-09 22:43:33	2025-12-09 22:43:33	test	test	Новый	66	\N
27	2025-12-09 22:52:16	2025-12-09 22:52:16	testfromiframe	test	Новый	67	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
3	Reid King	baumbach.chet@example.org	2025-12-08 18:54:27	$2y$12$0qYkc.nrl73/PKf.zfeX2.K3DzLUVO7.QJoU7C.4hNdZhI7zPQkv.	S7iaQ3vk3k	2025-12-08 18:54:27	2025-12-08 18:54:27
1	Admin User	admin@gmail.com	2025-12-08 18:54:26	$2y$12$0qYkc.nrl73/PKf.zfeX2.K3DzLUVO7.QJoU7C.4hNdZhI7zPQkv.	hE4ToWkfXTeZ3oY1AaJrI4os8Gki2kbmfGuu6KzD8swYr3wOgZa4oh6Omq8v	2025-12-08 18:54:27	2025-12-08 18:54:27
2	Manager User	manager@gmail.com	2025-12-08 18:54:27	$2y$12$0qYkc.nrl73/PKf.zfeX2.K3DzLUVO7.QJoU7C.4hNdZhI7zPQkv.	9Kaexwm9h7TFQfGGQ5BvmkkjPwq1ON4LSrYoWcYD0Sm5SafXtdOaIP86lTKA	2025-12-08 18:54:27	2025-12-08 18:54:27
\.


--
-- Name: customers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.customers_id_seq', 67, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, true);


--
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_id_seq', 2, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 7, true);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissions_id_seq', 1, false);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 2, true);


--
-- Name: tickets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tickets_id_seq', 27, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: customers customers_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_email_unique UNIQUE (email);


--
-- Name: customers customers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: media media_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id);


--
-- Name: media media_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- Name: model_has_roles model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: role_has_permissions role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- Name: roles roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: tickets tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: media_model_type_model_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX media_model_type_model_id_index ON public.media USING btree (model_type, model_id);


--
-- Name: media_order_column_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX media_order_column_index ON public.media USING btree (order_column);


--
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);


--
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: model_has_permissions model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: model_has_roles model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: tickets tickets_customer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_customer_id_foreign FOREIGN KEY (customer_id) REFERENCES public.customers(id) ON DELETE CASCADE;


--
-- Name: tickets tickets_manager_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_manager_id_foreign FOREIGN KEY (manager_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

