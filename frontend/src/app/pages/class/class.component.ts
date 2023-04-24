import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CourseService } from '@services/course.service';
import { Config } from '@config/index';

@Component({
  selector: 'app-class',
  templateUrl: './class.component.html',
  styleUrls: ['./class.component.css']
})
export class ClassComponent implements OnInit {

  urlBucket: any;
  idCurso:any;
  idClass:any;
  listClases: any;
  claseActual: any;
  activeDataClass: boolean;

  constructor(
    private router: Router,
    private courseService: CourseService
  ) {
    this.urlBucket = Config.aws.baseUrlBucket;
    this.activeDataClass = false;
   }

  ngOnInit(): void {
    this.idCurso = sessionStorage.getItem('idCurso');
    
    if(!this.idCurso){
      this.router.navigateByUrl('/course');
    }

    this.firstClass();
    this.getListClass();      
  }

  firstClass(){
    this.activeDataClass = false;
    this.courseService.getfirstClassCourse(this.idCurso)!.subscribe((firstClass) => {
      if(firstClass){
        this.claseActual = firstClass;
        this.activeDataClass = true;
      }
    });
  }

  getDataClass(idClass: string){
    this.activeDataClass = false;
    this.courseService.getClassCourse(this.idCurso,idClass)!.subscribe((dataClass) => {
      if(dataClass){
        this.claseActual = dataClass;
        this.activeDataClass = true;
      }
    });
  }
  
  getListClass(){
    this.courseService.getAllClassCourse(this.idCurso)!.subscribe((classList) => {
      if(classList){
        this.listClases = classList;
      }
    });  
  }

}
