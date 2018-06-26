import { Injectable } from '@angular/core';
import {HttpClient,HttpResponse} from '@angular/common/http';
import {Observable} from 'rxjs/Observable';
import {Patient} from '../models/patient';
import {Configs} from '../config';
@Injectable()
export class PatientService {
  constructor( private http: HttpClient) { }
  add(patient: Patient) : Observable<Response>{

      return this.http.post<Response>(Configs.URL+'?&controller=patient&action=add',patient);
     
  }

  getRecord(uuid: any): Observable<Patient[]>{

    return this.http.post<Patient[]>(Configs.URL+'?controller=patient&action=get',{uuid: uuid});
  }

  getRecords() : Observable<Patient[]> {

    return this.http.post<Patient[]>(Configs.URL+'?controller=patient&action=list',null);

  }

  updateRecord(patient:Patient): Observable<Patient[]>{

    return this.http.post<Patient[]>(Configs.URL+'?controller=patient&action=update',patient);
  }

  deleteRecord(uuid: string) : Observable<Response> {

    return this.http.post<Response>(Configs.URL+'?controller=patient&action=delete',{uuid:uuid});
  }
}
