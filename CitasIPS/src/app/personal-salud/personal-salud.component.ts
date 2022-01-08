import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { PersonalSaludService } from './personal-salud.service';
import { AppService } from '../app.service';
import { Observable, Subject } from 'rxjs';
import { PersonalSalud } from './personal-salud';
import { TipoPersonalSalud } from '../otras-clases/tipo-personal-salud';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';
import { MatDialog, MatDialogConfig } from "@angular/material/dialog";
import { CourseDialogComponent } from '../course-dialog/course-dialog.component';
import { SelectItem } from 'primeng/api';

@Component({
  selector: 'app-personal-salud',
  templateUrl: './personal-salud.component.html',
  styleUrls: ['./personal-salud.component.css']
})
export class PersonalSaludComponent implements OnInit {
  vaAgregarPersonalSalud: boolean = false;
  tipoPersonalSalud: number;
  periodoAcademico: string;
  personalSaludForm: any;
  tiposPersonalSalud: Observable<TipoPersonalSalud[]>;
  personalesSalud: PersonalSalud[];
  practicantes: PersonalSalud[];
  profesionalSeleccionado: PersonalSalud;
  cols: any[];
  cols2: any[];
  tiposIdentificacion: SelectItem[];
  tPersonalSalud: SelectItem[];
  _columnasSeleccionadas: any[];
  _columnasSeleccionadas2: any[];

  constructor(private formbuilder: FormBuilder,
    private personalSaludService: PersonalSaludService,
    private appService: AppService,
    private route: ActivatedRoute,
    private router: Router,
    private dialog: MatDialog) { }

  ngOnInit(): void {
    this.cols = [
      { field: 'identificacion', header: 'Identificación' },
      { field: 'tipo_identificacion', header: 'Tipo identificación' },
      { field: 'nombres', header: 'Nombres' },
      { field: 'apellidos', header: 'Apellidos' },
      { field: 'n_tipo_personal_salud', header: 'Tipo profesional' }
    ];
    this.cols2 = [
      { field: 'identificacion', header: 'Identificación' },
      { field: 'tipo_identificacion', header: 'Tipo identificación' },
      { field: 'nombres', header: 'Nombres' },
      { field: 'apellidos', header: 'Apellidos' },
      { field: 'fecha_inicio', header: 'Fecha inicio' },
      { field: 'fecha_fin', header: 'Fecha fin' }
    ];
    this._columnasSeleccionadas = this.cols;
    this._columnasSeleccionadas2 = this.cols2;
    this.appService.obtenerTiposIdentificacion().subscribe(data => {
      this.tiposIdentificacion = [];
      for(var i = 0; i < data.length; i++) {
          this.tiposIdentificacion.push({label: data[i].nombre, value: data[i].nombre});
      }
    });
    this.personalSaludService.obtenerTiposPersonalSalud().subscribe(data => {
      this.tPersonalSalud = [];
      for(var i = 0; i < data.length; i++) {
          this.tPersonalSalud.push({label: data[i].nombre, value: data[i].nombre});
      }
    });

    this.personalSaludForm = this.formbuilder.group({
      id_persona: ['', [Validators.required]],
      id_periodo_academico: ['', [Validators.required]],
      tipo_personal_salud: ['', [Validators.required]],
      identificacion: [''],
      tipo_identificacion: [''],
      nombres: [''],
    });

    this.appService.periodoAcademicoActual.subscribe(periodoAcademico => {
      this.periodoAcademico = periodoAcademico;
      this.personalSaludForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
      if(this.periodoAcademico != null){
        this.obtenerPersonalesSalud();
        this.obtenerPracticantes();
      }
    });

    this.obtenerTiposPersonalSalud();
  }

  @Input() get columnasSeleccionadas(): any[] {
    return this._columnasSeleccionadas;
  }

  set columnasSeleccionadas(val: any[]) {
    //Restaurar orden original
    this._columnasSeleccionadas = this.cols.filter(col => val.includes(col));
  }

  @Input() get columnasSeleccionadas2(): any[] {
    return this._columnasSeleccionadas2;
  }

