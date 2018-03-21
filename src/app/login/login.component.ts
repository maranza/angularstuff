import { Component, OnInit } from '@angular/core';
import { Admin } from '../models/admin';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public admin: Admin = new Admin();
  constructor(private authService: AuthService, private route: Router) { }

  ngOnInit() {


    this.route.navigate(['/dashboard']);


  }

  login(): void {

    this.authService.authenticate(this.admin).subscribe(data => {

      if (data['error']) {

        alert(data['error']);
      }

      else {


        if (data['success'] == true) {

          this.route.navigate(['/dashboard']);
        }

        else {

          alert('Invalid Credentials');
        }
      }

    });

  }

}
