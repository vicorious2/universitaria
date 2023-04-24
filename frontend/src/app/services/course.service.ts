import {
  buildRoute, ServicesRoutes
} from '@services/services-routes';
import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { HttpClient } from '@angular/common/http';
import { SessionService } from './session.service';
import { Router } from '@angular/router';

@Injectable({ providedIn: 'root' })
export class CourseService {

  constructor(
    private http: HttpClient,
    private serviceUtils: ServiceUtils,
    private sessionService: SessionService,
    private router: Router,
  ) { }
  
  getFilterCourse() {
    return this.serviceUtils.buildRequest(ServicesRoutes.filtroCursos, 'get');
  }

  getAllCourse() {
    return this.serviceUtils.buildRequest(ServicesRoutes.listaCursos, 'get');
  }

  getNewCourse() {
    return this.serviceUtils.buildRequest(ServicesRoutes.nuevosCursos, 'get');
  }

  getAllCourseRegister(idUsuario: string) {
    return this.serviceUtils.buildRequest(buildRoute(ServicesRoutes.listaCursosInscritos, { idUsuario: idUsuario }), 'get');
  }

  getAllClassCourse(idCourse: string) {
    return this.serviceUtils.buildRequest(buildRoute(ServicesRoutes.listaClases, { idCourse: idCourse }), 'get');
  }

  getfirstClassCourse(idCourse: string) {
    return this.serviceUtils.buildRequest(buildRoute(ServicesRoutes.primeraClase, { idCourse: idCourse }), 'get');
  }

  getClassCourse(idCourse: string, idClass: string) {
    return this.serviceUtils.buildRequest(buildRoute(ServicesRoutes.actualClase, { idCourse: idCourse , idClass: idClass }), 'get');
  }

  inscribirCurso(idCourse: number, idUser: number) {
    const data = {
      'id_curso': idCourse,
      'id_usuario': idUser,
    };

    return this.serviceUtils.buildRequest(ServicesRoutes.inscribirCurso, 'post', data);
  }

  crearCurso(nombre: string, descripcion: string, 
            id_usuario_p: number, id_facultad: number, id_estado: number,
            id_nivel: number, id_categoria: number) {

      const data = {
        'nombre': nombre,
        'descripcion': descripcion,
        'id_usuario_p': id_usuario_p,
        'id_facultad': id_facultad,
        'id_estado': id_estado,
        'id_nivel': id_nivel,
        'id_categoria': id_categoria
      }

      return this.serviceUtils.buildRequest(ServicesRoutes.crearCurso, 'post', data);
    }

}
