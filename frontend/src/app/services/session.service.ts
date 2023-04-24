import { Injectable } from '@angular/core';
import { sessionPersistence } from '@utils/session-persistence.util';

@Injectable({ providedIn: 'root' })

export class SessionService {
  private token: any;
  private sessionData: any;

  constructor() {
    const userData = sessionPersistence.get('userData');

    if (userData) {
      this.saveSessionData(userData);
    }

    this.patchSessionData = this.patchSessionData.bind(this);
  }

  getToken() {
    return this.token || '';
  }

  patchSessionData(data: any) {
    Object.assign(this.sessionData, data);
    this.saveSessionData(this.sessionData);

    return this.sessionData;
  }

  setToken(token: string) {
    this.token = token;
  }

  removeToken() {
    this.token = null;
  }

  isAuthenticated() {
    return this.token && this.token !== '';
  }

  getSessionData() {
    return this.sessionData;
  }

  saveSessionData(data: any) {
    this.setToken(data.token);
    sessionPersistence.set('userData', data);
    sessionPersistence.setRawString('token', data.token);
    this.sessionData = data;
  }

  removeSessionData() {
    sessionPersistence.delete('userData');
    sessionPersistence.delete('token');
    sessionPersistence.get('idModal');
    // sessionPersistence.deleteAll();
    this.sessionData = null;
  }

}
