import { Component, OnInit } from '@angular/core';
import { CourseService } from '@services/course.service';
import { SessionService } from '@services/session.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  listCursos: any;
  typeUser: any;

  constructor(
    private courseService: CourseService,
    private sessionService: SessionService,
  ) { }

  ngOnInit(): void {
    this.getNewCourse();
    const userData = this.sessionService.getSessionData();
    this.typeUser = userData.id_tipo_usuario;
  }

  getNewCourse(){
    this.courseService.getNewCourse()!.subscribe((courseList) => {
      this.listCursos = courseList;      
    });
  }

}
