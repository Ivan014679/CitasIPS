import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Paciente } from './paciente';
import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PacientesService {

  constructor(private http: HttpClient) { }

  obtenerEstudiante(id: string, type: string): Observable<Paciente>{
    return this.http.get<Paciente>('http://127.0.0.1:8000/api/estudiantes/' + id + ',' + type).pipe(catchError(this.errorHandler));
  }

  registrarPaciente(paciente:Paciente): Observable<Paciente>{
    const httpOptions = { headers: new HttpHeaders({'Content-Type': 'application/json'}) };  
    return this.http.post<Paciente>('http://127.0.0.1:8000/api/pacientes', paciente, httpOptions).pipe(catchError(this.errorHandler));
  }

  obtenerPaciente(id: number): Observable<Paciente>{
    return this.http.get<Paciente>('http://127.0.0.1:8000/api/pacientes/' + id).pipe(catchError(this.errorHandler));
  }

  errorHandler(error: HttpErrorResponse) {
    return throwError(error);
  }
}
