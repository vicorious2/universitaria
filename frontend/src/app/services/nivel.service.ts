import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class NivelService {
  constructor(private serviceUtils: ServiceUtils,) { }

  getNiveles() {
    return this.serviceUtils.buildRequest(ServicesRoutes.listarNiveles, 'get');
  }
}
