import {
  buildRoute, ServicesRoutes
} from '@services/services-routes';
import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { HttpClient } from '@angular/common/http';
import { SessionService } from './session.service';
import { Router } from '@angular/router';

@Injectable({ providedIn: 'root' })
export class LoginService {

  constructor(
    private http: HttpClient,
    private serviceUtils: ServiceUtils,
    private sessionService: SessionService,
    private router: Router,
  ) { }

  login(correo: string, typeUser: number, password: string) {
    const data = {
      'correo': correo,
      'password': password,
      'tipo_usuario': typeUser
    };

    return this.serviceUtils.buildRequest(ServicesRoutes.loginUser, 'post', data);
  }

  loginAdmin(correo: string, password: string) {
    const data = {
      'correo': correo,
      'password': password,
    };

    return this.serviceUtils.buildRequest(ServicesRoutes.loginAdmin, 'post', data);
  }

  logout() {
    this.sessionService.removeSessionData();
    this.sessionService.removeToken();
    this.router.navigateByUrl('login');
  }
}
