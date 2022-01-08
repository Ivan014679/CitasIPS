import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ReportesService } from './reportes.service';
import { AppService } from '../app.service';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';

@Component({
  selector: 'app-reportes',
  templateUrl: './reportes.component.html',
  styleUrls: ['./reportes.component.css']
})
export class ReportesComponent implements OnInit {
  periodoAcademico: string;
  tiposReportes: any;
  tipoReporte: string;
  registros: Object[];

  constructor(private formbuilder: FormBuilder,
    private reportesService: ReportesService,
    private appService: AppService,
    private route: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {
    this.appService.periodoAcademicoActual.subscribe(periodoAcademico => {
      this.periodoAcademico = periodoAcademico;
    });

    this.tiposReportes = this.formbuilder.group({
      tipos_reportes: ['', [Validators.required]],
    });
  }

  cambio(value: string){
    this.tipoReporte = value;
    this.appService.periodoAcademicoActual.subscribe(() => {
      this.reportesService.obtenerReportes(this.periodoAcademico, this.tipoReporte).subscribe((data) => {
        this.registros = data;
      });
    });
  }

  onClick(){
    window.location.href = 'http://127.0.0.1:8000/api/reportes/exportar/' + this.periodoAcademico + ',' + this.tipoReporte;
  }
}
