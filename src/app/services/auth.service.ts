import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse, HttpErrorResponse } from '@angular/common/http';
import { RequestOptions } from '@angular/http';
import { Observable} from 'rxjs/Observable';
import { ErrorObservable } from 'rxjs/observable/ErrorObservable';
import { Admin } from '../models/admin';
import { Configs } from '../config';
import { catchError, retry } from 'rxjs/operators';
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

    return this.http.post<Response>(Configs.URL + 'AuthenticationService', AdminDetails).pipe(
      catchError(this.handleError)
    );
  }

  logout(): Observable<Response> {
    localStorage.clear();
    return this.http.get<Response>(Configs.URL + 'AuthenticationService?logout=true').pipe(
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
        `body was: ${error.error.success}`);
        if (error.error.success === false) {
          return new ErrorObservable('Invalid Username or Password');
        }else {
          return new ErrorObservable(error.error.msg);
        }
    }
    // return an ErrorObservable with a user-facing error message
    return new ErrorObservable(
      'Something bad happened; please try again later.');
  }


}
