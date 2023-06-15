import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { CourseService } from '@services/course.service';
import { PdfService } from '@services/pdf.service'
import { Config } from '@config/index';
import {ElementRef} from '@angular/core';
import { SessionService } from '@services/session.service';


@Component({
  selector: 'app-class',
  templateUrl: './class.component.html',
  styleUrls: ['./class.component.css']
})
export class ClassComponent implements OnInit {

  @ViewChild("videoPlayer")
  videoPlayer!: ElementRef;

  videoClicked = false;

  urlBucket: any;
  url: any;
  idCurso:any;
  name:any;
  idClass:any;
  listClases: any[];
  claseActual: any;
  activeDataClass: boolean;

  clickedClaases: any[];
  static activateCertificate: boolean = false;
  

  constructor(
    private router: Router,
    private courseService: CourseService,
    private pdfService: PdfService,
    private sessionService: SessionService
  ) {
    this.urlBucket = Config.aws.baseUrlBucket;
    this.url =  Config.api.baseUrlBackend;
    this.activeDataClass = false;
    this.clickedClaases = []
    this.listClases = []
   }

  ngOnInit(): void {

    this.idCurso = sessionStorage.getItem('idCurso');

    const data = this.sessionService.getSessionData();
    this.name = data.nombre;
    
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

  generateCertificate() {
    this.pdfService.generarPDF(this.idCurso)!.subscribe((pdf) => {
    });  
    
  }

  startVideo(): void {
    var video = this.videoPlayer;
    this.videoPlayer.nativeElement.load();
    var idClass = this.claseActual.id_clase;
    var data = this.clickedClaases.filter(element => {
      return element == idClass;
    });

    if(data.length == 0){
      this.clickedClaases.push(idClass);
    }

    /*if(this.listClases.length == this.clickedClaases.length){
      this.activateCertificate = true;
    }*/

    var clases = this.listClases;
    var clicked = this.clickedClaases;
    var certificate = ClassComponent.activateCertificate;
    var id = setInterval(function(){
      console.log(video.nativeElement.currentTime);
      console.log(video.nativeElement.duration);
      var finaltime = Math.round(video.nativeElement.duration);
      var time = Math.round(video.nativeElement.currentTime);
      if(time == finaltime)
      {
        console.log(clases.length)
        console.log(clicked.length)
        if(clases.length == clicked.length){
          ClassComponent.activateCertificate = true;
          console.log('Certifico');
          console.log(ClassComponent.activateCertificate);
        }
        console.log('Termino');
        clearInterval(id);
      }
      
      },1000);

    this.videoClicked = true;
    this.videoPlayer.nativeElement.play();
  }


  play(){
    this.videoPlayer.nativeElement.play();
    this.startVideo();
  }

  pause(){
    this.videoPlayer.nativeElement.pause();

  }

  get staticCertificate() {
    return ClassComponent.activateCertificate;
  }

}
