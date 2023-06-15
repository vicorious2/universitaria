import { Component, OnInit } from '@angular/core';
import { LoginService } from '@services/login.service';
import { SessionService } from '@services/session.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  activo: boolean;
  nameUser : any;
  tipoUsuario: any;

  constructor(
    private sessionService: SessionService,
    private loginService: LoginService,
  ) { 
    this.activo = false;
    this.nameUser = "";
  }

  ngOnInit(): void {
    const userData = this.sessionService.getSessionData();

    
    if(userData != null && userData.length !== 0){
      this.tipoUsuario = userData.id_tipo_usuario;
      this.activo = true;
      this.nameUser = userData.nombre;
    }
  }

  onLogout(){
    this.loginService.logout();
  }

  
  onAdmin(){
    const userData = this.sessionService.getSessionData();
    window.open('http://127.0.0.1:8001?correo='+userData.correo + "&" + "key="+userData.password, "_blank");

  }

}
