import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Cita } from '../otras-clases/cita';
import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AdministracionCitasService {

  constructor(private http: HttpClient) { }

  obtenerCitas(periodoAcademico: string): Observable<Cita[]>{
    return this.http.get<Cita[]>('http://127.0.0.1:8000/api/citas/' + periodoAcademico);
  }

  obtenerCita(id: string): Observable<Cita>{
    return this.http.get<Cita>('http://127.0.0.1:8000/api/cita/' + id).pipe(catchError(this.errorHandler));
  }

  actualizarCita(cita: Cita): Observable<Cita>{
    const httpOptions = { headers: new HttpHeaders({'Content-Type': 'application/json'}) };
    return this.http.put<Cita>('http://127.0.0.1:8000/api/cita/' + cita.id, cita, httpOptions).pipe(catchError(this.errorHandler));
  }

  eliminarCita(id: string): Observable<string>{
    return this.http.delete<string>('http://127.0.0.1:8000/api/cita/' + id).pipe(catchError(this.errorHandler));
  }

  errorHandler(error: HttpErrorResponse) {
    return throwError(error);
  }
}
