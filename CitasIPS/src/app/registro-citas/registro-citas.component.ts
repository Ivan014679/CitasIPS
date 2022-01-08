import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { RegistroCitasService } from './registro-citas.service';
import { PersonalSaludService } from '../personal-salud/personal-salud.service';
import { AppService } from '../app.service';
import { Observable, Subject } from 'rxjs';
import { Cita } from '../otras-clases/cita';
import { Paciente } from '../pacientes/paciente';
import { Parentezco } from '../otras-clases/parentezco';
import { EstadoSeguimiento } from '../otras-clases/estado-seguimiento';
import { ServicioAplicado } from '../otras-clases/servicio-aplicado';
import { PersonalSalud } from '../personal-salud/personal-salud';
import { TipoPersonalSalud } from '../otras-clases/tipo-personal-salud';
import { ServicioComplementario } from '../otras-clases/servicio-complementario';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';
import { formatDate } from '@angular/common';
import { MatDialog, MatDialogConfig } from "@angular/material/dialog";
import { CourseDialogComponent } from '../course-dialog/course-dialog.component';
import { MenuItem, SelectItem } from 'primeng/api';

@Component({
  selector: 'app-registro-citas',
  templateUrl: './registro-citas.component.html',
  styleUrls: ['./registro-citas.component.css']
})
export class RegistroCitasComponent implements OnInit {
  idPaciente: string;
  cita: Cita;
  pacientes: Paciente[];
  pacienteSeleccionado: Paciente;
  periodoAcademico: string;
  horas: Observable<Object[]>;
  parentezcos: Observable<Parentezco[]>;
  estadosSeguimientos: Observable<EstadoSeguimiento[]>;
  serviciosAplicados: Observable<ServicioAplicado[]>;
  personalesSalud: Observable<PersonalSalud[]>;
  tiposPersonalSalud: Observable<TipoPersonalSalud[]>;
  serviciosComplementarios: Observable<ServicioComplementario[]>;
  registrarCitaForm: any;
  cols: any[];
  items: MenuItem[];
  tiposIdentificacion: SelectItem[];
  _columnasSeleccionadas: any[];
  strqueary: string;

  constructor(private formbuilder: FormBuilder,
    private registroCitasService: RegistroCitasService,
    private appService: AppService,
    private personalSaludService: PersonalSaludService,
    private route: ActivatedRoute,
    private router: Router,
    private dialog: MatDialog) {  }

  ngOnInit() {
    this.cols = [
      { field: 'identificacion', header: 'Identificación' },
      { field: 'tipo_identificacion', header: 'Tipo identificación' },
      { field: 'codigo', header: 'Código' },
      { field: 'nombres', header: 'Nombres' },
      { field: 'apellidos', header: 'Apellidos' }
    ];
    this._columnasSeleccionadas = this.cols;
    this.items = [
      { label: 'Reservar cita', icon: 'fa fa-plus-circle', command: (event) => this.reservarCita(this.pacienteSeleccionado) }
    ];
    this.appService.obtenerTiposIdentificacion().subscribe(data => {
      this.tiposIdentificacion = [];
      for(var i = 0; i < data.length; i++) {
          this.tiposIdentificacion.push({label: data[i].nombre, value: data[i].nombre});
      }
    });

    this.registrarCitaForm = this.formbuilder.group({
      id_paciente: ['', [Validators.required, Validators.minLength(1)]],
      acudiente: ['', [Validators.required, Validators.minLength(1)]],
      parentezco: ['', [Validators.required, Validators.minLength(1)]],
      fecha_cita: ['', [Validators.required, Validators.minLength(1)]],
      hora_cita: ['', [Validators.required, Validators.minLength(1)]],
      estado_seguimiento: ['', [Validators.required, Validators.minLength(1)]],
      personal_salud: ['', [Validators.required, Validators.minLength(1)]],
      tipo_personal_salud: ['', [Validators.required, Validators.minLength(1)]],
      servicio_aplicado: ['', [Validators.required, Validators.minLength(1)]],
      servicio_complementario: ['', [Validators.required, Validators.minLength(1)]],
      observaciones: ['', [Validators.maxLength(5000)]],
      id_periodo_academico: ['', [Validators.required, Validators.minLength(1)]],
    });

    this.appService.periodoAcademicoActual.subscribe(periodoAcademico => {
      this.periodoAcademico = periodoAcademico;
      this.registrarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
      this.obtenerPersonalesSalud();
    });
    this.obtenerPacientes();
    this.obtenerParentezcos();
    this.obtenerEstadosSeguimientos();
    this.obtenerServiciosAplicados();    
    this.obtenerTiposPersonalSalud();
    this.obtenerServiciosComplementarios();

    this.route.params.subscribe(params => {
      if(params.id != null){
        this.idPaciente = params.id;
        this.registrarCitaForm.controls.id_paciente.setValue(this.idPaciente);
      }      
    });
  }

