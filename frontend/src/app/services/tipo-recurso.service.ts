import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class TipoRecursoService {

  constructor(private serviceUtils: ServiceUtils,) { }

  getTipoRecursos() {
    return this.serviceUtils.buildRequest(ServicesRoutes.listarTiposRecurso, 'get');
  }
}
