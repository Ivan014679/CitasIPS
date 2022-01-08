import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Paciente } from '../pacientes/paciente';
import { Cita } from '../otras-clases/cita';
import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegistroCitasService {  

  constructor(private http: HttpClient) { }

  obtenerPacientes(): Observable<Paciente[]>{
    return this.http.get<Paciente[]>('http://127.0.0.1:8000/api/pacientes');
  }

  registrarCita(cita:Cita): Observable<Cita>{
    const httpOptions = { headers: new HttpHeaders({'Content-Type': 'application/json'}) };
    return this.http.post<Cita>('http://127.0.0.1:8000/api/citas', cita, httpOptions).pipe(catchError(this.errorHandler));
  }

  errorHandler(error: HttpErrorResponse) {
    return throwError(error);
  }
}
