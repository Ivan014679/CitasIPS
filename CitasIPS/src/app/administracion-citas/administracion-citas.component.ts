import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { AdministracionCitasService } from './administracion-citas.service';
import { PersonalSaludService } from '../personal-salud/personal-salud.service';
import { AppService } from '../app.service';
import { Observable, Subject } from 'rxjs';
import { Cita } from '../otras-clases/cita';
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
  selector: 'app-administracion-citas',
  templateUrl: './administracion-citas.component.html',
  styleUrls: ['./administracion-citas.component.css']
})
export class AdministracionCitasComponent implements OnInit {
  idCita: string;
  cita: Cita;
  citas: Cita[];
  citaSeleccionada: Cita;
  periodoAcademico: string;
  horas: Observable<Object[]>;
  horaPropia: string[];
  parentezcos: Observable<Parentezco[]>;
  estadosSeguimientos: Observable<EstadoSeguimiento[]>;
  serviciosAplicados: Observable<ServicioAplicado[]>;
  personalesSalud: Observable<PersonalSalud[]>;
  tiposPersonalSalud: Observable<TipoPersonalSalud[]>;
  serviciosComplementarios: Observable<ServicioComplementario[]>;
  editarCitaForm: any;
  cols: any[];
  items: MenuItem[];
  tiposIdentificacion: SelectItem[];
  nServicioAplicado: SelectItem[];
  _columnasSeleccionadas: any[];
  rowGroupMetadata: any;

  strqueary: string;

  constructor(private formbuilder: FormBuilder,
    private administracionCitasService: AdministracionCitasService,
    private personalSaludService: PersonalSaludService,
    private appService: AppService,
    private route: ActivatedRoute,
    private router: Router,
    private dialog: MatDialog) { }

