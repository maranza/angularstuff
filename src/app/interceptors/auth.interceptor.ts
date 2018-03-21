
import {Injectable} from '@angular/core';
import {HttpInterceptor,HttpRequest,HttpHandler} from '@angular/common/http';
@Injectable()
export class AuthInterceptor implements HttpInterceptor {

  constructor() {}

  intercept(req: HttpRequest<any>, next: HttpHandler) {
    // add withCredentials to every request 
    const authReq = req.clone({
      withCredentials: true,
    });

    // send cloned request with header to the next handler.
    return next.handle(authReq);
  }
}