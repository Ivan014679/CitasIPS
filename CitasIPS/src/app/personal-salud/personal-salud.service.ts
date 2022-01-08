import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { PersonalSalud } from './personal-salud';
import { TipoPersonalSalud } from '../otras-clases/tipo-personal-salud';
import { catchError } from 'rxjs/operators';
import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PersonalSaludService {

  constructor(private http: HttpClient) { }

  obtenerPersonalSalud(periodoAcademico: string): Observable<PersonalSalud[]>{
    return this.http.get<PersonalSalud[]>('http://127.0.0.1:8000/api/personal_salud/' + periodoAcademico);
  }

  obtenerTiposPersonalSalud(): Observable<TipoPersonalSalud[]>{
    return this.http.get<TipoPersonalSalud[]>('http://127.0.0.1:8000/api/tipos_personal_salud');
  }

  obtenerProfesionalUOtro(id: string): Observable<PersonalSalud>{
    return this.http.get<PersonalSalud>('http://127.0.0.1:8000/api/profesionales_otros/' + id).pipe(catchError(this.errorHandler));
  }

  obtenerPracticantes(periodoAcademico: string): Observable<PersonalSalud[]>{
    return this.http.get<PersonalSalud[]>('http://127.0.0.1:8000/api/practicantes/' + periodoAcademico);
  }

  agregarPersonalSalud(personalSalud: PersonalSalud): Observable<PersonalSalud>{
    const httpOptions = { headers: new HttpHeaders({'Content-Type': 'application/json'}) };
    return this.http.post<PersonalSalud>('http://127.0.0.1:8000/api/personal_salud', personalSalud, httpOptions).pipe(catchError(this.errorHandler));
  }

  errorHandler(error: HttpErrorResponse) {
    return throwError(error);
  }
}
