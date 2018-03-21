import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import {RequestOptions} from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Admin } from '../models/admin';
import { Configs } from '../config';

@Injectable()
export class AuthService {
  private status: boolean;

  constructor(private http: HttpClient) { }

  isLoggedIn(): boolean {

    this.http.post<Response>(Configs.URL + '?callback=loggedIn', null)
      .subscribe(data => {

        if (data['error']) {

          this.status = false;
        }

        else if (data['success'] == true) {

          this.status = true;
        }
        else {

          this.status = false;

        }
      });

    return this.status;
  }

  authenticate(AdminDetails: Admin): Observable<Response> {

    return this.http.post<Response>(Configs.URL + '?callback=login', AdminDetails);


  }

  logout(): Observable<Response> {

    return this.http.post<Response>(Configs.URL + '?callback=logout', null);
  }


}
