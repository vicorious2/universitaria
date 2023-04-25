import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ClaseService } from '@services/clase.service';
import { ResourcesService } from '@services/resources.service';
import { TipoRecursoService } from '@services/tipo-recurso.service';

@Component({
  selector: 'app-create-resources',
  templateUrl: './create-resources.component.html',
  styleUrls: ['./create-resources.component.css']
})
export class CreateResourcesComponent implements OnInit {

  resourcesForm;
  messageError: string;
  tipo_recursos: any;
  clases: any;
  
  constructor(private classService: ClaseService,
              private tipoRecursoService: TipoRecursoService,
              private recursosService: ResourcesService) {
    this.resourcesForm = new FormGroup({
      'nombre': new FormControl('', null),
      'ruta': new FormControl('', null),
      'tiporecurso': new FormControl('', null),
      'clase': new FormControl('', null),
    });
    this.messageError = '';
   }

  ngOnInit(): void {

    this.classService.getClases().subscribe((data) => {
      this.clases = data;
    })

    this.tipoRecursoService.getTipoRecursos().subscribe((data) => {
      this.tipo_recursos = data;
    })
 
  }

  onFormSubmit(){

    const nombre = this.resourcesForm.get("nombre")?.value;
    const ruta = this.resourcesForm.get("ruta")?.value;
    const tiporecurso = this.resourcesForm.get("tiporecurso")?.value;
    const clase = this.resourcesForm.get("clase")?.value;

    this.recursosService.crearRecurso(nombre, ruta, tiporecurso, clase).subscribe((data) => {
      this.messageError = data;
    }, error => {
      console.log(error);
      this.messageError = "Error al guardar el curso. Intente de nuevo o contacte a su administrador";
    });

  }

}