  @Input() get columnasSeleccionadas(): any[] {
    return this._columnasSeleccionadas;
  }

  set columnasSeleccionadas(val: any[]) {
    //Restaurar orden original
    this._columnasSeleccionadas = this.cols.filter(col => val.includes(col));
  }

  onFormSubmit(dataForm: any) {
    dataForm.personal_salud = dataForm.personal_salud.split(",", 2)[0];
    const cita = dataForm;
    this.registrar(cita);    
  }

  registrar(cita: Cita) {
    this.registroCitasService.registrarCita(cita).subscribe(
      () => {
        this.idPaciente = null;
        this.horas = null;
        this.registrarCitaForm.reset();
        this.registrarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
        this.openDialog('Registro exitoso', 'La cita ha sido reservada exitosamente.', -1, 'Cerrar', null);
      },
      (error) => {
        this.openDialog('Error', 'Ha ocurrido un error.', -1, 'Cerrar', null);
      }
    );
  }

  obtenerPacientes = () => {
    this.registroCitasService.obtenerPacientes().subscribe((data) => {
      this.pacientes = data;
    });
  }

  obtenerParentezcos = () => {
    this.parentezcos = this.appService.obtenerParentezcos();
  }

  obtenerEstadosSeguimientos = () => {
    this.estadosSeguimientos = this.appService.obtenerEstadosSeguimientos();
  }

  obtenerServiciosAplicados = () => {
    this.serviciosAplicados = this.appService.obtenerServiciosAplicados();
  }

  obtenerPersonalesSalud = () => {
    this.personalesSalud = this.personalSaludService.obtenerPersonalSalud(this.periodoAcademico);
  }

  obtenerTiposPersonalSalud = () => {
    this.tiposPersonalSalud = this.personalSaludService.obtenerTiposPersonalSalud();
  }

  obtenerServiciosComplementarios = () => {
    this.serviciosComplementarios = this.appService.obtenerServiciosComplementarios();
  }

  obtenerHorasDisponibles = (personalSalud: number, fecha: string) => {
    this.horas = this.appService.obtenerHorasDisponibles(personalSalud, fecha);
  }

  reservarCita(paciente: Paciente){
    this.idPaciente = paciente.id.toString();
    this.registrarCitaForm.controls.id_paciente.setValue(this.idPaciente);
  }

  onClick() {
    this.idPaciente = null;
    this.horas = null;
    this.registrarCitaForm.reset();
    this.registrarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
  }

  cambioFechaOPersonalSalud(value?: string){    
    if(value != null){
      this.registrarCitaForm.controls.tipo_personal_salud.setValue(value.split(",", 2)[1]);
    }
    const personalSaludId = this.registrarCitaForm.controls.personal_salud.value;
    this.obtenerHorasDisponibles(personalSaludId.split(",", 2)[0], this.registrarCitaForm.controls.fecha_cita.value);
  }

  diaActual() {
    return formatDate(Date.now(), 'yyyy-MM-dd', 'en');
  }

  finAnio() {
    return formatDate(new Date().getFullYear() + '12-31', 'yyyy-MM-dd', 'en');
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
