import { Injectable } from '@angular/core';
import { ServiceUtils } from '@services/services-utils';
import { ServicesRoutes, buildRoute } from './services-routes';
import { SessionService } from './session.service';

@Injectable({
  providedIn: 'root'
})
export class PdfService {

  constructor(private serviceUtils: ServiceUtils,
    private sessionService: SessionService,) { }

  generarPDF(course: any) {
    const userData = this.sessionService.getSessionData();
    const correo = userData.correo;
    return this.serviceUtils.buildRequest(buildRoute(ServicesRoutes.pdf, { view: 'pdf.ejemplo'  , fileName: 'certificate'+correo, course: course, name: userData.nombre }), 'get');
  }
}
