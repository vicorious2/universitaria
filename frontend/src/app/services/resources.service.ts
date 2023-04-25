import { Injectable } from '@angular/core';
import { ServicesRoutes } from './services-routes';
import { ServiceUtils } from './services-utils';

@Injectable({
  providedIn: 'root'
})
export class ResourcesService {

  constructor(private serviceUtils: ServiceUtils) { }

  crearRecurso(nombre: string, ruta: string, id_tipo_recurso: any, id_clase: any) {
    const data = {
      "nombre": nombre,
      "ruta": ruta,
      "id_tipo_recurso": id_tipo_recurso,
      "id_clase": id_clase
    }
    
    return this.serviceUtils.buildRequest(ServicesRoutes.crearRecurso, 'post', data);

  }

}
