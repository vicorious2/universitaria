import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes } from './services-routes';

@Injectable({
  providedIn: 'root'
})
export class MailService {

  constructor(private serviceUtils: ServiceUtils) { }

  sendMail(data: any) {
    return this.serviceUtils.buildRequest(ServicesRoutes.enviarMail, 'post', data);
  }
}
