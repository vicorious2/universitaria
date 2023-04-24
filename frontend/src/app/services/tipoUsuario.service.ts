import {
  buildRoute, ServicesRoutes
} from '@services/services-routes';
import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { HttpClient } from '@angular/common/http';

@Injectable({ providedIn: 'root' })
export class TipoUsuarioService {

  constructor(
    private http: HttpClient,
    private serviceUtils: ServiceUtils,
  ) { }

  getTypesUser() {
    return this.serviceUtils.buildRequest(ServicesRoutes.tipoUsuario, 'get');
  }
}
