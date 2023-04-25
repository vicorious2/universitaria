import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClassComponent } from '../pages/class/class.component';
import { CourseComponent } from '../pages/course/course.component';
import { HomeComponent } from '../pages/home/home.component';
import { LoginComponent } from '../pages/login/login.component';
import { ProfileComponent } from '../pages/profile/profile.component';
import { SessionAuthGuard } from '@guards/session-auth.guard';
import { CreateCourseComponent } from '../pages/create-course/create-course.component';
import { CreateClaseComponent } from '../pages/create-clase/create-clase.component';
import { CreateResourcesComponent } from '../pages/create-resources/create-resources.component';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  },
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: 'course',
    component: CourseComponent
  },
  {
    canActivate: [SessionAuthGuard],
    path: 'class',
    component: ClassComponent
  },
  {
    canActivate: [SessionAuthGuard],
    path: 'profile',
    component: ProfileComponent
  },{
    path: 'create-course',
    component: CreateCourseComponent
  },
  {
    path: 'create-clase',
    component: CreateClaseComponent
  },
  {
    path: 'create-recurso',
    component: CreateResourcesComponent
  }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }