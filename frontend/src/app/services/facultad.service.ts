import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class FacultadService {

  constructor(private serviceUtils: ServiceUtils,) { }

    getFacultades() {
      return this.serviceUtils.buildRequest(ServicesRoutes.listarFacultades, 'get');
    }

}
