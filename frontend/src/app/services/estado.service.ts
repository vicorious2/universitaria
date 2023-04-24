import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class EstadoService {
    constructor(private serviceUtils: ServiceUtils,) { }

    getEstados() {
      return this.serviceUtils.buildRequest(ServicesRoutes.listarEstado, 'get');
    }
}
