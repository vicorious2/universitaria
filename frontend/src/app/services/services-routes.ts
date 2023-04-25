import { Config } from '@config/index';

const {
    baseUrlBackend,
} = Config.api;

const ServicesRoutes = {
    tipoUsuario: {
        needsAuth: false,
        url: baseUrlBackend + '/tipoUsuario'
    },
    loginUser: {
        needsAuth: false,
        url: baseUrlBackend + '/loginUser'
    },
    filtroCursos: {
        needsAuth: false,
        url: baseUrlBackend + '/filtroCursos'
    },
    listaCursos: {
        needsAuth: false,
        url: baseUrlBackend + '/listaCursos'
    },
    nuevosCursos: {
        needsAuth: false,
        url: baseUrlBackend + '/nuevosCursos'
    },
    inscribirCurso: {
        needsAuth: true,
        url: baseUrlBackend + '/inscribirCurso'
    },
    listaCursosInscritos: {
        needsAuth: true,
        url: baseUrlBackend + '/listaCursosInscritos/:idUsuario'
    },
    listaClases: {
        needsAuth: true,
        url: baseUrlBackend + '/listaClases/:idCourse'
    },
    primeraClase: {
        needsAuth: true,
        url: baseUrlBackend + '/primeraClase/:idCourse'
    },
    actualClase: {
        needsAuth: true,
        url: baseUrlBackend + '/actualClase/:idCourse/:idClass'
    },
    listarFacultades: {
        needsAuth: false,
        url: baseUrlBackend + '/listarFacultades'
    },
    listarEstado: {
        needsAuth: false,
        url: baseUrlBackend + '/listarEstados'
    },
    listarTiposRecurso: {
        needsAuth: false,
        url: baseUrlBackend + '/listarTiposRecurso'
    },
    listarNiveles: {
        needsAuth: false,
        url: baseUrlBackend + '/listarNiveles'
    },
    listarCategorias: {
        needsAuth: false,
        url: baseUrlBackend + '/listarCategorias'
    },
    crearCurso: {
        needsAuth: true,
        url: baseUrlBackend + '/crearCurso'
    },
    crearClase: {
        needsAuth: true,
        url: baseUrlBackend + '/crearClase'
    },
    getClases: {
        needsAuth: true,
        url: baseUrlBackend + '/listarClases'
    },
    crearRecurso: {
        needsAuth: true,
        url: baseUrlBackend + '/crearRecurso'
    },
    
};

const buildRoute = (path: any, params: any) => {
    const route = Object.assign({}, path);

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            route.url = route.url.replace(new RegExp(':' + key, 'g'), encodeURIComponent(params[key]));
        }
    }

    return route;
};

export {
    buildRoute, ServicesRoutes
};