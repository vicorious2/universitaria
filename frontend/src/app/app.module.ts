import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './routing/app-routing.module';
import { HomeComponent } from './pages/home/home.component';
import { MenuComponent } from './components/menu/menu.component';
import { MaterialModule } from './shared/material.module';
import { ProfileComponent } from './pages/profile/profile.component';
import { LoginComponent } from './pages/login/login.component';
import { CourseComponent } from './pages/course/course.component';
import { ClassComponent } from './pages/class/class.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { ServiceUtils } from '@services/services-utils';
import { CreateCourseComponent } from './pages/create-course/create-course.component';
import { CreateClaseComponent } from './pages/create-clase/create-clase.component';
import { CreateResourcesComponent } from './pages/create-resources/create-resources.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    MenuComponent,
    ProfileComponent,
    LoginComponent,
    CourseComponent,
    ClassComponent,
    CreateCourseComponent,
    CreateClaseComponent,
    CreateResourcesComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    MaterialModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [ServiceUtils],
  bootstrap: [AppComponent]
})
export class AppModule { }
