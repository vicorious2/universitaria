import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CourseService } from '@services/course.service'
import { SessionService } from '@services/session.service';

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.css']
})
export class CourseComponent implements OnInit {

  listCategorias: any;
  listNiveles: any;
  listAreas: any;
  listCursos: any;
  listCursosAnt: any;
  activarButton: boolean;
  courseListRegister: any;
  typeUser: any;

  constructor(
    private router: Router,
    private courseService: CourseService,
    private sessionService: SessionService,
  ) { 
    this.activarButton = false;
  }

  ngOnInit(): void {
    sessionStorage.removeItem('idCurso');
    this.getFilterCourse();
    this.getAllCourse();
    this.getAllCourseRegister();
    let isAuthenticated = this.sessionService.isAuthenticated();
    if(isAuthenticated){
      this.activarButton = true;
    }

    const userData = this.sessionService.getSessionData();
    this.typeUser = userData.id_tipo_usuario;
  }

  getAllCourseRegister() {
    const userData = this.sessionService.getSessionData();
    const idUser = userData.id_usuario;
    this.courseService.getAllCourseRegister(idUser)!.subscribe((courseListRegister) => {
      this.courseListRegister = courseListRegister;
    });
  }

  getAllCourse() {
    this.courseService.getAllCourse()!.subscribe((courseList) => {
      this.listCursos = courseList;
    });
  }

  getFilterCourse() {
    this.courseService.getFilterCourse()!.subscribe((dataList) => {
      this.listCategorias = dataList.categorias;
      this.listNiveles = dataList.niveles;
      this.listAreas = dataList.areas;
    });
  }

  filter(type: String, idfilter: number, name: string){
   
    if(this.listCursosAnt){
      this.listCursos = this.listCursosAnt;
    }else{
      this.listCursosAnt = this.listCursos;
    }
    
    let filteredCourse;
    if(type == 'categoria'){
      filteredCourse = this.listCursos.filter((val: { categorias: string; }) => val.categorias.includes(name) );
    }
    if(type == 'area'){
      filteredCourse = this.listCursos.filter((val: { id_facultad: number; }) => val.id_facultad == idfilter);
    }
    if(type == 'nivel'){
      filteredCourse = this.listCursos.filter((val: { id_nivel: number; }) => val.id_nivel == idfilter);
    }
    
    this.listCursos = filteredCourse;
  }

  filterGeneral(){
    if(this.listCursosAnt){
      this.listCursos = this.listCursosAnt;
    }else{
      this.listCursosAnt = this.listCursos;
    }
  }

  goToClass(idCourse: number){
    
    const userData = this.sessionService.getSessionData();
    const idUser = userData.id_usuario;
    let cursoRegistrado ;
    sessionStorage.setItem('idCurso', idCourse.toString());

    if(this.courseListRegister){
      cursoRegistrado = this.courseListRegister.find((element: { id_curso: number; }) => element.id_curso == idCourse);
    }

    if(!cursoRegistrado){
      this.courseService.inscribirCurso(idCourse, idUser)!.subscribe((responseRegister) => {
        if(responseRegister){
          this.router.navigateByUrl('/class');
        }
      });
    }else{
      this.router.navigateByUrl('/class');
    }
  }

  onSubmitCourse(){
    this.router.navigate(['create-course']);
  }

  onSubmitClass(){
    this.router.navigate(['create-clase']);
  }

  onSubmitResources(){
    this.router.navigate(['create-recurso']);
  }
}