  set columnasSeleccionadas2(val: any[]) {
    //Restaurar orden original
    this._columnasSeleccionadas2 = this.cols2.filter(col => val.includes(col));
  }

  obtenerPersonalesSalud = () => {
    this.personalSaludService.obtenerPersonalSalud(this.periodoAcademico).subscribe((data) => {
      this.personalesSalud = data;
    });
  }

  obtenerTiposPersonalSalud = () => {
    this.tiposPersonalSalud = this.personalSaludService.obtenerTiposPersonalSalud();
  }

  onFormSubmit(dataForm: any) {
    const personalSalud = dataForm;
    this.agregar(personalSalud); 
  }

  agregar(personalSalud: PersonalSalud) {
    this.personalSaludService.agregarPersonalSalud(personalSalud).subscribe(
      () => {
        this.tipoPersonalSalud = 0;
        this.vaAgregarPersonalSalud = false;
        this.personalSaludForm.reset();
        this.personalSaludForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
        
        this.personalSaludService.obtenerPersonalSalud(this.periodoAcademico).subscribe((data) => {
          this.personalesSalud = data;

          this.openDialog('Registro exitoso', 'El profesional ha sido agregado exitosamente.', -1, 'Cerrar', null);
        });
      },
      (error) => {
        this.openDialog('Error', error.error.detail, -1, 'Cerrar', null);
      }
    );
  }

  cambio(value: number){
    this.tipoPersonalSalud = value;
    this.personalSaludForm.controls.id_persona.setValue(null);
    this.personalSaludForm.controls.identificacion.setValue(null);
    this.personalSaludForm.controls.tipo_identificacion.setValue(null);
    this.personalSaludForm.controls.nombres.setValue(null);

    /*if(value == 1){
      this.obtenerPracticantes();
    }*/
  }

  onClickAgregar(){
    this.vaAgregarPersonalSalud = true;
  }

  onClickAtras(){
    this.vaAgregarPersonalSalud = false;
  }

  buscar(){
    if (this.personalSaludForm.controls.identificacion.value == null || this.personalSaludForm.controls.identificacion.value == "") {
      this.openDialog('Error', 'No ha digitado el número de identificación del profesional.', -1, 'Cerrar', null);
    }else{
      this.obtenerProfesionalUOtro(this.personalSaludForm.controls.identificacion.value);
    }
  }

  obtenerProfesionalUOtro = (id: string) => {
    this.personalSaludService.obtenerProfesionalUOtro(id).subscribe((data) => {
      this.personalSaludForm.controls.id_persona.setValue(data.id_persona);
      this.personalSaludForm.controls.tipo_identificacion.setValue(data.tipo_identificacion);
      this.personalSaludForm.controls.nombres.setValue(data.nombres + ' ' + data.apellidos);
    },
      (error) => {
        this.openDialog('Error', 'El profesional no existe.', -1, 'Cerrar', null);
      });
  }

  obtenerPracticantes = () => {
    this.personalSaludService.obtenerPracticantes(this.periodoAcademico).subscribe((data) => {
      this.practicantes = data;
    });
  }

  filaSeleccionada(event) {
    this.personalSaludForm.controls.id_persona.setValue(event.data.id_persona);
    this.personalSaludForm.controls.identificacion.setValue(event.data.identificacion);
    this.personalSaludForm.controls.nombres.setValue(event.data.nombres + ' ' + event.data.apellidos);
  }

  filaDeseleccionada(event) {
    this.personalSaludForm.controls.id_persona.setValue(null);
    this.personalSaludForm.controls.identificacion.setValue(null);
    this.personalSaludForm.controls.tipo_identificacion.setValue(null);
    this.personalSaludForm.controls.nombres.setValue(null);
  }

  openDialog(titulo: string, mensaje: string, tipo: number, boton1: string, boton2: string) {
    const dialogConfig = new MatDialogConfig();

    dialogConfig.autoFocus = false;
    dialogConfig.data = {
      titulo: titulo,
      mensaje: mensaje,
      tipo: tipo,
      boton1: boton1,
      boton2: boton2,
    };

    this.dialog.open(CourseDialogComponent, dialogConfig);
  }
}
