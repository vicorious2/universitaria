import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ClaseService } from '@services/clase.service';
import { CourseService } from '@services/course.service';

@Component({
  selector: 'app-create-clase',
  templateUrl: './create-clase.component.html',
  styleUrls: ['./create-clase.component.css']
})
export class CreateClaseComponent implements OnInit {

  claseForm;
  messageError: string;
  cursos: any;
  
  constructor(private courseService: CourseService,
              private claseService: ClaseService) 
  {
    this.claseForm = new FormGroup({
      'nombre': new FormControl('', null),
      'descripcion': new FormControl('', null),
      'curso': new FormControl('', null),
    });
    this.messageError = '';
  }

  ngOnInit(): void {
    this.courseService.getAllCourse().subscribe((data) =>{
      this.cursos = data;
    })
  }

  onFormSubmit(){

    const nombre = this.claseForm.get("nombre")?.value;
    const descripcion = this.claseForm.get("descripcion")?.value;
    const id_curso = this.claseForm.get("curso")?.value;

    this.claseService.crearClase(nombre, descripcion, id_curso).subscribe((data) => {
      this.messageError = data;
    }, error => {
      console.log(error);
      this.messageError = "Error al guardar el curso. Intente de nuevo o contacte a su administrador";
    });

  }

}
