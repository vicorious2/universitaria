import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class CategoriaService {


  constructor(private serviceUtils: ServiceUtils,) { }

  getCategorias() {
    return this.serviceUtils.buildRequest(ServicesRoutes.listarCategorias, 'get');
  }
}
