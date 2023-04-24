import { Injectable } from '@angular/core';
import { ServiceUtils } from './services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class ClaseService {

  constructor(private serviceUtils: ServiceUtils) { }

  crearClase(nombre: string, descripcion: string, id_curso: string) {
    const data = {
      "nombre": nombre,
      "descripcion": descripcion,
      "id_curso": id_curso
    }
    return this.serviceUtils.buildRequest(ServicesRoutes.crearClase, 'post', data);

  }
}
