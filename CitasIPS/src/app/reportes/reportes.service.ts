import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ReportesService {

  constructor(private http: HttpClient) { }

  obtenerReportes(periodoAcademico: string, tipo: string): Observable<Object[]>{
    switch(tipo) { 
      case "1": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/genero/' + periodoAcademico);
      }
      case "2": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/edad/' + periodoAcademico);
      }
      case "3": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/estrato/' + periodoAcademico);
      }
      case "4": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/programa/' + periodoAcademico);
      }
      case "5": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/servicio_aplicado/' + periodoAcademico);
      }
      case "6": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/servicio_complementario/' + periodoAcademico);
      }
      case "7": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/tipo_personal_salud/' + periodoAcademico);
      }
      case "8": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/desercion_consulta/' + periodoAcademico);
      }
      case "9": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/eps/');
      }
      case "10": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/total_semestre/' + periodoAcademico);
      }
      case "11": { 
        return this.http.get<Object[]>('http://127.0.0.1:8000/api/reportes/seguimiento/' + periodoAcademico);
      }
      default: { 
         return null;
      } 
   }    
  }
}
