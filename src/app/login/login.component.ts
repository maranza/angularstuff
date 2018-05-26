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

  public error;

  public admin: Admin = new Admin();
  constructor(private authService: AuthService, private route: Router) {

  }

  ngOnInit() {

  }

  login(): void {

    this.authService.authenticate(this.admin).subscribe(data => {

      if (data['error']) {

        this.error = data['error'];
        // alert(data['error']);
      }

      else {


        if (data['success'] === true) {

          this.route.navigate(['/dashboard']);
          localStorage.setItem('username', this.admin.username);
        }

        else {

          // alert('Invalid Credentials');
          this.error = 'Invalid Credentials';
        }
      }

    });

  }

}
