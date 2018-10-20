import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Admin } from '../models/admin';
import { Configs } from '../config';

@Injectable()
export class AuthService {
  private status: boolean;

  constructor(private http: HttpClient) { }
  /**
   * check if user is logged in
   **/
  isLoggedIn(): boolean {

    if (localStorage.getItem('username')) {
      return true;
    } else {
      return false;
    }
  }

  authenticate(AdminDetails: Admin): Observable<Response> {

    return this.http.post<Response>(Configs.URL + '?controller=authenticate&action=login', AdminDetails);
  }

  logout(): Observable<Response> {
    localStorage.clear();
    return this.http.post<Response>(Configs.URL + '?controller=authenticate&action=logout', null);
  }


}
