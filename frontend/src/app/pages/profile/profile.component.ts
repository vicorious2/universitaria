import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CourseService } from '@services/course.service';
import { SessionService } from '@services/session.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

  userData : any;
  courseListRegister: any;

  constructor(
    private router: Router,
    private courseService: CourseService,
    private sessionService: SessionService,
  ) { }

  ngOnInit(): void {
    this.userData = this.sessionService.getSessionData();
    sessionStorage.removeItem('idCurso');
    this.getAllCourseRegister();
  }

  getAllCourseRegister() {
    const idUser = this.userData.id_usuario;
    this.courseService.getAllCourseRegister(idUser)!.subscribe((courseListRegister) => {
      this.courseListRegister = courseListRegister;
    });
  }

  goToClass(idCourse: number){
    sessionStorage.setItem('idCurso', idCourse.toString());
    this.router.navigateByUrl('/class');
  }

}
