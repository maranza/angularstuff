import { Injectable } from '@angular/core';
import { HttpClient,HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { Patient } from '../models/patient';
import { Configs } from '../config';
import { catchError, retry } from 'rxjs/operators';
import { throwError } from 'rxjs';
@Injectable()
export class PatientService {
  constructor(private http: HttpClient) { }
  add(patient: Patient): Observable<any> {

    return this.http.post<any>(Configs.URL + 'PatientService', patient).pipe(
      catchError(this.handleError)
    );
  }

  getRecord(uuid: any): Observable<Patient> {

    return this.http.get<Patient>(Configs.URL + 'PatientService?uuid=' + uuid).pipe(
      catchError(this.handleError)
    );
  }

  getRecords(): Observable<Patient[]> {
    return this.http.get<Patient[]>(Configs.URL + 'PatientService').pipe(
      catchError(this.handleError)
    );
  }
  updateRecord(patient: Patient): Observable<any> {
    return this.http.post<any>(Configs.URL + 'PatientService?uuid=' + patient.uuid, patient).pipe(
      catchError(this.handleError)
    );
  }
  deleteRecord(uuid: any): Observable<any> {
    return this.http.delete<any>(Configs.URL + 'PatientService?uuid=' + uuid, {}).pipe(
      catchError(this.handleError)
    );
  }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error.message);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      console.error(
        `Backend returned code ${error.status}, ` +
        `body was: ${error.error}`);
    }
    // return an ErrorObservable with a user-facing error message
    return throwError('Something bad happened; please try again later.');
  }

}