  ngOnInit(): void {
    this.cols = [
      { field: 'identificacion', header: 'Identificación' },
      { field: 'tipo_identificacion', header: 'Tipo identificación' },
      { field: 'codigo', header: 'Código' },
      { field: 'fecha_cita', header: 'Fecha' },
      { field: 'hora_cita', header: 'Hora' },
      { field: 'nombre_personal_salud', header: 'Profesional' },
      { field: 'n_servicio_aplicado', header: 'Servicio aplicado' }
    ];
    this._columnasSeleccionadas = this.cols;
    this.items = [
      { label: 'Editar cita', icon: 'fa fa-edit', command: (event) => this.editarCita(this.citaSeleccionada) },
      { label: 'Borrar cita', icon: 'fa fa-trash', command: (event) => this.eliminarCita(this.citaSeleccionada) }
    ];
    this.appService.obtenerTiposIdentificacion().subscribe(data => {
      this.tiposIdentificacion = [];
      for(var i = 0; i < data.length; i++) {
          this.tiposIdentificacion.push({label: data[i].nombre, value: data[i].nombre});
      }
    });
    this.appService.obtenerServiciosAplicados().subscribe(data => {
      this.nServicioAplicado = [];
      for(var i = 0; i < data.length; i++) {
          this.nServicioAplicado.push({label: data[i].nombre, value: data[i].nombre});
      }
    });

    this.editarCitaForm = this.formbuilder.group({
      id: ['', [Validators.required, Validators.minLength(1)]],
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
      this.editarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);      
      this.obtenerPersonalesSalud();
      if(this.periodoAcademico != null){
        this.obtenerCitas();
      }
    });
    this.obtenerParentezcos();
    this.obtenerEstadosSeguimientos();
    this.obtenerServiciosAplicados();    
    this.obtenerTiposPersonalSalud();
    this.obtenerServiciosComplementarios();
  }

  @Input() get columnasSeleccionadas(): any[] {
    return this._columnasSeleccionadas;
  }

  set columnasSeleccionadas(val: any[]) {
    //Restaurar orden original
    this._columnasSeleccionadas = this.cols.filter(col => val.includes(col));
  }

  onSort() {
    this.updateRowGroupMetaData();
  }

  updateRowGroupMetaData() {
    this.rowGroupMetadata = {};
    if (this.citas) {
        for (let i = 0; i < this.citas.length; i++) {
            let rowData = this.citas[i];
            let n_estado_seguimiento = rowData.n_estado_seguimiento;
            if (i == 0) {
                this.rowGroupMetadata[n_estado_seguimiento] = { index: 0, size: 1 };
            }
            else {
                let previousRowData = this.citas[i - 1];
                let previousRowGroup = previousRowData.n_estado_seguimiento;
                if (n_estado_seguimiento === previousRowGroup)
                    this.rowGroupMetadata[n_estado_seguimiento].size++;
                else
                    this.rowGroupMetadata[n_estado_seguimiento] = { index: i, size: 1 };
            }
        }
    }
  }

  onFormSubmit(dataForm: any) {
    dataForm.personal_salud = dataForm.personal_salud.split(",", 2)[0];
    const cita = dataForm;
    this.actualizar(cita);    
  }

  actualizar(cita: Cita) {
    this.administracionCitasService.actualizarCita(cita).subscribe(
      () => {
        this.idCita = null;
        this.horas = null;
        this.horaPropia = null;
        this.editarCitaForm.reset();
        this.editarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);

        this.administracionCitasService.obtenerCitas(this.periodoAcademico).subscribe((data) => {
          this.citas = data;          
          this.updateRowGroupMetaData();

          this.openDialog('Actualización exitosa', 'La cita ha sido actualizada exitosamente.', -1, 'Cerrar', null);
        });
      },
      (error) => {
        this.openDialog('Error', 'Ha ocurrido un error.', -1, 'Cerrar', null);
      }
    );
  }

  obtenerCitas = () => {
    this.administracionCitasService.obtenerCitas(this.periodoAcademico).subscribe((data) => {
      this.citas = data;
      this.updateRowGroupMetaData();
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

  obtenerHorasDisponiblesYPropia = (personalSalud: number, fecha: string, hora: string) => {
    this.horas = this.appService.obtenerHorasDisponiblesYPropia(personalSalud, fecha, hora);
  }

  onClick(){    
    this.idCita = null;
    this.horas = null;
    this.horaPropia = null;
    this.editarCitaForm.reset();
    this.editarCitaForm.controls.id_periodo_academico.setValue(this.periodoAcademico);
  }

  editarCita(cita: Cita){
    this.administracionCitasService.obtenerCita(cita.id.toString()).subscribe((data) => {
      this.cita = data;
      this.idCita = cita.id.toString();
      this.horaPropia = [this.cita.personal_salud.toString(), this.cita.hora_cita];
      this.obtenerHorasDisponiblesYPropia(this.cita.personal_salud, this.cita.fecha_cita, this.cita.hora_cita);
      this.editarCitaForm.setValue({
        id: cita.id,
        acudiente: this.cita.acudiente,
        parentezco: this.cita.parentezco,
        fecha_cita: this.cita.fecha_cita,
        hora_cita: this.cita.hora_cita,
        estado_seguimiento: this.cita.estado_seguimiento,
        personal_salud: this.cita.personal_salud + ',' + this.cita.tipo_personal_salud,
        tipo_personal_salud: this.cita.tipo_personal_salud,
        servicio_aplicado: this.cita.servicio_aplicado,
        servicio_complementario: this.cita.servicio_complementario,
        observaciones: this.cita.observaciones,
        id_periodo_academico: this.cita.id_periodo_academico,
      });
    },
    (error) => {
      this.idCita = null;
      this.horaPropia = null;
      this.openDialog('Error', 'Ha ocurrido un error', -1, 'Cerrar', null);      
    });
  }

  eliminarCita(cita: Cita) {
    const dialogRef: any = this.openDialog('Eliminar cita', '¿Está seguro que desea eliminar esta cita?', 0, 'No', 'Si');
    dialogRef.afterClosed().subscribe(
      data => {
        if (data) {
          this.administracionCitasService.eliminarCita(cita.id.toString()).subscribe((dato) => {
            this.administracionCitasService.obtenerCitas(this.periodoAcademico).subscribe((data) => {
              this.citas = data;          
              this.updateRowGroupMetaData();
    
              this.openDialog('Cita eliminada', 'La cita ha sido eliminada.', -1, 'Cerrar', null);
            });            
          },
            (error) => {
              this.openDialog('Error', 'Ha ocurrido un error', -1, 'Cerrar', null);
          });
        }
      }
    );
  }

  cambioFechaOPersonalSalud(value?: string){
    if(value != null){
      this.editarCitaForm.controls.tipo_personal_salud.setValue(value.split(",", 2)[1]);
    }
    const personalSaludId = this.editarCitaForm.controls.personal_salud.value;
    if(this.editarCitaForm.controls.personal_salud.value.split(",", 2)[0] == this.horaPropia[0]){
      this.obtenerHorasDisponiblesYPropia(personalSaludId.split(",", 2)[0], this.editarCitaForm.controls.fecha_cita.value, this.horaPropia[1]);
    }else{
      this.obtenerHorasDisponibles(personalSaludId.split(",", 2)[0], this.editarCitaForm.controls.fecha_cita.value);
    }
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

    return this.dialog.open(CourseDialogComponent, dialogConfig);
  }
}
