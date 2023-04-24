import { Component, OnInit } from '@angular/core';
import { SessionService } from '@services/session.service';
import { Router } from '@angular/router';
import { FormControl, FormGroup, } from '@angular/forms';
import { FacultadService } from '@services/facultad.service';
import { EstadoService } from '@services/estado.service';
import { TipoRecursoService } from '@services/tipo-recurso.service';
import { NivelService } from '@services/nivel.service';
import { CategoriaService } from '@services/categoria.service';
import { CourseService } from '@services/course.service';

@Component({
  selector: 'app-create-course',
  templateUrl: './create-course.component.html',
  styleUrls: ['./create-course.component.css']
})
export class CreateCourseComponent implements OnInit {

  loginForm;
  messageError: string;
  facultas: any;
  estados: any;
  tipoRecursos: any;
  niveles: any;
  categoria: any;

  constructor(private sessionService: SessionService,
    private router: Router, 
    private facultadService: FacultadService,
    private estadoService: EstadoService,
    private tipoRecursoService: TipoRecursoService,
    private nivelService: NivelService,
    private categoriaService: CategoriaService,
    private courseService: CourseService) 
    {
      this.loginForm = new FormGroup({
        'nombre': new FormControl('', null),
        'descripcion': new FormControl('', null),
        'categoria': new FormControl('', null),
        'facultad': new FormControl('', null),
        'estado': new FormControl('', null),
        'nivel': new FormControl('', null),
        'tipoRecurso': new FormControl('', null),
      });
      this.messageError = '';
    }

  userData : any;

  ngOnInit(): void {
    this.userData = this.sessionService.getSessionData();
    this.facultadService.getFacultades().subscribe((data) => {
      this.facultas = data;
    });

    this.estadoService.getEstados().subscribe((data) => {
      this.estados = data;
    });

    this.tipoRecursoService.getTipoRecursos().subscribe((data) => {
      this.tipoRecursos = data;
    });

    this.nivelService.getNiveles().subscribe((data) => {
      this.niveles = data;
    });

    this.categoriaService.getCategorias().subscribe((data) => {
      this.categoria = data;
    });
  }

  onFormSubmit() {

    const nombre = this.loginForm.get("nombre")?.value;
    const descripcion = this.loginForm.get("descripcion")?.value;
    const categoria = this.loginForm.get("categoria")?.value;
    const facultad = this.loginForm.get("facultad")?.value;
    const estado = this.loginForm.get("estado")?.value;
    const nivel = this.loginForm.get("nivel")?.value;
    const tipoRecurso = this.loginForm.get("tipoRecurso")?.value;

    const data = this.sessionService.getSessionData();
    const p_usuario_id = data.id_usuario;

    this.courseService.crearCurso(nombre, descripcion, p_usuario_id, facultad, estado, nivel, categoria).subscribe((data) => {
      this.messageError = data.data;
    }, error => {
      console.log(error);
      this.messageError = "Error al guardar el curso. Intente de nuevo o contacte a su administrador";
    });

    this.loginForm.patchValue({nombre: '', descripcion: '', categoria: '', facultad: '', estado: '', nivel: '', tipoRecurso: ''});
    
  }

}
