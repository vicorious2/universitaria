import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, } from '@angular/forms';
import { Router } from '@angular/router';

import { TipoUsuarioService } from '@services/tipoUsuario.service';
import { LoginService } from '@services/login.service';
import { SessionService } from '@services/session.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  loginForm;
  identificationTypes: any;
  tipoUsuario: any;
  messageError: string;

  constructor(
    private router: Router,
    private tipoUsuarioService: TipoUsuarioService,
    private loginService: LoginService,
    private sessionService: SessionService,
  ) {
    this.loginForm = new FormGroup({
      'contrasena': new FormControl('', null),
      'usuario': new FormControl('', null),
      'tipoUsuario': new FormControl('', null)
    });
    this.messageError= '';
  }

  ngOnInit(): void {
    this.loginService.logout();
    this.initIdTypesCombos();
  }

  private initIdTypesCombos() {
    this.tipoUsuarioService.getTypesUser()!.subscribe((data: {}) => {
      this.identificationTypes = data; 
    });
  }

  onFormSubmit() {
    const user = this.loginForm.get("usuario")?.value;
    const pass = this.loginForm.get("contrasena")?.value;
    const typeUser = this.loginForm.get("tipoUsuario")?.value;

    this.tipoUsuario = typeUser;

    console.log(typeUser);
    
    this.loginService.login(user,typeUser,pass).subscribe((responseData) => {
      if (responseData.token) {
        this.sessionService.setToken(responseData.token);
        let tipo_doc = "";
        if(responseData.user.id_tipo_doc ==1)
          tipo_doc = "Cedula";
        if(responseData.user.id_tipo_doc ==2)
          tipo_doc = "Cedula de extrangeria";
        if(responseData.user.id_tipo_doc ==3)
          tipo_doc = "Tarjeta Identidad";

        const sessionData = Object.assign({
          correo: user,
          password: pass,
          documento: responseData.user.documento,
          id_estado: responseData.user.id_estado,
          id_tipo_doc: responseData.user.id_tipo_doc,
          tipo_doc: tipo_doc,
          id_tipo_usuario: typeUser,
          id_usuario: responseData.user.id_usuario,
          nombre: responseData.user.nombre,
          telefono: responseData.user.telefono,
          token: responseData.token
        });

        this.sessionService.saveSessionData(sessionData);
        this.router.navigateByUrl('/');
      }

    }, error => {
      if (error.error.message === 'Unauthorized') {
        this.messageError = "Las credenciales proporcionadas no coinciden con nuestros registros.";
      } else {
        this.messageError = error.error.message;
      }
    });
  }
}
