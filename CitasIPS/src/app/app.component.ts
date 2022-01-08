import { Component } from '@angular/core';
import { Observable } from 'rxjs';
import { AppService } from './app.service';
import { PeriodoAcademico } from './otras-clases/periodo-academico';
import { MatDialog, MatDialogConfig } from "@angular/material/dialog";
import { CourseDialogComponent } from './course-dialog/course-dialog.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  periodosAcademicos: Observable<PeriodoAcademico[]>;
  periodoAcademico: string;
  title = 'CitasIPS';
  constructor(private appService:AppService,
    private dialog: MatDialog) { }

  ngOnInit(){
    this.obtenerPeriodosAcademicos(); 
    this.appService.periodoAcademicoActual.subscribe(periodoAcademico => {
      this.periodoAcademico = periodoAcademico;      
    });
  }

  obtenerPeriodosAcademicos = () => {
    this.periodosAcademicos=this.appService.obtenerPeriodosAcademicos();
    this.periodosAcademicos.subscribe((data) => {
      data.forEach(element => this.periodoAcademicoActual(element));
    });
  }

  periodoAcademicoActual(periodoAcademico: PeriodoAcademico){
    if(periodoAcademico.anio == new Date().getFullYear()){
      if((periodoAcademico.periodo == 1 && new Date().getMonth() >= 0 && new Date().getMonth() <= 5) || (periodoAcademico.periodo == 2 && new Date().getMonth() >= 6 && new Date().getMonth() <= 11)){
        this.periodoAcademico = periodoAcademico.id.toString();
        this.appService.periodoAcademicoCambio(this.periodoAcademico);
        return;
      }
    }
  }

  onChange(){
    this.appService.periodoAcademicoCambio(this.periodoAcademico);
  }

  acercaDe(){
    this.openDialog('Acerca de', 'CONTROL CITAS IPS v. 0.1<br /><br /><br />DIRECTOR:&nbsp;Gustavo Willyn Sánchez Rodríguez,&nbsp;gwsanchez@unicesmag.edu.co<br />PROGRAMADOR:&nbsp;Iván Camilo Narváez Vanegas<br /><br /><br />JEFATURA DE DESARROLLO DE SOFTWARE.', -1, 'Cerrar', null);
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
