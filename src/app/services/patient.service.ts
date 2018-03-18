import { Injectable } from '@angular/core';
import {HttpClient,HttpResponse} from '@angular/common/http';
import {Observable} from 'rxjs/Observable';
import {Patient} from '../models/patient';
@Injectable()
export class PatientService {
   URL : string = 'http://localhost:3000/api.php';
  constructor( private http: HttpClient) { }
  add(patient: Patient) : Observable<Response>{

      return this.http.post<Response>(this.URL+'?callback=addPatient',patient);
     
  }

  getRecords() : Observable<Patient[]> {

    return this.http.post<Patient[]>(this.URL+'?callback=getPatients',null);
    
  }

  deleteRecord(idNumber: string) : Observable<Response> {

    return this.http.post<Response>(this.URL+'?callback=deletePatient',{IdNumber:idNumber});
  }
}
