import { Component, OnInit } from '@angular/core';
import { CourseService } from '@services/course.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  listCursos: any;

  constructor(
    private courseService: CourseService,
  ) { }

  ngOnInit(): void {
    this.getNewCourse();
  }

  getNewCourse(){
    this.courseService.getNewCourse()!.subscribe((courseList) => {
      this.listCursos = courseList;      
    });
  }

}
