import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { PacientesService } from './pacientes.service';
import { AppService } from '../app.service';
import { Observable } from 'rxjs';
import { Paciente } from './paciente';
import { TipoIdentificacion } from '../otras-clases/tipo-identificacion';
import { Programa } from '../otras-clases/programa';
import { ModalidadAfiliacion } from '../otras-clases/modalidad-afiliacion';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';
import { formatDate } from '@angular/common';
import { MatDialog, MatDialogConfig } from "@angular/material/dialog";
import { CourseDialogComponent } from '../course-dialog/course-dialog.component';

@Component({
  selector: 'app-pacientes',
  templateUrl: './pacientes.component.html',
  styleUrls: ['./pacientes.component.css']
})
export class PacientesComponent implements OnInit {
  estudiante: Paciente;
  tiposIdentificacion: Observable<TipoIdentificacion[]>;
  programas: Observable<Programa[]>;
  modalidadesAfiliacion: Observable<ModalidadAfiliacion[]>;
  registrarPacienteForm: any;
  strqueary: string;
  constructor(private formbuilder: FormBuilder,
    private pacientesService: PacientesService,
    private appService: AppService,
    private route: ActivatedRoute,
    private router: Router,
    private dialog: MatDialog) { }

  ngOnInit() {
    this.obtenerTiposIdentificacion();
    this.obtenerProgramas();
    this.obtenerModalidadesAfiliacion();
    this.registrarPacienteForm = this.formbuilder.group({
      identificacion: ['', [Validators.required, Validators.maxLength(30), Validators.minLength(1)]],
      codigo: ['', [Validators.required, Validators.maxLength(20), Validators.minLength(1)]],
      expedicion: ['', [Validators.required, Validators.minLength(1)]],
      tipo_identificacion: ['', [Validators.required, Validators.minLength(1)]],
      nombres: ['', [Validators.required, Validators.minLength(1)]],
      apellidos: ['', [Validators.required, Validators.minLength(1)]],
      genero: ['', [Validators.required, Validators.minLength(1)]],
      fecha_nacimiento: ['', [Validators.required, Validators.minLength(1)]],
      edad: ['', [Validators.required, Validators.minLength(1)]],
      telefono: ['', [Validators.required, Validators.minLength(1)]],
      celular: ['', [Validators.required, Validators.minLength(1)]],
      correo_electronico: ['', [Validators.required, Validators.minLength(1)]],
      direccion: ['', [Validators.required, Validators.minLength(1)]],
      barrio: ['', [Validators.required, Validators.minLength(1)]],
      estrato: ['', [Validators.required, Validators.minLength(1)]],
      programa: ['', [Validators.required, Validators.minLength(1)]],
      semestre: ['', [Validators.required, Validators.minLength(1)]],
      eps: ['', [Validators.required, Validators.minLength(1)]],
      modalidad_afiliacion: ['', [Validators.required, Validators.minLength(1)]],
      id_estudiante: ['', [Validators.required, Validators.minLength(1)]],
    });
  }

  onFormSubmit(dataForm: any) {
    const paciente = dataForm;
    this.registrar(paciente);    
  }

  registrar(paciente: Paciente) {
    this.pacientesService.registrarPaciente(paciente).subscribe(
      () => {
        this.pacientesService.obtenerPaciente(this.estudiante.id_estudiante).subscribe(data => {
          this.registrarPacienteForm.reset();
          this.openDialog('Paciente registrado', 'El paciente ha sido registrado exitosamente.<br />¿Le gustaría ir a reservar una cita?', data.id, 'No', 'Si');
        });        
      },
      (error) => {
        if(error.error.detail.match('llave duplicada')){
          this.openDialog('Error', 'El estudiante ya se encuentra registrado como paciente.', -1, 'Cerrar', null);
        }
      }
    );
  }

  obtenerEstudiante = (id: string, type: string) => {
    this.pacientesService.obtenerEstudiante(id, type).subscribe((data) => {
      this.estudiante = data;
      this.registrarPacienteForm.setValue({
        identificacion: this.estudiante.identificacion,
        codigo: this.estudiante.codigo,
        expedicion: this.estudiante.expedicion,
        tipo_identificacion: this.estudiante.tipo_identificacion,
        nombres: this.estudiante.nombres,
        apellidos: this.estudiante.apellidos,
        genero: this.estudiante.genero,
        fecha_nacimiento: this.estudiante.fecha_nacimiento,
        edad: Math.floor(Math.abs(Date.now() - new Date(this.estudiante.fecha_nacimiento).getTime()) / (1000 * 3600 * 24) / 365.25),
        telefono: this.estudiante.telefono,
        celular: this.estudiante.celular,
        correo_electronico: this.estudiante.correo_electronico,
        direccion: this.estudiante.direccion,
        barrio: this.estudiante.barrio,
        estrato: this.estudiante.estrato,
        programa: this.estudiante.programa,
        semestre: this.estudiante.semestre,
        eps: '',
        modalidad_afiliacion: '',
        id_estudiante: this.estudiante.id_estudiante,
      });
    },
      (error) => {
        this.openDialog('Error', 'El estudiante no existe.', -1, 'Cerrar', null);
      });
  }

  obtenerTiposIdentificacion = () => {
    this.tiposIdentificacion = this.appService.obtenerTiposIdentificacion();
  }

  obtenerProgramas = () => {
    this.programas = this.appService.obtenerProgramas();
  }

  obtenerModalidadesAfiliacion = () => {
    this.modalidadesAfiliacion = this.appService.obtenerModalidadesAfiliacion();
  }

  diaActual() {
    return formatDate(Date.now(), 'yyyy-MM-dd', 'en');
  }

  onClick() {
    if ((this.registrarPacienteForm.controls.identificacion.value == null || this.registrarPacienteForm.controls.identificacion.value == "") && (this.registrarPacienteForm.controls.codigo.value == null || this.registrarPacienteForm.controls.codigo.value == "")) {
      this.openDialog('Error', 'No ha digitado el número de identificación ni el código del estudiante.', -1, 'Cerrar', null);
    } else if ((this.registrarPacienteForm.controls.identificacion.value != null && this.registrarPacienteForm.controls.identificacion.value != "") && (this.registrarPacienteForm.controls.codigo.value == null || this.registrarPacienteForm.controls.codigo.value == "")) {
      this.obtenerEstudiante(this.registrarPacienteForm.controls.identificacion.value, 'id');
    } else {
      this.obtenerEstudiante(this.registrarPacienteForm.controls.codigo.value, 'cod');
    }
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
