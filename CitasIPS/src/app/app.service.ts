import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject } from 'rxjs';
import { EstadoSeguimiento } from './otras-clases/estado-seguimiento';
import { ModalidadAfiliacion } from './otras-clases/modalidad-afiliacion';
import { Parentezco } from './otras-clases/parentezco';
import { Programa } from './otras-clases/programa';
import { ServicioAplicado } from './otras-clases/servicio-aplicado';
import { ServicioComplementario } from './otras-clases/servicio-complementario';
import { TipoIdentificacion } from './otras-clases/tipo-identificacion';
import { PeriodoAcademico } from './otras-clases/periodo-academico';

@Injectable({
  providedIn: 'root'
})
export class AppService {
  private periodoAcademicoFuente = new BehaviorSubject(null);
  periodoAcademicoActual = this.periodoAcademicoFuente.asObservable();

  constructor(private http: HttpClient) { }

  obtenerPeriodosAcademicos(): Observable<PeriodoAcademico[]>{
    return this.http.get<PeriodoAcademico[]>('http://127.0.0.1:8000/api/periodos_academicos');
  }
  
  periodoAcademicoCambio(periodoAcademico: string) {
    this.periodoAcademicoFuente.next(periodoAcademico);
  }

  obtenerEstadosSeguimientos(): Observable<EstadoSeguimiento[]>{
    return this.http.get<EstadoSeguimiento[]>('http://127.0.0.1:8000/api/estados_seguimientos');
  }

  obtenerModalidadesAfiliacion(): Observable<ModalidadAfiliacion[]>{
    return this.http.get<ModalidadAfiliacion[]>('http://127.0.0.1:8000/api/modalidades_afiliacion');
  }

  obtenerParentezcos(): Observable<Parentezco[]>{
    return this.http.get<Parentezco[]>('http://127.0.0.1:8000/api/parentezcos');
  }

  obtenerProgramas(): Observable<Programa[]>{
    return this.http.get<Programa[]>('http://127.0.0.1:8000/api/programas');
  }

  obtenerServiciosAplicados(): Observable<ServicioAplicado[]>{
    return this.http.get<ServicioAplicado[]>('http://127.0.0.1:8000/api/servicios_aplicados');
  }

  obtenerServiciosComplementarios(): Observable<ServicioComplementario[]>{
    return this.http.get<ServicioComplementario[]>('http://127.0.0.1:8000/api/servicios_complementarios');
  }

  obtenerTiposIdentificacion(): Observable<TipoIdentificacion[]>{
    return this.http.get<TipoIdentificacion[]>('http://127.0.0.1:8000/api/tipos_identificacion');
  }

  obtenerHorasDisponibles(personalSalud: number, fecha: string): Observable<Object[]>{
    if(personalSalud != 0 && fecha != null && fecha != ''){
      return this.http.get<Object[]>('http://127.0.0.1:8000/api/horas_disponibles/' + personalSalud + ',' + fecha);
    }else{
      return null;
    }
  }

  obtenerHorasDisponiblesYPropia(personalSalud: number, fecha: string, hora: string): Observable<Object[]>{
    if(personalSalud != 0 && fecha != null && fecha != '' && hora != null && hora != ''){
      return this.http.get<Object[]>('http://127.0.0.1:8000/api/horas_disponibles_y_propia/' + personalSalud + ',' + fecha + ',' + hora);
    }else{
      return null;
    }    
  }
}
